@extends('admin.partials.layout')

@section('meta')

<title>Setting | {{config('app.name')}}</title>

@endsection

@section('css')


@endsection

@section('main_content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="pb-4 d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-0 h2 fw-bold">Setting</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="mb-0">Change Password</h4>
                        <p>
                            We will email you a confirmation when changing your
                            password, so please expect that email after submitting.
                        </p>
                        <!-- Form -->
                        <form class="row" action="{{ route('admin.change-password') }}" method="POST">
                            @csrf
                            <div class="col-lg-6 col-md-12 col-12">
                                @if($errors->any())
                                    @if($errors->first() == 'success')
                                        <div class="alert alert-success" role="alert">
                                            Password has been succesfully updated.
                                        </div>
                                    @elseif($errors->first() == 'c_pass_not_match')
                                        <div class="alert alert-danger" role="alert">
                                            Current password doesnot match.
                                        </div>
                                    @elseif($errors->first() == 'other')
                                        <div class="alert alert-danger" role="alert">
                                            Password not updated. Please check your connection.
                                        </div>
                                    @endif
                                @endif
                                <div class="mb-3">
                                    <label class="form-label" for="currentpassword">Current password
                                        @error('current_password')
                                            <span style="font-size:13px!important; color: #fd0710!important;">
                                                {{ $message }} *
                                            </span>
                                        @enderror
                                    </label>
                                    <input id="currentpassword" type="password" name="current_password" class="form-control"
                                        placeholder="" />
                                </div>
                                <div class="mb-3 password-field">
                                    <label class="form-label" for="newpassword">New password
                                        @error('new_password')
                                            <span style="font-size:13px!important; color: #fd0710!important;">
                                                {{ $message }} *
                                            </span>
                                        @enderror
                                    </label>
                                    <input id="newpassword" type="password" name="new_password" class="form-control mb-2"
                                        placeholder=""/>
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
                                    <label class="form-label" for="confirmpassword">Confirm New Password
                                    @error('confirm_password')
                                        <span style="font-size:13px!important; color: #fd0710!important;">
                                            {{ $message }} *
                                        </span>
                                    @enderror
                                    </label>
                                    <input id="confirmpassword" type="password" name="confirm_password" class="form-control mb-2"
                                        placeholder="" />
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
                                    <a href="#">Reset your password via email</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
