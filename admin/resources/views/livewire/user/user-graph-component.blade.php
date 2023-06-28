@section('title')
<title>EzKafe | Analytics User Graph</title>
@endsection
@section('page-style')
<style type="text/css">
    body {
        background-color: #d2d2d2;
    }
    .card .card-body {
        background: white;
        padding:0px !important;
        color: black;
    }
    .card.card-accounts {
        background: white !important;
        border: none !important;
        box-shadow: none !important;
    }
    .card-header {
        background: white !important;
        border: none !important;
        box-shadow: none !important;
        color: #000000;
    }
</style>
@endsection
<div class="content-wrapper">
    <div class="row">
        <h3 class="text-dark">User Graph</h3>
        <p class="text-muted pb-4">EzKafe / Analytics</p>
    </div>
    <div class="row justify-content-center" style="margin-bottom:40px">
        <div class="col-6 grid-margin">
            <div class="card">
                <strong class="card-header">{{ $user_chart->options['chart_title'] }}</strong>
                <div class="card-body">
                    {!! $user_chart->renderHtml() !!}
                </div>

            </div>
        </div>
        <div class="col-6 grid-margin">
            <div class="card card-accounts">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-5">
                            <thead style="border-top:1px solid #000000">
                                <tr class="table-success">
                                    <th scope="col"> User ID </th>
                                    <th scope="col"> Order ID </th>
                                    <th scope="col"> Product Name </th>
                                    <th scope="col"> Create At </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td> #{{ $user->id }} </td>
                                        <td> #{{ $orders->find($user->id)->id }} </td>
                                        <td> {{ $products->find($orders->find($user->id)->products_id)->name }} </td>
                                        <td> {{ $user->created_at }} </td>
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
@section('page-script')
{!! $user_chart->renderChartJsLibrary() !!}

{!! $user_chart->renderJs() !!}
@endsection