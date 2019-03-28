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
                                        <label for="inputText3" class="col-form-label">Телефон клиента</label>
                                        <input id="inputText3" name="phone" type="text" class="form-control" value="{{ $order->phone }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Почта клиента</label>
                                        <input id="inputText3" name="email" type="text" class="form-control" value="{{ $order->email }}" readonly="readonly">
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
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            <button class="btn btn-danger push-to-telegram" type="submit" data-id="{{ $order->id }}" data-link="{{ $url }}" data-token="{{ csrf_token() }}">Push to Telegram</button>

        </div>

    </div>
@endsection

@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/orders/main.js") }}"></script>
@endsection