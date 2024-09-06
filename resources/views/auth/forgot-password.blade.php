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
















{{-- <!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="" />
    <title>Reset Password</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />


    <script>
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
    Custom
    <style>
        .sm-btn {
            margin-top: 2%;
            width: 20%;
            height: 20%;
            font-size: 10px;
        }
    </style>
    @livewireStyles
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="auth-bg">
    <!--begin::Theme mode setup on page load-->

    <!--end::Theme mode setup on page load-->
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_password_reset_form"
                            data-kt-redirect-url="{{ route('password.email') }}" action="{{ route('password.email') }}">
                            <!--begin::Heading-->
                            <div class="text-center mb-10">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Not Available</h1>
                                <!--end::Title-->
                                <!--begin::Link-->
                                <div class="text-gray-500 fw-semibold fs-6">Enter your email to reset your password.
                                </div>
                                <!--end::Link-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="text" placeholder="Email" name="email" autocomplete="off"
                                    class="form-control bg-transparent" />
                                <!--end::Email-->
                            </div>
                            <!--begin::Actions-->
                            <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                                <button type="button" id="kt_password_reset_submit" class="btn btn-primary me-4">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Submit</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                                <a href="{{ route('login') }}" class="btn btn-light">Cancel</a>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->

            </div>
            <!--end::Body-->
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
                style="background-image: linear-gradient(to right, #662d91, #912d73);">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                    <!--begin::Logo-->


                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
</body>
<!--end::Body-->

</html> --}}



