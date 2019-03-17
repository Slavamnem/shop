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
                        <h5 class="mb-0">Список всех товаров  </h5>
                        <p>Вся основная информация по товарам</p>
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
                                        <td>{{ $product->name }}</td>
                                        {{--<td>{{ $product->slug }}</td>--}}
                                        <td>{{ $product->base_price }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->group->name }}</td>
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end fixed header  -->
            <!-- ============================================================== -->
        </div>
    </div>
@endsection