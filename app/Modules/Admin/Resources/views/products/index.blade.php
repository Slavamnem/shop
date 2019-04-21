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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Название</th>
                                    {{--<th>Slug</th>--}}
                                    <th>Цена</th>
                                    <th>Количество</th>
                                    <th>Категория</th>
                                    <th>Группа</th>
                                    <th>Статус</th>
                                    <th>Цвет</th>
                                    <th>Размер</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($products as $product)
                                    <tr>
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
                                        <th>Название</th>
                                        {{--<th>Slug</th>--}}
                                        <th>Цена</th>
                                        <th>Количество</th>
                                        <th>Категория</th>
                                        <th>Группа</th>
                                        <th>Статус</th>
                                        <th>Цвет</th>
                                        <th>Размер</th>
                                        <th>Действия</th>
                                    </tr>
                                </tfoot>
                                <div> {{ $products->links() }} </div>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="{{ route('save-products-as-xml') }}">
                    <button class="btn btn-danger save-products-as-xml" type="submit" data-token="{{ csrf_token() }}">Сохранить в Xml</button>
                </a>
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