<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="bg-transparent page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Loan Application Details</h4>

                    <div class="page-title-right">
                        <ol class="m-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Loan Application Details</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-n4 mx-n4 card-border-effect-none">
                    <div class="bg-primary-subtle">
                        <div class="px-4 pb-0 card-body">
                            <div class="mb-3 row">
                                <div class="col-md">
                                    <div class="row align-items-center g-3">
                                        <div class="col-md-auto">
                                            <div class="avatar-md">
                                                <div class="bg-white avatar-title rounded-circle">
                                                    @if ($loan->user->photos->isNotEmpty())
                                                        @php
                                                            $photo = $loan->user->photos->first();
                                                            $photoPath = $photo->source === 'admin' 
                                                                ? url('public/storage/' . $photo->path) 
                                                                : 'https://app.capexfinancialservices.org/' . $photo->path;
                                                        @endphp
                                                        <img src="{{ $photoPath }}" alt="{{ $loan->user->fname }}" class="rounded-circle avatar-lg" />
                                                    @else
                                                        @php
                                                            $defaultImage = '../public/assets/images/user.png';
                                                            if ($loan->user->gender === 'Female') {
                                                                $defaultImage = '../public/assets/images/girl.png';
                                                            } elseif ($loan->user->gender === 'Male') {
                                                                $defaultImage = '../public/assets/images/boy.png';
                                                            }
                                                        @endphp
                                                        <img src="{{ $defaultImage }}" alt="{{ $loan->user->fname }}" class="rounded-circle avatar-lg" />
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div>
                                                <h4 class="fw-bold">{{ $loan->loan_product->name }} Loan of K  {{ number_format($loan->amount, 2, '.', ',') }}</h4>
                                                <div class="flex-wrap gap-3 hstack">
                                                    <div>
                                                        <i class="align-bottom ri-user-line me-1"></i>
                                                        <a target="_blank" href="{{ route('client-account', ['key'=>$loan->user->id]) }}">
                                                            {{ $loan->user->fname.' '.$loan->user->lname }}
                                                        </a>
                                                    </div>
                                                    <div><i class="align-bottom ri-building-line me-1"></i> {{ $loan->user->occupation.' '.$loan->user->address }}</div>
                                                    <div class="vr"></div>
                                                    <div>Date Applied : <span class="fw-medium">{{ $loan->created_at->toFormattedDateString() }}</span></div>
                                                    <div class="vr"></div>
                                                    @if ($loan->user->phone)
                                                    <div>Phone : <span class="fw-medium">{{ $loan->user->phone }}</span></div>
                                                    <div class="vr"></div>
                                                    @endif

                                                    @if($loan->status == 0)
                                                    <div class="badge rounded-pill bg-warning fs-12">Pending  Application</div>
                                                    @elseif($loan->status == 1)
                                                    <div class="badge rounded-pill bg-info fs-12">Open  Application</div>
                                                    @elseif($loan->status == 2)
                                                    <div class="badge rounded-pill bg-success fs-12">Processing  Application</div>
                                                    @elseif($loan->status == 3)
                                                    <div class="badge rounded-pill bg-danger fs-12">Rejected/ Denied Application</div>
                                                    @else
                                                    <div class="badge rounded-pill bg-success fs-12">Closed Application</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-auto">
                                    <div class="flex-wrap gap-1 hstack">
                                        {{-- <button type="button" class="py-0 btn fs-16 favourite-btn active">
                                            <i class="ri-star-fill"></i>
                                        </button>
                                        <button type="button" class="py-0 btn fs-16 text-body">
                                            <i class="ri-share-line"></i>
                                        </button> --}}
                                        <button type="button" class="py-0 btn fs-16 text-body">
                                            <i class="ri-flag-line"></i>
                                            {{-- <span></span> --}}
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#project-overview" role="tab">
                                        Overview
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-documents" role="tab">
                                        Repayments
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-activities" role="tab">
                                        Loan Product Information
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-team" role="tab">
                                        Statement
                                    </a>
                                </li> --}}
                            </ul>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="tab-content text-muted">
                    <div class="tab-pane fade show active" id="project-overview" role="tabpanel">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-muted">
                                            <h6 class="mb-3 fw-semibold text-uppercase">Summary Notes</h6>
                                            <p>{{ $loan->desc ?? 'No Description' }}. {{ $loan->note }}</p>

                                            {{-- <ul class="gap-2 ps-4 vstack">
                                                <li>kjkjk</li>
                                            </ul> --}}

                                            <div>
                                                <button type="button" class="p-0 btn btn-link link-primary">{{ $loan->loan_type->name }}</button>
                                                <button type="button" class="p-0 btn btn-link link-primary">{{ $loan->loan_child_type->name }}</button>
                                                <button type="button" class="p-0 btn btn-link link-primary">{{ $loan->loan_product->name }}</button>
                                            </div>

                                            <div class="pt-3 mt-4 border-top border-top-dashed">
                                                <div class="row gy-3">

                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Principal Amount :</p>
                                                            <h5 class="mb-0 fs-15"> {{ number_format($loan->amount, 2, '.',',') }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Duration :</p>
                                                            <div class="fs-12">{{ $loan->repayment_plan }} Months</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Priority :</p>
                                                            <div class="badge bg-primary fs-12">Normal</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Status :</p>
                                                            @if($loan->status == 0)
                                                                <div class="badge bg-warning fs-12">Pending</div>
                                                            @elseif($loan->status == 1)
                                                                <div class="badge bg-success fs-12">Open (Pending Repayment)</div>
                                                            @elseif($loan->status == 2)
                                                                <div class="badge bg-primary fs-12">Processing</div>
                                                            @else
                                                                <div class="badge bg-danger fs-12">Rejected</div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pt-3 mt-4 border-top border-top-dashed">
                                                <div class="row gy-3">

                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Est. Repayment Amount :</p>
                                                            <h5 class="mb-0 fs-15">{{ number_format(App\Models\Application::payback($loan->amount, $loan->repayment_plan, $loan_product->id), 2, '.', ',') }}</h5>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Current Pending Repayment From Borrower:</p>
                                                            <h5 class="mb-0 fs-15"> {{ number_format(App\Models\Loans::loan_balance($loan->id), 2, '.', ',') }}</h5>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-6">
                                                        <div>
                                                            <p class="mb-2 text-uppercase fw-medium">Application Source:</p>
                                                            <h5 class="mb-0 fs-15"> {{ $loan->source }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="p-2 mt-4 border-top border-top-dashed">
                                                <h6 class="mb-3 fw-semibold text-warning text-uppercase">Uploaded Attachments</h6>
                                                <div class="gap-2 p-4 d-flex">
                                                    <!-- end col -->
                                                    {{-- @if ($loan->user->uploads->where('name', 'nrc_file')->isNotEmpty())
                                                    <a target="_blank" href="{{ 'https://admin.capexfinancialservices.org/public/'.Storage::url($loan->user->uploads->where('name', 'nrc_file')->first()->path) }}"  class="open-modal" data-toggle="modal" data-target="#fileModal" data-file-url="{{ 'public/'.Storage::url($loan->user->uploads[0]->path) }}">
                                                    <div class="col-md-3">
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
                                                                    <h5 class="mb-1 fs-13"><a href="#" class="text-body text-truncate d-block">{{ $loan->user->fname.' '.$loan->user->lname }}'s NRC</a></h5>
                                                                    <div>{{ $loan->user->uploads->where('name', 'nrc_file')->first()->created_at->toFormattedDateString() }}</div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    </a>
                                                    @endif

                                                    @if ($loan->user->uploads->where('name', 'tpin_file')->isNotEmpty())
                                                    <a target="_blank" href="{{ 'https://admin.capexfinancialservices.org/public/'.Storage::url($loan->user->uploads->where('name', 'tpin_file')->first()->path) }}"  class="open-modal" data-toggle="modal" data-target="#fileModal" data-file-url="{{ 'public/'.Storage::url($loan->user->uploads[0]->path) }}">
                                                    <div class="col-md-3">
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
                                                                    <h5 class="mb-1 fs-13"><a href="#" class="text-body text-truncate d-block">{{ $loan->user->fname.' '.$loan->user->lname }}'s TPIN</a></h5>
                                                                    <div>{{ $loan->user->uploads->where('name', 'tpin_file')->first()->created_at->toFormattedDateString() }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </a>
                                                    @endif
                                                    @if ($loan->user->uploads->where('name', 'payslip_file')->isNotEmpty())
                                                    <a target="_blank" href="{{ 'https://admin.capexfinancialservices.org/public/'.Storage::url($loan->user->uploads->where('name', 'payslip_file')->first()->path) }}"  class="open-modal" data-toggle="modal" data-target="#fileModal" data-file-url="{{ 'public/'.Storage::url($loan->user->uploads[0]->path) }}">
                                                    <div class="col-md-3">
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
                                                                    <h5 class="mb-1 fs-13"><a href="#" class="text-body text-truncate d-block">{{ $loan->user->fname.' '.$loan->user->lname }}'s Payslip </a></h5>
                                                                    <div>{{ $loan->user->uploads->where('name', 'payslip_file')->first()->created_at->toFormattedDateString() }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </a>
                                                    @endif --}}

                                                    @php
                                                        function getFileUrl($upload) {
                                                            return $upload->source === 'admin'
                                                                ? url('public/' . Storage::url($upload->path))
                                                                : 'https://app.capexfinancialservices.org/public/' . Storage::url($upload->path);
                                                        }

                                                        function renderFileBlock($upload, $label, $user) {
                                                            return '
                                                                <a target="_blank" href="' . getFileUrl($upload) . '" class="open-modal" data-toggle="modal" data-target="#fileModal" data-file-url="public/' . Storage::url($upload->path) . '">
                                                                    <div class="col-md-3">
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

                                                    @if ($loan->user->uploads->where('name', 'nrc_file')->isNotEmpty())
                                                        {!! renderFileBlock($loan->user->uploads->where('name', 'nrc_file')->first(), 'NRC Front', $loan->user) !!}
                                                    @endif

                                                    @if ($loan->user->uploads->where('name', 'nrc_b_file')->isNotEmpty())
                                                        {!! renderFileBlock($loan->user->uploads->where('name', 'nrc_b_file')->first(), 'NRC Back', $loan->user) !!}
                                                    @endif

                                                    @if ($loan->user->uploads->where('name', 'tpin_file')->isNotEmpty())
                                                        {!! renderFileBlock($loan->user->uploads->where('name', 'tpin_file')->first(), 'TPIN', $loan->user) !!}
                                                    @endif

                                                    @if ($loan->user->uploads->where('name', 'payslip_file')->isNotEmpty())
                                                        {!! renderFileBlock($loan->user->uploads->where('name', 'payslip_file')->first(), 'Payslip', $loan->user) !!}
                                                    @endif

                                                    <!-- end col -->
                                                </div>
                                                <!-- end row -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->


                                <!-- end card -->
                            </div>
                            <!-- ene col -->

                            <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div>
                    <!-- end tab pane -->
                </div>
            </div>
            <!-- end col -->
        </div>

        @include('livewire.dashboard.loans.__parts.more-loan-info')
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>
