<div>
    <style>
        .tree {
            list-style-type: none;
            padding-left: 1em;
        }

        .tree li {
            margin: 0;
            padding: 0 1em;
            line-height: 2em;
            color: #000;
            position: relative;
        }

        .tree li:before {
            position: absolute;
            top: 0;
            left: 0;
            width: 1em;
            height: 1em;
            font-weight: bold;
            color: #000;
            transform: rotate(45deg);
            margin-top: 0.2em;
        }

        .toggle {
            cursor: pointer;
        }

        .nested {
            display: none;
        }

        .nested.show {
            display: block;
        }
    </style>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="p-3 col-12">
                    <div class="bg-transparent page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 fw-bold">Manage System Settings</h4>
                    </div>
                </div>
            </div>
        </div>
        @can('add user roles')
        <div class="col-md-12">
            <!--begin::Card-->
            <div class="card h-md-100">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-center">
                    <!--begin::Button-->
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_role">
                        <!--begin::Illustration-->
                        <!--end::Illustration-->
                        <!--begin::Label-->
                        <div class="text-gray-600 fw-bold fs-3 text-hover-primary">Add New Role</div>
                        <!--end::Label-->
                    </button>
                    <!--begin::Button-->
                </div>
                <!--begin::Card body-->
            </div>
            <!--begin::Card-->
        </div>
        @endcan
        <!--begin::Post-->
        <div class="px-3 post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container">
                <!--begin::Row-->
                <div class="">
                    <!--begin::Col-->
                    <div class="row g-5">
                        @foreach ($roles as $role)
                        <div class="col-md-4">
                            <div class="transition-all duration-300 ease-in-out shadow card card-flush hover:shadow-lg" 
                                style="border: none; border-radius: 15px; overflow: hidden;">
                                <div class="py-2 card-header" style="background: linear-gradient(45deg, #04942c, #387641);">
                                    <div class="card-title d-flex flex-column align-items-start">
                                        <div class="mb-3 d-flex align-items-center">
                                            <div class="rounded-full symbol symbol-circle symbol-50px">
                                                <div class="bg-white rounded-full symbol-label" style="border-radius:10px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="rounded bi bi-person-fill-gear text-primary-full" viewBox="0 0 16 16">
                                                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <h2 class="m-0 text-white fw-bold ms-2">{{ ucwords($role->name) }}</h2>
                                        </div>
                                        {{-- <span class="mt-1 text-white-50">{{ $role->users_count ?? 0 }} Users</span> --}}
                                    </div>
                                </div>
                                <div class="py-2 card-body">
                                    <div class="d-flex flex-column">
                                        <div class="mb-3 d-flex align-items-center">
                                            <span class="bullet bullet-vertical bg-primary me-3"></span>
                                            {{-- <span class="text-gray-800 fs-6 fw-semibold">{{ $role->permissions_count ?? 0 }} Permissions</span> --}}
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="bullet bullet-vertical bg-info me-3"></span>
                                            <span class="text-gray-800 fs-6 fw-semibold">Last updated: {{ $role->updated_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-4 card-footer bg-light">
                                    <div class="d-flex justify-content-between">
                                        @can('delete user roles')
                                            <button class="transition-all duration-300 ease-in-out btn btn-sm btn-danger hover:btn-dark" 
                                                    wire:click="destroy({{ $role->id }})"
                                                    onclick="return confirm('Are you sure you want to delete this role?')">
                                                <i class="bi bi-trash me-2"></i>Delete
                                            </button>
                                        @endcan
                                        @can('edit user roles')
                                            <button class="transition-all duration-300 ease-in-out btn btn-sm btn-info hover:btn-primary" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#kt_modal_update_role" 
                                                    wire:click="edit({{ $role->id }})">
                                                <i class="bi bi-pencil me-2"></i>Edit Role
                                            </button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--end::Col-->
                    <!--begin::Add new card-->
                    
                    <!--begin::Add new card-->
                </div>

                <div wire:ignore class="modal fade" id="kt_modal_add_role" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-750px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="fw-bold">Add a Role</h2>

                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>

                            <div class="w-full modal-body scroll-y my-7">
                                <form id="kt_modal_add_role_form" class="form" method="POST" action="{{ route('create-role') }}">
                                    @csrf
                                    <div wire:loading.remove wire:target="store" class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
                                        <div class="mb-10 row">
                                            <div class="col-lg-6 fv-row">
                                                <label class="fs-3 fw-bolder form-label text-success">
                                                    <span class="required">Role Name</span>
                                                </label>
                                                <input class="form-control form-control-lg form-control-solid bg-light-success" placeholder="Enter a role name" name="name" />
                                            </div>
                                            <div class="col-lg-6 d-flex align-items-center">
                                                <span class="text-gray-600 fs-5">Create a new role to manage user permissions</span>
                                            </div>
                                        </div>

                                        <div class="fv-row">
                                            <label class="mb-5 fs-3 fw-bolder form-label text-success">Role Permissions</label>
                                            <div class="table-responsive">
                                                <ul class="tree list-unstyled">
                                                    @foreach($permissions as $g => $p)
                                                        <li class="p-1 mb-2 rounded bg-light-success">
                                                            <span class="cursor-pointer toggle d-flex align-items-center">
                                                                <span class="me-2 text-success">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                                    </svg>
                                                                </span>
                                                                <span class="fs-4 fw-bold text-success">
                                                                    {{ ucwords($g) }} Management
                                                                </span>
                                                            </span>
                                                            <ul class="mt-3 nested list-unstyled">
                                                                <li>
                                                                    <div class="row">
                                                                        @foreach($p as $key => $perm)
                                                                            <div class="mb-3 col-lg-4">
                                                                                <label class="form-check form-check-custom form-check-solid me-1">
                                                                                    <input class="form-check-input bg-success" type="checkbox" name="permission[]" value="{{ $perm->name }}" />
                                                                                    <span class="form-check-label fs-6">{{ ucwords($perm->permission) }}</span>
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light btn-lg me-3" data-kt-roles-modal-action="cancel">Discard</button>
                                        <button type="submit" class="btn btn-success btn-lg" data-bs-dismiss="modal" data-kt-roles-modal-action="submit">
                                            <span class="indicator-label">Create Role</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div wire:ignore.self class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-750px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="fw-bold">Update Role</h2>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            <div class="mx-5 modal-body scroll-y my-7">
                                <form id="updateRoleForm" class="form" method="POST" action="{{ route('update-role') }}">
                                    @csrf
                                    <input type="hidden" name="role_id" value="{{$role_id}}">
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
                                        <div class="mb-10 fv-row">
                                            <label class="mb-2 fs-5 fw-bold form-label">
                                                <span class="required">Role name</span>
                                            </label>
                                            <input class="form-control form-control-solid" name="name" value="{{$name}}" wire:model.defer="name" />
                                        </div>
                                        <div class="fv-row">
                                            <label class="mb-2 fs-5 fw-bold form-label">Role Permissions</label>
                                            <div class="table-responsive">
                                                <!-- Begin nested dropdown structure -->
                                                <ul class="tree">
                                                    @foreach($permissions as $g => $p)
                                                        <li class="text-gray-800">
                                                            <span class="toggle">
                                                                <span style="color: blueviolet">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                                                                    </svg>
                                                                </span>
                                                                <span class="font-bold" style="color: blueviolet">
                                                                    <b>{{ ucwords($g) }} Management</b>
                                                                </span>
                                                            </span>
                                                            <ul class="nested">
                                                                <li class="d-block">
                                                                    @foreach($p as $key => $perm)
                                                                        <label for="{{ $perm->name.''.$perm->id }}" class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                            <input
                                                                                id="{{ $perm->name.''.$perm->id }}"
                                                                                class="form-check-input"
                                                                                type="checkbox"
                                                                                name="permission[]"
                                                                                @if(!empty($rolePermissions))
                                                                                value="{{ $perm->name }}"
                                                                                {{
                                                                                    in_array($perm->name, $rolePermissions) ? 'checked' : ''
                                                                                }}
                                                                                @endif
                                                                                value="{{ $perm->name }}"
                                                                            />
                                                                            <small class="form-check-label">{{ ucwords($perm->permission) }}</small>
                                                                            <span class="form-check-label">{{ $permission->permission }}</span>
                                                                        </label>
                                                                    @endforeach
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <!-- End nested dropdown structure -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">Discard</button>
                                        <button onclick="submitForm()" type="button" class="btn btn-primary" data-kt-roles-modal-action="cancel">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="align-middle spinner-border spinner-border-sm ms-2"></span>
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.toggle').click(function () {
                    $(this).parent().children('ul.nested').toggleClass('show');
                });
            });

            function submitForm() {
                var form = document.getElementById('updateRoleForm');
                var formData = new FormData(form);
                // Prevent the default form submission behavior
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                });
                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Handle the response data as needed
                    console.log(data);
                    jSuites.notification({
                            name: 'Role Update',
                            message: 'User role updated successfully!',
                    });
                })
                .catch(error => {
                    // Handle errors
                    console.error('There was a problem with the fetch operation:', error);
                });
            }
        </script>
    </div>

</div>
