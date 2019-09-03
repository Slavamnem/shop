@extends('layouts.main')

@section('content')
    <div class="container" style="background-color: grey">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default" style="background-color: grey">

                    <br>
                    <h2 align="center">Оформление заказа</h2>

                    <div id="basket" style="margin-top:0px !important;">
                        {!! $basket !!}
                    </div>
                    {{--@include('site.order.basket', ['basketProduct' => $basketProducts])--}}

                    <form method="POST" action="{{ route('checkout-create-order') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
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

                        <button class="btn btn-primary" type="submit">Добавить заказ</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section("custom-js")
    <script src="{{ asset("public/site/js/order.js") }}"></script>
@endsection