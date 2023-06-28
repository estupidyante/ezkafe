@section('title')
<title>EzKafe | Analytics Top Records</title>
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
        <h3 class="text-dark">Top Records</h3>
        <p class="text-muted pb-4">EzKafe / Analytics</p>
    </div>
    <div class="row justify-content-center" style="margin-bottom:40px">
        <div class="col-md-4">
            <div class="card">
                <strong class="card-header">Ingrdients (Sales)</strong>
                <div class="card-body">
                    <!-- All Ingredients -->
                    <canvas id="ingredientChart" height="200px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <strong class="card-header">Ingredients (All)</strong>
                <div class="card-body">
                    <!-- Sales Ingredients -->
                    <canvas id="ingredientAllChart" height="200px"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" style="margin-bottom:40px">
        <div class="col-6 grid-margin">
            <div class="card">
                <strong class="card-header">Transactions</strong>
                <div class="card-body">
                    <!-- transactions goes here -->
                    <canvas id="orderChart" height="200px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-6 grid-margin">
            <div class="card">
                <strong class="card-header">Revenue</strong>
                <div class="card-body">
                    <!-- revenue goes here -->
                    <canvas id="revenueChart" height="200px"></canvas>
                </div>
            </div>
        </div>
    </div>
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
                                    <th scope="col"> Current Price </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($top_orders as $item)
                                    @foreach ($products as $element)
                                        @if ($item->products_id == $element->id)
                                        <tr class="tab-pane">
                                            <td><img src="{{ url( $element->image ) }}" style="width: 150px; height:auto;"></td>
                                            <td class="text-wrap"> {{ $element->name }} </td>
                                            <td class="text-wrap"> {{ $element->description }} </td>
                                            <td class="text-wrap">
                                                @if ($element->ing_ids != "")
                                                    @foreach(explode(',', $element->ing_ids) as $ing_id) 
                                                        {{ $ingredients->find($ing_id)->name }},
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="text-wrap">
                                                @if ($element->measurement_ids != "")
                                                    @foreach(explode(',', $element->measurement_ids) as $msr_id) 
                                                        {{ $measurements->find($msr_id)->name }},
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="text-wrap"> {{ number_format($element->price, 2) }} </td>
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
</div>
@section('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var ingredient_all_labels =  {{ Js::from($ingredient_all_labels) }};
        var ingredient_all =  {{ Js::from($ingredient_all_data) }};
        if(ingredient_all.length > 0) {
            const ingredient_all_data = {
                labels: ingredient_all_labels,
                datasets: [{
                    label: 'Ingredients',
                    backgroundColor: getRandomColor(),
                    borderColor: 'rgb(181,25,236)',
                    data:  ingredient_all,
                }]
            };
            const ingredient_all_config = {
                type: 'bar',
                data: ingredient_all_data,
                options: {responsive:true}
            };
            const ingredientAllChart = new Chart(
                document.getElementById('ingredientAllChart'),
                ingredient_all_config
            );

            var order_labels =  {{ Js::from($order_labels) }};
            var orders =  {{ Js::from($order_data) }};
            const order_data = {
                labels: order_labels,
                datasets: [{
                    label: 'Transactions',
                    backgroundColor: 'rgb(118,216,109)',
                    borderColor: 'rgb(118,216,109)',
                    data: orders,
                }]
            };
            const order_config = {
                type: 'line',
                data: order_data,
                options: {responsive:true}
            };
            const orderChart = new Chart(
                document.getElementById('orderChart'),
                order_config
            );

            var sale_labels =  {{ Js::from($sale_labels) }};
            var sales =  {{ Js::from($sale_data) }};
            var expenses =  {{ Js::from($expense_data) }};
            var revenues = [Number(sales[0]) - Number(expenses['June'])];
            const revenue_data = {
                labels: sale_labels,
                datasets: [{
                    label: 'Sales',
                    backgroundColor: 'rgb(181,25,236)',
                    borderColor: 'rgb(181,25,236)',
                    data: sales,
                },{
                    label: 'Expenses',
                    backgroundColor: 'rgb(255,88,88)',
                    borderColor: 'rgb(255,88,88)',
                    data: expenses,
                },{
                    label: 'Revenue',
                    backgroundColor: 'rgb(70,95,225)',
                    borderColor: 'rgb(70,95,225)',
                    data: revenues,
                }]
            };
            const revenue_config = {
                type: 'line',
                data: revenue_data,
                options: {responsive:true}
            };
            const revenueChart = new Chart(
                document.getElementById('revenueChart'),
                revenue_config
            );

            function getRandomColor() {
                var letters = '0123456789ABCDEF'.split('');
                var color = '#';
                for (var i = 0; i < 6; i++ ) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
        }
    });
  
</script>
@endsection