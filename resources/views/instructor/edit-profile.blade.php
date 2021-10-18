@extends('instructor.partials.layout')

@section('meta')
<meta name="_token" content="{{ csrf_token() }}">
<title>Instructor Reviews | {{config('app.name')}}</title>

@endsection

@section('css')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />

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
		<!-- Card body -->
		<div class="card-body">
			<div class="d-lg-flex align-items-center justify-content-between">
				<div class="d-flex align-items-center mb-4 mb-lg-0">
					@if($user->img == "" || $user->img == null)
					<img src="../assets/images/avatar/avatar-3.jpg" id="img-uploaded" class="avatar-xl rounded-circle" alt="" />
					@else
						<img src="uploads/profiles/{{$user->img}}" id="img-uploaded" class="avatar-xl rounded-circle" alt="" />
					@endif
					<div class="ms-3">
						<h4 class="mb-0">Your avatar</h4>
						<p class="mb-0">
							PNG or JPG no bigger than 800px wide and tall.
						</p>
					</div>
				</div>
				<div style="display:flex;">
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
				@if(count($errors->all()) > 0)
					@if($errors->first() == 'success')
						<div class="alert alert-success mt-5 mb-3">
							Profile updated successfully.
						</div>
					@elseif($errors->first() == 'DPError')
						<div class="alert alert-warning mt-5 mb-3">
							Something went wrong. Please try again later.
						</div>
					@endif
				@endif
				<h4 class="mb-0">Personal Details</h4>
				<p class="mb-4">
					Edit your personal information and address.
				</p>
				<!-- Form -->
				<form class="row" action="{{route('instructor.updateProfile')}}" method="post">
					@csrf
					<div class="mb-3 col-12 col-md-6">
						<label class="form-label" for="name">Full Name</label>
						<input type="text" id="name" name="name" class="form-control" placeholder="Your name here.." value="{{$user->name}}" required />
					</div>
					<div class="mb-3 col-12 col-md-6">
						<label class="form-label" for="title">Title</label>
						<input type="text" id="title" name="title" class="form-control" placeholder="Your title here.." value="{{$user->title}}" required />
					</div>
					<div class="mb-3 col-12 col-md-6">
						<label class="form-label" for="phone">Phone</label>
						<input type="text" id="phone" class="form-control" placeholder="Phone" name="phone" value="{{$user->phone}}" required />
					</div>
					<div class="mb-3 col-12 col-md-6">
						<label class="form-label" for="birth">Birthday</label>
						<input class="form-control flatpickr" type="text" placeholder="Birth of Date" id="birth datepicker"
							name="birthday" value="{{$user->birthday}}"/>
					</div>
					<div class="col-12">
						<button class="btn btn-primary" type="submit">
							Update Profile
						</button>
					</div>
				</form>
			</div>
			<hr class="my-5" />
			<div>
				@if(count($errors->all()) > 0)
					@if($errors->first() == 'addresssuccess')
						<div class="alert alert-success mt-5 mb-3">
							Address updated successfully.
						</div>
					@endif
				@endif
				<h4 class="mb-0">Personal Details</h4>
				<p class="mb-4">
					Edit your address information.
				</p>
				<!-- Form -->
				<form class="row" action="{{route('instructor.updateAddress')}}" method="post">
					@csrf
					<div class="mb-3 col-12 col-md-6">
						<label class="form-label" for="address">Street Address</label>
						<input type="text" id="address" class="form-control" placeholder="Address" value="{{$user->street_address}}" name="street_address" required />
					</div>
					<!-- Address -->
					<div class="mb-3 col-12 col-md-6">
						<label class="form-label" for="suburb">Suburb</label>
						<input type="text" id="suburb" class="form-control" placeholder="Address" value="{{$user->suburb}}" name="suburb" required />
					</div>
					<!-- City -->
					<div class="mb-3 col-12 col-md-6">
						<label class="form-label" for="postcode">Postcode</label>
						<input type="text" id="postcode" class="form-control" placeholder="Postcode" name="postcode" value="{{$user->postcode}}" />
					</div>
					<!-- State -->
					<div class="mb-3 col-12 col-md-6">
						<label class="form-label">State</label>
						<input type="text" id="state" class="form-control" placeholder="State" name="state" required value="{{$user->state}}"/>
					</div>
					<!-- Country -->
					<div class="mb-3 col-12 col-md-6">
						<label class="form-label">Country</label>
						<input type="text" id="country" class="form-control" placeholder="Country" name="country" required value="{{$user->country}}" />
					</div>
					<div class="col-12">
						<!-- Button -->
						<button class="btn btn-primary" type="submit">
							Update Profile
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

{{-- DP change Modal --}}

<div class="modal fade" id="dpModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Update profile picture</h5>
            <button type="button" class="close no-bg" data-dismiss="modal" aria-label="Close">
            	<span aria-hidden="true">×</span>
            </button>
         </div>
         <form action="{{route('instructor.updateProfilePic')}}" method="post" enctype="multipart/form-data">
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
	            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	            <button type="submit" class="btn btn-primary" id="update">Update</button>
	         </div>
         </form>
      </div>
   </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>

<script type="text/javascript">
$(function() {
	var date = new Date();
	var currentMonth = date.getMonth();
	var currentDate = date.getDate();
	var currentYear = date.getFullYear();
	$('#datepicker').datepicker({
	maxDate: new Date(currentYear, currentMonth, currentDate)
	});
	});
</script>
<script>
	$("#sidenav ul li#profile").addClass("active");
	$("#chooseFile").click(function(){
		$("#dpModal").modal('show');
	});
	$(".modal-title button.close").click(function(){
		$("#dpModal").modal('hide');
		console.log('a')
	});

</script>
@endsection