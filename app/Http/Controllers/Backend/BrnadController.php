<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrnadController extends Controller
{
    public function BrandView(){

        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }

    public function BrandStore(Request $request){

        $request->validate([

            // Validation 

            'brand_name_en' => 'required',
            'brand_name_hin' => 'required',
            'brand_image' => 'required',

        ],[
            // Custom error msg
            'brand_name_en.required' => 'Input Brand English Name',
            'brand_name_hin.required' => 'Input Brand English Name',
         ]);

        //  Image name genarate, resize and save in a folder
         $image = $request->file('brand_image');
         $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
         Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
         $save_url = 'upload/brand/'.$name_gen;

        //  Insert others field in database
         Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_hin' => $request->brand_name_hin,
            'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)),
            'brand_slug_hin' => str_replace(' ','-',$request->brand_name_hin),
            'brand_image' => $save_url,
         ]);

        // Show a toster msg
        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );

        // return redirect to same page
        return redirect()->back()->with($notification);

    }

    public function BrandEdit($id){
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit',compact('brand'));
    }

    public function BrandUpdate(Request $request){
        $brand_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('brand_image')) {

            // Unlink a image
                unlink($old_img);
            //  Image name genarate, resize and save in a folder
                $image = $request->file('brand_image');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
                $save_url = 'upload/brand/'.$name_gen;

                //  Update others field in database
                Brand::findOrFail($brand_id)->update([
                    'brand_name_en' => $request->brand_name_en,
                    'brand_name_hin' => $request->brand_name_hin,
                    'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)),
                    'brand_slug_hin' => str_replace(' ','-',$request->brand_name_hin),
                    'brand_image' => $save_url,
                ]);

                // Show a toster msg
                $notification = array(
                    'message' => 'Brand Updated Successfully',
                    'alert-type' => 'info'
                );

                // return redirect to same page
                return redirect()->route('all.brand')->with($notification);

        }else{

            //  Update others field in database
            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_hin' => $request->brand_name_hin,
                'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)),
                'brand_slug_hin' => str_replace(' ','-',$request->brand_name_hin),
            ]);

            // Show a toster msg
            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'info'
            );

            // return redirect to same page
            return redirect()->route('all.brand')->with($notification);

        }
    }

    public function BrandDelete($id){

        // delete img from folder
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);

        // delete the record
        Brand::findOrFail($id)->delete();

        // Show a toster msg
        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'info'
        );

        // return redirect to same page
        return redirect()->back()->with($notification);
    }
    
}
