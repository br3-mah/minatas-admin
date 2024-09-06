
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="bg-transparent page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Borrowers</h4>

                    <div class="page-title-right">
                        <ol class="m-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Borrowers</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0 card-title">Add, Edit & Remove Loan Borrowers</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="listjs-table" id="customerList">
                            <div class="mb-3 row g-4">
                                <div class="col-sm-auto">
                                    <div>
                                        @can('create clientele')
                                        <a href="" type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="align-bottom ri-add-line me-1"></i> Add Borrower</a>
                                        @endcan

                                        <a href="#" data-bs-toggle="modal" data-bs-target="#export_borrowers_panel" class="px-3 btn btn-success">Export</a>
                                        {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#import_customers_panel" class="px-3 btn btn-warning">Import</a> --}}

                                        {{-- <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button> --}}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    {{-- <div class="d-flex justify-content-sm-end">
                                        <div class="search-box ms-2">
                                            <input type="text" class="form-control search" placeholder="Search...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                            <div class="px-3 mt-3 mb-1 table-responsive table-card">
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Source</th>
                                            <th>Employer</th>
                                            <th>NRC</th>
                                            <th>Joining Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @forelse($users as $user)
                                        <tr>
                                            <td class="customer_name">{{ 1000 + $user->id }}</td>
                                            <td class="customer_name">{{ $user->fname.' '.$user->lname }}</td>
                                            <td class="email">{{ $user->email }}</td>
                                            <td class="email">{{ $user->phone ?? 'No phone' }}</td>
                                            <td class="email">{{ $user->usource ?? 'Other' }}</td>
                                            <td class="phone">{{ $user->employer ?? 'No Employment' }}</td>
                                            <td class="nrc">{{ $user->nrc_no ?? $user->nrc ?? 'No nrc no.' }}</td>
                                            <td class="date">{{ $user->created_at->diffForHumans() }}</td>
                                            <td>
                                                <div class="gap-2 d-flex">
                                                    @can('view clientele')
                                                    <div class="show">
                                                        <a href="{{ route('client-account', ['key'=>$user->id]) }}" class="btn btn-sm btn-primary">Show</a>
                                                    </div>
                                                    @endcan

                                                    @can('edit clientele')
                                                    <div class="edit">
                                                        <a href="{{ route('edit-user', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    </div>
                                                    @endcan

                                                    @can('delete clientele')
                                                    <div class="remove">
                                                        <a class="btn btn-sm btn-danger" wire:click="destroy({{ $user->id }})" onclick="confirm('Are you sure you want to permanently delete this account.') || event.stopImmediatePropagation();">Remove</a>
                                                    </div>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <div class="col-span-12 intro-y md:col-span-6">
                                            <div class="text-center box">
                                                <p>No User Found</p>
                                            </div>
                                        </div>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="noresult" style="display: none">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="mb-0 text-muted">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                                    </div>
                                </div>
                            </div>


                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end col -->
        </div>


        <!-- Modal -->
        <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                            <div class="pt-2 mx-4 mt-4 fs-15 mx-sm-5">
                                <h4>Are you Sure ?</h4>
                                <p class="mx-4 mb-0 text-muted">Are you Sure You want to Remove this Record ?</p>
                            </div>
                        </div>
                        <div class="gap-2 mt-4 mb-2 d-flex justify-content-center">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn w-sm btn-danger " id="delete-record">Yes, Delete It!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end modal -->

    </div>
    <!-- container-fluid -->
    @include('livewire.dashboard.borrowers.__parts.create')
    @include('livewire.dashboard.loans.__modals.export-borrowers')
    @include('livewire.dashboard.loans.__modals.import-borrowers')
</div>
