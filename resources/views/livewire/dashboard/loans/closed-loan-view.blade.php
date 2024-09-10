<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="py-3 col-12">
                <div class="bg-transparent page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 fw-bold">Closed Loans</h4>
{{-- 
                    <div class="page-title-right">
                        <ol class="m-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Closed Loans</li>
                        </ol>
                    </div> --}}

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="p-2 mb-2 text-white rounded bg-light-success" role="alert">
            List of loan which have been paid back & closed.
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Closed Loans</h5>
                    </div>
                    <div class="card-body">
                        <table id="fixed-header" class="table align-middle table-bordered dt-responsive nowrap table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Loan #.</th>
                                    <th>Borrower</th>
                                    <th>Loan Type</th>
                                    <th>Principal</th>
                                    <th>Due</th>
                                    <th>Paid</th>
                                    <th>Date Complete</th>
                                    <th class="actions-btns">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($loan_requests as $loan)
                                    <tr>
                                        <td style="">#{{ $loan->id }}</td>
                                        <td style="">{{ $loan->fname.' '. $loan->lname }}</td>
                                        <td style="">{{ $loan->type }} Loan</td>
                                        <td style="">K{{ $loan->amount }}</td>
                                        <td style="">K{{ App\Models\Application::payback($loan->amount, $loan->repayment_plan, $loan->loan_product_id) }}</td>
                                        <td style="">K{{ App\Models\Loans::loan_settled($loan->id) }}</td>
                                        
                                        <td style="">
                                            @php 
                                                $date_str = $loan->date_paid;
                                                $date = DateTime::createFromFormat('Y-m-d H:i:s', $date_str);
                                                echo $date->format('F j, Y, g:i a');
                                            @endphp
                                        </td>
                                        <td class="actions-btns d-flex">
                                            <a  href="{{ route('loan-details',['id' => $loan->id]) }}">  
                                                Details                                               
                                            </a>
                                        </td>	
                                    </tr>
                                @empty
                                <div class="col-span-12 intro-y md:col-span-6">
                                    <div class="text-center box">
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
