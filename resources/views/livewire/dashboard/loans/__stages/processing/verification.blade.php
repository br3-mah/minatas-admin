<div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Verify {{ $loan->user->fname.' '.$loan->user->lname }}'s Loan Request</h3>
            </div>
            

            @can('approve loan')
            <div class="col-12 d-flex justify-between">
                <a title="Undo" href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_review_rollback" wire:click="setLoanID({{$loan->id}})" class="btn btn-danger btn-label left nexttab nexttab"><i class="ri-arrow-left-line label-icon align-middle fs-16 ms-2"></i> Reject Submission </a>
                <button title="Open loan application" wire:click="accept({{$loan->id}})" type="button" class="btn btn-info btn-label right ms-auto nexttab nexttab" data-nexttab="steparrow-description-info-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Verify Application </button>
            </div>
            @endcan
        </div>
    
        <div class="p-2 border-top border-top-dashed mt-4">
            <div class="row gy-3 p-4">

                <div class="col-lg-3 col-sm-6">
                    <div>
                        <p class="mb-2 text-uppercase fw-medium">Principal Amount :</p>
                        <h5 class="fs-15 mb-0"> {{ $loan->amount }}</h5>
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
                            <div class="badge bg-success fs-12">Inprogress</div>
                        @elseif($loan->status == 2)
                            <div class="badge bg-primary fs-12">Processing</div>
                        @else
                            <div class="badge bg-danger fs-12">Rejected</div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <div class="p-2 border-top border-top-dashed mt-4">
            <div class="row gy-3 p-4">

                <div class="col-lg-3 col-sm-6">
                    <div>
                        <p class="mb-2 text-uppercase fw-medium">Est. Repayment Amount :</p>
                        <h5 class="fs-15 mb-0">{{ App\Models\Application::payback($loan->amount, $loan->repayment_plan, $loan_product->id) }}</h5>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div>
                        <p class="mb-2 text-uppercase fw-medium">Current Pending Repayment From Borrower:</p>
                        <h5 class="fs-15 mb-0"> {{ App\Models\Loans::customer_balance($loan->user->id) }}</h5>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div>
                        <p class="mb-2 text-uppercase fw-medium">Applied From (Source) :</p>
                        <h5 class="fs-15 mb-0"> {{ $loan->source}}</h5>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="p-2 border-top border-top-dashed mt-4">
            <h6 class="mb-3 fw-semibold text-warning text-uppercase">Uploaded Attachments</h6>
            <div class="d-flex gap-2 p-4">
                <!-- end col -->
                
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
    
    @include('livewire.dashboard.loans.__parts.more-loan-info')
    <!-- ene col -->
    {{-- <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Assigned Staff</h5>
                <div class="d-flex flex-wrap gap-2 fs-16">
                    <div class="badge fw-medium bg-primary-subtle text-primary">Bremah Nyeleti</div>
                </div>
            </div>
            <!-- end card body -->
        </div>
    </div> --}}


</div>
