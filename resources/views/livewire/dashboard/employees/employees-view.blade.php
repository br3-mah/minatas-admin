
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="bg-transparent page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Employees</h4>

                    <div class="page-title-right">
                        <ol class="m-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employees</li>
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
                        <h4 class="mb-0 card-title">Add, Edit & Remove Employees</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="listjs-table" id="customerList">
                            <div class="mb-3 row g-4">
                                <div class="col-sm-auto">
                                    <div>
                                        <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="align-bottom ri-add-line me-1"></i> Add</button>
                                        {{-- <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="px-3 mt-3 mb-1 table-responsive table-card">
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="sort" data-sort="customer_name">Fullnames</th>
                                            <th class="sort" data-sort="email">Email</th>   
                                            <th class="sort" data-sort="date">Phone</th>
                                            <th class="sort" data-sort="status">Created Date</th>
                                            <th class="sort" data-sort="action">Status</th>
                                            <th class="sort" data-sort="action">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @forelse($users as $user)
                                            @if( !$user->hasRole('user')  && $user->id !== 1)
                                            <tr>
                                                <td class="customer_name">{{ $user->fname.' '.$user->name.' '.$user->lname }}</td>
                                                <td class="email">{{ $user->email }}</td>
                                                <td class="phone">{{ $user->phone }}</td>
                                                <td class="date">{{ $user->created_at->toFormattedDateString() }}</td>
                                                <td class="status"><span class="badge bg-success-subtle text-success text-uppercase">Active</span></td>
                                                <td>
                                                    <div class="gap-2 d-flex">
                                                        <div class="show">
                                                            <a href="{{ route('client-account', ['key' => $user->id]) }}" class="btn btn-sm btn-primary edit-item-btn">Details</a>
                                                        </div>
                                                        <div class="edit">
                                                            <a  href="{{ route('edit-user', $user->id) }}" class="btn btn-sm btn-primary edit-item-btn">Edit</a>
                                                        </div>
                                                        <div class="remove">
                                                            <a wire:click="destory({{$user->id}})" onclick="confirm('Are you sure you want to permanently delete this account.') || event.stopImmediatePropagation();" class="btn btn-sm btn-danger remove-item-btn">Remove</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
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

                   
                        </div>
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end col -->
        </div>

        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="p-3 modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                    </div>
                    <form method="POST" action="{{ route('create-user') }}" class="tablelist-form" autocomplete="off">
                        @csrf
                        <div class="modal-body">
                            <div class="row g-3 mb-7">
                                <div class="col-md-6">
                                    <label class="mb-2 required fs-6 fw-semibold">Firstname</label>
                                    <input class="form-control form-control-solid" placeholder="Firstname" name="fname" />
                                </div>
                                <div class="col-md-6">
                                    <label class="mb-2 required fs-6 fw-semibold">Lastname</label>
                                    <input class="form-control form-control-solid" placeholder="Surname" name="lname" />
                                </div>
                            </div>
                            <div class="row g-3 mb-7">
                                <div class="col-md-12">
                                    <label class="mb-2 fs-6 fw-semibold">
                                        <span class="required">Email</span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Email address must be active">
                                            <i class="text-gray-500 ki-duotone ki-information-5 fs-6"></i>
                                        </span>
                                    </label>
                                    <input type="email" class="form-control form-control-solid" placeholder="" name="email" />
                                </div>
                            </div>
                            <div class="row g-3 mb-7">
                                <div class="col-md-12">
                                    <label class="mb-2 fs-6 fw-semibold">Defualt Password</label>
                                    <input type="text" disabled class="form-control form-control-solid" placeholder="capex+2024" required />
                                </div>
                            </div>
                            <br>
                            <div class="fw-bold fs-3 rotate collapsible mb-7" data-bs-toggle="collapse" href="#kt_modal_add_customer_billing_info" role="button" aria-expanded="false" aria-controls="kt_customer_view_details">
                                General Information
                                <span class="rotate-180 ms-2">
                                    <i class="ki-duotone ki-down fs-3"></i>
                                </span>
                            </div>
                            <div id="kt_modal_add_customer_billing_info" class="collapse show">
                                <div class="row g-3 mb-7">
                                    <div class="col-md-12">
                                        <label class="mb-2 required fs-6 fw-semibold">Address Line 1</label>
                                        <input class="form-control form-control-solid" placeholder="" name="address1" value="101, Collins Street" />
                                    </div>
                                </div>
                                <div class="row g-3 mb-7">
                                    <div class="col-md-12">
                                        <label class="mb-2 fs-6 fw-semibold">Active Phone Number</label>
                                        <input class="form-control form-control-solid" placeholder="" name="phone" />
                                    </div>
                                </div>
                                <div class="row g-3 mb-7">
                                    <div class="col-md-12">
                                        <label class="mb-2 required fs-6 fw-semibold">Town</label>
                                        <input class="form-control form-control-solid" placeholder="" name="city" />
                                    </div>
                                </div>
                                <div class="row g-3 mb-7">
                                    <div class="col-md-6">
                                        <label class="mb-2 required fs-6 fw-semibold">National ID Type</label>
                                        <select class="form-control" placeholder="" name="id_type">
                                            <option value="">--choose--</option>
                                            <option value="NRC">NRC</option>
                                            <option value="Passport">Passport</option>
                                            <option value="Driver Liecense">Driver Liecense</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-2 required fs-6 fw-semibold">National ID</label>
                                        <input class="form-control" placeholder="" name="nrc_no" />
                                    </div>
                                </div>
                                <div class="row g-3 mb-7">
                                    <div class="col-md-6">
                                        <label class="mb-2 fs-6 fw-semibold">
                                            <span class="required">Gender</span>
                                            <span class="ms-1" data-bs-toggle="tooltip" title="Sex of the employee">
                                                <i class="text-gray-500 ki-duotone ki-information-5 fs-6"></i>
                                            </span>
                                        </label>
                                        <select name="gender" aria-label="Select a gender" data-control="select2" data-placeholder="Select a gender..." data-dropdown-parent="#kt_modal_add_customer" class="form-select form-select-solid fw-bold">
                                            <option value="">Select a gender...</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-2 fs-6 fw-semibold">
                                            <span class="required">Role</span>
                                            <span class="ms-1" data-bs-toggle="tooltip" title="User role & permissions">
                                                <i class="text-gray-500 ki-duotone ki-information-5 fs-6"></i>
                                            </span>
                                        </label>
                                        <select name="assigned_role" aria-label="Select a role" data-control="select2" data-placeholder="Select a role..." data-dropdown-parent="#kt_modal_add_customer" class="form-select form-select-solid fw-bold">
                                            <option value="">Select a user role...</option>
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-3 mb-7">
                                    <div class="col-md-12">
                                        <div class="d-flex flex-stack">
                                            <div class="me-5">
                                                <label class="fs-6 fw-semibold">Allow spooling?</label>
                                                <div class="fs-7 fw-semibold text-muted">If user is allowed spooling, they will be able to pick and review a loan request when in spooling mode</div>
                                            </div>
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" name="billing" type="checkbox" value="1" id="kt_modal_add_customer_billing" checked="checked" />
                                                <span class="form-check-label fw-semibold text-muted" for="kt_modal_add_customer_billing">Yes</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="gap-2 hstack justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="add-btn">Add Customer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
</div>
