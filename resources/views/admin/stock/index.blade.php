@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Склад</h2>
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


        <div class="row">
            <!-- ============================================================== -->
            <!-- fixed header  -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header stock-main-block">
                        {{--<div class="row">--}}
                            {{--<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9">--}}
                                {{--<h5 class="mb-0">Склад</h5>--}}
                            {{--</div>--}}
                            {{--<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">--}}
                                {{--<a href="{{ route("admin-groups-create") }}">--}}
                                    {{--<button class="btn btn-primary" type="submit">ДОБАВИТЬ ГРУППУ</button>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="card-body stock-main-block">
                        <div class="table-responsive">
                            @foreach($categories as $category)
                                <h1 align="center">{{$category->name}}</h1>
                                <div>
                                    @foreach($category->products as $product)
                                        <h3>Название: {{ $product->name }}</h3>
                                        <h3>Количество: <input type="number" class="stock-quantity" value="{{ $product->quantity }}"></h3>
                                        <img src="{{ asset("storage/app/{$product->mainImage->url}") }}" alt="User Avatar" class=" img-fluid stock-image">
                                        <br><br><br>
                                    @endforeach
                                </div>
                                <hr class="stock-cat-delimiter">
                            @endforeach
                            {{--<table id="example4" class="table table-striped table-bordered" style="width:100%">--}}
                                {{--<thead>--}}
                                {{--<tr>--}}
                                    {{--<th>Название</th>--}}
                                    {{--<th>Действия</th>--}}
                                {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tbody>--}}
                                {{--@forelse($groups as $group)--}}
                                    {{--<tr>--}}
                                        {{--<td>--}}
                                            {{--<a href="{{ route("admin-groups-show", ['id' => $group->id]) }}">--}}
                                                {{--{{ $group->name }}--}}
                                            {{--</a>--}}
                                        {{--</td>--}}
                                        {{--<td>--}}
                                            {{--<a href="{{ route("admin-groups-edit", ['id' => $group->id]) }}">--}}
                                                {{--<img src="{{ asset("public/admin/assets/images/pencil.png") }}" alt="" style="max-width:20px; max-height:20px">--}}
                                            {{--</a>--}}
                                            {{--<a href="{{ route("admin-groups-delete", ['id' => $group->id]) }}">--}}
                                                {{--<img src="{{ asset("public/admin/assets/images/trash.jpg") }}" alt="" style="max-width:20px; max-height:20px">--}}
                                            {{--</a>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                {{--@empty--}}
                                    {{--<p>Групп нет</p>--}}
                                {{--@endforelse--}}
                                {{--</tbody>--}}
                                {{--<tfoot>--}}
                                {{--<tr>--}}
                                    {{--<th>Название</th>--}}
                                    {{--<th>Действия</th>--}}
                                {{--</tr>--}}
                                {{--</tfoot>--}}
                            {{--</table>--}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end fixed header  -->
            <!-- ============================================================== -->
        </div>
    </div>
@endsection