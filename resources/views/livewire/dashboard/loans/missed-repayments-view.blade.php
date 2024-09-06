<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                    <h4 class="mb-sm-0">Missed Repayments</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Missed Repayments</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="alert alert-info" role="alert">
            List of loans which have missed their installments.
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Missed Repayment Loans</h5>
                    </div>
                    <div class="card-body">
                        <table id="fixed-header" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr class="fw-bold text-muted">
                                    <th class="actions-btns"></th>
                                    <th>Borrower</th>
                                    <th>Loan Purpose</th>
                                    <th>Principal</th>
                                    <th>Total Collectable</th>
                                    <th>Installment<br>Amount</th>
                                    <th>Missed Date</th>
                                    <th class="actions-btns">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @forelse($mssd_repays as $user)
                                {{-- @dd($user) --}}
                                <tr>
                                    <td class="actions-btns" style="text-align: center">
                                        @if($user->user->profile_photo_path == null)
                                            @if($user->fname != null && $user->lname != null)
                                                <span class="text-primary">{{ $user->fname[0].' '.$user->lname[0] }}</span>
                                            @else
                                                <span>{{ $user->name[0] }}</span>
                                            @endif
                                        @else
                                            <img class="rounded-circle" width="35" src="{{ 'public/'.Storage::url($user->profile_photo_path) }}" />
                                        @endif
                                    </td>

                                    <td style="text-align: center;">
                                        <a target="_blank" href="{{ route('client-account', ['key'=>$user->id]) }}">
                                            {{ $user->fname.' '.$user->lname }} 
                                        </a>
                                    </td>

                                    <td style="text-align: center;">{{ $user->type }} Loan</td>
                                    <td style="text-align: center;">K{{ $user->amount }}</td>
                                    <td style="text-align: center;">K{{ App\Models\Loans::loan_balance($user->id) }}</td>
                                    <td style="text-align: center;"><a href="javascript:void(0);"><strong>K{{ App\Models\Application::monthly_installment($user->amount, $user->repayment_plan) }}</strong></a></td>
                                    <td style="text-align: center; color:#f70000" class="text-danger">
                                        @php 
                                        $date_str = $user->next_dates;
                                            $date = DateTime::createFromFormat('Y-m-d H:i:s', $date_str);
                                            echo $date->format('F j, Y, g:i a');
                                        @endphp
                                    </td>
                                    <td class="actions-btns">
                                        <div class="d-flex">
                                            <a target="_blank" href="{{ route('client-account', ['key'=>$user->user_id]) }}" class="btn btn-primary shadow btn-xs sharp me-1">
                                                <i class="fas fa-user-alt"></i>
                                            </a>
                                            <a target="_blank" href="{{ route('loan-details', ['id'=>$user->id]) }}" class="btn btn-light shadow btn-xs sharp me-1">
                                                <i class="fas fa-file"></i>
                                            </a>
                                            <a title="Track Loan Repayments" href="track-repayments/{{$user->id}}">  
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                                                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                                                    <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                                </svg>                                              
                                            </a>                                      
                                        </div>												
                                    </td>												
                                </tr>
                                @empty
                                <div class="intro-y col-span-12 md:col-span-6">
                                    <div class="box text-center">
                                        <p>No User Found</p>
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
