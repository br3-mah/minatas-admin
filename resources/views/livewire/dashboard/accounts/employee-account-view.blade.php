
<div class="page-content">
    <!-- start page title -->
    <div class="row">
        <div class="px-5 py-4 col-12">
            <div class="bg-transparent page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 fw-bold">Employee Information</h4>

                {{-- <div class="page-title-right">
                    <ol class="m-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employees') }}">Employees</a></li>
                        <li class="breadcrumb-item active">Employee Information</li>
                    </ol>
                </div> --}}

            </div>
        </div>
    </div>
    <div class="container-xxl">
        <div class="gap-2 p-3 rounded-lg col-md-12 row">
                @if (!empty($user->photos))
                    @foreach ($user->photos as $photo )
                        <img src="{{ url('public/storage/' . $photo->path) }}" alt="user-img" class="rounded-sm img-thumbnail col-3" />
                    @endforeach
                @else
                    @if ($user->gender) 
                        @if ($user->gender == 'Female')
                            <img src="public/assets/images/girl.png" alt="user-img" class="rounded-sm img-thumbnail" />
                        @else
                            <img src="public/assets/images/boy.png" alt="user-img" class="rounded-sm img-thumbnail" />
                        @endif
                    @else
                        <img src="public/assets/images/user.png" alt="user-img" class="rounded-sm img-thumbnail" />
                    @endif
                @endif
        </div>
        <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
            <div class="row g-4">
                <!--end col-->
                <div class="col">
                    <div class="p-2">
                        <h3 class="mb-1 fs-2"><b>{{ $user->fname.' '.$user->lname }}</b></h3>
                        <div class="fw-bold fs-4">
                            {{ preg_replace('/[^A-Za-z0-9. -]/', '',  $user->roles->pluck('name')) ?? 'Guest' }}
                        </div>
                        <div class="gap-1 hstack text-muted">
                            <div class="me-2"><i class="align-bottom ri-map-pin-user-line me-1 fs-16 text-body"></i>{{ $user->address ?? 'No Address' }}</div>
                            @if ($user->occupation || $user->jobTitle)
                            <div>
                                <i class="align-bottom ri-building-line me-1 fs-16 text-body"></i>{{ $user->jobTitle ?? $user->occupation ?? 'No Occupation'  }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!--end col-->
                 <div class="order-last col-12 col-lg-auto order-lg-0">
                    <div class="text-center row text">
                        <div class="col-lg-6 col-4">
                            <div class="p-2">
                                <h4 class="mb-1">K{{ App\Models\Loans::customer_balance($user->id) }}</h4>
                                <p class="mb-0 fs-14 text-muted">Current Amount Owing</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-4">
                            <div class="p-2">
                                <h4 class="mb-1">K{{ App\Models\Loans::customer_total_borrowed($user->id) }}</h4>
                                <p class="mb-0 fs-14 text-muted">Overall Total Amount Borrowed (Pending/Open/Closed)</p>
                            </div>
                        </div>
                    </div>
                </div> 
                <!--end col-->

            </div>
            <!--end row-->
        </div>


        
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <!-- Tab panes -->
                    <div class="pt-4 tab-content text-muted">
                        <div class="tab-pane active" id="overview-tab" role="tabpanel">
                            <div class="px-3">
                                <div class="p-4 container-fluid bg-light-success rounded-3">
                                    <div class="row g-4">
                                        <!-- Basic & Personal Information -->
                                        <div class="col-md-6">
                                            <div class="border-0 shadow-sm card h-100">
                                                <div class="card-body">
                                                    <h5 class="mb-4 card-title text-success"><i class="bi bi-person-circle me-2"></i>Basic & Personal Information</h5>
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless">
                                                            <tbody>
                                                                <tr>
                                                                    <th class="text-success fw-medium w-35">Full Name:</th>
                                                                    <td>{{ $user->fname.' '.$user->lname }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-success fw-medium">Gender:</th>
                                                                    <td class="text-capitalize">{{ $user->gender }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-success fw-medium">Mobile:</th>
                                                                    <td>{{ $user->phone }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-success fw-medium">E-mail:</th>
                                                                    <td>{{ $user->email }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-success fw-medium">Location:</th>
                                                                    <td>{{ $user->address ?? 'No Address' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-success fw-medium">Joined Date:</th>
                                                                    <td>{{ $user->created_at->toFormattedDateString() }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Next of Kin -->
                                        <div class="col-md-6">
                                            <div class="border-0 shadow-sm card h-100">
                                                <div class="card-body">
                                                    <h5 class="mb-4 card-title text-success"><i class="bi bi-people me-2"></i>Next of Kin</h5>
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless">
                                                            <tbody>
                                                                <tr>
                                                                    <th class="text-success fw-medium w-35">Full Name:</th>
                                                                    <td>{{ $user->nokfname.' '.$user->noklname }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-success fw-medium">Phone Number:</th>
                                                                    <td>{{ $user->nokphone ?? 'No Phone' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-success fw-medium">Date of Birth:</th>
                                                                    <td>{{ $user->nokDob ?? 'No Record' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-success fw-medium">Email Address:</th>
                                                                    <td>{{ $user->nokemail ?? 'No Email' }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Employment Details -->
                                    
                                    </div>
                                </div>
                                <!--end col-->
                                {{-- <div class="col-xxl-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="mb-3 card-title">About</h5>
                                            <p>Hi I'm Anna Adame, It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is European languages are members of the same family.</p>
                                            <p>You always want to make sure that your fonts work well together and try to limit the number of fonts you use to three or less. Experiment and play around with the fonts that you already have in the software you’re working with reputable font websites. This may be the most commonly encountered tip I received from the designers I spoke with. They highly encourage that you use different fonts in one design, but do not over-exaggerate and go overboard.</p>
                                            <div class="row">
                                                <div class="col-6 col-md-4">
                                                    <div class="mt-4 d-flex">
                                                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                                <i class="ri-user-2-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="overflow-hidden flex-grow-1">
                                                            <p class="mb-1">Designation :</p>
                                                            <h6 class="mb-0 text-truncate">Lead Designer / Developer</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-6 col-md-4">
                                                    <div class="mt-4 d-flex">
                                                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                                <i class="ri-global-line"></i>
                                                            </div>
                                                        </div>
                                                        <div class="overflow-hidden flex-grow-1">
                                                            <p class="mb-1">Website :</p>
                                                            <a href="#" class="fw-semibold">www.velzon.com</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </div>
                                        <!--end card-body-->
                                    </div><!-- end card -->

                                </div> --}}
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        
                        <!--end tab-pane-->
                    </div>
                    <!--end tab-content-->
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div><!-- container-fluid -->
</div><!-- End Page-content -->
