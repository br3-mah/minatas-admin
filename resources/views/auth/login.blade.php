<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admiro admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Admiro admin template, best javascript admin, dashboard template, bootstrap admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>Minatas - Sign In</title>
    <!-- Favicon icon-->
    <link rel="icon" href="public/admin/img/fav.png" type="image/x-icon">
    <link rel="shortcut icon" href="public/admin/img/fav.png" type="image/x-icon">
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&amp;display=swap" rel="stylesheet">
    <!-- Flag icon css -->
    <link rel="stylesheet" hrefpublic/assets//css/vendors/flag-icon.css">
    <!-- iconly-icon-->
    <link rel="stylesheet" href="public/assets//css/iconly-icon.css">
    <link rel="stylesheet" href="public/admin/assets//css/bulk-style.css">
    <!-- iconly-icon-->
    <link rel="stylesheet" href="public/admin/assets//css/themify.css">
    <!--fontawesome-->
    <link rel="stylesheet" href="public/admin/assets//css/fontawesome-min.css">
    <!-- Whether Icon css-->
    <link rel="stylesheet" type="text/css" href="public/admin/assets//css/vendors/weather-icons/weather-icons.min.css">
    <!-- App css -->
    <link rel="stylesheet" href="public/admin/assets//css/style.css">
    <link id="color" rel="stylesheet" href="public/admin/assets//css/color-1.css" media="screen">
  </head>
  <body>
    <!-- tap on top starts-->
    <div class="tap-top"><i class="iconly-Arrow-Up icli"></i></div>
    <!-- tap on tap ends-->
    <!-- loader-->
    <div class="loader-wrapper">
      <div class="loader"><span></span><span></span><span></span><span></span><span></span></div>
    </div>
    <!-- login page start-->
    <div class="container-fluid">
      <div class="row">
        <div class="p-0 col-12">
          <div class="login-card login-dark">
            <div>
              <div><a class="text-center logo" href="{{ route('dashboard') }}">
                <img class="m-auto img-fluid for-light" src="public/admin/img/logo-white.svg" alt="looginpage">
                <img class="img-fluid for-dark" src="public/admin/img/logo-dark.svg" alt="logo"></a>
              </div>
              <div class="login-main"> 
                <form class="theme-form" method="POST" action="{{ route('login') }}">
                  <h2 class="text-center">Sign in to account</h2>
                  <p class="text-center">Enter your email &amp; password to login</p>
                  <div class="form-group">
                    <label class="col-form-label">Email Address</label>
                    <input class="form-control" name="email" type="email" required="" placeholder="">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password" required="">
                      <div class="show-hide"><span class="show"></span></div>
                    </div>
                  </div>
                  <div class="mb-0 form-group checkbox-checked">
                    <div class="form-check checkbox-solid-info">
                      <input class="form-check-input" name="remember_me" id="solid6" type="checkbox">
                      <label class="form-check-label" for="solid6">Remember password</label>
                    </div><a class="link" href="forget-password.html">Forgot password?</a>
                    <div class="mt-3 text-end">
                      <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                    </div>
                  </div>
                  <div class="login-social-title">
                    <h6>Or Sign in with</h6>
                  </div>
                  <div class="form-group">
                    <ul class="login-social">
                      <li><a href="https://www.linkedin.com/" target="_blank"><i class="icon-linkedin"></i></a></li>
                      <li><a href="https://twitter.com/" target="_blank"><i class="icon-twitter"></i></a></li>
                      <li><a href="https://www.facebook.com/" target="_blank"><i class="icon-facebook"></i></a></li>
                      <li><a href="https://www.instagram.com/" target="_blank"><i class="icon-instagram"></i></a></li>
                    </ul>
                  </div>
                  <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="sign-up.html">Create Account</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- jquery-->
      <script src="public/admin/assets//js/vendors/jquery/jquery.min.js"></script>
      <!-- bootstrap js-->
      <script src="public/admin/assets//js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js" defer=""></script>
      <script src="public/admin/assets//js/vendors/bootstrap/dist/js/popper.min.js" defer=""></script>
      <!--fontawesome-->
      <script src="public/admin/assets//js/vendors/font-awesome/fontawesome-min.js"></script>
      <!-- password_show-->
      <script src="public/admin/assets//js/password.js"></script>
      <!-- custom script -->
      <script src="public/admin/assets//js/script.js"></script>
    </div>
  </body>
</html>