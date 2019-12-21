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

                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header" id="payment-types-title"></h5>
                            <div class="card-body">
                                <div id="c3chart_donut"></div>
                            </div>
                        </div>
                    </div>


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
                            <h5 class="card-header" id="test_graphic">

                                {{--<div>--}}
                                    {{--<a id="a-make" href="#">Make a screenshot</a>--}}
                                    {{--<a id="a-download" href="#" style="display:none;">Download a screenshot</a>--}}
                                {{--</div>--}}

                                {{--<div id="main">--}}
                                    {{--<div id="screenshot">--}}
                                        {{--<h3>title</h3>--}}
                                        {{--<img src="{{ asset("public/admin/assets/images/trash.jpg") }}" alt="" style="max-width:20px; max-height:20px">--}}
                                    {{--</div>--}}
                                {{--</div>--}}


                                {{--<form method="POST" enctype="multipart/form-data" action="/save" id="myForm">--}}
                                    {{--<input type="hidden" name="img_val" id="img_val" value="" />--}}
                                {{--</form>--}}

                                {{--<div id="more">--}}
                                    {{--<h1> hello </h1>--}}
                                    {{--<button onclick="take()"> take </button>--}}
                                {{--</div>--}}


                            </h5>
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
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

    <script>
        // window.take = function() {
        //     html2canvas(document.getElementById("more"), {
        //         onrendered: function (canvas) {
        //             document.getElementById('img_val').value = canvas.toDataURL("image/png");
        //             document.getElementById("myForm").submit();
        //         }
        //     })
        // }
        //
        //
        // function makeScreenshot()
        // {
        //     html2canvas(document.getElementById("screenshot"), {scale: 2}).then(canvas =>
        //     {
        //         canvas.id = "canvasID";
        //         var main = document.getElementById("main");
        //         while (main.firstChild) { main.removeChild(main.firstChild); }
        //         main.appendChild(canvas);
        //     });
        // }
        //
        // document.getElementById("a-make").addEventListener('click', function()
        // {
        //     document.getElementById("a-make").style.display = "none";
        //     makeScreenshot();
        //     document.getElementById("a-download").style.display = "inline";
        // }, false);
        //
        // document.getElementById("a-download").addEventListener('click', function()
        // {
        //     this.href = document.getElementById("canvasID").toDataURL();
        //     this.download = "canvas-image.png";
        // }, false);
    </script>
@endsection
