@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Элементы сайта</h2>
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
                                <h5 class="mb-0">Список всех элементов сайта</h5>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                <a href="{{ route("admin-site-elements-create") }}">
                                    <button class="btn btn-primary" type="submit">ДОБАВИТЬ ЭЛЕМЕНТ</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @if ($siteElements->currentPage() != 1)
                                    <li class="page-item"><a class="page-link" href="{{ $siteElements->url(1) }}">1</a></li>
                                @endif
                                @if ($siteElements->currentPage() > 2)
                                    <li class="page-item"><a class="page-link" href="{{ $siteElements->previousPageUrl() }}"><<</a></li>
                                @endif
                                <li class="page-item active"><a class="page-link " href="">{{ $siteElements->currentPage() }}</a></li>
                                @if ($siteElements->currentPage() < $siteElements->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $siteElements->nextPageUrl() }}">>></a></li>
                                @endif
                                @if ($siteElements->currentPage() + 1 < $siteElements->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $siteElements->url($siteElements->lastPage()) }}">{{ $siteElements->lastPage() }}</a></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Ключ</th>
                                    <th>Значение</th>
                                    <th>Тип</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($siteElements as $siteElement)
                                    <tr>
                                        <td>
                                            <a href="{{ route("admin-site-elements-show", ['id' => $siteElement->id]) }}">
                                                {{ $siteElement->key }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $siteElement->value }}
                                        </td>
                                        <td>
                                            {{ $siteElement->type }}
                                        </td>
                                        <td>
                                            <a href="{{ route("admin-site-elements-edit", ['id' => $siteElement->id]) }}">
                                                <img src="{{ asset("public/admin/assets/images/pencil.png") }}" alt="" style="max-width:20px; max-height:20px">
                                            </a>
                                            <a href="{{ route("admin-site-elements-delete", ['id' => $siteElement->id]) }}">
                                                <img src="{{ asset("public/admin/assets/images/trash.jpg") }}" alt="" style="max-width:20px; max-height:20px">
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <p>Элементов нет</p>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Ключ</th>
                                    <th>Значение</th>
                                    <th>Тип</th>
                                    <th>Действия</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @if ($siteElements->currentPage() != 1)
                                    <li class="page-item"><a class="page-link" href="{{ $siteElements->url(1) }}">1</a></li>
                                @endif
                                @if ($siteElements->currentPage() > 2)
                                    <li class="page-item"><a class="page-link" href="{{ $siteElements->previousPageUrl() }}"><<</a></li>
                                @endif
                                <li class="page-item active"><a class="page-link " href="">{{ $siteElements->currentPage() }}</a></li>
                                @if ($siteElements->currentPage() < $siteElements->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $siteElements->nextPageUrl() }}">>></a></li>
                                @endif
                                @if ($siteElements->currentPage() + 1 < $siteElements->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $siteElements->url($siteElements->lastPage()) }}">{{ $siteElements->lastPage() }}</a></li>
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