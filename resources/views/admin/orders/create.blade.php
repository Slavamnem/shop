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
                        <div class="col-md-7">

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

                                                    {{--<input id="order-new-product" name="name" type="text" class="form-control" value="">--}}
                                                    {{--<div id="order-new-products"></div>--}}

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

                                        <div class="block">
                                            <h3>Контактные данные</h3>
                                            <hr>
                                            <div class="form-group">
                                                <label for="name" class="col-form-label">Ваше имя:</label>
                                                <input id="order_client_name" name="name" type="text" class="form-control" value="{{ old("name") }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-form-label">Фамилия:</label>
                                                <input id="order_client_last_name" name="last_name" type="text" class="form-control" value="{{ old("last_name") }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-form-label">Телефон:</label>
                                                <input id="order_client_phone" name="phone" type="text" class="form-control" value="{{ old("phone") }}">
                                            </div>
                                            @if($errors->has("phone"))
                                                <span class="help-block" style="color:red">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif

                                            <div class="form-group">
                                                <label for="name" class="col-form-label">Адрес электронной почты:</label>
                                                <input id="order_client_email" name="email" type="text" class="form-control" value="{{ old("email") }}">
                                            </div>
                                        </div>

                                        <br><hr><br>

                                        <div class="block">

                                            <h3>Доставка и оплата</h3>
                                            <hr>

                                            <div class="form-group">
                                                <label for="name" class="col-form-label">Город:</label>
                                                <select name="city" class="form-control" id="order-city">
                                                    <option value="">Выберите город</option>
                                                    @forelse($cities as $city)
                                                        <option value="{{$city->ref}}">{{$city->name}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                            @if($errors->has("city"))
                                                <span class="help-block" style="color:red">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                            @endif

                                            <div class="form-group">
                                                <label for="name" class="col-form-label">Тип доставки:</label>
                                                <select name="delivery_type" class="form-control" id="order-delivery-type">
                                                    <option value="">Выберите тип доставки</option>
                                                    @forelse($delivery_types as $type)
                                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                            @if($errors->has("delivery_type"))
                                                <span class="help-block" style="color:red">
                                                    <strong>{{ $errors->first('delivery_type') }}</strong>
                                                </span>
                                            @endif

                                            <div class="form-group warehouses"></div>

                                            <div class="form-group">
                                                <label for="name" class="col-form-label">Тип оплаты:</label>
                                                <select name="payment_type" class="form-control" id="new-product">
                                                    <option value="">Выберите тип оплаты</option>
                                                    @forelse($payment_types as $type)
                                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                            @if($errors->has("payment_type"))
                                                <span class="help-block" style="color:red">
                                                    <strong>{{ $errors->first('payment_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <br>
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">Комментарий:</label><br>
                                            <textarea name="description" id="description" cols="40" rows="10">{{ old("description") }}</textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Добавить заказ</button>

                        </div>
                        <div class="col-md-5">
                            <h3>Корзина <button class="btn btn-danger remove-basket" type="button">Удалить</button></h3>
                            <table id="basket" class="table table-striped table-bordered" style="width:100%">
                                @include('admin.orders.basket')
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