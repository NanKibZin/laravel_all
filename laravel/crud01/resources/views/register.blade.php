<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin Premium Bootstrap Admin Dashboard Template</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/ionicons/dist/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.addons.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/shared/style.css') }}">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo_1/style.css') }}">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
              <h2 class="text-center mb-4">Register</h2>
              <div class="auto-form-wrapper">
                <form action="{{ route('auth.registerProcess') }}" method="POST">
                    @csrf
                  <div class="form-group">
                   <label for="">Name</label>
                   <input value="{{ old('name') }}" type="text" name="name" class="form-control" placeholder="Username">
                   @error('name')
                   <p class=" text-danger">{{ $message }}</p>
                   @enderror 
                  </div>
                  <div class="form-group">
                   <label for="">Email</label>
                   <input value="{{ old('email') }}" type="email" name="email" placeholder="Email" class="form-control">
                   @error('email')
                   <p class=" text-danger">{{ $message }}</p>
                   @enderror 
                    </div>
                  </div>
                  <div class="form-group">
                   <label for="">Password</label>
                   <input value="{{ old('password') }}" type="password" name="password" class="form-control" placeholder="Password"> 
                   @error('password')
                   <p class=" text-danger">{{ $message }}</p>
                   @enderror 
                  </div>
                  <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control">
                    @error('confirm')
                    <p class=" text-danger">{{ $message }}</p>
                    @enderror 
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary submit-btn btn-block">Register</button>
                  </div>
                  <div class="text-block text-center my-3">
                    <span class="text-small font-weight-semibold">Already have and account ?</span>
                    <a href="{{ route('auth.login') }}" class="text-black text-small">Login</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.addons.js') }}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/shared/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/shared/misc.js') }}"></script>

    <script src="{{ asset('assets/js/shared/jquery.cookie.js') }}" type="text/javascript"></script>
  </body>
</html>