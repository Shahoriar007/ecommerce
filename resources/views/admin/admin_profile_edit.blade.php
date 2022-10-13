@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="container-full">

		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Edit Admin Profile</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">

					<form method="post" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
						@csrf

					  <div class="row">
						<div class="col-12">	
							
						<div class="row">
								<div class="col-md-6">

								<div class="form-group">

									<h5>Admin User Name<span class="text-danger">*</span></h5>

									<div class="controls">
										<input type="text" name="name" class="form-control" required="" value="{{ $editData->name }}">
									</div>
								</div>

								</div>

								<div class="col-md-6">

									<div class="form-group">
										
										<h5>Admin Email<span class="text-danger">*</span></h5>

										<div class="controls">
											<input type="email" name="email" class="form-control" required="" value="{{ $editData->email }}">
										</div>
									</div>
								
								</div>
						</div>

						<div class="row">
								<div class="col-md-6">
							
									<div class="form-group">
										<h5>Profile Image <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="file" name="profile_photo_path" class="form-control" id="image" required=""> 
											
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<img id="showImage" src="{{ (!empty($adminData->profile_photo_path))?
                        			url('upload/admin_images/'.$adminData->profile_photo_path):url('upload/no_image.jpg') }}" 
									style="width: 100px; height: 100px">

								</div>
							
						</div>
						
					  </div>
						
						<div class="text-xs-right">
							<button type="submit" class="btn btn-rounded btn-info">Submit</button>
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
		<!-- /.content -->
	  </div>


<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>

@endsection 