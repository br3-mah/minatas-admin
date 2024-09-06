<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="bg-transparent page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Guarantors</h4>

                    <div class="page-title-right">
                        <ol class="m-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Guarantors</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="alert alert-info" role="alert">
            List of all Guarantors/ Next of Kin with respective borrowers
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Gurantors</h5>
                    </div>
                    <div class="card-body">
                        <table id="guarantorTable" class="table align-middle table-bordered dt-responsive nowrap table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name.</th>
                                    <th>Gender.</th>
                                    <th>Mobile</th>
                                    <th>Borrower</th>
                                    <th>Email</th>
                                    <th>Relationship</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($guarantors as $user)
                                    <tr>
                                        <td>{{ $user->fname.' '.$user->lname }} </td>
                                        <td>{{ $user->gender }}</td>
                                        <td>{{ $user->phone ?? '--' }}</td>
                                        <td><a href="{{ route('client-account', ['key'=>$user->user_id]) }}"><strong>{{ $user->customer }}</strong></a></td>
                                        <td><a href="javascript:void(0);"><strong>{{ $user->email }}</strong></a></td>
                                        <td>{{ $user->relation }}</td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
