<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                    <h4 class="mb-sm-0">Add Loan Information</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('sys-settings') }}">System Settings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-parent-types']) }}">Loan Types</a></li>
                            <li class="breadcrumb-item active">Add Loan Types</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Loan Type Information</h4>
                    </div>

                    <div class="card-body">
                        <div class="live-preview">
                            <form wire:submit.prevent="createLoanType" class="row g-3">
                                <div class="col-md-12">
                                    <label for="fullnameInput" class="form-label">Name
                                        <span>
                                            <i class="text-danger ri-asterisk"></i>
                                        </span> </label>
                                    <input required type="text" wire:model.lazy="loan_type_name" class="form-control" id="fullnameInput" placeholder="Enter loan type name">
                                    @error('loan_type_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="fullnameInput" class="form-label">Description</label>
                                    <textarea cols="5"rows="10" wire:model.lazy="loan_type_desc" class="form-control" id="fullnameInput" placeholder="Loan type desc"></textarea>
                                    @error('loan_type_desc') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary" id="submitButton">Save Loan Type</button>
                                    </div>
                                </div>
                            </form>

                            {{-- @if (session()->has('message'))
                                <div class="alert alert-success mt-3">
                                    {{ session('message') }}
                                </div>
                            @endif --}}

                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>
