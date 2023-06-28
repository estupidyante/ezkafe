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
                <div class="card-body">
                    <livewire:datatable/order-datatables 
                        searchable="created_at"
                        exportable
                    />
                </div>
            </div>
        </div>
    </div>
</div>