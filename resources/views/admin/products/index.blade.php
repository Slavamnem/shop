@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Товары</h2>
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
                                <h5 class="mb-0">Список всех товаров</h5>
                                <p>Вся основная информация по товарам</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                <a href="{{ route("admin-products-create") }}">
                                    <button class="btn btn-primary" type="submit">ДОБАВИТЬ ТОВАР</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    @if($products->total() > $products->perPage())
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    @if ($products->currentPage() != 1)
                                        <li class="page-item"><a class="page-link" href="{{ $products->url(1) }}">1</a></li>
                                    @endif
                                    @if ($products->currentPage() > 2)
                                        <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}"><<</a></li>
                                    @endif
                                    <li class="page-item active"><a class="page-link " href="">{{ $products->currentPage() }}</a></li>
                                    @if ($products->currentPage() < $products->lastPage())
                                        <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}">>></a></li>
                                    @endif
                                    @if ($products->currentPage() + 1 < $products->lastPage())
                                        <li class="page-item"><a class="page-link" href="{{ $products->url($products->lastPage()) }}">{{ $products->lastPage() }}</a></li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Название</th>
                                    <th>Цена</th>
                                    <th>Количество</th>
                                    <th>Категория</th>
                                    <th>Модель</th>
                                    <th>Статус</th>
                                    <th>Цвет</th>
                                    <th>Размер</th>
                                    <th>Действия</th>
                                </tr>
                                <tr>
                                    <th><input type="text" class="admin-filter-input" data-table="products" data-name="name"></th>
                                    <th><input type="text" class="admin-filter-input" data-table="products" data-name="base_price"></th>
                                    <th><input type="text" class="admin-filter-input" data-table="products" data-name="quantity"></th>
                                    <th><input type="text" class="admin-filter-input" data-table="products" data-name="category_id"></th>
                                    <th><input type="text" class="admin-filter-input" data-table="products" data-name="group_id"></th>
                                    <th><input type="text" class="admin-filter-input" data-table="products" data-name="status_id"></th>
                                    <th><input type="text" class="admin-filter-input" data-table="products" data-name="color_id"></th>
                                    <th><input type="text" class="admin-filter-input" data-table="products" data-name="size_id"></th>
                                </tr>
                                </thead>
                                <tbody class="tbody">
                                @forelse($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            <a href="{{ route("admin-products-show", ['id' => $product->id]) }}">
                                                {{ $product->name }}
                                            </a>
                                        </td>
                                        <td>{{ $product->base_price }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>
                                            <a href="{{ route("admin-categories-show", ['id' => $product->category->id]) }}">
                                                {{ $product->category->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route("admin-groups-show", ['id' => $product->group->id]) }}">
                                                {{ $product->group->name }}
                                            </a>
                                        </td>
                                        <td>{{ $product->status->name }}</td>
                                        <td>{{ $product->color->name }}</td>
                                        <td>{{ $product->size->name }}</td>
                                        <td>
                                            <a href="{{ route("admin-products-edit", ['id' => $product->id]) }}">
                                                <img src="{{ asset("public/admin/assets/images/pencil.png") }}" alt="" style="max-width:20px; max-height:20px">
                                            </a>
                                            <a href="{{ route("admin-products-delete", ['id' => $product->id]) }}">
                                                <img src="{{ asset("public/admin/assets/images/trash.jpg") }}" alt="" style="max-width:20px; max-height:20px">
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <p>Товаров нет</p>
                                @endforelse

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Название</th>
                                        {{--<th>Slug</th>--}}
                                        <th>Цена</th>
                                        <th>Количество</th>
                                        <th>Категория</th>
                                        <th>Модель</th>
                                        <th>Статус</th>
                                        <th>Цвет</th>
                                        <th>Размер</th>
                                        <th>Действия</th>
                                    </tr>
                                </tfoot>
                                {{--<div>{{ $products->links() }}</div>--}}
                                {{--<div>{{ $products->nextPageUrl() }}</div>--}}
                            </table>
                        </div>
                    </div>

                    @if($products->total() > $products->perPage())
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    @if ($products->currentPage() != 1)
                                        <li class="page-item"><a class="page-link" href="{{ $products->url(1) }}">1</a></li>
                                    @endif
                                    @if ($products->currentPage() > 2)
                                        <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}"><<</a></li>
                                    @endif
                                    <li class="page-item active"><a class="page-link " href="">{{ $products->currentPage() }}</a></li>
                                    @if ($products->currentPage() < $products->lastPage())
                                        <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}">>></a></li>
                                    @endif
                                    @if ($products->currentPage() + 1 < $products->lastPage())
                                        <li class="page-item"><a class="page-link" href="{{ $products->url($products->lastPage()) }}">{{ $products->lastPage() }}</a></li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif

                </div>
                <a href="{{ route('save-products-as-xml') }}">
                    <button class="btn btn-danger save-products-as-xml" type="submit" data-token="{{ csrf_token() }}">Сохранить в Xml</button>
                </a>
                <a href="{{ route('save-products-as-txt') }}">
                    <button class="btn btn-warning save-products-as-xml" type="submit" data-token="{{ csrf_token() }}">Сохранить в Txt</button>
                </a>
                <button class="btn btn-success index-products" type="button" data-token="{{ csrf_token() }}">Индексировать все товары</button>
            </div>

            <!-- ============================================================== -->
            <!-- end fixed header  -->
            <!-- ============================================================== -->
        </div>
    </div>
@endsection

@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/products/main.js") }}"></script>
@endsection