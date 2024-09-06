<style>
    .loan-card {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border: none;
        border-radius: 15px;
    }
    .loan-amount {
        color: #2c3e50;
        font-weight: 700;
    }
    .status-badge {
        font-size: 0.9rem;
        padding: 0.5em 1em;
    }
</style>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow loan-card">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="card-title h3 mb-3">Currently Active & Open</h1>
                            <h2 class="display-4 mb-3 loan-amount">K {{ number_format($loan->amount, 2, '.', ',') }}</h2>

                            <br>
                            <p class="card-title h3 mb-3">Pending Repayment Amount</p>
                            <h5 class="display-4 mb-3 text-info loan-amount">K {{ number_format(App\Models\Application::payback($loan->amount, $loan->repayment_plan, $loan->loan_product_id), 2, '.', ',') }}</h5>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success status-badge me-3">Active</span>
                                <p class="text-muted mb-0">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Loan status: Open
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4 mt-md-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" width="100%" height="auto">
                                <circle cx="100" cy="100" r="80" fill="#e0e7ff"/>
                                <path d="M100 20v160M20 100h160" stroke="#3b82f6" stroke-width="12" stroke-linecap="round"/>
                                <circle cx="100" cy="100" r="60" fill="#3b82f6" opacity="0.3"/>
                                <path d="M100 50v100M50 100h100" stroke="#3b82f6" stroke-width="8" stroke-linecap="round"/>
                                <circle cx="100" cy="100" r="15" fill="#1d4ed8"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>