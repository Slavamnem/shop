@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Категории</h2>
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
                                <h5 class="mb-0">Список всех категорий</h5>
                                <p>Вся основная информация по категориям</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                <a href="{{ route("admin-categories-create") }}">
                                    <button class="btn btn-primary" type="submit">ДОБАВИТЬ КАТЕГОРИЮ</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @if ($categories->currentPage() != 1)
                                    <li class="page-item"><a class="page-link" href="{{ $categories->url(1) }}">1</a></li>
                                @endif
                                @if ($categories->currentPage() > 2)
                                    <li class="page-item"><a class="page-link" href="{{ $categories->previousPageUrl() }}"><<</a></li>
                                @endif
                                <li class="page-item active"><a class="page-link " href="">{{ $categories->currentPage() }}</a></li>
                                @if ($categories->currentPage() < $categories->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $categories->nextPageUrl() }}">>></a></li>
                                @endif
                                @if ($categories->currentPage() + 1 < $categories->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $categories->url($categories->lastPage()) }}">{{ $categories->lastPage() }}</a></li>
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
                                    <th>Slug</th>
                                    <th>Сортировка</th>
                                    <th>Действия</th>
                                </tr>
                                <tr>
                                    <th><input type="text" class="admin-filter-input" data-name="name"></th>
                                    <th><input type="text" class="admin-filter-input" data-name="slug"></th>
                                    <th><input type="text" class="admin-filter-input" data-name="ordering"></th>
                                </tr>
                                </thead>
                                <tbody class="tbody">
                                @forelse($categories as $category)
                                    <tr>
                                        <td>
                                            <a href="{{ route("admin-categories-show", ['id' => $category->id]) }}">
                                                {{ $category->name }}
                                            </a>
                                        </td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->ordering }}</td>
                                        <td>
                                            <a href="{{ route("admin-categories-edit", ['id' => $category->id]) }}" class="btn btn-sm btn-outline-light">
                                                Edit
                                            </a>
                                            <a href="{{ route("admin-categories-delete", ['id' => $category->id]) }}" class="btn btn-sm btn-outline-light">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <p>Категорий нет</p>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Название</th>
                                    <th>Slug</th>
                                    <th>Сортировка</th>
                                    <th>Действия</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @if ($categories->currentPage() != 1)
                                    <li class="page-item"><a class="page-link" href="{{ $categories->url(1) }}">1</a></li>
                                @endif
                                @if ($categories->currentPage() > 2)
                                    <li class="page-item"><a class="page-link" href="{{ $categories->previousPageUrl() }}"><<</a></li>
                                @endif
                                <li class="page-item active"><a class="page-link " href="">{{ $categories->currentPage() }}</a></li>
                                @if ($categories->currentPage() < $categories->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $categories->nextPageUrl() }}">>></a></li>
                                @endif
                                @if ($categories->currentPage() + 1 < $categories->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $categories->url($categories->lastPage()) }}">{{ $categories->lastPage() }}</a></li>
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
    <script src="{{ asset("public/admin/assets/js/categories/index.js") }}"></script>
@endsection