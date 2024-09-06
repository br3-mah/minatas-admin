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
            <div class="modal-body scroll-y mx-5 my-7">
                <form id="updateRoleForm" class="form" method="POST" action="{{ route('update-role') }}">
                    @csrf
                    <input type="hidden" name="role_id" value="{{$role_id}}">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
                        <div class="fv-row mb-10">
                            <label class="fs-5 fw-bold form-label mb-2">
                                <span class="required">Role name</span>
                            </label>
                            <input class="form-control form-control-solid" name="name" value="{{$name}}" wire:model.defer="name" />
                        </div>
                        <div class="fv-row">
                            <label class="fs-5 fw-bold form-label mb-2">Role Permissions</label>
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
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
