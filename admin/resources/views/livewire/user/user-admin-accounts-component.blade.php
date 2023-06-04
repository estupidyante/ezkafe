<div class="content-wrapper">
    <div class="row">
        <h3 class="text-dark">Admin Accounts</h3>
        <p class="text-muted pb-0 m-0">EzKafe / Admin Accounts</p>
        <p class="text-muted pb-4">Here are all the accounts that are registered in the system.</p>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card card-accounts">
                <h6 class="card-header">
                    <a href="{{ url('user/product') }}" class="btn btn-primary float-end">
                        <span class="menu-icon">
                            <i class="mdi mdi-account-plus"></i>
                        </span>
                        <span>Register New Account</span>
                    </a>
                </h6>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <p>{{ session('status') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                        </div>
                    @elseif(session('failed'))
                        <div class="alert alert-danger" role="alert">
                            <p>{{ session('failed') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-5">
                            <thead>
                                <tr class="table-success">
                                    <th scope="col"> Full Name </th>
                                    <th scope="col"> Username </th>
                                    <th scope="col"> Email </th>
                                    <th scope="col"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $row)
                                    <tr>
                                        <td> {{$row->name}} </td>
                                        <td> {{$row->username}} </td>
                                        <td> {{$row->email}} </td>
                                        <td>
                                            <a href="{{ url('user/editAccount/'.$row->id) }}" class="btn btn-success">Edit</a>
                                            <a href="{{ url('user/deleteAccount/'.$row->id) }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>