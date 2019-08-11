@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Команды</h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tables</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <!-- ============================================================== -->
            <!-- fixed header  -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9">
                                <h5 class="mb-0">Выполнение команд</h5>
                            </div>
                            {{--<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">--}}
                                {{--<a href="{{ route("admin-commands") }}">--}}
                                    {{--<button class="btn btn-primary" type="submit">ДОБАВИТЬ ЦВЕТ</button>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="inputText3" class="col-form-label">Введите название...</label>
                            <div class="row">
                                <div class="col-md-9">
                                    <input id="search_command" type="text" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-success save-products-as-xml" id="execute-command" type="submit" data-token="{{ csrf_token() }}"> Запуск </button>
                                </div>
                            </div>
                        </div>

                        <div id="filtered_commands" class="table-responsive"></div>

                        <br><br>
                        <div class="command-worksheet"></div>

                        <div id="loader" style="display: none">
                            <br>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4 col-md-offset-4 col-lg-offset-4 col-sm-offset-4">
                                    <h3>Запуск команды...</h3>
                                    <span class="dashboard-spinner spinner-primary spinner-xxl"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">--}}
                        {{--<nav aria-label="Page navigation example">--}}
                            {{--<ul class="pagination">--}}
                                {{--<li class="page-item"><a class="page-link" href="{{ $colors->previousPageUrl() }}">Previous</a></li>--}}
                                {{--<li class="page-item active"><a class="page-link " href="">{{ $colors->currentPage() }}</a></li>--}}
                                {{--<li class="page-item"><a class="page-link" href="{{ $colors->nextPageUrl() }}">Next</a></li>--}}
                            {{--</ul>--}}
                        {{--</nav>--}}
                    {{--</div>--}}
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end fixed header  -->
            <!-- ============================================================== -->

            <div class="dropdown-menu dropdown-menu-right modal" id="command-modal"></div>

        </div>
    </div>
@endsection

@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/commands/index.js") }}"></script>
@endsection