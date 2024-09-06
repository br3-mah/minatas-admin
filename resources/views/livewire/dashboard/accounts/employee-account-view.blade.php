
<div class="page-content">
    <!-- start page title -->
    <div class="row">
        <div class="px-4 col-12">
            <div class="bg-transparent page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Employee Information</h4>

                <div class="page-title-right">
                    <ol class="m-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employees') }}">Employees</a></li>
                        <li class="breadcrumb-item active">Employee Information</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid">
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
                        <h3 class="mb-1"><b>{{ $user->fname.' '.$user->lname }}</b></h3>
                        <div class="gap-1 hstack text-muted">
                            <div class="me-2"><i class="align-bottom ri-map-pin-user-line me-1 fs-16 text-body"></i>{{ $user->address ?? 'No Address' }}</div>
                            @if ($user->occupation || $user->jobTitle)
                                
                            @endif
                            <div>
                                <i class="align-bottom ri-building-line me-1 fs-16 text-body"></i>{{ $user->jobTitle ?? $user->occupation ?? 'No Occupation'  }}
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
                {{-- <div class="order-last col-12 col-lg-auto order-lg-0">
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
                </div> --}}
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
                                <div class="row">
                                    <div class="card col-md-6">
                                        <div class="card-body">
                                            <h5 class="mb-3 card-title"><b>Basic & Personal Information</b></h5>
                                            <div class="px-8 table-responsive row">
                                                <div class="table px-8 mb-0 table-borderless">
                                                    <div class="px-10 pt-2">
                                                        <p>
                                                            <th class="ps-0 text-warning fs-9" scope="row"><b>Full Name :</b></th>
                                                            <td class="text-muted">{{ $user->fname.' '.$user->lname }}</td>
                                                        </p>
                                                        <p>
                                                            <th class="ps-0 text-warning fs-9" scope="row"><b>Gender :</b></th>
                                                            <td class="uppercase text-muted">{{ $user->gender }}</td>
                                                        </p>
                                                        <p>
                                                            <th class="ps-0 text-warning fs-9" scope="row"><b>Mobile :</b></th>
                                                            <td class="text-muted">{{ $user->phone }}</td>
                                                        </p>
                                                        <p>
                                                            <th class="ps-0 text-warning fs-9" scope="row"><b>E-mail :</b></th>
                                                            <td class="text-muted">{{ $user->email }}</td>
                                                        </p>
                                                        <p>
                                                            <th class="ps-0 text-warning fs-9" scope="row"><b>Location :</b></th>
                                                            <td class="text-muted">{{ $user->address ?? 'No Address' }}
                                                            </td>
                                                        </p>
                                                        <p>
                                                            <th class="ps-0 text-warning fs-9" scope="row"><b>Joined Date</b></th>
                                                            <td class="text-muted">{{ $user->created_at->toFormattedDateString() }}</td>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card col-md-6">
                                        <div class="card-body">
                                            <div class="mb-2 d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-0 card-title"><b>Next of Kin</b></h5>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="py-3 d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-xs me-3">
                                                        <img src="public/assets/images/user.png" alt="" class="img-fluid rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="mb-1 fs-14">Fullnames</h5>
                                                            <p class="mb-0 fs-13 text-muted">{{ $user->nokfname.' '.$user->noklname }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="py-3 d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-xs me-3">
                                                        <img src="public/assets/images/users/phone.png" alt="" class="img-fluid rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="mb-1 fs-14">Phone Number</h5>
                                                            <p class="mb-0 fs-13 text-muted">{{ $user->nokphone ?? 'No Phone' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="py-3 d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-xs me-3">
                                                        <img src="public/assets/images/users/calendar.png" alt="" class="img-fluid rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="mb-1 fs-14">Date of Birth</h5>
                                                            <p class="mb-0 fs-13 text-muted">{{ $user->nokDob ?? 'No Record' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="py-3 d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-xs me-3">
                                                        <img src="public/assets/images/users/email.png" alt="" class="img-fluid rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="mb-1 fs-14">Email Address</h5>
                                                            <p class="mb-0 fs-13 text-muted">{{ $user->nokemail ?? 'No Email' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div>
                                    <!--end card-->

                                    <div class="card col-md-12">
                                        <div class="card-body">
                                            <div class="mb-4 d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-0 card-title"><b>Employement Details</b></h5>
                                                </div>
                                            </div>
                                            <div class="mb-4 d-flex">
                                                <div class="flex-shrink-0">
                                                    <img src="assets/images/small/img-4.jpg" alt="" height="50" class="rounded" />
                                                </div>
                                                <div class="overflow-hidden flex-grow-1 ms-3">
                                                    <a href="javascript:void(0);">
                                                        <h6 class="text-truncate fs-14">Employer</h6>
                                                    </a>
                                                    <p class="mb-0 text-muted">{{ $user->employer }}</p>
                                                </div>
                                            </div>
                                            <div class="mb-4 d-flex">
                                                <div class="flex-shrink-0">
                                                    <img src="assets/images/small/img-5.jpg" alt="" height="50" class="rounded" />
                                                </div>
                                                <div class="overflow-hidden flex-grow-1 ms-3">
                                                    <a href="javascript:void(0);">
                                                        <h6 class="text-truncate fs-14">Job Title</h6>
                                                    </a>
                                                    <p class="mb-0 text-muted">{{ $user->jobTitle ?? $user->occupation }}</p>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <img src="assets/images/small/img-6.jpg" alt="" height="50" class="rounded" />
                                                </div>
                                                <div class="overflow-hidden flex-grow-1 ms-3">
                                                    <a href="javascript:void(0);">
                                                        <h6 class="text-truncate fs-14">Employer Contacts</h6>
                                                    </a>
                                                    <p class="mb-0 text-muted">{{ $user->address2 }}</p>
                                                    <p class="mb-0 text-muted">{{ $user->phone }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end card-body-->
                                    </div>
                                    <!--end card-->
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
