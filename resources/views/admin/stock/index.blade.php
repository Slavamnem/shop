@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h1 class="pageheader-title">Склад</h1>
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
                    </div>
                    <div class="card-body stock-main-block">
                        <div class="table-responsive">
                            @foreach($categories as $category)
                                <div class="stock-cat-block">
                                    <div class="cat_border">
                                        <h1 align="center">{{$category->name}}</h1>
                                    </div>
                                    <div class="row">
                                        @foreach($category->products as $product)
                                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                                <div class="card">
                                                    @if(!empty($product->mainImage->url))
                                                        <img class="card-img-top stock-img img-fluid" src="{{ @asset("storage/app/{$product->mainImage->url}") }}" alt="Card image cap">
                                                    @else
                                                        <img class="card-img-top stock-img img-fluid" src="{{ @asset("storage/app/default-image.jpg") }}" alt="Card image cap">
                                                    @endif
                                                    <div class="card-body">
                                                        <h3 class="card-title">{{ $product->name }}</h3>
                                                        <p class="card-text">Количество: {{ $product->quantity }}</p>
                                                        <a href="{{ route('admin-products-show', ['id' => $product->id]) }}" class="btn btn-primary">Открыть товар</a>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 stock-product-card">--}}
                                                {{--<div class="card card-figure">--}}
                                                    {{--<figure class="figure">--}}
                                                        {{--<h4 align="center">{{ $product->name }}</h4>--}}
                                                        {{--<img src="{{ @asset("storage/app/{$product->mainImage->url}") }}" alt="User Avatar" class=" img-fluid stock-image">--}}
                                                        {{--<figcaption class="figure-caption">--}}
                                                            {{--<h4 align="center">Количество: <input type="number" data-product="{{ $product->id }}" class="stock-quantity" value="{{ $product->quantity }}"></h4>--}}
                                                        {{--</figcaption>--}}
                                                    {{--</figure>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        @endforeach
                                    </div>
                                    <br><br>
                                </div>
                            @endforeach
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

@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/stock/main.js") }}"></script>
@endsection