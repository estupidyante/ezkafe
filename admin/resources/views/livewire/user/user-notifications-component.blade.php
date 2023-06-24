@section('title')
<title>EzKafe | Notifications</title>
@endsection
<div class="content-wrapper">
    <div class="row">
        <h3 class="text-dark">Notifications</h3>
        <p class="text-muted pb-4">Here are all the notifications in the system.</p>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card card-accounts">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-5">
                            <thead>
                                <tr class="table-success">
                                    <th scope="col"> Type </th>
                                    <th scope="col"> Content </th>
                                    <th scope="col"> Create At </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notifications as $notify)
                                    <tr>
                                        <td> {{ $notify->type }} </td>
                                        <td> {{ $notify->content }} </td>
                                        <td> {{ $notify->created_at }} </td>
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