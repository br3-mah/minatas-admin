<div class="page-content">
    <div class="w-full">
            <div class="text-center p-2 d-flex justify-content-center">
                <h4>Application Loan Assement</h4>
            </div>

            <div class="step-arrow-nav mb-4">
                <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                    
                    @if(true)
                    {{-- @dd($current) --}}
                    @if($loan_product->loan_status !== null || $loan_product !== null)
                        @switch(strtolower($current->stage))
                            @case('processing')
                                @php
                                    $count = 1;
                                @endphp
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link done" id="steparrow-gen-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-gen-info" type="button" role="tab" aria-controls="steparrow-gen-info" aria-selected="true">Loan Request Submitted</button>
                                </li>
                                @forelse ($loan_product->loan_status->where('stage', 'processing') as $key => $step)
                                    @php
                                        $count ++;
                                    @endphp
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $current->position >= $count ? 'done' : '' }}" id="{{$step->stage}}-tab" data-bs-toggle="pill" data-bs-target="#{{$step->stage}}" type="button" role="tab" aria-controls="{{$step->stage}}" aria-selected="true">{{ $step->status->name }}</button>
                                    </li>
                                @empty
                                    {{-- <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $current->position >= $count ? 'done' : '' }}" id="verify-tab-tab" data-bs-toggle="pill" data-bs-target="#verify-tab" type="button" role="tab" aria-controls="verify-tab" aria-selected="true">Verify Submission</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $current->position >= $count ? 'done' : '' }}" id="verify-tab-tab" data-bs-toggle="pill" data-bs-target="#verify-tab" type="button" role="tab" aria-controls="verify-tab" aria-selected="true">Approve Loan</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $current->position >= $count ? 'done' : '' }}" id="verify-tab-tab" data-bs-toggle="pill" data-bs-target="#verify-tab" type="button" role="tab" aria-controls="verify-tab" aria-selected="true">Give out Funds</button>
                                    </li> --}}
                                @endforelse
                            @break
                            @case('open')
                                {{-- <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="steparrow-description-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-description-info" type="button" role="tab" aria-controls="steparrow-description-info" aria-selected="false">Description</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill" data-bs-target="#pills-experience" type="button" role="tab" aria-controls="pills-experience" aria-selected="false">Finish</button>
                                </li> --}}
                            @break
                            @default
                            @break
                        @endswitch
                    @endif
                    @endif
                </ul>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="steparrow-gen-info" role="tabpanel" aria-labelledby="steparrow-gen-info-tab">
                    
                    @if(true)
                        {{-- @if($loan->complete == 1) --}}
                        @switch(strtolower($current->stage))
                            @case('processing')
                                @switch(strtolower($current->status))
                                    @case('reviewing')
                                        @include('livewire.dashboard.loans.__stages.processing.reviewing')
                                    @break
                                    @case('verification')
                                        @include('livewire.dashboard.loans.__stages.processing.verification')
                                    @break
                                    @case('approval')
                                        @include('livewire.dashboard.loans.__stages.processing.approval')
                                    @break
                                    @case('disbursements')
                                        @include('livewire.dashboard.loans.__stages.processing.disbursements')
                                    @break
                                    @default
                                        @include('livewire.dashboard.loans.__stages.processing.reviewing')
                                    @break
                                @endswitch
                            @break

                            @case('open')
                                @switch(strtolower($current->status))
                                    @case('current loan')
                                        @include('livewire.dashboard.loans.__stages.open.current-loan')
                                    @break
                                    @default
                                        @include('livewire.dashboard.loans.__stages.open.current-due-today')
                                    @break
                                @endswitch
                            @break

                            @case('denied')
                                @switch(strtolower($current->status))
                                    @case('incomplet kyc')
                                        @include('livewire.dashboard.loans.__stages.denied.incomplete-kyc')
                                    @break
                                    @case('incomplete crb')
                                        @include('livewire.dashboard.loans.__stages.denied.incomplete-crb')
                                    @break
                                    @case('bad credit score')
                                        @include('livewire.dashboard.loans.__stages.denied.bad-credit-score')
                                    @break
                                    @case('Financial Risk')
                                        @include('livewire.dashboard.loans.__stages.denied.financial-risk')
                                    @break
                                    @default
                                        @include('livewire.dashboard.loans.__stages.denied.fraud')
                                    @break
                                @endswitch
                            @break

                            @default
                            <div class="modal fade show" id="kt_modal_decline_warning" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <div class="modal-content">
                                        <div class="modal-body py-2">
                                            <div class="settings mb-2">
                                                <div class="text-danger">
                                                    <h1 class="text-info fw-bold font-bold">No Loan Products or Loan Product has no statuses </h1>
                                                    <p>Note: This loan is current active and is pending for repayment has collection.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endswitch
                        @else
                        @include('livewire.dashboard.loans.__stages.denied.incomplete-kyc')
                        @endif
                </div>
            </div>
    </div>

    

    @include('livewire.dashboard.loans.__modals.rollback-warning')
    @include('livewire.dashboard.loans.__modals.review-warning')
    @include('livewire.dashboard.loans.__modals.decline-loan')
</div>
