@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

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
                                        <select name="status_id" class="form-control" readonly="readonly">
                                            @forelse($statuses as $status)
                                                <option <?php if($status->id == $order->status->id) echo "selected"; ?> value="{{$status->id}}">{{$status->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Сумма заказа</label>
                                        <input id="inputText3" name="sum" type="text" class="form-control" value="{{ $order->sum }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Клиент:</label>
                                        <input id="inputText3" name="client_id" type="hidden" class="form-control" value="{{ $order->client_id }}">
                                        <a href="{{ route("admin-clients-show", ["id" => $order->client->id]) }}" style="color:blue">{{ $order->client->name . " " . $order->client->last_name }}</a>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Телефон клиента</label>
                                        <input id="inputText3" name="phone" type="text" class="form-control" value="{{ $order->client->phone }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Почта клиента</label>
                                        <input id="inputText3" name="email" type="text" class="form-control" value="{{ $order->client->email }}" readonly="readonly">
                                    </div>
                                    <h4>Способ оплаты</h4>
                                    <div class="form-group">
                                        <select name="payment_type_id" class="form-control" readonly="readonly">
                                            @forelse($payment_types as $type)
                                                <option <?php if($type->id == $order->payment_type->id) echo "selected"; ?> value="{{$type->id}}">{{$type->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <h4>Способ доставки</h4>
                                    <div class="form-group">
                                        <select name="delivery_type_id" class="form-control" readonly="readonly">
                                            @forelse($delivery_types as $type)
                                                <option <?php if($type->id == $order->delivery_type->id) echo "selected"; ?> value="{{$type->id}}">{{$type->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Город доставки</label>
                                        <input id="inputText3" name="city" type="text" class="form-control" value="{{ $order->city }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Отделение Новой Почты</label>
                                        <input id="inputText3" name="warehouse" type="text" class="form-control" value="{{ $order->warehouse }}" readonly="readonly">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="order-products">

                            <div class="table-responsive">
                                <table id="example4" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Товар</th>
                                        <th>Количество</th>
                                        <th>Цена</th>
                                        <th>Общая сумма</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($order->products as $orderProduct)
                                        <tr>
                                            <td>
                                                <a href="{{ route("admin-products-show", ['id' => $orderProduct->id]) }}">
                                                    {{ $orderProduct->product->name }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $orderProduct->quantity }}
                                            </td>
                                            <td>
                                                {{ $orderProduct->product_price }}
                                            </td>
                                            <td>
                                                {{ $orderProduct->sum }}
                                            </td>
                                        </tr>
                                    @empty
                                        <p>Товаров нет</p>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            <br>
            <button class="btn btn-danger push-to-telegram" type="submit" data-id="{{ $order->id }}" data-link="{{ $url }}" data-token="{{ csrf_token() }}">Push to Telegram</button>

        </div>

    </div>
@endsection

@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/orders/main.js") }}"></script>
@endsection