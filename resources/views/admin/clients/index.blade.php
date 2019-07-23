@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Клиенты</h2>
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
                                <h5 class="mb-0">Список всех клиентов</h5>
                                <p>Вся основная информация по клиентам</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                <a href="{{ route("admin-clients-create") }}">
                                    <button class="btn btn-primary" type="submit">ДОБАВИТЬ КЛИЕНТА</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="{{ $clients->previousPageUrl() }}">Previous</a></li>
                                <li class="page-item active"><a class="page-link " href="">{{ $clients->currentPage() }}</a></li>
                                <li class="page-item"><a class="page-link" href="{{ $clients->nextPageUrl() }}">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Имя</th>
                                    <th>Фамилия</th>
                                    <th>Телефон</th>
                                    <th>Почта</th>
                                    <th>Действия</th>
                                </tr>
                                <tr>
                                    <th><input type="text" class="admin-filter-input" data-table="clients" data-name="name"></th>
                                    <th><input type="text" class="admin-filter-input" data-table="clients" data-name="last_name"></th>
                                    <th><input type="text" class="admin-filter-input" data-table="clients" data-name="phone"></th>
                                    <th><input type="text" class="admin-filter-input" data-table="clients" data-name="email"></th>
                                </tr>
                                </thead>
                                <tbody class="tbody">
                                @forelse($clients as $client)
                                    <tr>
                                        <td>
                                            <a href="{{ route("admin-clients-show", ['id' => $client->id]) }}">
                                                {{ $client->name }}
                                            </a>
                                        </td>
                                        <td>{{ $client->last_name }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td>
                                            <a href="{{ route("admin-new-email", ['email' => $client->email]) }}">
                                                {{ $client->email }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route("admin-clients-edit", ['id' => $client->id]) }}">
                                                <img src="{{ asset("public/admin/assets/images/pencil.png") }}" alt="" style="max-width:20px; max-height:20px">
                                            </a>
                                            <a href="{{ route("admin-clients-delete", ['id' => $client->id]) }}">
                                                <img src="{{ asset("public/admin/assets/images/trash.jpg") }}" alt="" style="max-width:20px; max-height:20px">
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <p>Клиентов не найдено</p>
                                @endforelse

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Имя</th>
                                        <th>Фамилия</th>
                                        <th>Телефон</th>
                                        <th>Почта</th>
                                        <th>Действия</th>
                                    </tr>
                                </tfoot>
                                {{--<div> {{ $clients->links() }} </div>--}}
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="{{ $clients->previousPageUrl() }}">Previous</a></li>
                                <li class="page-item active"><a class="page-link " href="">{{ $clients->currentPage() }}</a></li>
                                <li class="page-item"><a class="page-link" href="{{ $clients->nextPageUrl() }}">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                {{--<a href="{{ route('save-products-as-xml') }}">--}}
                    {{--<button class="btn btn-danger save-products-as-xml" type="submit" data-token="{{ csrf_token() }}">Сохранить в Xml</button>--}}
                {{--</a>--}}
                {{--<button class="btn btn-success index-products" type="button" data-token="{{ csrf_token() }}">Индексировать все товары</button>--}}
            </div>

            <!-- ============================================================== -->
            <!-- end fixed header  -->
            <!-- ============================================================== -->
        </div>
    </div>
@endsection

@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/clients/main.js") }}"></script>
@endsection