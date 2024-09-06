<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                    <h4 class="mb-sm-0">Add Loan Information</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Loans</a></li>
                            <li class="breadcrumb-item active">Add Loan Information</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Loan Information</h4>

                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="live-preview">
                            <form action="{{ route("proxy-apply-loan") }}" method="POST" enctype="multipart/form-data" class="row g-3">
                                @csrf
                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">Loan Package</label>
                                    <select id="inputState" class="form-select" data-choices data-choices-sorting="true">
                                        <option selected>Choose...</option>
                                        @forelse ($this->get_all_loan_products() as $lp)
                                            <option {{ $loan->loan_product_id == $lp->id ? 'selected':'' }} >{{ $lp->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">Customer </label>
                                    <select id="inputState" class="form-select" data-choices data-choices-sorting="true">
                                        <option selected>Choose...</option>
                                        @forelse ($borrowers as $b)
                                        <option value="{{ $b->id }}">{{ $b->fname.' '.$b->lname.' | '.$b->phone }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="fullnameInput" class="form-label">Loan Description</label>
                                    <textarea cols="5"rows="10" name="desc" class="form-control" id="fullnameInput" placeholder="Description"> </textarea>
                                </div>

                                <div class="col-md-4">
                                    <label for="fullnameInput" class="form-label">Principal Amount</label>
                                    <input type="number" name="amount" class="form-control" id="fullnameInput" placeholder="Principal Amount">
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="inputState" class="form-label">Duration</label>
                                    <select id="inputState" name="repayment_plan" class="form-select" data-choices data-choices-sorting="true">
                                        <option  value="1">1 Month</option>
                                        <option  value="2">2 Months</option>
                                        <option  value="3">3 Months</option>
                                        <option  value="4">4 Months</option>
                                        <option  value="5">5 Months</option>
                                        <option  value="6">6 Months</option>
                                        <option  value="7">7 Months</option>
                                        <option  value="8">8 Months</option>
                                        <option  value="9">9 Months</option>
                                        <option  value="10">10 Months</option>
                                        <option  value="11">11 Months</option>
                                        <option  value="12">12 Months</option>
                                    </select>
                                    <input type="hidden" value="{{ $user['id'] }}" name="borrower_id" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label for="fullnameInput" class="form-label">MOU Loan</label>
                                    <input type="text" name="mou_loan" class="form-control" id="fullnameInput" placeholder="MOU Loan">
                                </div>
                                <div class="col-md-4">
                                    <label for="fullnameInput" class="form-label">Due Date</label>
                                    <input type="text" name="due_date" class="form-control" id="fullnameInput" placeholder="Due Date">
                                </div>
                                <div class="col-md-4">
                                    <label for="fullnameInput" class="form-label">Related Party</label>
                                    <input type="text" name="related_party" class="form-control" id="fullnameInput" placeholder="Related Party">
                                </div>
                                <div class="col-md-4">
                                    <label for="fullnameInput" class="form-label">Days Late/(Early)</label>
                                    <input type="text" name="days_late" class="form-control" id="fullnameInput" placeholder="Days Late/Early">
                                </div>
                                <div class="col-md-4">
                                    <label for="fullnameInput" class="form-label">Note</label>
                                    <input type="text" name="note" class="form-control" id="fullnameInput" placeholder="Note">
                                </div>

                                <br>
                                <h5 class="card-title mt-4 flex-grow-1">Next of Kin</h5>
                                <hr>
                                <div class="col-md-4">
                                    <label for="fullnameInput" class="form-label">First Name</label>
                                    <input type="text" name="nok_fname" class="form-control" id="fullnameInput" placeholder="Enter your name">
                                </div>

                                <div class="col-md-4">
                                    <label for="fullnameInput" class="form-label">Last Name</label>
                                    <input type="text" name="nok_lname" class="form-control" id="fullnameInput" placeholder="Enter your name">
                                </div>

                                <div class="col-md-4">
                                    <label for="fullnameInput" class="form-label">Phone</label>
                                    <input type="text" name="nok_phone" class="form-control" id="fullnameInput" placeholder="Enter your name">
                                </div>

                                <div class="col-md-4">
                                    <label for="fullnameInput" class="form-label">Email Address</label>
                                    <input type="text" name="nok_email" class="form-control" id="fullnameInput" placeholder="Enter your name">
                                </div>

                                <div class="col-md-4 ">
                                    <label for="fullnameInput" class="form-label">Relationship</label>
                                    <input type="text" name="nok_relation" class="form-control" id="fullnameInput" placeholder="Enter your Relationship">
                                </div>


                                <br>
                                <h5 class="card-title mt-5 flex-grow-1">Support Ducuments</h5>
                                <div class="card-body border-top p-9">
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-bold fs-6">NRC</label>
                                        <div class="col-lg-8 fv-row">
                                            <input type="file" name="nrc_file" class="form-control" id="nrcFile">
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Payslip</label>
                                        <div class="col-lg-8 fv-row">
                                            <input type="file" name="payslip_file" class="form-control" id="payslip_file" >
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-bold fs-6">TPIN</label>
                                        <div class="col-lg-8 fv-row">
                                            <input type="file" name="tpin_file" class="form-control" id="tpin_file" >
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">
                                            Check me out
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Save Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>
