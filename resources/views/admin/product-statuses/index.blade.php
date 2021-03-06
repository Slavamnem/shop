@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Статусы товаров</h2>
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
                                <h5 class="mb-0">Список всех статусов</h5>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                <a href="{{ route("admin-product-statuses-create") }}">
                                    <button class="btn btn-primary" type="submit">ДОБАВИТЬ СТАТУС</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @if ($statuses->currentPage() != 1)
                                    <li class="page-item"><a class="page-link" href="{{ $statuses->url(1) }}">1</a></li>
                                @endif
                                @if ($statuses->currentPage() > 2)
                                    <li class="page-item"><a class="page-link" href="{{ $statuses->previousPageUrl() }}"><<</a></li>
                                @endif
                                <li class="page-item active"><a class="page-link " href="">{{ $statuses->currentPage() }}</a></li>
                                @if ($statuses->currentPage() < $statuses->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $statuses->nextPageUrl() }}">>></a></li>
                                @endif
                                @if ($statuses->currentPage() + 1 < $statuses->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $statuses->url($statuses->lastPage()) }}">{{ $statuses->lastPage() }}</a></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($statuses as $status)
                                    <tr>
                                        <td>
                                            <a href="{{ route("admin-product-statuses-show", ['id' => $status->id]) }}">
                                                {{ $status->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route("admin-product-statuses-edit", ['id' => $status->id]) }}">
                                                <img src="{{ asset("public/admin/assets/images/pencil.png") }}" alt="" style="max-width:20px; max-height:20px">
                                            </a>
                                            <a href="{{ route("admin-product-statuses-delete", ['id' => $status->id]) }}">
                                                <img src="{{ asset("public/admin/assets/images/trash.jpg") }}" alt="" style="max-width:20px; max-height:20px">
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <p>Статусов нет</p>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Название</th>
                                    <th>Действия</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @if ($statuses->currentPage() != 1)
                                    <li class="page-item"><a class="page-link" href="{{ $statuses->url(1) }}">1</a></li>
                                @endif
                                @if ($statuses->currentPage() > 2)
                                    <li class="page-item"><a class="page-link" href="{{ $statuses->previousPageUrl() }}"><<</a></li>
                                @endif
                                <li class="page-item active"><a class="page-link " href="">{{ $statuses->currentPage() }}</a></li>
                                @if ($statuses->currentPage() < $statuses->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $statuses->nextPageUrl() }}">>></a></li>
                                @endif
                                @if ($statuses->currentPage() + 1 < $statuses->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $statuses->url($statuses->lastPage()) }}">{{ $statuses->lastPage() }}</a></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end fixed header  -->
            <!-- ============================================================== -->
        </div>
    </div>
@endsection