<header class="page-header row">
{{-- LOGO  --}}
<div class="col-auto logo-wrapper d-flex align-items-center">
    <a href="index.html">
        <img class="light-logo img-fluid" src="public/admin/img/logo-white.svg" alt="logo"/>
        <img class="dark-logo img-fluid" src="public/admin/img/logo-dark.svg" alt="logo"/>
    </a>
    {{-- <a class="close-btn toggle-sidebar" href="javascript:void(0)">
        <svg class="svg-color">
            <use href="#Category"></use>
        </svg>
    </a> --}}
</div>

{{-- TOP NAVBAR --}}
<div class="page-main-header col">
    <div class="header-left">
    <form class="form-inline search-full col" action="#" method="get">
        <div class="form-group w-100">
        <div class="Typeahead Typeahead--twitterUsers">
            <div class="u-posRelative">
            <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Loan ID .." name="q" title="" autofocus="autofocus"/>
            <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
            </div>
            <div class="Typeahead-menu"></div>
        </div>
        </div>
    </form>
    <div class="form-group-header d-lg-block d-none">
        <div class="Typeahead Typeahead--twitterUsers">
        <div class="u-posRelative d-flex align-items-center"> 
            <input class="py-0 demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Loan ID..." name="q" title=""/><i class="search-bg iconly-Search icli"></i>
        </div>
        </div>
    </div>
    </div>
    <div class="nav-right">
    <ul class="header-right"> 
        
        <li class="search d-lg-none d-flex"> <a href="javascript:void(0)">
            <svg>
            <use href="#Search"></use>
            </svg></a></li>
        <li>  <a class="dark-mode" href="javascript:void(0)">
            <svg>
            <use href="#moondark"></use>
            </svg></a></li>
        <li class="custom-dropdown"><a href="javascript:void(0)">
            <svg>
            <use href="#notification"></use>
            </svg></a><span class="badge rounded-pill badge-primary"> {{ auth()->user()->notifications()->count() }} </span>
            <div class="py-0 overflow-hidden custom-menu notification-dropdown">
                <h3 class="title bg-primary-light dropdown-title">Notification 
                    <a href="{{ route('notifications') }}" class="font-primary">View all</a>
                </h3>
                <ul class="activity-timeline">
                    @forelse (auth()->user()->notifications()->get() as $note)
                        <li class="d-flex align-items-start">
                            <div class="activity-line"></div>
                            <div class="activity-dot-primary"></div>
                            <div class="flex-grow-1">
                            <h6 class="f-w-600 font-primary">{{ $note->created_at->toFormattedDateString() }}<span>Today</span><span class="circle-dot-primary float-end">
                                <svg class="circle-color">
                                    <use href="#circle"></use>
                                </svg></span></h6>
                            <h5>{{ $note->data['name'] }}</h5>
                            <p class="mb-0">{{ $note->data['msg'] }}</p>
                            </div>
                        </li>
                    @empty
                        <li class="d-flex align-items-start">
                            <div class="activity-dot-primary"></div>
                            <div class="flex-grow-1">
                            No Notifications
                            </div>
                        </li> 
                    @endforelse
                    
                </ul>
            </div>
        </li>
        
        <li class="profile-nav custom-dropdown">
        <div class="user-wrap">
            <div class="user-img">
                @if (auth()->user()->profile_photo_path)
                    @if ($route == 'edit-user' || $route == 'profile.show' || $route == 'loan-details' || $route == 'detailed' || $route == 'loan-statement')
                        <img width="50" src="{{ '../public/'.Storage::url(auth()->user()->profile_photo_path) }}" alt="Profile Pic">
                    @else
                        <img width="50" src="{{ 'public/'.Storage::url(auth()->user()->profile_photo_path) }}" alt="Profile Pic">
                    @endif
                @else
                    <img width="50" src="https://thumbs.dreamstime.com/b/default-avatar-profile-image-vector-social-media-user-icon-potrait-182347582.jpg" alt="Profile Pic">
                @endif
            </div>
            <div class="user-content">
            <h6>{{ auth()->user()->fname.' '.auth()->user()->lname }}</h6>
            <p class="mb-0">{{ preg_replace('/[^A-Za-z0-9. -]/', '',  Auth::user()->roles->pluck('name')) ?? 'Guest' }}<i class="fa-solid fa-chevron-down"></i></p>
            </div>
        </div>
        <div class="overflow-hidden custom-menu">
            <ul class="profile-body">
            <li class="d-flex"> 
                <svg class="svg-color">
                <use href="#Profile"></use>
                </svg><a class="ms-2" href="{{ route('profile.show') }}">Account</a>
            </li>
            <li class="d-flex"> 
                <svg class="svg-color">
                <use href="#Message"></use>
                </svg><a class="ms-2" target="_blank" href="https://mail.google.com">Gmail</a>
            </li>
            {{-- <li class="d-flex"> 
                <svg class="svg-color">
                <use href="#Document"></use>
                </svg><a class="ms-2" href="to-do.html">Task</a>
            </li> --}}
            <li class="d-flex">
                <svg class="svg-color">
                    <use href="#Login"></use>
                </svg>
                <form method="POST" action="{{ route('logout') }}" class="ms-2">
                    @csrf
                    <button type="submit" class="btn btn-link">Log Out</button>
                </form>
            </li>

            </ul>
        </div>
        </li>
    </ul>
    </div>
</div>
</header>