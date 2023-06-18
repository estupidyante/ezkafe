@section('title')
<title>EzKafe | Admin Dashboard</title>
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
    .card .card-body {
        background:white;
        padding:0px !important;
    }
    .card.card-accounts {
        background: white !important;
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
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 24px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    .label_with_button {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom:1rem;
    }
    button.dynamic_add {
        font-size: 0.6rem;
        margin-top:0.5rem;
    }
    .dynamic_select_with_delete {
        display: flex;
        justify-content: space-between;
        margin-top:0.5rem;
    }
    .dynamic_select_with_delete button {
        margin-left:0.5rem;
    }
</style>
@endsection
<div class="content-wrapper">
    <div class="row">
        <h3 class="text-dark">Dashboard</h3>
        <p class="text-muted pb-4">Here are the contents of the dashboard</p>
    </div>
    <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-dashboard">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="icon icon-circle icon-box-warning ">
                                <span class="mdi mdi-food icon-item"></span>
                            </div>
                        </div>
                        <div class="col-9">
                            <h5 class="text-black font-weight-bold text-center text-32">{{$ingredients_count}}</h5>
                            <h6 class="text-muted font-weight-normal text-center">TOTAL INGREDIENTS</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-dashboard">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="icon icon-circle icon-box-danger">
                                <span class="mdi mdi-coin icon-item"></span>
                            </div>
                        </div>
                        <div class="col-9">
                            <h5 class="text-black font-weight-bold text-center text-32">{{number_format($revenue_count, 2)}}</h5>
                            <h6 class="text-muted font-weight-normal text-center">TOTAL REVENUE</h6>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-dashboard">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="icon icon-circle icon-box-success ">
                                <span class="mdi mdi-basket icon-item"></span>
                            </div>
                        </div>
                        <div class="col-9">
                            <h5 class="text-black font-weight-bold text-center text-32">{{$orders_count}}</h5>
                            <h6 class="text-muted font-weight-normal text-center">TOTAL ORDERS</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-dashboard">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="icon icon-circle icon-box-primary">
                                <span class="mdi mdi-account-circle icon-item"></span>
                            </div>
                        </div>
                        <div class="col-9">
                            <h5 class="text-black font-weight-bold text-center text-32">{{$users_count}}</h5>
                            <h6 class="text-muted font-weight-normal text-center">TOTAL USERS</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(sizeof($top_orders))
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <h6 class="card-header">Top 5 Products</h6>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-5 tab-content">
                            <thead class="table-secondary">
                                <tr>
                                    <th scope="col"> Image </th>
                                    <th scope="col"> Name </th>
                                    <th scope="col"> Description </th>
                                    <th scope="col"> Ingredients </th>
                                    <th scope="col"> Preferred Measurements </th>
                                    <th scope="col"> Price </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($top_orders as $item)
                                    @foreach ($products as $element)
                                        @if ($item->products_id == $element->id)
                                        <tr class="tab-pane">
                                            <td><img src="{{ url( $element->image ) }}" style="width: 150px; height:auto;"></td>
                                            <td> {{ $element->name }} </td>
                                            <td> {{ $element->description }} </td>
                                            <td>
                                                @if ($element->ing_ids != "")
                                                    @foreach(explode(',', $element->ing_ids) as $ing_id) 
                                                        {{ $ingredients->find($ing_id)->name }},
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if ($element->measurement_ids != "")
                                                    @foreach(explode(',', $element->measurement_ids) as $msr_id) 
                                                        {{ $measurements->find($msr_id)->name }},
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td> {{ $element->price }} </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    </div>
