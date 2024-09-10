
<div class="page-content">
    <!-- start page title -->
    <div class="row">
        <div class="px-5 py-4 col-12">
            <div class="bg-transparent page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 fw-bold">Borrower Information</h4>

                    {{-- <div class="page-title-right">
                        <ol class="m-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('borrowers') }}">Borrowers</a></li>
                            <li class="breadcrumb-item active">Borrower Information</li>
                        </ol>
                    </div> --}}

            </div>
        </div>
    </div>
    <div class="">
        <div class="flex gap-2 px-5 py-3 col-md-12">
            @if ($user->photos->isNotEmpty())
                @foreach ($user->photos as $photo)
                    @php
                        $photoPath = $photo->source === 'admin' 
                            ? url('public/storage/' . $photo->path) 
                            : 'https://minatasresources.com/' . $photo->path;
                    @endphp
                    <img width="5" src="{{ $photoPath }}" alt="user-img" class="col-1" />
                @endforeach
            @else
                @php
                    $defaultImage = 'public/assets/images/user.png';
                    if ($user->gender === 'Female') {
                        $defaultImage = 'public/assets/images/girl.png';
                    } elseif ($user->gender === 'Male') {
                        $defaultImage = 'public/assets/images/boy.png';
                    }
                @endphp
                <img width="5" src="{{ $defaultImage }}" alt="user-img" class="col-1" />
            @endif
        </div>
        <div class="p-3 px-6 mb-4 profile-header bg-light-success">
                <div class="px-4 row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="mb-3 text-success"><b>{{ $user->fname.' '.$user->lname }}</b></h2>
                        <div class="flex gap-3 mb-3 d-flex">
                            <div class="p-2 badge bg-success-subtle text-success">
                                <i class="bi bi-person-vcard-fill me-1"></i>
                                <b>{{ $user->uuid }}</b>
                            </div>
                            @if($user->address)
                            <div class="p-2 badge bg-success-subtle text-success">
                                <i class="bi bi-geo-alt-fill me-1"></i>
                                {{ $user->address }}
                            </div>
                            @endif
                            @if($user->occupation || $user->jobTitle)
                            <div class="p-2 badge bg-success-subtle text-success">
                                <i class="bi bi-briefcase-fill me-1"></i>
                                {{ $user->jobTitle ?? $user->occupation }}
                            </div>
                            @endif
                        </div>
                        <div class="p-2 badge bg-success-subtle text-success">
                            <i class="bi bi-archive-fill me-1"></i>
                            <b>Source: {{ $user->usource ?? 'System Entry' }}</b>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="text-white border-0 card bg-success">
                                    <div class="text-center card-body">
                                        <h4 class="mb-2">K{{ App\Models\Loans::customer_balance($user->id) }}</h4>
                                        <p class="mb-0 fs-7">Current Amount Owing</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-white border-0 card bg-success">
                                    <div class="text-center card-body">
                                        <h4 class="mb-2">K{{ App\Models\Loans::customer_total_borrowed($user->id) }}</h4>
                                        <p class="mb-0 fs-7">Total Amount Borrowed</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        <div class="row">
            <div class="col-lg-12">
                <div>
                    <!-- Tab panes -->
                    <div class="pt-4 tab-content text-muted">
                        <div class="tab-pane active" id="overview-tab" role="tabpanel">
                            <div class="px-3">
                                <div class="bg-white row">
                                    <div class="col-md-6">
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
                                                            <th class="ps-0 text-warning fs-9" scope="row"><b>Date of Birth :</b></th>
                                                            <td class="uppercase text-muted">{{ $user->dob ?? 'Unknown' }}</td>
                                                        </p>
                                                        <p>
                                                            <th class="ps-0 text-warning fs-9" scope="row"><b>Gender :</b></th>
                                                            <td class="uppercase text-muted">{{ $user->gender ?? 'Unknown' }}</td>
                                                        </p>
                                                        <p>
                                                            <th class="ps-0 text-warning fs-9" scope="row"><b>Mobile :</b></th>
                                                            <td class="text-muted">{{ $user->phone ?? 'Unknown' }}</td>
                                                        </p>
                                                        <p>
                                                            <th class="ps-0 text-warning fs-9" scope="row"><b>E-mail :</b></th>
                                                            <td class="text-muted">{{ $user->email ?? 'Unknown' }}</td>
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


                                    <div class=" col-md-6">
                                        <div class="card-body">
                                            <div class="mb-2 d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-0 card-title"><b>Next of Kin</b></h5>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="py-3 d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="mb-1 fs-14">Fullnames</h5>
                                                            <p class="mb-0 fs-13 text-muted">{{ $user->nokfname.' '.$user->noklname ?? 'Unknown' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="py-3 d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="mb-1 fs-14">Phone Number</h5>
                                                            <p class="mb-0 fs-13 text-muted">{{ $user->nokphone ?? 'No Phone' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="py-3 d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <div>
                                                            <h5 class="mb-1 fs-14">Date of Birth</h5>
                                                            <p class="mb-0 fs-13 text-muted">{{ $user->nokDob ?? 'No Record' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="py-3 d-flex align-items-center">
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

                                    <div class="card col-md-6">
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
                                    <div class="card col-md-6">
                                        <div class="card-body">
                                            <div class="mb-4 d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-0 card-title"><b>Supporting Documents</b></h5>
                                                </div>
                                            </div>
                                            <div>
                                            @php
                                                function getFileUrl($upload) {
                                                    return $upload->source === 'admin'
                                                        ? url('public/' . Storage::url($upload->path))
                                                        : 'https://minatasresources.com/public/' . Storage::url($upload->path);
                                                }

                                                function renderFileBlock($upload, $label, $user) {
                                                    return '
                                                        <a target="_blank" href="' . getFileUrl($upload) . '" class="open-modal" data-toggle="modal" data-target="#fileModal" data-file-url="public/' . Storage::url($upload->path) . '">
                                                            <div class="col-md-12">
                                                                <div class="p-2 border border-dashed rounded">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 me-3">
                                                                            <div class="avatar-sm">
                                                                                <div class="rounded avatar-title bg-light text-primary fs-24">
                                                                                    <i class="ri-file-ppt-2-line"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="overflow-hidden flex-grow-1">
                                                                            <h5 class="mb-1 fs-13">
                                                                                <a href="#" class="text-body text-truncate d-block">' . $user->fname . ' ' . $user->lname . '\'s ' . $label . '</a>
                                                                            </h5>
                                                                            <div>' . $upload->created_at->toFormattedDateString() . '</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>';
                                                }
                                            @endphp

                                            @if ($user->uploads->where('name', 'nrc_file')->isNotEmpty())
                                                {!! renderFileBlock($user->uploads->where('name', 'nrc_file')->first(), 'NRC Front', $user) !!}
                                            @endif

                                            @if ($user->uploads->where('name', 'nrc_b_file')->isNotEmpty())
                                                {!! renderFileBlock($user->uploads->where('name', 'nrc_b_file')->first(), 'NRC Back', $user) !!}
                                            @endif

                                            @if ($user->uploads->where('name', 'tpin_file')->isNotEmpty())
                                                {!! renderFileBlock($user->uploads->where('name', 'tpin_file')->first(), 'TPIN', $user) !!}
                                            @endif

                                            @if ($user->uploads->where('name', 'payslip_file')->isNotEmpty())
                                                {!! renderFileBlock($user->uploads->where('name', 'payslip_file')->first(), 'Payslip', $user) !!}
                                            @endif

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
