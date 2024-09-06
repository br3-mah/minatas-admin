<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                    <h4 class="mb-sm-0">Principal Outstanding</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Principal Outstanding</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="alert alert-danger" role="alert">
            Outstanding principal balance for Open loans.        
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Principal Outstanding</h5>
                    </div>
                    <div class="card-body">
                        <table id="fixed-header" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Loan #.</th>
                                    <th>Borrower</th>
                                    <th>Released</th>
                                    <th>Maturity</th>
                                    <th>Principal</th>
                                    <th>Principal Paid</th>
                                    <th>Principal Balance</th>
                                    <th>Principal Due Till Today</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($loan_requests as $loan)
                                    @if($loan->type != null)
                                    <tr>
                                        <td style="text-align:center;">#{{ $loan->id }}</td>
                                        <td style="text-align:center;">{{ $loan->fname.' '. $loan->lname }}</td>
                                        <td style="text-align:center;">{{ $loan->type }} Loan</td>
                                        <td style="text-align:center;">{{ $loan->repayment_plan }} Month(s)</td>
                                        <td style="text-align:center;">K{{ $loan->amount }}</td>
                                        <td style="text-align:center;">K{{ App\Models\Application::payback($loan->amount, $loan->repayment_plan, $loan->loan_product_id) }}</td>
                                        <td style="text-align:center;">
                                            <span class="badge badge-xl light badge-info">
                                                K{{ App\Models\Application::paybackInstallment($loan->amount, $loan->repayment_plan, $loan->loan_product_id) }} 
                                            </span>
                                        </td>
                                        <td style="">
                                            {{$loan->due_date}}
                                        </td>
                                        <td>
                                            <span class="badge badge-sm light badge-success">
                                                <i class="fa fa-circle text-info me-1"></i>
                                                Pending Payback
                                            </span>
                                        </td>
                                    </tr>
                                    @endif
                                @empty
                                <div class="intro-y col-span-12 md:col-span-6">
                                    <div class="box text-center">
                                        <p>Nothing Found.</p>
                                    </div>
                                </div>
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
