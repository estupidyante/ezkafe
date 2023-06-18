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
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <strong class="card-header">{{ $user_chart->options['chart_title'] }}</strong>
                <div class="card-body">
                    {!! $user_chart->renderHtml() !!}
                </div>

            </div>
        </div>
    </div>
</div>
@section('page-script')
{!! $user_chart->renderChartJsLibrary() !!}

{!! $user_chart->renderJs() !!}
@endsection