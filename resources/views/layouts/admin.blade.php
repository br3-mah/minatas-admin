<!DOCTYPE html >
<html lang="en">
  <head>
    @php
        $route = request()->route()->getName();
        
    @endphp
    @if (
        $route == 'loan-details'
    )
    <link rel="icon" href="../public/admin/img/logo-white.svg" type="image/x-icon"/>
    <link rel="shortcut icon" href="../public/admin/img/logo-dark.svg" type="image/x-icon"/>
    @else
    <link rel="icon" href="public/admin/img/logo-white.svg" type="image/x-icon"/>
    <link rel="shortcut icon" href="public/admin/img/logo-dark.svg" type="image/x-icon"/>
    @endif
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Admiro admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities."/>
    <meta name="keywords" content="admin template, Admiro admin template, best javascript admin, dashboard template, bootstrap admin template, responsive admin template, web app"/>
    <meta name="author" content="pixelstrap"/>
    <title>Minata - Dash</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/iconly@2.2.1/iconly.css">
    <!-- Favicon icon-->
    <link rel="icon" href="public/admin/img/logo-white.svg" type="image/x-icon"/>
    <link rel="shortcut icon" href="public/admin/img/logo-dark.svg" type="image/x-icon"/>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/"/>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin=""/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">    <!-- Flag icon css -->
    <link rel="stylesheet" href="public/admin/assets/css/vendors/flag-icon.css"/>
    <!-- iconly-icon-->
    <link rel="stylesheet" href="public/admin/assets/css/iconly-icon.css"/>
    <link rel="stylesheet" href="public/admin/assets/css/bulk-style.css"/>
    <!-- iconly-icon-->
    <link rel="stylesheet" href="public/admin/assets/css/themify.css"/>
    <!--fontawesome-->
    <link rel="stylesheet" href="public/admin/assets/css/fontawesome-min.css"/>
    <!-- Whether Icon css-->
    <link rel="stylesheet" type="text/css" href="public/admin/assets/css/vendors/weather-icons/weather-icons.min.css"/>
    <link rel="stylesheet" type="text/css" href="public/admin/assets/css/vendors/scrollbar.css"/>
    <link rel="stylesheet" type="text/css" href="public/admin/assets/css/vendors/slick.css"/>
    <link rel="stylesheet" type="text/css" href="public/admin/assets/css/vendors/slick-theme.css"/>
    {{-- Datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="public/admin/assets/css/vendors/datatables.css">
    <!-- App css -->
    <link rel="stylesheet" href="public/admin/assets/css/style.css"/>
    <link id="color" rel="stylesheet" href="public/admin/assets/css/color-1.css" media="screen"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @livewireStyles
  </head>
  <body data-route-name="{{ Route::currentRouteName() }}">
    <!-- page-wrapper Start-->
    <!-- tap on top starts-->
    <div class="tap-top"><i class="iconly-Arrow-Up icli"></i></div>
    <!-- tap on tap ends-->
    <!-- loader-->
    <div class="loader-wrapper">
      <div class="loader"><span></span><span></span><span></span><span></span><span></span></div>
    </div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper"> 
      @include('layouts.admin-top-menu')
      <div class="page-body-wrapper"> 
      @include('layouts.admin-side-menu')
      {{ $slot }}
    </div>
    @livewireScripts
    <!-- jquery-->
    <script src="public/admin/assets/js/vendors/jquery/jquery.min.js"></script>
    <!-- bootstrap js-->
    <script src="public/admin/assets/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js" defer=""></script>
    <script src="public/admin/assets/js/vendors/bootstrap/dist/js/popper.min.js" defer=""></script>
    <!--fontawesome-->
    <script src="public/admin/assets/js/vendors/font-awesome/fontawesome-min.js"></script>
    <!-- feather-->
    <script src="public/admin/assets/js/vendors/feather-icon/feather.min.js"></script>
    <script src="public/admin/assets/js/vendors/feather-icon/custom-script.js"></script>
    <!-- sidebar -->
    <script src="public/admin/assets/js/sidebar.js"></script>
    <!-- height_equal-->
    <script src="public/admin/assets/js/height-equal.js"></script>
    <!-- config-->
    <script src="public/admin/assets/js/config.js"></script>
    <!-- apex-->
    <script src="public/admin/assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="public/admin/assets/js/chart/apex-chart/stock-prices.js"></script>
    <!-- scrollbar-->
    <script src="public/admin/assets/js/scrollbar/simplebar.js"></script>
    <script src="public/admin/assets/js/scrollbar/custom.js"></script>
    <!-- slick-->
    <script src="public/admin/assets/js/slick/slick.min.js"></script>
    <script src="public/admin/assets/js/slick/slick.js"></script>
    <!-- data_table-->
    <script src="public/admin/assets/js/js-datatables/datatables/jquery.dataTables.min.js"></script>
    <!-- page_datatable-->
    <script src="public/admin/assets/js/js-datatables/datatables/datatable.custom.js"></script>
    <!-- page_datatable1-->
    <script src="public/admin/assets/js/js-datatables/datatables/datatable.custom1.js"></script>
    <!-- page_datatable-->
    <script src="public/admin/assets/js/datatable/datatables/datatable.custom.js"></script>
    <!-- theme_customizer-->
    {{-- <script src="public/admin/assets/js/theme-customizer/customizer.js"></script> --}}
    <!-- tilt-->
    <script src="public/admin/assets/js/animation/tilt/tilt.jquery.js"></script>
    <!-- page_tilt-->
    <script src="public/admin/assets/js/animation/tilt/tilt-custom.js"></script>
    <!-- dashboard_1-->
    <script src="public/admin/assets/js/dashboard/dashboard_1.js"></script>
    <!-- custom script -->
    <script src="public/admin/assets/js/script.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,             // Adds a close button to the notifications
            "debug": false,                  // Disable debugging
            "newestOnTop": true,             // Display the newest notifications on top
            "progressBar": false,             // Show a progress bar
            "positionClass": "toast-bottom-right",  // Positioning of the toast on the page
            "preventDuplicates": true,       // Prevent showing duplicate notifications
            "onclick": null,                 // Callback when a toast is clicked
            "showDuration": "300",           // Animation duration when showing the notification
            "hideDuration": "1000",          // Animation duration when hiding the notification
            "timeOut": "5000",               // Time in milliseconds before the notification disappears
            "extendedTimeOut": "1000",       // Time in milliseconds after hovering over the toast
            "showEasing": "swing",           // Easing function when showing the toast
            "hideEasing": "linear",          // Easing function when hiding the toast
            "showMethod": "fadeIn",          // Method used to show the toast
            "hideMethod": "fadeOut"          // Method used to hide the toast
        };
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif

        @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif

        @if(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif

        // User Input validation
        @if ($errors->has('nrc_no'))
            toastr.error("{{ $errors->first('nrc_no') }}", "Validation Error");
        @endif

        @if ($errors->has('phone'))
            toastr.error("{{ $errors->first('phone') }}", "Validation Error");
        @endif
    </script>
    <!-- Include Flatpickr script -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
    <script>
        flatpickr("#dueDate", {
            dateFormat: "Y-m-d", // Laravel's standard format
        });
        flatpickr("#customerDob", {
            dateFormat: "Y-m-d", // Laravel's standard format
        });
        flatpickr("#nokDob", {
            dateFormat: "Y-m-d", // Laravel's standard format
        });
        flatpickr("#dob", {
            dateFormat: "Y-m-d", // Laravel's standard format
        });
        let table = new DataTable('#customerTable', {
            order: [[0, 'desc']]
        });
        let table2 = new DataTable('#guarantorTable',{
            order: [[0, 'desc']]
        });
        let table3 = new DataTable('#nxtkinTable',{
            order: [[0, 'desc']]
        });
        let table4 = new DataTable('#loanReqTable',{
            order: [[5, 'desc']]
        });
        let table5 = new DataTable('#example3Users',{
            order: [[6, 'desc']]
        });

    </script>
    <script>
        $(document).ready(function() {
            $("#customerphone").on("input", function() {
                let phoneValue = $(this).val().replace(/\D/g, ''); // Remove non-digits

                if (phoneValue.length > 10) {
                    phoneValue = phoneValue.slice(0, 10); // Limit to 10 digits
                }

                // Format the phone number
                if (phoneValue.length > 3 && phoneValue.length <= 6) {
                    phoneValue = phoneValue.slice(0, 3) + '-' + phoneValue.slice(3);
                } else if (phoneValue.length > 6) {
                    phoneValue = phoneValue.slice(0, 3) + '-' + phoneValue.slice(3, 6) + '-' + phoneValue.slice(6);
                }

                $(this).val(phoneValue);

                if (phoneValue.replace(/\D/g, '').length < 10) {
                    $(this).css("border-color", "red");
                } else {
                    $(this).css("border-color", "");
                }
            });
            $("#customerphone").on("keypress", function(e) {
                if (!/[0-9]/.test(String.fromCharCode(e.which))) {
                    return false; // Block non-numeric input
                }
            });

            $("#phone").on("input", function() {
                let phoneValue = $(this).val().replace(/\D/g, ''); // Remove non-digits

                if (phoneValue.length > 10) {
                    phoneValue = phoneValue.slice(0, 10); // Limit to 10 digits
                }

                // Format the phone number
                if (phoneValue.length > 3 && phoneValue.length <= 6) {
                    phoneValue = phoneValue.slice(0, 3) + '-' + phoneValue.slice(3);
                } else if (phoneValue.length > 6) {
                    phoneValue = phoneValue.slice(0, 3) + '-' + phoneValue.slice(3, 6) + '-' + phoneValue.slice(6);
                }

                $(this).val(phoneValue);

                if (phoneValue.replace(/\D/g, '').length < 10) {
                    $(this).css("border-color", "red");
                } else {
                    $(this).css("border-color", "");
                }
            });


            $("#empphone").on("keypress", function(e) {
                if (!/[0-9]/.test(String.fromCharCode(e.which))) {
                    return false; // Block non-numeric input
                }
            });$("#empphone").on("input", function() {
                let phoneValue = $(this).val().replace(/\D/g, ''); // Remove non-digits

                if (phoneValue.length > 10) {
                    phoneValue = phoneValue.slice(0, 10); // Limit to 10 digits
                }

                // Format the phone number
                if (phoneValue.length > 3 && phoneValue.length <= 6) {
                    phoneValue = phoneValue.slice(0, 3) + '-' + phoneValue.slice(3);
                } else if (phoneValue.length > 6) {
                    phoneValue = phoneValue.slice(0, 3) + '-' + phoneValue.slice(3, 6) + '-' + phoneValue.slice(6);
                }

                $(this).val(phoneValue);

                if (phoneValue.replace(/\D/g, '').length < 10) {
                    $(this).css("border-color", "red");
                } else {
                    $(this).css("border-color", "");
                }
            });
            $("#empphone").on("keypress", function(e) {
                if (!/[0-9]/.test(String.fromCharCode(e.which))) {
                    return false; // Block non-numeric input
                }
            });
        });
    </script>
  </body>
</html>