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
@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
@endpush
<div class="content-wrapper">
    <div class="row">
        <h3 class="text-dark">Orders</h3>
        <p class="text-muted pb-0 m-0">EzKafe / Reports / Orders</p>
        <p class="text-muted pb-4">Here are all the orders from the machine</p>
    </div>
    <div class="row justify-content-end" style="padding:0rem 1.5625rem;">
        <div class="col-md-4">
            <input type="datetime-local" class="form-control" name="filter_date" style="background:#000000;">
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card card-accounts">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-5">
                            <thead style="border-top:1px solid #000000">
                                <tr class="table-success">
                                    <th scope="col"> Order ID </th>
                                    <th scope="col"> User ID </th>
                                    <th scope="col"> Product </th>
                                    <th scope="col"> Date &amp; Time </th>
                                    <th scope="col"> Amount </th>
                                    <th scope="col"> Status </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td> #{{ $order->id }} </td>
                                        <td> {{ $order->clients_id }} </td>
                                        <td> {{ $products->find($order->products_id)->name }} </td>
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
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    config = {
        enableTime: false,
        dateFormat: "Y-m-d H:i",
        maxDate: "today",
        disableMobile: "false",
        onChange: function(selectedDates, dateStr, instance) {
            console.log('onChange: ', dateStr);
        },
        onOpen: [
            function(selectedDates, dateStr, instance){
                //...
            },
            function(selectedDates, dateStr, instance){
                //...
            }
        ],
        onClose: function(selectedDates, dateStr, instance){
            console.log('onClose: ', dateStr);
        }
    }
    flatpickr("input[type=datetime-local]", config);
</script>
@endpush