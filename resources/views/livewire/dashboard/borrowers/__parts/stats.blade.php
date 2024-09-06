<div class="col-xl-3" >
    <div class="card card-xl-stretch mb-xl-8">
        <div class="card-body p-0 d-flex flex-column">
            <!--begin::Stats-->
            <div class="card-p pt-5 bg-body flex-grow-1 mx-2" style="box-shadow: rgba(0, 0, 0, 0.08) 0px 4px 12px;">
                <!--begin::Row-->
                <div class="row g-0">
                    <!--begin::Col-->
                    <div class="col mr-8">
                        <!--begin::Label-->
                        <div class="fs-7 text-muted fw-bold">Number of Times Borrowed</div>
                        <!--end::Label-->

                        <!--begin::Stat-->
                        <div class="d-flex align-items-center">
                            <div class="fs-4 fw-bold">{{ App\Models\Application::my_number_of_loans($data->id) }}</div>
                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <!--end::Stat-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col">
                        <!--begin::Label-->
                        <div class="fs-7 text-muted fw-bold">Total Amount Borrowed</div>
                        <!--end::Label-->

                        <!--begin::Stat-->
                        <div class="fs-4 fw-bold">K {{ App\Models\Loans::customer_total_borrowed($data->id) }}</div>
                        <!--end::Stat-->
                    </div>
                    <!--end::Col-->
                </div>
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Mixed Widget 3-->
</div>

<div class="col-xl-3" >
    <div class="card card-xl-stretch mb-xl-8">
            <div class="card-body p-0 d-flex flex-column">
                <!--begin::Stats-->
                <div class="card-p pt-5 bg-body flex-grow-1 mx-2" style="box-shadow: rgba(0, 0, 0, 0.08) 0px 4px 12px;">
                    <!--begin::Row-->
                    <div class="row g-0">
                        <!--begin::Col-->
                        <div class="col mr-8">
                            <!--begin::Label-->
                            <div class="fs-7 text-muted fw-bold">Number of Pending Borrowed</div>
                            <!--end::Label-->

                            <!--begin::Stat-->
                            <div class="d-flex align-items-center">
                                <div class="fs-4 fw-bold">{{ App\Models\Application::my_number_of_pending_loans($data->id) }}</div>
                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-1"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                            <!--end::Stat-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col">
                            <!--begin::Label-->
                            <div class="fs-7 text-muted fw-bold">Pending Amount </div>
                            <!--end::Label-->

                            <!--begin::Stat-->
                            <div class="fs-4 fw-bold">K {{ App\Models\Loans::customer_total_pending_borrowed($data->id) }}</div>
                            <!--end::Stat-->
                        </div>
                        <!--end::Col-->
                    </div>
                </div>
            </div>
            <!--end::Body-->
    </div>
    <!--end::Mixed Widget 3-->
</div>



<div class="col-xl-3" >
    <div class="card card-xl-stretch mb-xl-8">
            <div class="card-body p-0 d-flex flex-column">
                <!--begin::Stats-->
                <div class="card-p pt-5 bg-body flex-grow-1 mx-2" style="box-shadow: rgba(0, 0, 0, 0.08) 0px 4px 12px;">
                    <!--begin::Row-->
                    <div class="row g-0">
                        <!--begin::Col-->
                        <div class="col mr-8">
                            <!--begin::Label-->
                            <div class="fs-7 text-muted fw-bold">Number of Pending Repayments</div>
                            <!--end::Label-->

                            <!--begin::Stat-->
                            <div class="d-flex align-items-center">
                                <div class="fs-4 fw-bold">{{ App\Models\Application::my_number_of_pending_repayments($data->id) }}</div>
                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-1"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                            <!--end::Stat-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col">
                            <!--begin::Label-->
                            <div class="fs-7 text-muted fw-bold">Total Pending Repayments </div>
                            <!--end::Label-->

                            <!--begin::Stat-->
                            <div class="fs-4 fw-bold">K {{  App\Models\Application::my_pending_repayment_amount($data->id) }}</div>
                            <!--end::Stat-->
                        </div>
                        <!--end::Col-->
                    </div>
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 3-->
    </div>



    <div class="col-xl-3" >
        <div class="card card-xl-stretch mb-xl-8">
                <div class="card-body p-0 d-flex flex-column">
                    <!--begin::Stats-->
                    <div class="card-p pt-5 bg-body flex-grow-1 mx-2" style="box-shadow: rgba(0, 0, 0, 0.08) 0px 4px 12px;">
                        <!--begin::Row-->
                        <div class="row g-0">
                            <!--begin::Col-->
                            <div class="col mr-8">
                                <!--begin::Label-->
                                <div class="fs-7 text-muted fw-bold">Number of Settled Repayments</div>
                                <!--end::Label-->

                                <!--begin::Stat-->
                                <div class="d-flex align-items-center">
                                    <div class="fs-4 fw-bold">{{ App\Models\Loans::customer_total_settled_amount($data->id) }}</div>
                                    <i class="ki-duotone ki-arrow-up fs-5 text-success ms-1"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                                <!--end::Stat-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col">
                                <!--begin::Label-->
                                <div class="fs-7 text-muted fw-bold">Total Settled Repayments </div>
                                <!--end::Label-->

                                <!--begin::Stat-->
                                <div class="fs-4 fw-bold">K {{ App\Models\Loans::customer_total_paid($data->id) }}</div>
                                <!--end::Stat-->
                            </div>
                            <!--end::Col-->
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Mixed Widget 3-->
        </div>
