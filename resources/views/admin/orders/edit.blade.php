@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

            <form method="POST" action="{{ route("admin-orders-update", ['id' => $order->id]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="section-block">
                    <h1 class="section-title">
                        Заказ №{{$order->id }}
                    </h1>
                    <p>Takes the basic nav from above and adds the .nav-tabs class to generate a tabbed interface..</p>
                </div>

                <div class="tab-outline">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-outline-one" data-toggle="tab" href="#outline-one" role="tab" aria-controls="home" aria-selected="true">Основные характеристики</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="outline-one" role="tabpanel" aria-labelledby="tab-outline-one">

                            <div class="card">
                                <div class="card-body">
                                    <h4>Статус заказа</h4>
                                    <div class="form-group">
                                        <select name="status_id" class="form-control">
                                            @forelse($statuses as $status)
                                                <option <?php if($status->id == $order->status->id) echo "selected"; ?> value="{{$status->id}}">{{$status->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Сумма заказа</label>
                                        <input id="inputText3" name="sum" type="text" class="form-control" value="{{ $order->sum }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Клиент:</label>
                                        <input id="inputText3" name="client_id" type="hidden" class="form-control" value="{{ $order->client_id }}">
                                        <a href="{{ route("admin-clients-show", ["id" => $order->client->id]) }}" style="color:blue">{{ $order->client->name . " " . $order->client->last_name }}</a>
                                    </div>
                                    @if($errors->has("sum"))
                                        <span class="help-block" style="color:red">
                                            <strong>{{ $errors->first('sum') }}</strong>
                                        </span>
                                    @endif
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Телефон клиента</label>
                                        <input id="inputText3" name="phone" type="text" class="form-control" value="{{ $order->client->phone }}">
                                    </div>
                                    @if($errors->has("phone"))
                                        <span class="help-block" style="color:red">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Почта клиента</label>
                                        <input id="inputText3" name="email" type="text" class="form-control" value="{{ $order->client->email }}">
                                    </div>
                                    <h4>Способ оплаты</h4>
                                    <div class="form-group">
                                        <select name="payment_type_id" class="form-control">
                                            @forelse($payment_types as $type)
                                                <option <?php if($type->id == $order->payment_type->id) echo "selected"; ?> value="{{$type->id}}">{{$type->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <h4>Способ доставки</h4>
                                    <div class="form-group">
                                        <select name="delivery_type_id" class="form-control">
                                            @forelse($delivery_types as $type)
                                                <option <?php if($type->id == $order->delivery_type->id) echo "selected"; ?> value="{{$type->id}}">{{$type->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Город доставки</label>
                                        <input id="inputText3" name="city" type="text" class="form-control" value="{{ $order->city }}">
                                    </div>
                                    @if($errors->has("city"))
                                        <span class="help-block" style="color:red">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Отделение Новой Почты</label>
                                        <input id="inputText3" name="warehouse" type="text" class="form-control" value="{{ $order->warehouse }}">
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Сохранить заказ</button>

                        </div>
                    </div>
                </div>

            </form>

            {{--<form method="POST" action="{{ route("admin-orders-push-to-telegram", ['id' => $order->id]) }}">--}}
                {{--{{ csrf_field() }}--}}
                <button class="btn btn-danger push-to-telegram" type="submit" data-id="{{ $order->id }}" data-link="{{ $url }}" data-token="{{ csrf_token() }}">Push to Telegram</button>
            {{--</form>--}}

        </div>

    </div>
@endsection

@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/orders/main.js") }}"></script>
@endsection