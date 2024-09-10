<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="p-3 col-12">
                <div class="bg-transparent page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 fw-bold">Manage System Settings</h4>
                </div>
            </div>
        </div>
        
        <div>
            <div class="mb-6 row g-6 g-xl-9">
                <div class="col-md-6 col-xl-4">
                    <div class="card border-hover-primary">
                        <div class="card-body p-9">
                            <div class="fs-4 fw-bold text-dark">User Settings</div>
                            <div class="flex-wrap p-4 mb-6 d-flex">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="fs-6 text-muted fw-bold">User KYC settings</a></li> <!-- Change text color to blue -->
                                    <li><a href="#" class="fs-6 text-muted fw-bold">User Requirements</a></li> <!-- Change text color to blue -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card border-hover-primary">
                        <div class="card-body p-9">
                            <div class="fs-4 fw-bold text-dark">Loan Settings</div>
                            <div class="flex-wrap p-4 mb-6 d-flex">
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-parent-types']) }}" class="fs-6 text-info fw-bold hover:text-light">Loan Types</a></li>
                                    <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-categories']) }}" class="fs-6 text-info fw-bold hover:text-light">Loan Categories</a></li>
                                    <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-types']) }}" class="fs-6 text-info fw-bold hover:text-light">Loan Products</a></li>
                                    <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-disbursements']) }}" class="fs-6 text-info fw-bold">Loan Disbursed By</a></li>
                                    <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-approval']) }}" class="fs-6 text-info fw-bold">Loan Approval Hierachy</a></li> <!-- Change text color to blue -->
                                    <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-repayment-cycle']) }}" class="fs-6 text-info fw-bold">Loan Repayment Cycles</a></li>
                                    <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-penalty-settings']) }}" class="fs-6 text-info fw-bold">Loan Penalty Settings</a></li>
                                    <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-fees']) }}" class="fs-6 text-info fw-bold">Loan Fees</a></li>
                                    <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-remainder-settings']) }}" class="fs-6 text-info fw-bold">Loan Remainder Settngs</a></li>
                                    <li><a href="#" class="fs-6 text-muted fw-bold">Loan Adjustments</a></li>
                                    <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'send-borrower-otp']) }}" class="fs-6 text-info fw-bold">Send OTP to Borrower before Loan Disbursment</a></li>
                                    <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'institutes']) }}" class="fs-6 text-info fw-bold">Loan Institutions</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card border-hover-primary">
                        <div class="card-body p-9">
                            <div class="fs-4 fw-bold text-dark">Manage Staff</div>
                            <div class="flex-wrap p-4 mb-6 d-flex">
                                <ul class="list-unstyled">
                                    {{-- <li><a href="{{ route('item-settings', ['confg' => 'staff','settings' => 'departments']) }}" class="fs-6 text-info fw-bold">Departments</a></li> <!-- Change text color to blue --> --}}
                                    <li><a href="{{ route('employees') }}" class="fs-6 text-info fw-bold">Staff</a></li>
                                    @can('view user roles')
                                    <li><a href="{{ route('roles', ['confg' => 'user','settings' => 'user-roles']) }}" class="fs-6 text-info fw-bold">User Roles & Permissions</a></li>
                                    @endcan
                                    <li><a href="#" class="fs-6 text-muted fw-bold">Staff Email Notifications</a></li>
                                    <li><a href="#" class="fs-6 text-muted fw-bold">Audit Management</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" style="border-top: 0.5px solid #00000017"></div>
                <div class="col-md-6 col-xl-4">
                    <div class="card border-hover-primary">
                        <div class="card-body p-9">
                            <div class="fs-4 fw-bold text-dark">Manage Branches</div>
                            <div class="flex-wrap p-4 mb-6 d-flex">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Branches</a></li> <!-- Change text color to blue -->
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Branch Holidays</a></li> <!-- Change text color to blue -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card border-hover-primary">
                        <div class="card-body p-9">
                            <div class="fs-4 fw-bold text-dark">Borrowers</div>
                            <div class="flex-wrap p-4 mb-6 d-flex">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Download Statements/Schedules</a></li>
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Format Borrower Report</a></li>
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Rename Borrower Report</a></li>
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Rename Collect Sheet Headings</a></li>
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Manage Loan Officers</a></li>
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Invite Borrowers Settings</a></li>
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Bulk Update Borrowers With Loan Officers</a></li>
                                    <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'crb']) }}" class="fs-6 text-info fw-bold">CRB Checks</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card border-hover-primary">
                        <div class="card-body p-9">
                            <div class="fs-4 fw-bold text-dark">Repayments</div>
                            <div class="flex-wrap p-4 mb-6 d-flex">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Loan Repayment Methods</a></li>
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Manage Collectors</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" style="border-top: 0.5px solid #00000017"></div>
                <div class="col-md-6 col-xl-4">
                    <div class="card border-hover-primary">
                        <div class="card-body p-9">
                            <div class="fs-4 fw-bold text-dark">Collateral</div>
                            <div class="flex-wrap p-4 mb-6 d-flex">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Collecteral Types</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card border-hover-primary">
                        <div class="card-body p-9">
                            <div class="fs-4 fw-bold text-dark">Other Income</div>
                            <div class="flex-wrap p-4 mb-6 d-flex">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Other Income</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card border-hover-primary">
                        <div class="card-body p-9">
                            <div class="fs-4 fw-bold text-dark">Bulk Updates</div>
                            <div class="flex-wrap p-4 mb-6 d-flex">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Upload Borrowers from CSV file</a></li>
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Upload Loans from CSV file</a></li>
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Upload Repayments from CSV file</a></li>
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Upload Expenses from CSV file</a></li>
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Upload Other Income from CSV file</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" style="border-top: 0.5px solid #00000017"></div>
                <div class="col-md-6 col-xl-4">
                    <div class="card border-hover-primary">
                        <div class="card-body p-9">
                            <div class="fs-4 fw-bold text-dark">Asset Management</div>
                            <div class="flex-wrap p-4 mb-6 d-flex">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="fs-6 text-muted disabled fw-bold">Asset Management Types</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
