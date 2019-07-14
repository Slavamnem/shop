@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">


        <div class="row">
            <!-- ============================================================== -->
            <!-- top selling products  -->
            <!-- ============================================================== -->
            <div class="col-xl-10 col-xl-offset-1 col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Топ продаваемых товаров</h5>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">#</th>
                                    <th class="border-0">Фото</th>
                                    <th class="border-0">Название</th>
                                    <th class="border-0">Продано</th>
                                    <th class="border-0">Цена</th>
                                    <th class="border-0">Общая прибыль</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            {{--<div class="m-r-10"><img src="{{ @asset("storage/app/{$product->mainImage->url}") }}" alt="user" class="rounded" width="45"></div>--}}
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->base_price }}</td>
                                        <td>{{ $product->total_sum }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="8"><a href="#" class="btn btn-outline-light float-right">View Details</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection