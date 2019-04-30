@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

            <form method="POST" action="{{ route("admin-orders-store") }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="section-block">
                    <h1 class="section-title">
                        Новый заказ
                    </h1>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="tab-outline">
                                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab-outline-one" data-toggle="tab" href="#outline-one" role="tab" aria-controls="home" aria-selected="true">Выбор товаров</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab-outline-two" data-toggle="tab" href="#outline-two" role="tab" aria-controls="home" aria-selected="false">Заполнение данных</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade show active" id="outline-one" role="tabpanel" aria-labelledby="tab-outline-one">

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="name" class="col-form-label">Название товара</label>
                                                    {{--<input id="inputText3" name="name" type="text" class="form-control" value="">--}}
                                                    <select name="productId" class="form-control" id="new-product">
                                                        @forelse($products as $product)
                                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                    <br>
                                                    <button class="btn btn-primary add-product-to-basket" type="button">Добавить в корзину</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade show" id="outline-two" role="tabpanel" aria-labelledby="tab-outline-one">

                                        <p>!!!!</p>

                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Добавить заказ</button>

                        </div>
                        <div class="col-md-6">
                            <h3>Корзина</h3>
                            <table id="basket" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Название товара</th>
                                    <th>Цена</th>
                                    <th>Количество</th>
                                    <th>Сумма</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4">
                                            <p align="center">Корзина пуста</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </form>

        </div>

    </div>
@endsection


@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/orders/main.js") }}"></script>
@endsection