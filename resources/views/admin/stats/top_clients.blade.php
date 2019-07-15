@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid dashboard-content">


        <div class="row">
            <!-- ============================================================== -->
            <!-- top selling products  -->
            <!-- ============================================================== -->
            <div class="col-xl-11 col-xl-offset-1 col-lg-11 col-lg-offset-1 col-md-11 col-md-offset-1 col-sm-12 col-12">
                <div class="card">
                    <h1>Топ клиентов</h1>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">Рейтинг</th>
                                    <th class="border-0">Имя</th>
                                    <th class="border-0">Фамилия</th>
                                    <th class="border-0">Телефон</th>
                                    <th class="border-0">Почта</th>
                                    <th class="border-0">Прибыль</th>
                                </tr>
                                </thead>
                                <tbody id="top-products-list">
                                @foreach($clients as $number => $client)
                                    <tr>
                                        <td>{{ $number + 1 }}</td>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->last_name }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->orders->sum('sum') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/stats/main.js") }}"></script>
@endsection
