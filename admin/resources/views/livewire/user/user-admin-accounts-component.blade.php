@section('title')
<title>EzKafe | Admin Accounts</title>
@endsection
<div class="content-wrapper">
    <div class="row">
        <h3 class="text-dark">Admin Accounts</h3>
        <p class="text-muted pb-0 m-0">EzKafe / Admin Accounts</p>
        <p class="text-muted pb-4">Here are all the accounts that are registered in the system.</p>
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
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card card-accounts">
                <h6 class="card-header">
                    <a href="#" class="btn btn-primary float-end d-flex justify-content-center" data-mdb-toggle="modal" data-mdb-target="#addAccountModal">
                        <span class="menu-icon">
                            <i class="mdi mdi-account-plus"></i>
                        </span>
                        <span>Register New Account</span>
                    </a>
                </h6>
                <div class="card-body">
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
                                            <a href="#" class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#updateAccountModal_{{ $row->id }}">Edit</a>
                                            <!-- <a href="{{ url('user/'. $row->id .'/accounts/edit') }}" class="btn btn-success">Edit</a> -->
                                            @if( $you->id !== $row->id )
                                            <form class="d-inline" action="{{ route('user.account.destroy', $row ) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                            @endif
                                            <!-- <a href="{{ url('user/deleteAccount/'.$row->id) }}" class="btn btn-danger">Delete</a> -->
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
<!-- Modal -->
<div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAccountModalLabel">
            <span class="menu-icon">
                <i class="mdi mdi-account-plus"></i>
            </span>
            <span>Add New Admin Account</span>
        </h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Please answer all the input fields to add a new admin account.</p>
        <form method="POST" action="{{ route('user.account.create') }}">
            @csrf
            <div class="form-group">
                <label><span class="font-bold">Fullname </span> <span> (Lastname, Firstname, Middle Initial)</span></label>
                <input type="text" class="form-control p_input" name="name" placeholder="Enter your name" :value="name" required autofocus autocomplete="name">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control p_input" name="username" placeholder="Enter your name" :value="username" required autofocus autocomplete="username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control p_input" name="email" placeholder="Enter your email address" :value="email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control p_input" name="password" placeholder="Enter your password" required autocomplete="new-password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control p_input" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password">
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-success enter-btn" name="register">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
@foreach ($accounts as $account)
<div class="modal fade" id="updateAccountModal_{{ $account->id }}" tabindex="-1" aria-labelledby="updateAccountModalLabel_{{ $account->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateAccountModalLabel_{{ $account->id }}">
            <span class="menu-icon">
                <i class="mdi mdi-account-plus"></i>
            </span>
            <span>Edit Admin Account</span>
        </h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Please answer all the input fields to add a new admin account.</p>
        <form method="POST" action="/user/account/{{ $account->id }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label><span class="font-bold">Fullname </span> <span> (Lastname, Firstname, Middle Initial)</span></label>
                <input type="text" class="form-control p_input" name="name" placeholder="Enter your name" :value="name" value="{{ $account->name }}" required autofocus>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control p_input" name="username" placeholder="Enter your name" :value="username" value="{{ $account->username }}" required autofocus>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control p_input" name="email" placeholder="Enter your email address" :value="email"  value="{{ $account->email }}">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control p_input" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control p_input" name="password_confirmation" placeholder="Confirm password" required>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-success enter-btn" name="register">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach