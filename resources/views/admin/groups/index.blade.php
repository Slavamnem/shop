@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Модели товаров</h2>
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
                                <h5 class="mb-0">Список всех моделей</h5>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                <a href="{{ route("admin-groups-create") }}">
                                    <button class="btn btn-primary" type="submit">ДОБАВИТЬ МОДЕЛЬ</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @if ($groups->currentPage() != 1)
                                    <li class="page-item"><a class="page-link" href="{{ $groups->url(1) }}">1</a></li>
                                @endif
                                @if ($groups->currentPage() > 2)
                                    <li class="page-item"><a class="page-link" href="{{ $groups->previousPageUrl() }}"><<</a></li>
                                @endif
                                <li class="page-item active"><a class="page-link " href="">{{ $groups->currentPage() }}</a></li>
                                @if ($groups->currentPage() < $groups->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $groups->nextPageUrl() }}">>></a></li>
                                @endif
                                @if ($groups->currentPage() + 1 < $groups->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $groups->url($groups->lastPage()) }}">{{ $groups->lastPage() }}</a></li>
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
                                <tr>
                                    <th><input type="text" class="admin-filter-input" data-name="name"></th>
                                </tr>
                                </thead>
                                <tbody class="tbody">
                                @forelse($groups as $group)
                                    <tr>
                                        <td>
                                            <a href="{{ route("admin-groups-show", ['id' => $group->id]) }}">
                                                {{ $group->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route("admin-groups-edit", ['id' => $group->id]) }}">
                                                <img src="{{ asset("public/admin/assets/images/pencil.png") }}" alt="" style="max-width:20px; max-height:20px">
                                            </a>
                                            <a href="{{ route("admin-groups-delete", ['id' => $group->id]) }}">
                                                <img src="{{ asset("public/admin/assets/images/trash.jpg") }}" alt="" style="max-width:20px; max-height:20px">
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <p>Групп нет</p>
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
                                @if ($groups->currentPage() != 1)
                                    <li class="page-item"><a class="page-link" href="{{ $groups->url(1) }}">1</a></li>
                                @endif
                                @if ($groups->currentPage() > 2)
                                    <li class="page-item"><a class="page-link" href="{{ $groups->previousPageUrl() }}"><<</a></li>
                                @endif
                                <li class="page-item active"><a class="page-link " href="">{{ $groups->currentPage() }}</a></li>
                                @if ($groups->currentPage() < $groups->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $groups->nextPageUrl() }}">>></a></li>
                                @endif
                                @if ($groups->currentPage() + 1 < $groups->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $groups->url($groups->lastPage()) }}">{{ $groups->lastPage() }}</a></li>
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

@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/groups/main.js") }}"></script>
@endsection