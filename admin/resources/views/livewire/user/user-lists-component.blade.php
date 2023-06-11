@section('title')
<title>EzKafe | Users Lists</title>
@endsection
<div class="content-wrapper">
    <div class="row">
        <h3 class="text-dark">Users Lists</h3>
        <p class="text-muted pb-0 m-0">EzKafe / Reports / Users</p>
        <p class="text-muted pb-4">Here are all the user accounts that are registered in the system.</p>
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-5">
                            <thead>
                                <tr class="table-success">
                                    <th scope="col"> User ID </th>
                                    <th scope="col"> Order ID </th>
                                    <th scope="col"> Create At </th>
                                    <th scope="col"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td> {{ $user->id }} </td>
                                        <td> {{ $orders->find($user->id)->id }} </td>
                                        <td> {{ $user->created_at }} </td>
                                        <td>
                                            <form class="d-inline" action="{{ route('user.user.destroy', $user ) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
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