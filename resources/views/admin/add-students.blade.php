@extends('admin.partials.layout')

@section('meta')

<title>Add Students | {{config('app.name')}}</title>

@endsection

@section('css')


@endsection

@section('main_content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-4 mb-4 d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-0 h2 fw-bold">Add Students</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <div class="card border-0 mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Add Details</h4>
                </div>
                <div class="card-body">
                    <div class="">
                        @if($errors->any())
                            @if($errors->first() == 'user_created')
                                <div class="alert alert-success" role="alert">
                                    Student added successfully.
                                </div>
                            @elseif($errors->first() == 'unknownError')
                                <div class="alert alert-danger" role="alert">
                                    Try Again Please.
                                </div>
                            @elseif($errors->first() == 'emailError')
                                <div class="alert alert-danger" role="alert">
                                    This email is already registered.
                                </div>
                            @endif
                        @endif
                        <form class="row" action="{{ route('admin.add_student') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="fname">First Name</label>
                                <input type="text" id="fname" class="form-control" placeholder="First Name" required name="first_name" />
                                @error('first_name')
                                    <span>
                                        <p style="font-size:13px!important; color: #fd0710!important;">{{ $message }}*</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="lname">Last Name</label>
                                <input type="text" id="lname" class="form-control" placeholder="Last Name" required name="last_name" />
                                @error('last_name')
                                    <span>
                                        <p style="font-size:13px!important; color: #fd0710!important;">{{ $message }}*</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="phone">Phone</label>
                                <input type="text" id="phone" class="form-control" placeholder="Phone" required name="phone" />
                                @error('phone')
                                    <span>
                                        <p style="font-size:13px!important; color: #fd0710!important;">{{ $message }}*</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" id="email" class="form-control" placeholder="Enter email" required name="email" />
                                @error('email')
                                    <span>
                                        <p style="font-size:13px!important; color: #fd0710!important;">{{ $message }}*</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="password">Enter Password</label>
                                <input type="password" id="password" class="form-control" placeholder="Enter Password" required name="password" />
                                @error('password')
                                    <span>
                                        <p style="font-size:13px!important; color: #fd0710!important;">{{ $message }}*</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="confirm_password">Confirm Password</label>
                                <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password" required name="confirm_password" />
                                @error('confirm_password')
                                    <span>
                                        <p style="font-size:13px!important; color: #fd0710!important;">{{ $message }}*</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
