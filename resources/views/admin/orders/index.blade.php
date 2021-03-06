@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Заказы</h2>
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


        @if(Auth::user()->can("watch", [new \App\Order()]))
            <div class="row">
                <!-- ============================================================== -->
                <!-- fixed header  -->
                <!-- ============================================================== -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9">
                                    <h5 class="mb-0">Список всех заказов</h5>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                    <a href="{{ route("admin-orders-create") }}">
                                        <button class="btn btn-primary" type="submit">ДОБАВИТЬ ЗАКАЗ</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <br>
                        @if($orders->total() > $orders->perPage())
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        @if ($orders->currentPage() != 1)
                                            <li class="page-item"><a class="page-link" href="{{ $orders->url(1) }}">1</a></li>
                                        @endif
                                        @if ($orders->currentPage() > 2)
                                            <li class="page-item"><a class="page-link" href="{{ $orders->previousPageUrl() }}"><<</a></li>
                                        @endif
                                        <li class="page-item active"><a class="page-link " href="">{{ $orders->currentPage() }}</a></li>
                                        @if ($orders->currentPage() < $orders->lastPage())
                                            <li class="page-item"><a class="page-link" href="{{ $orders->nextPageUrl() }}">>></a></li>
                                        @endif
                                        @if ($orders->currentPage() + 1 < $orders->lastPage())
                                            <li class="page-item"><a class="page-link" href="{{ $orders->url($orders->lastPage()) }}">{{ $orders->lastPage() }}</a></li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example4" class="table table-bordered" style="width:100%">
                                    {{-- table-striped--}}
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Статус</th>
                                        <th>Сумма</th>
                                        <th>Телефон</th>
                                        <th>Почта</th>
                                        <th>Способ оплаты</th>
                                        <th>Способ доставки</th>
                                        <th>Время создания</th>
                                        <th>Действия</th>
                                    </tr>
                                    <tr>
                                        <th><input type="text" class="admin-filter-input" data-table="orders" data-name="id"></th>
                                        <th><input type="text" class="admin-filter-input" data-table="orders" data-name="status-id"></th>
                                        <th><input type="text" class="admin-filter-input" data-table="orders" data-name="sum"></th>
                                        <th>
                                            {{--<input type="text" class="admin-filter-input" data-table="orders" data-name="phone">--}}
                                        </th>
                                        <th>
                                            {{--<input type="text" class="admin-filter-input" data-table="orders" data-name="email">--}}
                                        </th>
                                        <th><input type="text" class="admin-filter-input" data-table="orders" data-name="payment_type_id"></th>
                                        <th><input type="text" class="admin-filter-input" data-table="orders" data-name="delivery_type_id"></th>
                                    </tr>
                                    </thead>
                                    <tbody class="tbody">
                                    @forelse($orders as $order)
                                        <tr class="{{ $order->getStatusClass() }}">
                                            <td>
                                                <a href="{{ route("admin-orders-show", ['id' => $order->id]) }}">
                                                    {{ $order->id }}
                                                </a>
                                            </td>
                                            <td>
                                               {{ $order->status->name }}
                                            </td>
                                            <td>
                                                {{ $order->sum }}
                                            </td>
                                            <td>
                                                {{ $order->client->phone }}
                                            </td>
                                            <td>
                                                <a href="{{ route("admin-new-email", ['email' => $order->client->email]) }}">
                                                    {{ $order->client->email }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $order->payment_type->name }}
                                            </td>
                                            <td>
                                                {{ $order->delivery_type->name }}
                                            </td>
                                            <td>
                                                {{ $order->created_at }}
                                            </td>
                                            <td>
                                                <a href="{{ route("admin-orders-edit", ['id' => $order->id]) }}">
                                                    <img src="{{ asset("public/admin/assets/images/pencil.png") }}" alt="" style="max-width:15px; max-height:20px">
                                                </a>
                                                <a href="{{ route("admin-orders-show", ['id' => $order->id]) }}">
                                                    <img src="{{ asset("public/admin/assets/images/show.jpg") }}" alt="" style="max-width:15px; max-height:20px">
                                                </a>
                                                <a href="{{ route("admin-orders-delete", ['id' => $order->id]) }}">
                                                    <img src="{{ asset("public/admin/assets/images/trash.jpg") }}" alt="" style="max-width:15px; max-height:20px">
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <p>Заказов нет</p>
                                    @endforelse
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Статус</th>
                                        <th>Сумма</th>
                                        <th>Телефон</th>
                                        <th>Почта</th>
                                        <th>Способ оплаты</th>
                                        <th>Способ доставки</th>
                                        <th>Время создания</th>
                                        <th>Действия</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        @if($orders->total() > $orders->perPage())
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        @if ($orders->currentPage() != 1)
                                            <li class="page-item"><a class="page-link" href="{{ $orders->url(1) }}">1</a></li>
                                        @endif
                                        @if ($orders->currentPage() > 2)
                                            <li class="page-item"><a class="page-link" href="{{ $orders->previousPageUrl() }}"><<</a></li>
                                        @endif
                                        <li class="page-item active"><a class="page-link " href="">{{ $orders->currentPage() }}</a></li>
                                        @if ($orders->currentPage() < $orders->lastPage())
                                            <li class="page-item"><a class="page-link" href="{{ $orders->nextPageUrl() }}">>></a></li>
                                        @endif
                                        @if ($orders->currentPage() + 1 < $orders->lastPage())
                                            <li class="page-item"><a class="page-link" href="{{ $orders->url($orders->lastPage()) }}">{{ $orders->lastPage() }}</a></li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end fixed header  -->
                <!-- ============================================================== -->
            </div>
        @else
            @include("access_denied", ["message" => "Недостаточно прав для просмотра заказов"])
        @endif
    </div>
@endsection

@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/orders/main.js") }}"></script>
@endsection