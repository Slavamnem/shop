@extends('layouts.admin-layout')
@section('content')
    {{--<div class="container-fluid ">--}}
        {{--<div class="dashboard-wrapper">--}}
            <div class="container-fluid  dashboard-content">
                <div class="alert alert-primary" role="alert">
                    <h1 align="center" class="alert-heading">Статистика</h1>
                </div>
                <div class="row">
                    <!-- ============================================================== -->
                    <!-- line chart with area  -->
                    <!-- ============================================================== -->

                    {{--<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">--}}
                        {{--<div class="card">--}}
                            {{--<h5 class="card-header">Line Charts</h5>--}}
                            {{--<div class="card-body">--}}
                                {{--<canvas id="chartjs_line2"></canvas>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}


                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10">
                        <div class="card">
                            <h3 class="card-header" id="year-sales-title"></h3>
                            <div class="card-body">
                                <div class="ct-chart-area ct-golden-section"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10">
                        <div class="card">
                            <h3 class="card-header" id="notifications-title"></h3>
                            <div class="card-body">
                                <div class="ct-chart-area-notifications ct-golden-section"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10">
                        <div class="card">
                            <h3 class="card-header" id="month-sales-title"></h3>
                            <div class="card-body">
                                <div class="ct-chart-area-month ct-golden-section"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header" id="year-sales-payment-types"></h5>
                            <div class="card-body">
                                <div class="ct-chart-multilines ct-golden-section"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header" id="test_graphic"></h5>
                            <div class="card-body">
                                <div class="ct-chart-multilines2 ct-golden-section"></div>
                            </div>
                        </div>
                    </div>

                    
                </div>

                <a class="btn btn-success" href="{{ route('admin-orders-all-export') }}" id="export-order-stats-">Export</a>
                <a class="btn btn-success" href="{{ route('admin-orders-year-export') }}" id="export-order-stats-">Export Year</a>
                <a class="btn btn-success" href="{{ route('admin-orders-month-export') }}" id="export-order-stats-">Export Month</a>
                <a class="btn btn-success" href="{{ route('admin-orders-day-export') }}" id="export-order-stats-">Export Day</a>

            </div>
        {{--</div>--}}
    {{--</div>--}}
@endsection

@section("custom-js")
    <script src="{{ asset("public/admin/assets/vendor/charts/charts-bundle/Chart.bundle.js") }}"></script>
    <script src="{{ asset("public/admin/assets/vendor/charts/charts-bundle/chartjs.js") }}"></script>
    <script src="{{ asset("public/admin/assets/vendor/charts/chartist-bundle/chartist.min.js") }}"></script>
    <script src="{{ asset("public/admin/assets/vendor/charts/chartist-bundle/Chartistjs.js") }}"></script>
    <script src="{{ asset("public/admin/assets/js/stats/main.js") }}"></script>
@endsection
