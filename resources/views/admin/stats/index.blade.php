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
                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10">
                        <div class="card">
                            <h3 class="card-header">Динамика продаж</h3>
                            <div class="card-body">
                                <div class="ct-chart-area ct-golden-section"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Доход по типом оплаты (картой и наличкой)</h5>
                            <div class="card-body">
                                <div class="ct-chart-multilines ct-golden-section"></div>
                            </div>
                        </div>
                    </div>

                    
                </div>

            </div>
        {{--</div>--}}

    {{--</div>--}}
@endsection

@section("custom-js")
    <script src="{{ asset("public/admin/assets/vendor/charts/chartist-bundle/chartist.min.js") }}"></script>
    <script src="{{ asset("public/admin/assets/vendor/charts/chartist-bundle/Chartistjs.js") }}"></script>
    {{--<script>--}}
        {{--if ($('.ct-chart-area').length) {--}}
            {{--new Chartist.Line('.ct-chart-area', {--}}
                    {{--labels: [1, 2, 3, 4, 5, 10, 7, 8, 9, 10],--}}
                    {{--series: [--}}
                        {{--[5, 9, 7, 8, 5, 3, 5, 4, 10, 4]--}}
                    {{--]--}}
                {{--},--}}


                {{--{--}}
                    {{--low: 0,--}}
                    {{--showArea: true,--}}

                {{--});--}}
        {{--}--}}
    {{--</script>--}}
@endsection
