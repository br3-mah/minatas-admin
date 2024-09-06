<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
            <h4 class="mb-sm-0">{{ ucwords(str_replace('-', ' ', $settings)) }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboards</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('sys-settings') }}">System Settings</a></li>
                    <li class="breadcrumb-item active">{{ ucwords(str_replace('-', ' ', $settings)) }}</li>
                </ol>
            </div>

        </div>
    </div>
</div>


<div class="card-header">
    <div class="card-toolbar">
        <a href="{{ route('system-create', ['page' => 'loan-type']) }}" class="btn btn-soft-primary">
        Add Loan Type</a>
    </div>
</div>

<div class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold text-muted bg-light">
                    <th class="ps-4 min-w-205px rounded-start">Loan Type</th>
                    <th class="min-w-100px">Description</th>
                    <th class="min-w-100px">Dated Added</th>
                    <th class="min-w-100px">Actions</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody>
                @forelse ($loan_types as $type)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="d-flex justify-content-start flex-column">
                                <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $type->name }}</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="text-muted fw-semibold text-muted d-block fs-7">{{ $type->description ?? 'No Description' }}</span>
                    </td>
                    <td>
                        <a href="#" class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $type->created_at->toFormattedDateString() }}</a>
                        {{-- <span class="text-muted fw-semibold text-muted d-block fs-7">Insurance</span> --}}
                    </td>

                    <td class="text-end">
                        <a title="You can not delete this for now" wire:click="deleteLoanType({{ $type->id }})" disabled class="btn disabled btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                            </svg>
                        </a>
                        <a title="Edit" href="{{ route('system-edit', ['page' => 'loan-parent-type', 'item_id' => $type->id]) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                @empty

                @endforelse
            </tbody>
        </table>
    </div>
</div>
