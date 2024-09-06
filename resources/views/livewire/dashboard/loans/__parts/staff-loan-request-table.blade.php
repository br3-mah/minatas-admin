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

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Recent loan requests list</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-auto ms-auto">
                                <div class="list-grid-nav hstack gap-1 mb-2">
                                    @if(request()->route()->getName() == 'view-loan-requests')
                                        <button onclick="resetBulk()" type="button" id="resetBtn" class="btn btn-sm btn-flex btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_add_payment">
                                            <i class="ki-duotone ki-plus-cross fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>Reset
                                        </button>
                                        <button onclick="deleteBulk()" type="button" id="deleteBtn" class="btn mx-2 btn-sm btn-flex btn-light-danger"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_add_payment">
                                            <i class="ki-duotone ki-plus-cross fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>Delete
                                        </button>
                                        <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-duotone ki-category fs-6">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                        </button>
                                    @endif
                                    <button class="btn btn-info addMembers-modal" data-bs-toggle="modal" data-bs-target="#exportModal"><i class="ri-add-fill me-1 align-bottom"></i> Export XLS</button>
                                    @if (Route::currentRouteName() !== 'approved-loans')
                                        <a href="{{ route('proxy-loan-create') }}" class="btn btn-primary"><i class="ri-add-fill me-1 align-bottom"></i> Add New Loan</a>
                                    @endif
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <table id="loanReqTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
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
                                    <th>Source</th>
                                    <th>Status</th>
                                    @if (Route::currentRouteName() !== 'approved-loans')
                                        @if($this->current_configs('loan-approval')->value == 'spooling')
                                        <th></th>
                                        @endif

                                        @if($this->current_configs('loan-approval')->value == 'manual')
                                        <th></th>
                                        @endif
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
                                    <td>{{ $loan->uuid }}</td>
                                    <td>{{ $loan->loan_product->name }}</td>
                                    <td>K {{ number_format($loan->amount, 2, '.', ',') }}</td>
                                    <td>
                                        <a target="_blank" href="{{ route('client-account', ['key'=>$loan->user->id])}}">
                                            {{ $loan->user->fname.' '. $loan->user->lname }}
                                        </a>
                                    </td>
                                    <td>{{ $loan->created_at->toFormattedDateString() }}</td>
                                    {{-- <td>
                                        K {{
                                            number_format(App\Models\Application::payback($loan->amount, $loan->repayment_plan, $loan->loan_product_id), 2, '.', ',')
                                        }}
                                        Upto {{ $loan->repayment_plan }} Months
                                    </td>--}}
                                    <td>{{  $loan->source }}</td> 

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
                                    @if (Route::currentRouteName() !== 'approved-loans')
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
                                    @endif
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-primary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a href="{{ route('detailed',['id' => $loan->id]) }}" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                                @if (Route::currentRouteName() === 'view-loan-requests')
                                                    <li><a href="{{ route('loan-details', ['id' => $loan->id]) }}" class="dropdown-item edit-item-btn"><i class="ri-exchange-funds-fill align-bottom me-2 text-muted"></i> Asses Loans</a></li>
                                                    <li><a href="{{ route('edit-loan', ['id' => $loan->id]) }}" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                                @endif
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


    @include('livewire.dashboard.loans.__modals.assign-loan')
    @include('livewire.dashboard.loans.__modals.review-warning')
    @include('livewire.dashboard.loans.__modals.export-loan-panel')
    @include('livewire.dashboard.loans.__modals.import-loan-panel')

    <script>
        const delBtn = document.getElementById('deleteBtn');
        const resetBtn = document.getElementById('resetBtn');

        delBtn.style.display = 'none';
        resetBtn.style.display = 'none';
        function showBulkOps(){
            delBtn.style.display = 'block';
            resetBtn.style.display = 'block';
        }

        function resetBulk() {
            // Fetch all selected checkboxes
            const checkboxes = document.querySelectorAll('input[name="items[]"]:checked');
            const selectedIds = Array.from(checkboxes).map(checkbox => checkbox.value);

            if (selectedIds.length > 0) {
                // Confirm deletion
                const confirmDelete = confirm("Are you sure you want to reset to processing on the selected loan applications?");

                if (confirmDelete) {
                    // Send an AJAX request to the Laravel route with the selected IDs
                    fetch('reset-loans', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ ids: selectedIds }),
                    })
                    .then(response => {
                        if (response.ok) {
                            console.log('Items deleted successfully.');
                            window.location.reload(true);
                        } else {
                            console.error('Failed to delete items.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            } else {
                alert("No items selected for deletion.");
            }
        }
        function deleteBulk() {
            // Fetch all selected checkboxes
            const checkboxes = document.querySelectorAll('input[name="items[]"]:checked');
            const selectedIds = Array.from(checkboxes).map(checkbox => checkbox.value);

            if (selectedIds.length > 0) {
                // Confirm deletion
                const confirmDelete = confirm("Are you sure you want to delete the selected loan applications?");

                if (confirmDelete) {
                    // Send an AJAX request to the Laravel route with the selected IDs
                    fetch('delete-loans', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ ids: selectedIds }),
                    })
                    .then(response => {
                        if (response.ok) {
                            console.log('Items deleted successfully.');
                            window.location.reload(true);
                        } else {
                            console.error('Failed to delete items.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            } else {
                alert("No items selected for deletion.");
            }
        }

    </script>
</div>
