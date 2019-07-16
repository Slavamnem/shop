@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

                <div class="section-block">
                    <h1 class="section-title">
                        {{ $client->name . " " . $client->last_name }}
                    </h1>
                    <p>Takes the basic nav from above and adds the .nav-tabs class to generate a tabbed interface..</p>
                </div>

                <div class="tab-outline">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-outline-one" data-toggle="tab" href="#outline-one" role="tab" aria-controls="home" aria-selected="true">Основная инфа</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-outline-two" data-toggle="tab" href="#outline-two" role="tab" aria-controls="profile" aria-selected="false">Заказы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-outline-three" data-toggle="tab" href="#outline-three" role="tab" aria-controls="contact" aria-selected="false">Обращения</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="outline-one" role="tabpanel" aria-labelledby="tab-outline-one">

                            <div class="card">
                                <!--<h5 class="card-header"></h5>-->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Имя</label>
                                        <input id="inputText3" name="name" type="text" class="form-control" value="{{ $client->name }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Фамилия</label>
                                        <input id="inputText3" name="last_name" type="text" class="form-control" value="{{ $client->last_name }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Телефон</label>
                                        <input id="inputText3" name="phone" type="text" class="form-control" value="{{ $client->phone }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Почта</label>
                                        <input id="inputText3" name="email" type="text" class="form-control" value="{{ $client->email }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Рейтинг</label>
                                        <input id="inputText3" name="rating" type="text" class="form-control" value="{{ $client->rating }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Общая прибыль</label>
                                        <input id="inputText3" name="rating" type="text" class="form-control" value="{{ $client->orders->sum('sum') }}" readonly="readonly">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="outline-two" role="tabpanel" aria-labelledby="tab-outline-two">
                            <div class="table-responsive">
                                <table id="example4" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Номер заказа</th>
                                        <th>Статус</th>
                                        <th>Сумма</th>
                                        <th>Время создания</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($client->orders->sortByDesc('created_at')->sortByDesc('id') as $order)
                                        <tr>
                                            <td>
                                                <a href="{{ route("admin-orders-show", ['id' => $order->id]) }}">
                                                    {{ '#' . $order->id}}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $order->status->name }}
                                            </td>
                                            <td>
                                                {{ $order->sum }}
                                            </td>
                                            <td>
                                                {{ $order->created_at }}
                                            </td>
                                        </tr>
                                    @empty
                                        <p>Товаров нет</p>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="outline-three" role="tabpanel" aria-labelledby="tab-outline-three">
                            В разработке
                        </div>
                    </div>
                </div>

        </div>

    </div>
@endsection