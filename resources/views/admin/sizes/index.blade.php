@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Размеры товаров</h2>
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
                                <h5 class="mb-0">Список всех групп</h5>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                <a href="{{ route("admin-sizes-create") }}">
                                    <button class="btn btn-primary" type="submit">ДОБАВИТЬ РАЗМЕР</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @if ($sizes->currentPage() != 1)
                                    <li class="page-item"><a class="page-link" href="{{ $sizes->url(1) }}">1</a></li>
                                @endif
                                @if ($sizes->currentPage() > 2)
                                    <li class="page-item"><a class="page-link" href="{{ $sizes->previousPageUrl() }}"><<</a></li>
                                @endif
                                <li class="page-item active"><a class="page-link " href="">{{ $sizes->currentPage() }}</a></li>
                                @if ($sizes->currentPage() < $sizes->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $sizes->nextPageUrl() }}">>></a></li>
                                @endif
                                @if ($sizes->currentPage() + 1 < $sizes->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $sizes->url($sizes->lastPage()) }}">{{ $sizes->lastPage() }}</a></li>
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
                                @forelse($sizes as $size)
                                    <tr>
                                        <td>
                                            <a href="{{ route("admin-sizes-show", ['id' => $size->id]) }}">
                                                {{ $size->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route("admin-sizes-edit", ['id' => $size->id]) }}">
                                                <img src="{{ asset("public/admin/assets/images/pencil.png") }}" alt="" style="max-width:20px; max-height:20px">
                                            </a>
                                            <a href="{{ route("admin-sizes-delete", ['id' => $size->id]) }}">
                                                <img src="{{ asset("public/admin/assets/images/trash.jpg") }}" alt="" style="max-width:20px; max-height:20px">
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <p>Размеров нет</p>
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
                                @if ($sizes->currentPage() != 1)
                                    <li class="page-item"><a class="page-link" href="{{ $sizes->url(1) }}">1</a></li>
                                @endif
                                @if ($sizes->currentPage() > 2)
                                    <li class="page-item"><a class="page-link" href="{{ $sizes->previousPageUrl() }}"><<</a></li>
                                @endif
                                <li class="page-item active"><a class="page-link " href="">{{ $sizes->currentPage() }}</a></li>
                                @if ($sizes->currentPage() < $sizes->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $sizes->nextPageUrl() }}">>></a></li>
                                @endif
                                @if ($sizes->currentPage() + 1 < $sizes->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $sizes->url($sizes->lastPage()) }}">{{ $sizes->lastPage() }}</a></li>
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