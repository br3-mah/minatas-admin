
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                    <h4 class="mb-sm-0">My Wallet</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">My Wallet</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row dash-nft">
            <div class="col-xxl-9">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card overflow-hidden">
                            <div class="card-body bg-marketplace d-flex">
                                <div class="flex-grow-1">
                                    <h4 class="fs-18 lh-base mb-0">Receive, Withdrawl and Manage <br> your own <span class="text-primary">Wallet.</span> </h4>
                                    <p class="mb-0 mt-2 pt-1 text-muted">Get and deposit funds from mobile money within your wallet.</p>
                                    <div class="d-flex gap-3 mt-4">
                                        <a href="#!"  data-bs-toggle="modal" data-bs-target="#loanWalletFundUpdate" class="btn btn-primary">Deposit </a>
                                        
                                        @if($current_funds > 0)
                                        <button wire:click="reverseFunds()" onclick="confirm('The last updated amount will be deducted from wallet funds, Are you sure you want to continue?') || event.stopImmediatePropagation();"
                                         class="btn btn-soft-primary">Reverse Txn</button>
                                         <button wire:click="resetWallet()" onclick="confirm('The wallet will be set to ZMW 0, Are you sure you want continue with the action?') || event.stopImmediatePropagation();"
                                          class="btn btn-soft-danger">Reset to Zero</button>
                                        @endif
                                    </div>
                                </div>
                                <img src="public/assets/images/bg-d.png" alt="" class="img-fluid" />
                            </div>
                        </div>
                    </div><!--end col-->
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-height-100">
                            <div class="card-body">
                                <div class="float-end">
                                    <div class="dropdown card-header-dropdown">
                                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted fs-18"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Today</a>
                                            <a class="dropdown-item" href="#">Last Week</a>
                                            <a class="dropdown-item" href="#">Last Month</a>
                                            <a class="dropdown-item" href="#">Current Year</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-primary"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ps-3">
                                        <h5 class="text-muted text-uppercase fs-13 mb-0">Total Deposit</h5>
                                    </div>
                                </div>
                                <div class="mt-4 pt-1">
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0">K<span class="counter-value" data-target="{{ $account->deposit }}"></span> </h4>
                                    <p class="mt-4 mb-0 text-muted"><span class="badge bg-success-subtle text-success mb-0 me-1"> <i class="ri-arrow-down-line align-middle"></i> 0 % </span> vs. previous month</p>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-height-100">
                            <div class="card-body">
                                <div class="float-end">
                                    <div class="dropdown card-header-dropdown">
                                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted fs-18"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Today</a>
                                            <a class="dropdown-item" href="#">Last Week</a>
                                            <a class="dropdown-item" href="#">Last Month</a>
                                            <a class="dropdown-item" href="#">Current Year</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-wallet text-primary"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ps-3">
                                        <h5 class="text-muted text-uppercase fs-13 mb-0">Total Withdrawls</h5>
                                    </div>
                                </div>
                                <div class="mt-4 pt-1">
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-0">K<span class="counter-value" data-target="{{ $account->withraw }}"></span> </h4>
                                    <p class="mt-4 mb-0 text-muted"><span class="badge bg-success-subtle text-success mb-0"> <i class="ri-arrow-up-line align-middle"></i> 0 % </span> vs. previous month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->

                <div class="row">
                    <div class="col-xxl-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-xxl-8">
                                        <div class="">
                                            <div class="card-header border-0 align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Your Wallet Balance</h4>
                                            </div><!-- end card header -->
                                            
                                            <div id="line_chart_basic" data-colors='["--vz-primary","--vz-success", "--vz-secondary"]' class="apex-charts" dir="ltr"></div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-4">
                                        <div class="border-start p-4 h-100 d-flex flex-column">

                                            <div class="w-100">
                                                <div class="d-flex align-items-center">
                                                    @if (auth()->user()->profile_photo_path)
                                                        @if ($route == 'edit-user' || $route == 'profile.show' || $route == 'loan-details' || $route == 'detailed' || $route == 'loan-statement')
                                                            <img class="img-fluid avatar-xs rounded-circle object-fit-cover" src="{{ '../public/'.Storage::url(auth()->user()->profile_photo_path) }}" alt="Profile Pic">
                                                        @else
                                                            <img class="img-fluid avatar-xs rounded-circle object-fit-cover" src="{{ 'public/'.Storage::url(auth()->user()->profile_photo_path) }}" alt="Profile Pic">
                                                        @endif
                                                    @else
                                                        <img class="img-fluid avatar-xs rounded-circle object-fit-cover" src="https://thumbs.dreamstime.com/b/default-avatar-profile-image-vector-social-media-user-icon-potrait-182347582.jpg" alt="Profile Pic">
                                                    @endif
                                                    <div class="ms-3 flex-grow-1">
                                                        <h5 class="fs-16 mb-1">{{ auth()->user()->fname.' '.auth()->user()->lname }}</h5>
                                                        <p class="text-muted mb-0">{{ auth()->user()->nrc_no ?? auth()->user()->phone }}</p>
                                                    </div>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="align-middle text-muted" role="button" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-share-line fs-18"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton5">
                                                            <li>
                                                                <button title="Your Wallet Account balance will be set to K0" href="#" class="btn btn-danger dropdown-item">
                                                                    <i class="ri-settings-fill text-danger align-bottom me-1"></i> Reset Account
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <h3 class="ff-secondary fw-bold mt-4"><i class="mdi mdi-ethereum text-primary"></i> {{ $current_funds ?? 0  }} ZMW</h3>
                                                <p class="text-success mb-3">+0.00 (0%)</p>

                                                <p class="text-muted">Capex wallet is a digital wallet asset that is collectable, unique, and non-transferrable.</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div><!--end row-->
            </div><!--end col-->


            
            
        </div>
        <!--end row-->
    </div>
    <!-- container-fluid -->

    <div wire:ignore class="modal fade" id="loanWalletFundUpdate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-full"> <div class="modal-content">
            <div class="modal-header bg-primary d-flex justify-content-between align-items-center">
              <h5 class="modal-title text-white">Update Wallet Funds</h5>
              <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
      
            <form wire:submit.prevent="store">
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-body"> @csrf
                        <div class="form-group">
                          <label for="amount">Amount</label>
                          <input wire:model.defer="amount" type="text" class="form-control" placeholder="Enter amount">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
      
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      

</div>
<!-- End Page-content -->