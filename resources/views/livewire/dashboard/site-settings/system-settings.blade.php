<div class="page-content">
    <div class="container-fluid bg-gradient-green">

        <!-- Start page title -->
        <div class="row">
            <div class="p-3 col-12">
                <div class="bg-transparent page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 text-success fw-bold">🌿 Manage System Settings</h4>
                </div>
            </div>
        </div>

        <!-- Main content area -->
        <div class="mb-6 row g-6 g-xl-9">
            <!-- Loan Settings Card -->
            <div class="col-md-6 col-xl-4">
                <div class="rounded shadow-lg card border-hover-green">
                    <div class="p-5 card-body">
                        <h5 class="fw-bold text-dark">💸 Loan Settings</h5>
                        <ul class="mt-3 list-unstyled">
                            <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-parent-types']) }}" class="fs-6 text-green fw-bold hover-light">Loan Types</a></li>
                            <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-categories']) }}" class="fs-6 text-green fw-bold hover-light">Loan Categories</a></li>
                            <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-types']) }}" class="fs-6 text-green fw-bold hover-light">Loan Products</a></li>
                            <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-disbursements']) }}" class="fs-6 text-green fw-bold hover-light">Loan Disbursed By</a></li>
                            <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-approval']) }}" class="fs-6 text-green fw-bold hover-light">Loan Approval Hierarchy</a></li>
                            <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-repayment-cycle']) }}" class="fs-6 text-green fw-bold hover-light">Loan Repayment Cycles</a></li>
                            <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-penalty-settings']) }}" class="fs-6 text-green fw-bold hover-light">Loan Penalty Settings</a></li>
                            <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-fees']) }}" class="fs-6 text-green fw-bold hover-light">Loan Fees</a></li>
                            <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-remainder-settings']) }}" class="fs-6 text-green fw-bold hover-light">Loan Remainder Settings</a></li>
                            <li><a href="#" class="fs-6 text-green fw-bold hover-light">Loan Adjustments</a></li>
                            <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'send-borrower-otp']) }}" class="fs-6 text-green fw-bold hover-light">Send OTP to Borrower before Loan Disbursement</a></li>
                            <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'institutes']) }}" class="fs-6 text-green fw-bold hover-light">Loan Institutions</a></li>
                            <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'loan-adjustment-settings']) }}" class="fs-6 text-green fw-bold hover-light">Loan Adjustment Rules</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <!-- Manage Staff Card -->
            <div class="col-md-6 col-xl-4">
                <div class="rounded shadow-lg card border-hover-green">
                    <div class="p-5 card-body">
                        <h5 class="fw-bold text-dark">🧑‍💼 Manage Staff</h5>
                        <ul class="mt-3 list-unstyled">
                            <li><a href="{{ route('employees') }}" class="fs-6 text-green fw-bold hover-light">Staff</a></li>
                            <li><a href="{{ route('roles', ['confg' => 'user','settings' => 'user-roles']) }}" class="fs-6 text-green fw-bold hover-light">User Roles & Permissions</a></li>
                            <li><a href="#" class="fs-6 text-muted fw-bold">Staff Email Notifications</a></li>
                            <li><a href="#" class="fs-6 text-muted fw-bold">Audit Management</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- User Settings Card -->
            <div class="col-md-6 col-xl-4">
                <div class="rounded shadow-lg card border-hover-green">
                    <div class="p-5 card-body">
                        <h5 class="fw-bold text-dark">👤 User Settings</h5>
                        <ul class="mt-3 list-unstyled">
                            <li><a href="#" class="fs-6 text-green fw-bold hover-light">User KYC Settings</a></li>
                            <li><a href="#" class="fs-6 text-green fw-bold hover-light">User Requirements</a></li>
                        </ul>
                    </div>
                </div>
            </div>
{{-- 
            <!-- Horizontal Divider -->
            <div class="my-4 col-12">
                <hr style="border: 1px solid #60D39A">
            </div>

            <!-- Manage Branches Card -->
            <div class="col-md-6 col-xl-4">
                <div class="rounded shadow-lg card border-hover-green">
                    <div class="p-5 card-body">
                        <h5 class="fw-bold text-dark">🏢 Manage Branches</h5>
                        <ul class="mt-3 list-unstyled">
                            <li><a href="#" class="fs-6 text-muted fw-bold">Branches</a></li>
                            <li><a href="#" class="fs-6 text-muted fw-bold">Branch Holidays</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Borrowers Card -->
            <div class="col-md-6 col-xl-4">
                <div class="rounded shadow-lg card border-hover-green">
                    <div class="p-5 card-body">
                        <h5 class="fw-bold text-dark">👥 Borrowers</h5>
                        <ul class="mt-3 list-unstyled">
                            <li><a href="{{ route('item-settings', ['confg' => 'loan','settings' => 'crb']) }}" class="fs-6 text-green fw-bold hover-light">CRB Checks</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Repayments Card -->
            <div class="col-md-6 col-xl-4">
                <div class="rounded shadow-lg card border-hover-green">
                    <div class="p-5 card-body">
                        <h5 class="fw-bold text-dark">💵 Repayments</h5>
                        <ul class="mt-3 list-unstyled">
                            <li><a href="#" class="fs-6 text-muted fw-bold">Loan Repayment Methods</a></li>
                            <li><a href="#" class="fs-6 text-muted fw-bold">Manage Collectors</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Collateral Card -->
            <div class="col-md-6 col-xl-4">
                <div class="rounded shadow-lg card border-hover-green">
                    <div class="p-5 card-body">
                        <h5 class="fw-bold text-dark">🔒 Collateral</h5>
                        <ul class="mt-3 list-unstyled">
                            <li><a href="#" class="fs-6 text-muted fw-bold">Collateral Types</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Other Income Card -->
            <div class="col-md-6 col-xl-4">
                <div class="rounded shadow-lg card border-hover-green">
                    <div class="p-5 card-body">
                        <h5 class="fw-bold text-dark">💰 Other Income</h5>
                        <ul class="mt-3 list-unstyled">
                            <li><a href="#" class="fs-6 text-muted fw-bold">Other Income</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Bulk Updates Card -->
            <div class="col-md-6 col-xl-4">
                <div class="rounded shadow-lg card border-hover-green">
                    <div class="p-5 card-body">
                        <h5 class="fw-bold text-dark">📂 Bulk Updates</h5>
                        <ul class="mt-3 list-unstyled">
                            <li><a href="#" class="fs-6 text-muted fw-bold">Upload Borrowers from CSV</a></li>
                            <li><a href="#" class="fs-6 text-muted fw-bold">Upload Repayments from CSV</a></li>
                            <li><a href="#" class="fs-6 text-muted fw-bold">Upload Loan Records from CSV</a></li>
                        </ul>
                    </div>
                </div>
            </div> --}}

        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
</div>
