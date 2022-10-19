@extends('admin.admin_master')
@section('admin')


	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
		  <div class="row"> 

            <!-- Add Brand Page -->

            <div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title"> Edit Brand</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                    <form method="post" action="{{ route('brand.update',$brand->id) }}" enctype="multipart/form-data">
						@csrf

                        <input type="hidden" name="id" value="{{ $brand->id }}">
                        <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">

                        <div class="form-group">
                            <h5>Brand Name English<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="brand_name_en" class="form-control" value="{{ $brand->brand_name_en}}">

                                @error('brand_name_en')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Brand Name Hindi<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="brand_name_hin" class="form-control" value="{{ $brand->brand_name_hin}}">

                                @error('brand_name_hin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Confirm Password<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="file" name="brand_image" class="form-control" >

                                @error('brand_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
						
						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
						</div>

					</form>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->

			  <!-- /.box -->          
			</div>

		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  

@endsection