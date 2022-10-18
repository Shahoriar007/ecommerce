<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrnadController extends Controller
{
    public function BrandView(){

        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }

    public function BrandStore(){

    }
    
}
