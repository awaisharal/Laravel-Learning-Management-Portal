<!DOCTYPE html>
<html lang="en">
<head>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <base href="/">
  <link rel="shortcut icon" type="image/x-icon" href="/assets/images/favicon/favicon.ico">
  <link href="/assets/fonts/feather/feather.css" rel="stylesheet" />
  <link href="/assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="/assets/libs/dragula/dist/dragula.min.css" rel="stylesheet" />
  <link href="/assets/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" />
  <link href="/assets/libs/prismjs/themes/prism.css" rel="stylesheet" />
  <link href="/assets/libs/dropzone/dist/dropzone.css" rel="stylesheet" />
  <link href="/assets/libs/magnific-popup/dist/magnific-popup.css" rel="stylesheet" />
  <link href="/assets/libs/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
  <link href="/assets/libs/@yaireo/tagify/dist/tagify.css" rel="stylesheet">
  <link href="/assets/libs/tiny-slider/dist/tiny-slider.css" rel="stylesheet">
  <link href="/assets/libs/tippy.js/dist/tippy.css" rel="stylesheet">
  <link href="/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <!-- Theme CSS -->
  <link rel="stylesheet" href="/assets/css/theme.min.css">
  <link rel="stylesheet" href="/assets/css/custom.css">
  <title>Recover Account</title>
</head>
<body>
  <!-- Page content -->
  <div class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center g-0 min-vh-100">
      <div class="col-lg-5 col-md-8 py-8 py-xl-0">
        <!-- Card -->
        <div class="card shadow ">
          <!-- Card body -->
          <div class="card-body p-6">
            <div class="mb-4">
              <a href="/"><img src="/assets/images/brand/logo/logo-icon.svg" class="mb-4" alt=""></a>
              <h1 class="mb-1 fw-bold">Recover Password</h1>
            </div>
            <!-- Form -->
            @if($errors->any())
                @if($errors->first() == 'pass_not_match')
                    <div class="alert alert-danger" role="alert">
                      Passwords does not match.
                    </div>
                @elseif($errors->first() == 'email_not_match')
                    <div class="alert alert-danger" role="alert">
                      This email you entered in not registered.
                    </div>
                @elseif($errors->first() == 'banned')
                    <div class="alert alert-danger" role="alert">
                      You are banned by admin.
                    </div>
                @endif
            @endif
            <form method="post" action="{{ route('student.resetPassword') }}">
              @csrf
              <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" id="password" class="form-control" name="pass1" placeholder="New password here" required>
                @error('pass1')
                    <span>
                        <p style="font-size:13px!important; color: #fd0710!important;">{{ $message }}*</p>
                    </span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="password2" class="form-label">Confirm Password</label>
                <input type="password" id="password2" class="form-control" name="pass2" placeholder="Re enter password here" required>
                @error('pass2')
                    <span>
                        <p style="font-size:13px!important; color: #fd0710!important;">{{ $message }}*</p>
                    </span>
                @enderror
              </div>
              <div>
                	<!-- Button -->
                  <div class="d-grid">
                    <input type="hidden" name="id" value="{{$id}}">
                    <button type="submit" class="btn btn-primary ">Reset Password</button>
                  </div>
              </div>
              
            </form>
          </div>
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
      <div class="modal-body">
        @if(count($errors) > 0)
          @if($errors->first() == 'emailMatchError')
            <div class="alert alert-warning">
              Email address does not match with our records.
            </div>
          @elseif($errors->first() == 'resetSuccess')
            <div class="alert alert-success">
              We have sent the password reset instructions. Please check your mailbox.
            </div>
          @endif
        @endif
          <div class="form-group">
            <label>Email Address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter your email address here" required>
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" id="id" />
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Recover</button>
      </div>
    </div>
  </div>
</div>
  <!-- Scripts -->
  <!-- Libs JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

{{-- <script src="/assets/libs/jquery/dist/jquery.min.js"></script> --}}
<script src="/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/odometer/odometer.min.js"></script>
<script src="/assets/libs/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
<script src="/assets/libs/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="/assets/libs/flatpickr/dist/flatpickr.min.js"></script>
<script src="/assets/libs/inputmask/dist/jquery.inputmask.min.js"></script>
<script src="/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="/assets/libs/quill/dist/quill.min.js"></script>
<script src="/assets/libs/file-upload-with-preview/dist/file-upload-with-preview.min.js"></script>
<script src="/assets/libs/dragula/dist/dragula.min.js"></script>
<script src="/assets/libs/bs-stepper/dist/js/bs-stepper.min.js"></script>
<script src="/assets/libs/dropzone/dist/min/dropzone.min.js"></script>
<script src="/assets/libs/jQuery.print/jQuery.print.js"></script>
<script src="/assets/libs/prismjs/prism.js"></script>
<script src="/assets/libs/prismjs/components/prism-scss.min.js"></script>
<script src="/assets/libs/@yaireo/tagify/dist/tagify.min.js"></script>
<script src="/assets/libs/tiny-slider/dist/min/tiny-slider.js"></script>
<script src="/assets/libs/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="/assets/libs/tippy.js/dist/tippy-bundle.umd.min.js"></script>
<script src="/assets/libs/typed.js/lib/typed.min.js"></script>
<script src="/assets/libs/jsvectormap/dist/js/jsvectormap.min.js"></script>
<script src="/assets/libs/jsvectormap/dist/maps/world.js"></script>
<script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>




<!-- clipboard -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>


<!-- Theme JS -->
<script src="/assets/js/theme.min.js"></script>

</body>

</html>