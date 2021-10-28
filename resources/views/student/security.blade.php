@extends('student.partials.layout')

@section('meta')

<title>Student Security | {{config('app.name')}}</title>

@endsection

@section('css')

@endsection

@section('main_content')
<div class="col-lg-9 col-md-8 col-12">
	<div class="card">
		<!-- Card header -->
		<div class="card-header">
			<h3 class="mb-0">Security</h3>
			<p class="mb-0">
				Edit your account settings and change your password here.
			</p>
		</div>
		<!-- Card body -->
		<div class="card-body">
			<div>
				@if(count($errors->all()) > 0)
					@if($errors->first() == 'success')
						<div class="alert alert-success mt-5 mb-3">
							Password updated successfully.
						</div>
					@elseif($errors->first() == 'invalid')
						<div class="alert alert-warning mt-5 mb-3">
							You have entered incorrect old password
						</div>
					@elseif($errors->first() == 'mismatch')
						<div class="alert alert-warning mt-5 mb-3">
							New passwords does not match 
						</div>
					@elseif($errors->first() == 'resetSuccess')
			            <div class="alert alert-success">
			              We have sent the password reset instructions. Please check your mailbox.
			            </div>
					@endif
				@endif
				<h4 class="mb-0">Change Password</h4>
				<p>
					We will email you a confirmation when changing your
					password, so please expect that email after submitting.
				</p>
				<!-- Form -->
				<form class="row" method="post" action="{{route('student.passwordUpdate')}}">
					@csrf
					<div class="col-lg-6 col-md-12 col-12">
							<!-- Current password -->
						<div class="mb-3">
							<label class="form-label" for="currentpassword">Current password</label>
							<input id="currentpassword" type="password" name="old" class="form-control"
								placeholder="" required />
						</div>
							<!-- New password -->
						<div class="mb-3 password-field">
							<label class="form-label" for="newpassword">New password</label>
							<input id="newpassword" type="password" name="new1" class="form-control mb-2"
								placeholder="" required />
							<div class="row align-items-center g-0">
								<div class="col-6">
									<span data-bs-toggle="tooltip" data-placement="right"
										title="Test it by typing a password in the field below. To reach full strength, use at least 6 characters, a capital letter and a digit, e.g. 'Test01'">Password
										strength
										<i class="fas fa-question-circle ms-1"></i></span>
								</div>
							</div>
						</div>
						<div class="mb-3">
								<!-- Confirm new password -->
							<label class="form-label" for="confirmpassword">Confirm New Password</label>
							<input id="confirmpassword" type="password" name="new2" class="form-control mb-2"
								placeholder="" required />
						</div>
							<!-- Button -->
						<button type="submit" class="btn btn-primary">
							Save Password
						</button>
						<div class="col-6"></div>
					</div>
					<div class="col-12 mt-4">
						<p class="mb-0">
							Can't remember your current password?
							<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ForgotModal">Reset your password via email</a>
						</p>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="ForgotModal" tabindex="-1" role="dialog" aria-labelledby="addSectionModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="padding-bottom: 0!important;">
      <div class="modal-header">
        <h4 class="modal-title" id="addSectionModalLabel1">
          Reset Password
        </h4>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
      </div>
      <form action="{{route('student.forgetPassword')}}" method="POST">
      @csrf
      <input type="hidden" name="id" value="{{ $user_id }}">
      <input type="hidden" name="email" value="{{ $user_email }}">
      <div class="modal-body">
        Are you sure you want to reset your password?
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" id="id" />
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Reset</button>
      </div>
    </div>
  </div>
</div>
@endsection