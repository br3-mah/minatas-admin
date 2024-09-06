
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-bs-theme="light" data-body-image="img-1" data-preloader="enabled">
<head>

    @php
        $route = request()->route()->getName();
    @endphp
    <meta charset="utf-8" />
    <title>Dashboard | Capex Finance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    @if (
        $route == 'loan-details'
    )
    <link rel="shortcut icon" href="../public/assets/images/fav.png">
    @else
    <link rel="shortcut icon" href="public/assets/images/fav.png">
    @endif

    <!-- jsvectormap css -->
    <link href="public/assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="public/assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css" />
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <script src="https://jsuites.net/v4/jsuites.js"></script>
    <link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <!-- Include jQuery and jQuery UI CSS and JS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    @livewireStyles
</head>

<body  data-route-name="{{ Route::currentRouteName() }}">
    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar" style="
            background-color: rgba(224, 222, 222, 0.5);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 4px 10px rgba(88, 64, 36, 0.1);
            border: 1px solid rgb(255, 255, 255);
            color: white;
            ">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="{{ route('dashboard') }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="public/assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="public/assets/images/logo-dark.png" alt="" height="22">
                        </span>
                    </a>

                    <a href="{{ route('dashboard') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="public/assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="public/assets/images/logo-light.png" alt="" height="22">
                        </span>
                    </a>
                </div>

                <button type="button" class="px-3 btn btn-sm fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
                <div class="app-search d-none d-md-block">
                    {{-- <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search..." autocomplete="off" id="search-options" value="">
                        <span class="mdi mdi-magnify search-widget-icon"></span>
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
                    </div> --}}
                    {{-- <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                        <div data-simplebar style="max-height: 320px;">
                            <!-- item-->
                            <div class="dropdown-header">
                                <h6 class="mb-0 text-overflow text-muted text-uppercase">Recent Searches</h6>
                            </div>

                            <div class="bg-transparent dropdown-item text-wrap">
                                <a href="{{ route('dashboard') }}" class="btn btn-soft-primary btn-sm rounded-pill">how to setup <i class="mdi mdi-magnify ms-1"></i></a>
                                <a href="{{ route('dashboard') }}" class="btn btn-soft-primary btn-sm rounded-pill">buttons <i class="mdi mdi-magnify ms-1"></i></a>
                            </div>
                            <!-- item-->
                            <div class="mt-2 dropdown-header">
                                <h6 class="mb-1 text-overflow text-muted text-uppercase">Pages</h6>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="align-middle ri-bubble-chart-line fs-18 text-muted me-2"></i>
                                <span>Analytics Dashboard</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="align-middle ri-lifebuoy-line fs-18 text-muted me-2"></i>
                                <span>Help Center</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="align-middle ri-user-settings-line fs-18 text-muted me-2"></i>
                                <span>My account settings</span>
                            </a>

                            <!-- item-->
                            <div class="mt-2 dropdown-header">
                                <h6 class="mb-2 text-overflow text-muted text-uppercase">Members</h6>
                            </div>

                            <div class="notification-list">
                                <!-- item -->
                                <a href="javascript:void(0);" class="py-2 dropdown-item notify-item">
                                    <div class="d-flex">
                                        <img src="public/assets/images/users/avatar-2.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">Angela Bernier</h6>
                                            <span class="mb-0 fs-11 text-muted">Manager</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- item -->
                                <a href="javascript:void(0);" class="py-2 dropdown-item notify-item">
                                    <div class="d-flex">
                                        <img src="public/assets/images/users/avatar-3.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">David Grasso</h6>
                                            <span class="mb-0 fs-11 text-muted">Web Designer</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- item -->
                                <a href="javascript:void(0);" class="py-2 dropdown-item notify-item">
                                    <div class="d-flex">
                                        <img src="public/assets/images/users/avatar-5.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">Mike Bunch</h6>
                                            <span class="mb-0 fs-11 text-muted">React Developer</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="pt-3 pb-1 text-center">
                            <a href="pages-search-results.html" class="btn btn-primary btn-sm">View All Results <i class="ri-arrow-right-line ms-1"></i></a>
                        </div>
                    </div> --}}
                </div>
            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="p-0 dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="m-0 form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-category-alt fs-22'></i>
                    </button>
                    <div class="p-0 dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <div class="p-3 border border-dashed border-top-0 border-start-0 border-end-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fw-semibold fs-15"> Quick Goto </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="#!" class="btn btn-sm btn-soft-info"> View All Apps
                                        <i class="align-middle ri-arrow-right-s-line"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="p-2">
                            <div class="row g-0">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="public/assets/images/brands/github.png" alt="Github">
                                        <span>Loan Calculator</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="public/assets/images/brands/bitbucket.png" alt="bitbucket">
                                        <span>Borrowers</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="public/assets/images/brands/dribbble.png" alt="dribbble">
                                        <span>CRB Check</span>
                                    </a>
                                </div>
                            </div>

                            <div class="row g-0">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="public/assets/images/brands/dropbox.png" alt="dropbox">
                                        <span>Settings</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="public/assets/images/brands/mail_chimp.png" alt="mail_chimp">
                                        <span>Loan Products</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="public/assets/images/brands/slack.png" alt="slack">
                                        <span>Institutions</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-bell fs-22'></i>
                        <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">0<span class="visually-hidden">unread messages</span></span>
                    </button>
                    <div class="p-0 dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="page-header-notifications-dropdown">

                        <div class="dropdown-head bg-primary bg-pattern rounded-top">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 text-white fs-16 fw-semibold"> Notifications </h6>
                                    </div>
                                    <div class="col-auto dropdown-tabs">
                                        <span class="badge bg-light-subtle text-body fs-13"> 4 New</span>
                                    </div>
                                </div>
                            </div>

                            <div class="px-2 pt-2">
                                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="true">
                                            All (4)
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#messages-tab" role="tab" aria-selected="false">
                                            Messages
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#alerts-tab" role="tab" aria-selected="false">
                                            Alerts
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="tab-content position-relative" id="notificationItemsTabContent">
                            <div class="py-2 tab-pane fade show active ps-2" id="all-noti-tab" role="tabpanel">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">
                                    {{-- <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xs me-3">
                                                <span class="avatar-title bg-info-subtle text-info rounded-circle fs-16">
                                                    <i class="bx bx-badge-check"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-2 lh-base">Your <b>Elite</b> author Graphic
                                                        Optimization <span class="text-secondary">reward</span> is
                                                        ready!
                                                    </h6>
                                                </a>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> Just 30 sec ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check01">
                                                    <label class="form-check-label" for="all-notification-check01"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex">
                                            <img src="public/assets/images/users/avatar-2.jpg" class="flex-shrink-0 me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Angela Bernier</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">Answered to your comment on the cash flow forecast's
                                                        graph 🔔.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 48 min ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                    <label class="form-check-label" for="all-notification-check02"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xs me-3">
                                                <span class="avatar-title bg-danger-subtle text-danger rounded-circle fs-16">
                                                    <i class='bx bx-message-square-dots'></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-2 fs-13 lh-base">You have received <b class="text-success">20</b> new messages in the conversation
                                                    </h6>
                                                </a>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 2 hrs ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check03">
                                                    <label class="form-check-label" for="all-notification-check03"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex">
                                            <img src="public/assets/images/users/avatar-8.jpg" class="flex-shrink-0 me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Maureen Gibson</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">We talked about a project on linkedin.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 4 hrs ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="all-notification-check04">
                                                    <label class="form-check-label" for="all-notification-check04"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="my-3 text-center view-all">
                                        <button type="button" class="btn btn-soft-success waves-effect waves-light">View
                                            All Notifications <i class="align-middle ri-arrow-right-line"></i></button>
                                    </div>
                                </div>

                            </div>

                            <div class="py-2 tab-pane fade ps-2" id="messages-tab" role="tabpanel" aria-labelledby="messages-tab">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">
                                    <div class="text-reset notification-item d-block dropdown-item">
                                        <div class="d-flex">
                                            <img src="public/assets/images/users/avatar-3.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">James Lemire</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">We talked about a project on linkedin.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 30 min ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="messages-notification-check01">
                                                    <label class="form-check-label" for="messages-notification-check01"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item">
                                        <div class="d-flex">
                                            <img src="public/assets/images/users/avatar-2.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Angela Bernier</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">Answered to your comment on the cash flow forecast's
                                                        graph 🔔.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 2 hrs ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="messages-notification-check02">
                                                    <label class="form-check-label" for="messages-notification-check02"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item">
                                        <div class="d-flex">
                                            <img src="public/assets/images/users/avatar-6.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Kenneth Brown</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">Mentionned you in his comment on 📃 invoice #12501.
                                                    </p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 10 hrs ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="messages-notification-check03">
                                                    <label class="form-check-label" for="messages-notification-check03"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item">
                                        <div class="d-flex">
                                            <img src="public/assets/images/users/avatar-8.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Maureen Gibson</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">We talked about a project on linkedin.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 3 days ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="messages-notification-check04">
                                                    <label class="form-check-label" for="messages-notification-check04"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="my-3 text-center view-all">
                                        <button type="button" class="btn btn-soft-success waves-effect waves-light">View
                                            All Messages <i class="align-middle ri-arrow-right-line"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 tab-pane fade" id="alerts-tab" role="tabpanel" aria-labelledby="alerts-tab"></div>

                            <div class="notification-actions" id="notification-actions">
                                <div class="d-flex text-muted justify-content-center">
                                    Select <div id="select-content" class="px-1 text-body fw-semibold">0</div> Result <button type="button" class="p-0 btn btn-link link-danger ms-3" data-bs-toggle="modal" data-bs-target="#removeNotificationModal">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            @if (auth()->user()->profile_photo_path)
                                @if ($route == 'edit-user' || $route == 'profile.show' || $route == 'loan-details' || $route == 'detailed' || $route == 'loan-statement')
                                    <img class="rounded-circle header-profile-user" src="{{ '../public/'.Storage::url(auth()->user()->profile_photo_path) }}" alt="Profile Pic">
                                @else
                                    <img class="rounded-circle header-profile-user" src="{{ 'public/'.Storage::url(auth()->user()->profile_photo_path) }}" alt="Profile Pic">
                                @endif
                            @else
                                <img class="rounded-circle header-profile-user" src="https://thumbs.dreamstime.com/b/default-avatar-profile-image-vector-social-media-user-icon-potrait-182347582.jpg" alt="Profile Pic">
                            @endif
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-semibold user-name-text">{{ auth()->user()->fname.' '.auth()->user()->lname }}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">{{ preg_replace('/[^A-Za-z0-9. -]/', '',  Auth::user()->roles->pluck('name')) ?? 'Guest' }}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome {{ auth()->user()->fname }}!</h6>
                        <a class="dropdown-item" href="{{ route('profile.show') }}"><i class="align-middle mdi mdi-account-circle text-muted fs-16 me-1"></i> <span class="align-middle">Company Profile</span></a>
                        {{-- <a class="dropdown-item" href="apps-chat.html"><i class="align-middle mdi mdi-message-text-outline text-muted fs-16 me-1"></i> <span class="align-middle">Messages</span></a>
                        <a class="dropdown-item" href="apps-tasks-kanban.html"><i class="align-middle mdi mdi-calendar-check-outline text-muted fs-16 me-1"></i> <span class="align-middle">Taskboard</span></a>
                        <a class="dropdown-item" href="pages-faqs.html"><i class="align-middle mdi mdi-lifebuoy text-muted fs-16 me-1"></i> <span class="align-middle">Help</span></a>--}}
                        <div class="dropdown-divider"></div>
                        {{-- <a class="dropdown-item" href="pages-profile.html"><i class="align-middle mdi mdi-wallet text-muted fs-16 me-1"></i> <span class="align-middle">Balance : <b>K0.0</b></span></a> --}}
                        <a class="dropdown-item" href="{{ route('sys-settings') }}"><span class="mt-1 badge bg-success-subtle text-success float-end">New</span><i class="align-middle mdi mdi-cog-outline text-muted fs-16 me-1"></i> <span class="align-middle">Settings</span></a>
                        {{-- <a class="dropdown-item" href="auth-lockscreen-basic.html"><i class="align-middle mdi mdi-lock text-muted fs-16 me-1"></i> <span class="align-middle">Lock screen</span></a> --}}

                        <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                            @csrf
                            <button type="submit" class="pl-4 btn btn-sm btn-light d-flex align-items-center w-100">
                                <i class="mdi mdi-logout text-muted me-2 fs-5"></i>
                                <span class="align-middle" data-key="t-logout">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- removeNotificationModal -->
<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="pt-2 mx-4 mt-4 fs-15 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="mx-4 mb-0 text-muted">Are you sure you want to remove this Notification ?</p>
                    </div>
                </div>
                <div class="gap-2 mt-4 mb-2 d-flex justify-content-center">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->
        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="{{ route('dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="public/assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="public/assets/images/logo-dark.png" alt="" height="22">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="public/assets/images/logo-light.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="public/assets/images/logo-light.png" alt="" height="22">
                    </span>
                </a>
                <button type="button" class="p-0 btn btn-sm fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('dashboard')}}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('proxy-loan-create') }}" aria-expanded="false" aria-controls="sidebarApps">
                                <i class="ri-apps-2-line"></i> <span data-key="t-apps">Create Loan Request</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('view-loan-requests') }}"  aria-expanded="false" aria-controls="sidebarLayouts">
                                <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Loan Requests</span>
                                {{-- <span class="badge badge-pill bg-danger" data-key="t-hot">2</span> --}}
                            </a>
                        </li>

                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Directories</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarCharts1"  data-bs-toggle="collapse" role="button"  aria-expanded="true" aria-controls="sidebarCharts1">
                                <i class="ri-pie-chart-line"></i> <span data-key="t-charts">Manage Borrowers</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarCharts1">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('borrowers') }}" class="nav-link"  aria-expanded="false" aria-controls="sidebarApexcharts" data-key="t-apexcharts">
                                            Clients
                                        </a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a href="{{ route('guarantors') }}" class="nav-link" data-key="t-chartjs"> Guarantors </a>
                                    </li> --}}
                                    <li class="nav-item">
                                        <a href="{{ route('refs') }}" class="nav-link" data-key="t-chartjs"> Related Parties </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarAdvanceUI" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAdvanceUI">
                                <i class="ri-stack-line"></i> <span data-key="t-advance-ui">Loan Management</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarAdvanceUI">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('approved-loans') }}" class="nav-link" data-key="t-sweet-alerts">Open Loans</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('closed-loans') }}" class="nav-link" data-key="t-nestable-list">Closed Loans</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('due-loans') }}" class="nav-link" data-key="t-scrollbar">Due Loans</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('missed-repayments') }}" class="nav-link" data-key="t-animation">Missed Repayments</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('loan-arrears') }}" class="nav-link" data-key="t-tour">Loans in Arrears</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('no-repayments') }}" class="nav-link" data-key="t-swiper-slider">No Repayments</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('past-maturity-date') }}" class="nav-link" data-key="t-ratings">Past Maturity Date</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('principal-outstanding') }}" class="nav-link" data-key="t-highlight">Principal Outstanding</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('one-month-late') }}" class="nav-link" data-key="t-scrollSpy">1 Month Late Loans</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('three-month-late') }}" class="nav-link" data-key="t-scrollSpy">3 Month Late Loans</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('loan-calculator') }}" class="nav-link" data-key="t-scrollSpy">Loan Calculator</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('employees') }}">
                                <i class="ri-honour-line"></i> <span data-key="t-widgets">Employees</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarCharts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCharts">
                                <i class="ri-pie-chart-line"></i> <span data-key="t-charts">Accounting</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarCharts">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#sidebarApexcharts" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApexcharts" data-key="t-apexcharts">
                                            Repayments
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarApexcharts">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="{{ route('make-payment') }}" class="nav-link" data-key="t-line"> Make Repayment
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a href="{{ route('loan-wallet') }}" class="nav-link" data-key="t-chartjs"> Main Wallet </a>
                                    </li> --}}
                                </ul>
                            </div>
                        </li>

                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Settings</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                                <i class="ri-account-circle-line"></i> <span data-key="t-authentication">User Management</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarAuth">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('users') }}" class="nav-link" aria-expanded="false" aria-controls="sidebarSignIn" data-key="t-signin">
                                            All Users
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('roles') }}" class="nav-link" aria-expanded="false" aria-controls="sidebarSignIn" data-key="t-signin">
                                            User Roles & Permission
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('sys-settings') }}" aria-expanded="false" aria-controls="sidebarAuth">
                                <i class="ri-settings-3-line"></i> <span data-key="t-authentication">Manage Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <!-- End Page-content -->
            {{ $slot }}
            <footer class="footer border-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Greenwebbtech.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Greenwebbtech
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-primary btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <center>
            <img width="300" src="https://bollin.inf.ed.ac.uk/img/loading.gif" alt="">
        </center>
    </div>

    <!-- JAVASCRIPT -->

    @livewireScripts
    <script src="public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="public/assets/libs/node-waves/waves.min.js"></script>
    <script src="public/assets/libs/feather-icons/feather.min.js"></script>
    <script src="public/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="public/assets/js/plugins.js"></script>

    <!-- apexcharts -->
    <script src="public/assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- apexcharts -->
    <script src="public/assets/libs/apexcharts/apexcharts.min.js"></script>
    {{-- <script src="../../../../cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/dayjs.min.js"></script> --}}
  	{{-- <script src="../../../../cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/plugin/quarterOfYear.min.js"></script> --}}

    <!-- apexcharts init -->
    <script src="public/assets/js/pages/apexcharts-column.init.js"></script>

    <!-- Vector map-->
    <script src="public/assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="public/assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!--Swiper slider js-->
    <script src="public/assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- Dashboard init -->
    <script src="public/assets/js/pages/dashboard-ecommerce.init.js"></script>

    <!-- App js -->
    <script src="public/assets/js/app.js"></script>
    <!-- cleave.js -->
    <script src="public/assets/libs/cleave.js/cleave.min.js"></script>
    <!-- form masks init -->
    <script src="public/assets/js/pages/form-masks.init.js"></script>
    <!-- form wizard init -->
    <script src="public/assets/js/pages/form-wizard.init.js"></script>

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


        document.addEventListener("DOMContentLoaded", function () {
            // Get the current route name from the body or an element attribute (assume it's stored in a data attribute)
            const currentRoute = document.body.getAttribute('data-route-name');

            // Check the current route and expand/collapse accordingly
            if (currentRoute === 'borrowers'
                || currentRoute === 'guarantors'
                || currentRoute === 'refs'
                || currentRoute === 'edit-user'
                || currentRoute === 'client-account'
                ) {
                const sidebarCharts = document.getElementById('sidebarCharts1');

                // Collapse if the current route doesn't match any of the specified routes
                sidebarCharts.classList.add('show');
            } else {
                // Otherwise, collapse it
                sidebarCharts.classList.remove('show');
            }

            // Check the current route and expand/collapse accordingly
            if (currentRoute === 'approved-loans'
                || currentRoute === 'due-loans'
                || currentRoute === 'closed-loans'
                || currentRoute === 'missed-repayments'
                || currentRoute === 'loan-arrears'
                || currentRoute === 'no-repaymentss'
                || currentRoute === 'past-maturity-date'
                || currentRoute === 'one-month-late'
                || currentRoute === 'three-month-late'
                || currentRoute === 'loan-calculator'
                || currentRoute === 'new-loan'
                || currentRoute === 'proxy-loan-create'
                || currentRoute === 'loan-details'
                || currentRoute === 'detailed'
                || currentRoute === 'dashboard'
            ) {
                const sidebarCharts = document.getElementById('sidebarAdvanceUI');
                // Collapse if the current route doesn't match any of the specified routes
                sidebarCharts.classList.add('show');
            } else {
                // Otherwise, collapse it
                sidebarCharts.classList.remove('show');
            }

            // Check the current route and expand/collapse accordingly
            if (currentRoute === 'make-payment'
                || currentRoute === 'loan-wallet'
            ) {
                const sidebarCharts = document.getElementById('sidebarApexcharts');

                // Collapse if the current route doesn't match any of the specified routes
                sidebarCharts.classList.add('show');
            } else {
                // Otherwise, collapse it
                sidebarCharts.classList.remove('show');
            }
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
    @script
</body>
</html>
