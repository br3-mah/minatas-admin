
<!-- Page sidebar end-->
<div class="page-body">
    <div class="container-fluid">
    <div class="page-title">
        <div class="row">
        <div class="col-sm-6 col-12"> 
            <h2>My Dashboard</h2>
            <p class="mb-0 text-title-gray">Welcome back! Let’s start from where you left.</p>
        </div>
        <div class="col-sm-6 col-12">
            {{-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html"><i class="iconly-Home icli svg-color"></i></a></li>
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">Main</li>
            </ol> --}}
        </div>
        </div>
    </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid default-dashboard">
    <div class="row">
        <div class="col-xl-4 proorder-xxl-1 col-sm-6 box-col-6">
        <div class="card welcome-banner">
            <div class="p-0 card-header card-no-border">
            <div class="welcome-card">
            <img class="w-100 img-fluid" src="public/admin/assets/images/dashboard-1/welcome-bg.png" alt=""/><img class="position-absolute img-1 img-fluid" src="public/admin/assets/images/dashboard-1/img-1.png" alt=""/><img class="position-absolute img-2 img-fluid" src="public/admin/assets/images/dashboard-1/img-2.png" alt=""/><img class="position-absolute img-3 img-fluid" src="public/admin/assets/images/dashboard-1/img-3.png" alt=""/><img class="position-absolute img-4 img-fluid" src="public/admin/assets/images/dashboard-1/img-4.png" alt=""/><img class="position-absolute img-5 img-fluid" src="public/admin/assets/images/dashboard-1/img-5.png" alt=""/></div>
            </div>
            <div class="card-body">
            <div class="d-flex align-center">
                <h1>Hello, {{ auth()->user()->fname }}  <img src="public/admin/assets/images/dashboard-1/hand.png" alt=""/></h1>
            </div>
            <p> Welcome back! Let’s start from where you left.</p>
            <div class="d-flex align-center justify-content-between"><a class="btn btn-pill btn-primary" href="{{ route('proxy-loan-create') }}">Create New Loan!</a><span> 
                {{-- <svg class="stroke-icon">
                    <use href="https://admin.pixelstrap.net/admiro/public/admin/assets/svg/icon-sprite.svg#watch"></use>
                </svg>  --}}
                
                11:14 AM</span></div>
            </div>
        </div>
        </div>
        <div class="col-xxl-3 col-xl-4 proorder-xxl-2 col-sm-6 box-col-6">
        <div class="card earning-card">
            <div class="pb-0 card-header card-no-border">
            <div class="header-top">
                <h3>Last 5 Months Earnings Trend </h3>
                <div class="dropdown">
                <button class="btn dropdown-toggle" id="userdropdown3" type="button" data-bs-toggle="dropdown" aria-expanded="false">Monthly</button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown3"><a class="dropdown-item" href="#">Weekly</a><a class="dropdown-item" href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a></div>
                </div>
            </div>
            </div>
            <div class="pb-0 card-body">
            <div class="gap-3 d-flex align-center">
                <h2>K 0.00</h2>
                
                {{-- <span class="text-primary">
                    36.28%
                <svg class="stroke-icon stroke-primary">
                    <use href="https://admin.pixelstrap.net/admiro/public/admin/assets/svg/icon-sprite.svg#arrow-down"></use>
                </svg></span> --}}
            </div>
            <div id="earnings-chart"></div>
            </div>
        </div>
        </div>
        <div class="col-xxl-5 col-xl-6 proorder-xxl-7 col-lg-12 box-col-12">
        <div class="card job-card">
            <div class="pb-0 card-header card-no-border">
            <div class="header-top">
                <h3>Stats</h3>
                <div>  
                <p>Tuesday 10, <span>September 2024</span></p>
                </div>
            </div>
            </div>
            <div class="pt-2 card-body">
                <ul class="gap-3 d-flex align-center justify-content-center"> 
                    <li>
                        <div class="gap-2 d-flex"> 
                            {{-- <div class="flex-shrink-0 bg-light-primary">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/admiro/public/admin/assets/svg/icon-sprite.svg#job-bag"></use>
                                </svg>
                            </div> --}}
                            <div class="flex-grow-1"> 
                                <h3>0</h3>
                                <p>Open Loans</p>
                            </div>
                        </div>
                    </li>
                    <li>
                    <div class="gap-2 d-flex"> 
                        {{-- <div class="flex-shrink-0 bg-light-secondary">
                        <svg class="stroke-icon">
                            <use href="https://admin.pixelstrap.net/admiro/public/admin/assets/svg/icon-sprite.svg#employees"></use>
                        </svg>
                        </div> --}}
                        <div class="flex-grow-1"> 
                        <h3>0</h3>
                        <p>Closed Loans</p>
                        </div>
                    </div>
                    </li>
                    <li>
                    <div class="gap-2 d-flex"> 
                        {{-- <div class="flex-shrink-0 bg-light-warning">
                        <svg class="stroke-icon">
                            <use href="https://admin.pixelstrap.net/admiro/public/admin/assets/svg/icon-sprite.svg#hours-work"></use>
                        </svg>
                        </div> --}}
                        <div class="flex-grow-1"> 
                            <h3>0</h3>
                            <p>Pending Loans</p>
                        </div>
                    </div>
                    </li>
                </ul>
                <br>
                <ul class="gap-3 d-flex align-center justify-content-center"> 
                    <li>
                        <div class="gap-2 d-flex"> 
                            <div class="flex-grow-1"> 
                                <h3>0</h3>
                                <p>Loans in Arears</p>
                            </div>
                        </div>
                    </li>
                    <li>
                    <div class="gap-2 d-flex"> 
                        {{-- <div class="flex-shrink-0 bg-light-secondary">
                        <svg class="stroke-icon">
                            <use href="https://admin.pixelstrap.net/admiro/public/admin/assets/svg/icon-sprite.svg#employees"></use>
                        </svg>
                        </div> --}}
                        <div class="flex-grow-1"> 
                        <h3>0</h3>
                        <p>Unresolved Loans</p>
                        </div>
                    </div>
                    </li>
                    <li>
                    <div class="gap-2 d-flex"> 
                        {{-- <div class="flex-shrink-0 bg-light-warning">
                        <svg class="stroke-icon">
                            <use href="https://admin.pixelstrap.net/admiro/public/admin/assets/svg/icon-sprite.svg#hours-work"></use>
                        </svg>
                        </div> --}}
                        <div class="flex-grow-1"> 
                        <h3>0</h3>
                        <p>Reject Loans</p>
                        </div>
                    </div>
                    </li>
                </ul>
                <br>
                <ul class="gap-3 d-flex align-center justify-content-center"> 
                    <li>
                        <div class="gap-2 d-flex"> 
                            {{-- <div class="flex-shrink-0 bg-light-primary">
                                <svg class="stroke-icon">
                                    <use href="https://admin.pixelstrap.net/admiro/public/admin/assets/svg/icon-sprite.svg#job-bag"></use>
                                </svg>
                            </div> --}}
                            <div class="flex-grow-1"> 
                                <h3>K0</h3>
                                <p>Disbursed to Date</p>
                            </div>
                        </div>
                    </li>
                    <li>
                    <div class="gap-2 d-flex"> 
                        {{-- <div class="flex-shrink-0 bg-light-secondary">
                        <svg class="stroke-icon">
                            <use href="https://admin.pixelstrap.net/admiro/public/admin/assets/svg/icon-sprite.svg#employees"></use>
                        </svg>
                        </div> --}}
                        <div class="flex-grow-1"> 
                        <h3>K0</h3>
                        <p>Repayments to Date</p>
                        </div>
                    </div>
                    </li>
                    <li>
                    <div class="gap-2 d-flex"> 
                        {{-- <div class="flex-shrink-0 bg-light-warning">
                        <svg class="stroke-icon">
                            <use href="https://admin.pixelstrap.net/admiro/public/admin/assets/svg/icon-sprite.svg#hours-work"></use>
                        </svg>
                        </div> --}}
                        <div class="flex-grow-1"> 
                        <h3>K0</h3>
                        <p>Total Rejected</p>
                        </div>
                    </div>
                    </li>
                </ul>
            </div>
        </div>
        </div>


        <div class="col-xxl-6 col-xl-8 proorder-xxl-8 col-lg-12 col-md-6 box-col-7">
        <div class="card">
            <div class="pb-0 card-header card-no-border">
            <h3>Recent Active Loans</h3>
            </div>
            <div class="pt-0 card-body transaction-history">
            
            <div class="table-responsive theme-scrollbar">
                <table class="table display table-bordernone" id="transaction" style="width:100%">
                    <thead> 
                        <tr>
                          <th>Description</th>
                            <th>Phone</th>
                            <th>Principal</th>
                            <th>Sex</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    @forelse($all_loan_requests as $loan)
                        <tr>
                            {{-- <td>{{ $loan->uuid }}</td> --}}
                            <td>
                                <div class="gap-3 d-flex align-items-center">
                                    {{-- <div class="flex-shrink-0">
                                    <img src="public/admin/assets/images/dashboard-1/icon/1.png" alt=""/>
                                    </div> --}}
                                    <div class="flex-grow-1"><a href="product-page.html">
                                        <h6>{{ $loan->loan_product->name }}</h6></a>
                                        <p>
                                            {{ $loan->user->fname.' '.$loan->user->lname }}
                                            {{ $loan->user->phone }}
                                            {{ $loan->occupation ?? $loan->jobTitle }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <h6>{{ $loan->amount }}</h6>
                            </td>
                            <td>
                                <div class="d-flex"> 
                                    <div class="flex-grow-1">
                                        <h6>K {{ $loan->amount }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $loan->user->gender ?? 'Not set' }}</td>
                            <td>{{ $loan->created_at->toFormattedDateString() }}</td>
                            <td class="text-end">
                                <div class="btn bg-light-success border-light-success text-success">
                                    @if($loan->status == 0)
                                        Pending
                                    @elseif($loan->status == 1)
                                        Open
                                    @elseif($loan->status == 2)
                                        Pending
                                    @elseif($loan->status = 3)
                                        Danger
                                    @else
                                        Paid
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <div class="px-3 text-muted">
                                No Loans have been requested.
                            </div>
                        </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>



        <div class="col-xxl-6 col-xl-7 proorder-xxl-5 col-md-6 box-col-6">
        <div class="card height-equal">
            <div class="pb-0 card-header card-no-border">
                <h3>Recent Pending Processing Loans</h3>
            </div>
            <div class="pt-0 card-body manage-invoice filled-checkbox">
            <div class="table-responsive theme-scrollbar">
                <table class="table mt-0 display table-bordernone" id="manage-invoice" style="width:100%">
                <thead>
                    <tr> 
                        <th>Description.</th>
                        <th>Phone</th>
                        <th>Occupation</th>
                        <th>Principal</th>
                        <th>Status</th>
                        <th>Sex</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($all_loan_requests as $loan)
                        <tr>
                            <td>
                                <div class="text-left">
                                    {{ $loan->loan_product->name }}
                                </div>
                                <p class="f-w-600">
                                    <a target="_blank" href="{{ route('client-account', ['key'=>$loan->user->id]) }}">
                                        {{ ucwords($loan->user->fname).' '.ucwords($loan->user->lname) }}
                                    </a>
                                    <a target="_blank" href="{{ route('detailed', ['id' => $loan->id]) }}">No. {{ $loan->uuid }}</a>
                                </p>
                            </td>
                            <td>
                                <h6 class="f-w-600">
                                    {{  $loan->user->phone ?? 'No Phone' }}
                                </h6>
                            </td>
                            <td>
                                <h6 class="f-w-600">K{{ $loan->amount }}</h6>
                            </td>
                            <td>
                                <h6 class="f-w-600">K{{ $loan->amount }}</h6>
                            </td>
                            <td> 
                                <p class="f-w-600">
                                     {{ $loan->user->gender ?? 'Not set' }}
                                </p>
                            </td>
                            <td class="text-end"> 
                                <div class="btn bg-light-success border-light-success text-success">
                                     @if($loan->status == 0)
                                        Pending
                                    @elseif($loan->status == 1)
                                        Open
                                    @elseif($loan->status == 2)
                                        Pending
                                    @elseif($loan->status = 3)
                                        Danger
                                    @else
                                        Paid
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <div class="px-3 text-muted">
                            No Loans have been requested.
                        </div>
                    </tr>
                    @endforelse
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>


        <div class="col-lg-6 proorder-xxl-6 box-col-12">
        <div class="card growthcard">
            <div class="pb-0 card-header card-no-border">
            <div class="header-top">
                <h3>Monthly Revenue Growth</h3>
                <ul class="simple-wrapper nav nav-pills" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link" id="home-tab" data-bs-toggle="tab" href="#yearly" role="tab" aria-selected="true">Yearly</a></li>
                <li class="nav-item"><a class="nav-link" id="profile-tabs" data-bs-toggle="tab" href="#monthly" role="tab" aria-selected="false">Monthly</a></li>
                <li class="nav-item"><a class="nav-link active" id="contact-tab" data-bs-toggle="tab" href="#weekly" role="tab" aria-selected="false">Weekly</a></li>
                </ul>
            </div>
            </div>
            <div class="pb-0 card-body">
            <div id="growth-chart"></div>
            </div>
        </div>
        </div>
        <div class="col-xxl-3 col-xl-5 proorder-xxl-4 col-md-6 box-col-6">
        <div class="card">
            <div class="pb-0 card-header card-no-border">
            <div class="header-top">
                <h3>Top Clients</h3>
                <div class="dropdown icon-dropdown">
                    <span title="Clients that have constantly repaid and closed their recent active/open loans" class="btn" id="userdropdown7" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis"></i>
                    </span>
                </div>
            </div>
            </div>
            <div class="pt-2 card-body top-user">
            <ul>
                @forelse ($this->getClosedLoanRequests('auto')->take(10) as $loan)
                <li class="gap-2 d-flex align-items-center justify-content-between"> 
                    <div class="gap-2 d-flex">
                        <div class="flex-shrink-0 comman-round">
                            <img src="public/admin/assets/images/dashboard-1/user/01.png" alt=""/>
                        </div>
                        <div><a href="#"> 
                            <h6> {{ $loan->user->fname.' '.$loan->user->lname }} </h6></a>
                        <p> 
                            <svg class="stroke-icon">
                            <use href="https://admin.pixelstrap.net/admiro/public/admin/assets/svg/icon-sprite.svg#map-icon"></use>
                            </svg>Texas
                        </p>
                        </div>
                    </div>
                    <button class="btn bg-light-success border-light-success text-success">Completed</button><span>K{{ $loan->amount }}</span>
                </li>
                @empty
                <div class="px-3 text-muted">
                    <p>No Top Clients</a>
                </div>
                @endforelse
            </ul>
            </div>
        </div>
        </div>


        
        
        <div class="col-xxl-3 col-xl-4 proorder-xxl-11 col-md-6 box-col-6">
        <div class="card height-equal">
            <div class="pb-0 card-header card-no-border">
            <div class="header-top">
                <h3>Total Reprayments</h3>
                {{-- <div class="dropdown icon-dropdown">
                <button class="btn" id="userdropdown1" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis"></i></button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown1"><a class="dropdown-item" href="#">Weekly</a><a class="dropdown-item" href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a></div>
                </div> --}}
            </div>
            </div>
            <div class="card-body total-invest">
            <div class="row"> 
                <div class="col-6 col-md-12 income-chart">
                <div class="Incomechrt" id="Incomechrt"></div>
                </div>
                <div class="text-center col-6 col-md-12 invest-content">
                <svg class="stroke-icon">
                    <use href="https://admin.pixelstrap.net/admiro/public/admin/assets/svg/icon-sprite.svg#chart-invest"></use>
                </svg>
                <div class="btn btn-pill btn-primary"> <span> </span>Live</div>
                <p class="mb-0 des-title">This Invest Cycle</p>
                <h3>7,48,000</h3>
                <p class="description-title">Current Balance this invest cycle</p>
                </div>
            </div>
            </div>
        </div>
        </div>

        
    </div>
    </div>
</div>
{{-- <footer class="footer"> 
    <div class="container-fluid">
    <div class="row"> 
        <div class="col-md-6 footer-copyright">
        <p class="mb-0">Copyright 2024 © Admiro theme by pixelstrap.</p>
        </div>
        <div class="col-md-6">
        <p class="mb-0 float-end">Hand crafted &amp; made with
            <svg class="svg-color footer-icon">
            <use href="https://admin.pixelstrap.net/admiro/assets/svg/iconly-sprite.svg#heart"></use>
            </svg>
        </p>
        </div>
    </div>
    </div>
</footer> --}}
</div>