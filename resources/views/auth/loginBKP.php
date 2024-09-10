<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-bs-theme="dark" data-body-image="img-1" data-preloader="disable">


<!-- Mirrored from themesbrand.com/velzon/html/galaxy/auth-signin-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Jul 2024 20:13:59 GMT -->
<head>

    <meta charset="utf-8" />
    <title>Sign In | Capex</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="public/assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="public/assets/js/layout.js"></script>
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

    <!-- auth-page wrapper -->
    <div class="py-5 auth-page-wrapper auth-bg-cover d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="overflow-hidden auth-page-content pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="overflow-hidden border-0 card card-bg-fill card-border-effect-none">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-4 p-lg-5 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="index.html" class="d-block">
                                                    <img src="public/assets/images/logo-light.png" alt="" height="18">
                                                </a>
                                            </div>
                                            <div class="mt-auto">

                                                <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="pb-5 text-center text-white carousel-inner">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">"Welcome to the Capex Admin. Log in to manage your loans, track repayments, and stay in control of your financial future."</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end carousel -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="p-4 p-lg-5">
                                        <div>
                                            <h5 class="text-warning">Welcome Back !</h5>
                                            <p class="text-muted">Sign in to continue to Capex.</p>
                                        </div>

                                        <div class="mt-4">
                                            <form method="POST" action="{{ route('login') }}">

                                                <x-jet-validation-errors class="mb-4 text-danger" />
                                                @if (session('status'))
                                                    <div class="mb-4 text-sm font-medium text-green-600">
                                                        {{ session('status') }}
                                                    </div>
                                                @endif

                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="email" class="form-control" id="username" name="email" placeholder="Enter username">
                                                </div>

                                                <div class="mb-3">
                                                    <div class="float-end">
                                                        <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                                                    </div>
                                                    <label class="form-label" for="password-input">Password</label>
                                                    <div class="mb-3 position-relative auth-pass-inputgroup">
                                                        <input type="password" class="form-control pe-5 password-input" name="password" placeholder="Enter password" id="password-input">
                                                        <button class="top-0 btn btn-link position-absolute end-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="align-middle ri-eye-fill"></i></button>
                                                    </div>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                                    <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                                </div>

                                                <div class="mt-4">
                                                    <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                                </div>
{{-- staff --}}

                                            </form>
                                        </div>


                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
       
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

    <!-- password-addon init -->
    <script src="public/assets/js/pages/password-addon.init.js"></script>
</body>


<!-- Mirrored from themesbrand.com/velzon/html/galaxy/auth-signin-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Jul 2024 20:13:59 GMT -->
</html>
