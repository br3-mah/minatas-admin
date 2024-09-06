
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-bs-theme="dark" data-body-image="img-1" data-preloader="disable">
<!-- Mirrored from themesbrand.com/velzon/html/galaxy/pages-coming-soon.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Jul 2024 20:14:12 GMT -->
<head>

    <meta charset="utf-8" />
    <title>Capex Financial Services</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="public/public/public/assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="/public/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="public/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="public/assets/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 pt-4 mb-4">
                            <div class="mb-sm-5 pb-sm-4 pb-5">
                                <img src="public/public/public/assets/images/comingsoon.png" alt="" height="120" class="move-animation">
                            </div>
                            <div class="mb-5">
                                <h1 class="display-2 coming-soon-text">Not Available</h1>
                            </div>
                            <div>
                                {{-- <div class="row justify-content-center mt-5">
                                    <div class="col-lg-8">
                                        <div id="countdown" class="countdownlist"></div>
                                    </div>
                                </div> --}}

                                <div class="mt-5">
                                    <h4>Get notified when we launch</h4>
                                    <p class="text-muted">Don't worry we will not spam you 😊</p>
                                </div>

                                <div class="input-group countdown-input-group mx-auto my-4">
                                    <input type="email" class="form-control border-light shadow" placeholder="Enter your email address" aria-label="search result" aria-describedby="button-email">
                                    <button class="btn btn-warning" type="button" id="button-email">Send<i class="ri-send-plane-2-fill align-bottom ms-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="public/assets/libs/node-waves/waves.min.js"></script>
    <script src="public/assets/libs/feather-icons/feather.min.js"></script>
    <script src="public/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="public/assets/js/plugins.js"></script>

    <!-- particles js -->
    <script src="public/assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="public/assets/js/pages/particles.app.js"></script>

    <!-- Countdown js -->
    <script src="public/assets/js/pages/coming-soon.init.js"></script>

</body>


<!-- Mirrored from themesbrand.com/velzon/html/galaxy/pages-coming-soon.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Jul 2024 20:14:12 GMT -->
</html>
{{--

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from tende.vercel.app/reset.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 Nov 2023 16:22:14 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/capex/images/logoi.png')}}" />
    <!-- Custom Stylesheet -->

    <link rel="stylesheet" href="{{ asset('public/capex/css/style.css')}}" />
  </head>

  <body class="@@dashboard">


<div id="preloader"><i>.</i><i>.</i><i>.</i></div>


<div id="main-wrapper">

    <div class="authincation section-padding">
        <div class="container">
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <x-jet-validation-errors class="mb-4" />
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-6 col-md-6">
                    <div class="mini-logo text-center my-3">
                        <a href="{{ route('welcome') }}">
                            <img width="100" src="{{ asset('public/web/images/logo.png')}}" alt="" />
                        </a>
                        <h4 class="card-title mt-5">Change Password</h4>
                    </div>
                    <div class="auth-form card">

                        <x-jet-validation-errors class="w-full" />
                        <div class="card-body">
                            <form class="row g-3" method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <div class="col-12">
                                    <label class="form-label">Email</label>

                                    <input type="email" name="email" :value="old('email', $request->email)" required autofocus class="form-control">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">New Password</label>
                                    <input  type="password" name="password" required autocomplete="new-password" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" required autocomplete="new-password" class="form-control">
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                                </div>
                            </form>
                            <div class="new-account mt-3">
                                <p>Didn't get code? <a class="text-primary" href="otp-1.html">Resend</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<script src="{{ asset('public/capex/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('public/capex/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


















<script src="{{ asset('public/capex/js/scripts.js')}}"></script>


</body>


<!-- Mirrored from tende.vercel.app/reset.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 Nov 2023 16:22:14 GMT -->
</html> --}}
