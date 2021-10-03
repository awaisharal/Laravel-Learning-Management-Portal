@extends('student.partials.layout')

@section('meta')

<title>Student Profile | {{config('app.name')}}</title>

@endsection

@section('css')

@endsection

@section('main_content')
<div class="col-lg-9 col-md-8 col-12">
	<div class="card">
		<!-- Card header -->
		<div class="card-header">
			<h3 class="mb-0">Profile Details</h3>
			<p class="mb-0">
				You have full control to manage your own account setting.
			</p>
		</div>
		<div style="padding-left: 20px;padding-right: 20px;">
		@if(count($errors) > 0)
			@if($errors->first() == 'DPSuccess')
				<div class="alert alert-success">
					Profile picture updated successfully.
				</div>
			@elseif($errors->first() == 'error')
				<div class="alert alert-warning">
					Something went wrong. Please try again later.
				</div>
			@endif
		@endif
		</div>
		<!-- Card body -->
		<div class="card-body">
			<div class="d-lg-flex align-items-center justify-content-between">
				<div class="d-flex align-items-center mb-4 mb-lg-0">
					@if($user->img == null || $user->img == "")
					<img src="../assets/images/avatar/avatar-3.jpg" id="img-uploaded" class="avatar-xl rounded-circle" alt="" />
					@else
					<img src="uploads/profiles/students/{{$user->img}}" id="img-uploaded" class="avatar-xl rounded-circle" alt="" />
					@endif
					<div class="ms-3">
						<h4 class="mb-0">Your avatar</h4>
						<p class="mb-0">
							PNG or JPG no bigger than 800px wide and tall.
						</p>
					</div>
				</div>
				<div style="display: flex;">
					<form action="" method="post" enctype="multipart/form-data">
						<input type="file" name="profile_pic" id="profile_pic" style="display:none;" />
					</form>
					<a class="btn btn-outline-white btn-sm" id="chooseFile" style="margin-right:10px;">Update</a>
					<form action="{{route('instructor.deleteDP')}}" method="post">
						@csrf
						<button class="btn btn-outline-danger btn-sm">Delete</button>
					</form>
				</div>
			</div>
			<hr class="my-5" />
			<div>
				<h4 class="mb-0">Personal Details</h4>
				<p class="mb-4">
					Edit your personal information and address.
				</p>
				@if(count($errors) > 0)
					@if($errors->first() == 'PersonalSuccess')
						<div class="alert alert-success">
							Personal details updated successfully.
						</div>
					@endif
				@endif
				<!-- Form -->
				<form class="row" action="{{route('student.editPersonalData')}}" method="post">
					@csrf
					<!-- First name -->
					<div class="mb-3 col-12 col-md-6">
						<label class="form-label" for="name">Full Name</label>
						<input type="text" id="name" name="name" class="form-control" placeholder="Your Full Name" value="{{$user->name}}" required />
					</div>
					<!-- Phone -->
					<div class="mb-3 col-12 col-md-6">
						<label class="form-label" for="phone">Phone</label>
						<input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" value="{{$user->phone}}" required />
					</div>
					<!-- Birthday -->
					<div class="mb-3 col-12 col-md-6">
						<label class="form-label" for="birth">Birthday</label>
						<input class="form-control flatpickr" name="birthday" type="text" placeholder="Birth of Date" id="birth"
							name="birth" value="{{$user->birthday}}"/>
					</div>
					<!-- Address -->
					<div class="mb-3 col-12 col-md-6">
						<label class="form-label" for="address">Address Line 1</label>
						<input type="text" id="address" name="address_line1" class="form-control" placeholder="Address" value="{{$user->address_line1}}"/>
					</div>
					<!-- Address -->
					<div class="mb-3 col-12 col-md-6">
						<label class="form-label" for="address2">Address Line 2</label>
						<input type="text" id="address2" name="address_line2" class="form-control" placeholder="Address" value="{{$user->address_line2}}" />
					</div>
					<div class="mb-3 col-12 col-md-6">
						<label class="form-label" for="address2">City</label>
						<input type="text" id="city" name="city" class="form-control" placeholder="City" value="{{$user->city}}" />
					</div>
					<!-- State -->
					<div class="mb-3 col-12 col-md-6">
						<label class="form-label">State</label>
						<input type="text" id="state" name="state" class="form-control" placeholder="State" value="{{$user->state}}" />
					</div>
					<!-- Country -->
					<div class="mb-3 col-12 col-md-6">
						<label class="form-label">Country</label>
						<select class="selectpicker" data-width="100%" name="country">
							@if($user->country != '' || $user->country != null)
								<option value="{{$user->country}}" selected>{{$user->country}}</option>
							@endif
							<option value="">Select Country</option>
							<option value="Australia">Australia</option>
							<option value="USA">USA</option>
							<option value="China">China</option>
							<option value="Germany">Germany</option>
						</select>
					</div>
					<div class="col-12">
						<!-- Button -->
						<input type="hidden" name="id" value="{{$user->id}}">
						<button class="btn btn-primary" type="submit">
							Update Profile
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="dpModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Update profile picture</h5>
            <button type="button" class="close no-bg" aria-label="Close" onclick="dismissModal()">
            	<span aria-hidden="true">×</span>
            </button>
         </div>
         <form action="{{route('student.updateProfilePic')}}" method="post" enctype="multipart/form-data">
         	@csrf
	         <div class="modal-body">
	            <div class="img-container">
	               <div class="row">
	                  <div class="col-md-12">
	                     <div class="custom-file-container" data-upload-id="courseCoverImg" id="courseCoverImg">
	                        <label class="form-label">Choose profile picture
	                          <a href="javascript:void(0)" class="custom-file-container__image-clear"
	                            title="Clear Image"></a></label>
	                        <label class="custom-file-container__custom-file">
	                          <input type="file" class="custom-file-container__custom-file__custom-file-input"
	                            accept="image/*" name="file" />
	                          <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
	                          <span class="custom-file-container__custom-file__custom-file-control"></span>
	                        </label>
	                        @if(count($errors->all()) > 0)
	                        @if($errors->first('file'))
	                          <div style="color: red;font-size: 13px;margin-top: 10px;">
	                            <ul>
	                              <li>Field is required</li>
	                              <li>File must be an image</li>
	                              <li>File must be less then 10MB</li>
	                            </ul>
	                          </div>
	                        @endif
	                        @endif
	                        <small class="mt-3 d-block">Upload your profile picture here. It must meet our standards to be accepted.
	                          Important guidelines: 400x400 pixels; .jpg, .jpeg, or .png. no text on the image.</small>
	                        <div class="custom-file-container__image-preview" style="width: 300px!important;"></div>
	                      </div>
	                  </div>
	               </div>
	            </div>
	         </div>
	         <div class="modal-footer">
	            <button type="button" class="btn btn-secondary" onclick="dismissModal()">Cancel</button>
	            <button type="submit" class="btn btn-primary" id="update">Update</button>
	         </div>
         </form>
      </div>
   </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
	$("#chooseFile").click(function(){
		$("#dpModal").modal('show');
	});
</script>
@endsection