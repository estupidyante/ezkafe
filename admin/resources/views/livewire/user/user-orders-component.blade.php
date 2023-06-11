@section('title')
<title>EzKafe | Orders</title>
@endsection
@section('page-style')
<style type="text/css">
    .category {
        display: flex;
    }
    body {
        background-color: #d2d2d2;
    }
    .categories {
        min-height: 500px;
    }
    .nav-tabs.table-tabs .nav-link {
        background: #ffffff;
        color: #000000;
        border:0px;
    }
    .nav-tabs.table-tabs .nav-link.active {
        background: #D9D9D9;
        color: #000000;
    }
    .card.card-accounts {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
    }
    .card-header {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
    }
    .table {
        margin: 0px !important;
    }
    .table thead tr {
        border: none !important;
    }
    .tab-content {
        padding: 0px !important;
        background: #ffffff !important;
        border: none !important;
    }
</style>
@endsection
<div class="content-wrapper">
    <div class="row">
        <h3 class="text-dark">Orders</h3>
        <p class="text-muted pb-0 m-0">EzKafe / Reports / Orders</p>
        <p class="text-muted pb-4">Here are all the orders from the machine</p>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card card-accounts">
                <h6 class="card-header">
                    this is where the calendar filter goes
                </h6>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-5">
                            <thead>
                                <tr class="table-success">
                                    <th scope="col"> Order ID </th>
                                    <th scope="col"> User ID </th>
                                    <th scope="col"> Date &amp; Time </th>
                                    <th scope="col"> Amount </th>
                                    <th scope="col"> Status </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td> #{{ $order->id }} </td>
                                        <td> {{ $order->user_id }} </td>
                                        <td> {{ $order->created_at }} </td>
                                        <td> {{ $order->amount }} </td>
                                        <td> {{ $order->status }} </td>
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