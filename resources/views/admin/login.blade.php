
<!DOCTYPE html>
<html lang="en">

<head>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <base href="/">
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon/favicon.ico">
  <link href="assets/fonts/feather/feather.css" rel="stylesheet" />
  <link href="assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="assets/libs/dragula/dist/dragula.min.css" rel="stylesheet" />
  <link href="assets/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" />
  <link href="assets/libs/prismjs/themes/prism.css" rel="stylesheet" />
  <link href="assets/libs/dropzone/dist/dropzone.css" rel="stylesheet" />
  <link href="assets/libs/magnific-popup/dist/magnific-popup.css" rel="stylesheet" />
  <link href="assets/libs/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
  <link href="assets/libs/@yaireo/tagify/dist/tagify.css" rel="stylesheet">
  <link href="assets/libs/tiny-slider/dist/tiny-slider.css" rel="stylesheet">
  <link href="assets/libs/tippy.js/dist/tippy.css" rel="stylesheet">
  <link href="assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <!-- Theme CSS -->
  <link rel="stylesheet" href="assets/css/theme.min.css">
  <title>Sign in</title>
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
              <h1 class="mb-1 fw-bold">Admin Sign in</h1>
            </div>
            <!-- Form -->
            @if($errors->any())
                @if($errors->first() == 'pass_not_match')
                    <div class="alert alert-danger" role="alert">
                      Please enter correct password.
                    </div>
                @elseif($errors->first() == 'email_not_match')
                    <div class="alert alert-danger" role="alert">
                      Please enter correct email..
                    </div>
                @endif
            @endif
            <form method="post" action="/admin/login">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email Adress</label>
                <input type="email" id="email" class="form-control" name="email" placeholder="Email address here" required>
                @error('email')
                    <span>
                        <p style="font-size:13px!important; color: #fd0710!important;">{{ $message }}*</p>
                    </span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="**************" required>
                @error('password')
                    <span>
                        <p style="font-size:13px!important; color: #fd0710!important;">{{ $message }}*</p>
                    </span>
                @enderror
              </div>
              <div class="d-lg-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="rememberme">
                  <label class="form-check-label " for="rememberme">Remember me</label>
                </div>
                <div>
                  <a href="forget-password.html">Forgot your password?</a>
                </div>
              </div>
              <div>
                	<!-- Button -->
                  <div class="d-grid">
                <button type="submit" class="btn btn-primary ">Sign in</button>
              </div>
              </div>
              <hr class="my-4">
              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <!-- Libs JS -->
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/odometer/odometer.min.js"></script>
<script src="assets/libs/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
<script src="assets/libs/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="assets/libs/flatpickr/dist/flatpickr.min.js"></script>
<script src="assets/libs/inputmask/dist/jquery.inputmask.min.js"></script>
<script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="assets/libs/quill/dist/quill.min.js"></script>
<script src="assets/libs/file-upload-with-preview/dist/file-upload-with-preview.min.js"></script>
<script src="assets/libs/dragula/dist/dragula.min.js"></script>
<script src="assets/libs/bs-stepper/dist/js/bs-stepper.min.js"></script>
<script src="assets/libs/dropzone/dist/min/dropzone.min.js"></script>
<script src="assets/libs/jQuery.print/jQuery.print.js"></script>
<script src="assets/libs/prismjs/prism.js"></script>
<script src="assets/libs/prismjs/components/prism-scss.min.js"></script>
<script src="assets/libs/@yaireo/tagify/dist/tagify.min.js"></script>
<script src="assets/libs/tiny-slider/dist/min/tiny-slider.js"></script>
<script src="assets/libs/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="assets/libs/tippy.js/dist/tippy-bundle.umd.min.js"></script>
<script src="assets/libs/typed.js/lib/typed.min.js"></script>
<script src="assets/libs/jsvectormap/dist/js/jsvectormap.min.js"></script>
<script src="assets/libs/jsvectormap/dist/maps/world.js"></script>
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>




<!-- clipboard -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>


<!-- Theme JS -->
<script src="assets/js/theme.min.js"></script>
</body>

</html>