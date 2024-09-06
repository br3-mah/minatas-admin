<div class="modal fade" id="kt_modal_create_expense" tabindex="-1" aria-hidden="true">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <div class="modal-dialog modal-fullscreen p-9">
        <div class="modal-content modal-rounded">
            <div class="modal-header">
                <h2>Create Expense</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>

            <div class="modal-body scroll-y m-5">
                <div class="stepper stepper-links d-flex flex-column" id="kt_modal_create_expense_stepper">
                    <div class="container">
                        <div class="fv-row mb-8">
                            <label class="required fs-6 fw-semibold mb-2">Release Date</label>
                            <div class="position-relative d-flex align-items-center">
                                <input class="form-control form-control ps-12" id="exp_date" wire:model.defer="exp_date" />
                            </div>
                        </div>

                        <div class="fv-row mb-8">
                            <label class="required fs-6 fw-semibold mb-2">Expense Name</label>
                            <div class="position-relative d-flex align-items-center">
                                <input class="form-control form-control ps-12" placeholder="e.g. Transport" wire:model.defer="exp_name" />
                            </div>
                        </div>
                        <div class="fv-row mb-8">
                            <label class="required fs-6 fw-semibold mb-2">Amount</label>
                            <div class="position-relative d-flex align-items-center">
                                <input class="form-control form-control ps-12" placeholder="ZMW" wire:model.defer="exp_amount" />
                            </div>
                        </div>
                        <div class="fv-row mb-8">
                            <label class="required fs-6 fw-semibold mb-2">Expense Type</label>
                            <div class="position-relative d-flex align-items-center">
                                <input class="form-control form-control ps-12"  wire:model.defer="exp_type" />
                            </div>
                        </div>
                        <div class="fv-row mb-8">
                            <label class="required fs-6 fw-semibold mb-2">Details</label>
                            <textarea class="form-control form-control" rows="3"  wire:model.defer="exp_details">

                            </textarea>
                        </div>

                        <div class="d-flex flex-center pb-20">
                            <button type="button" wire:click='createExpense()' class="btn btn-lg btn-light me-3" data-kt-element="complete-start">Submit</button>
                            {{-- <a href="" class="btn btn-lg btn-primary" data-bs-toggle="tooltip" title="Coming Soon">View Project</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        flatpickr('#exp_date', {
            dateFormat: 'Y-m-d', // Set the date format as needed
            // You can add more options here, like minDate, maxDate, etc.
        });
    </script>

</div>
