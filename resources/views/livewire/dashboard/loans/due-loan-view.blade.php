<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                    <h4 class="mb-sm-0">{{ $this->title }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ $this->title }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        {{-- <div class="alert alert-danger" role="alert">
            
        </div> --}}

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Due Date Loans</h5>
                    </div>
                    <div class="card-body">
                        <table id="fixed-header" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10px;">
                                        <div class="form-check">
                                            <input onclick="showBulkOps()" class="form-check-input fs-15" type="checkbox" id="checkAll" value="1">
                                        </div>
                                    </th>
                                    <th>Loan No.</th>
                                    <th>Loan Type.</th>
                                    <th>Principal</th>
                                    <th>Borrower</th>
                                    <th>Date</th>
                                    <th>Payback</th>
                                    <th>Repayment Balance</th>
                                    <th>Status</th>
                                    @if($this->current_configs('loan-approval')->value == 'spooling')
                                    <th></th>
                                    @endif
                                    @if($this->current_configs('loan-approval')->value == 'manual')
                                    <th></th>
                                    @endif
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($requests as $loan)

                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input onclick="showBulkOps()" class="form-check-input fs-15" type="checkbox" name="items[]" value="{{ $loan->id }}">
                                        </div>
                                    </th>
                                    <td>{{ $loan->created_at.''.$loan->id }}</td>
                                    <td>{{ $loan->loan_product->name }}</td>
                                    <td>K  {{ number_format($loan->amount, 2, '.', ',') }}</td>
                                    <td>
                                        <a target="_blank" href="{{ route('client-account', ['key'=>$loan->user->id])}}">
                                            {{ $loan->user->fname.' '. $loan->user->lname }}
                                        </a>
                                    </td>
                                    <td>{{ $loan->created_at->toFormattedDateString() }}</td>
                                    <td>
                                        K {{
                                            number_format(App\Models\Application::payback($loan->amount, $loan->repayment_plan, $loan->loan_product_id), 2, '.', ',')
                                        }}
                                        Upto {{ $loan->repayment_plan }} Months
                                    </td>
                                    <td>K {{  number_format(App\Models\Loans::loan_balance( $loan->id)) }}</td>
                                    
                                    <td>
                                        @if($loan->status == 0)
                                            <span class="badge bg-warning-subtle text-warning">Pending</span>
                                        @elseif($loan->status == 1)
                                            <span class="badge bg-success-subtle text-success">Open</span>
                                        @elseif($loan->status == 2)
                                            <span class="badge bg-primary-subtle text-primary">Processing</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">Denied</span>
                                        @endif
                                    </td>
                                    
                                    @if($this->current_configs('loan-approval')->value == 'spooling')
                                    <td class="text-success">
                                        @role('admin')@else
                                            @can('review loan')
                                                @if($loan->status == 0 || $loan->status == 3)
                                                    <button wire:click="setLoanID({{ $loan->id }})" data-bs-toggle="modal" data-bs-target="#kt_modal_review_warning" class="btn btn-sm btn-success">Review</button>
                                                @endif
                                            @endcan
                                        @endrole
                                    </td>
                                    @endif

                                    @if($this->current_configs('loan-approval')->value == 'manual')
                                    <td>
                                        @role('admin')
                                            @if ($loan->is_assigned == 0)
                                                <button wire:click="setLoanID({{$loan->id}})" class="btn btn-sm btn-success"  data-bs-toggle="modal" data-bs-target="#kt_modal_assign">
                                                    Assign
                                                </button>
                                            @else
                                                @if($loan->status == 1)
                                                <button title="Cancel loan before disbursing funds" wire:click="setLoanID({{$loan->id}})" class="btn btn-sm btn-light"  data-bs-toggle="modal" data-bs-target="#kt_modal_assign">
                                                    Cancel
                                                </button>
                                                @else
                                                <button wire:click="setLoanID({{$loan->id}})" class="btn btn-xs btn-warning"  data-bs-toggle="modal" data-bs-target="#kt_modal_assign">
                                                    Re-assign
                                                </button>
                                                @endif
                                            @endif
                                        @else
                                            @can('review loan')
                                                @if($loan->status == 0 || $loan->status == 3)
                                                    <button wire:click="setLoanID({{ $loan->id }})" data-bs-toggle="modal" data-bs-target="#kt_modal_review_warning" class="btn btn-sm btn-success">Review</button>
                                                @endif
                                            @endcan
                                        @endrole
                                    </td>
                                    @endif

                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-primary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a href="{{ route('detailed',['id' => $loan->id]) }}" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                                <li><a href="{{ route('edit-loan', ['id' => $loan->id]) }}" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                                {{-- <li>
                                                    <a class="dropdown-item remove-item-btn">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                    </a>
                                                </li> --}}
                                            </ul>
                                        </div>
                                    </td>

                                </tr>                                    
                                @empty
                                    
                                @endforelse
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- container-fluid -->
</div>
