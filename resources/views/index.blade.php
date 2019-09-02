@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-md-offset-0">
                        <div class="panel panel-default">
                            <h3 class="panel-heading" align="center">Фильтр</h3>

                            <div class="panel-body">
                                <div class="card">
                                    <h5 class="card-header">Категории</h5>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach($categories as $category)
                                                @include('site.facet_categories', ['category' => $category, 'level' => 0])
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                {{--<div class="card">--}}
                                    {{--<h5 class="card-header">Свойства</h5>--}}
                                    {{--<div class="card-body">--}}
                                        {{--<ul class="list-group">--}}
                                            {{--<li class="list-group-item d-flex justify-content-between align-items-center">--}}
                                                {{--Cras justo odio--}}
                                                {{--<span class="badge badge-primary badge-pill">14</span>--}}
                                            {{--</li>--}}
                                            {{--<li class="list-group-item d-flex justify-content-between align-items-center">--}}
                                                {{--Dapibus ac facilisis in--}}
                                                {{--<span class="badge badge-primary badge-pill">2</span>--}}
                                            {{--</li>--}}
                                            {{--<li class="list-group-item d-flex justify-content-between align-items-center">--}}
                                                {{--Morbi leo risus--}}
                                                {{--<span class="badge badge-primary badge-pill">1</span>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-md-offset-0">
                        <div class="panel panel-default">
                            <h2 class="panel-heading" align="center">Товары</h2>

                            <div class="panel-body" id="products-block">
                                @foreach($categories as $category)
                                    @if(count($category->products))
                                    <div class="stock-cat-block">
                                        <div class="cat_border">
                                            <h2 align="center">{{$category->name}}</h2>
                                        </div>
                                        <div class="row">
                                            @foreach($category->products as $product)
                                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="card">
                                                        <a href="{{ route('admin-products-show', ['id' => $product->id]) }}" class="">
                                                            @if(!empty($product->mainImage->url))
                                                                <img class="card-img-top stock-img img-fluid" src="{{ @asset("storage/app/{$product->mainImage->url}") }}" alt="Card image cap">
                                                            @else
                                                                <img class="card-img-top stock-img img-fluid" src="{{ @asset("storage/app/default-image.jpg") }}" alt="Card image cap">
                                                            @endif
                                                        </a>
                                                        <div class="card-body">
                                                            <h3 class="card-title">{{ $product->name }}</h3>
                                                            <p class="card-text">Количество: {{ $product->quantity }}</p>
                                                            <button data-id="{{ $product->id }}" class="btn btn-primary add-to-basket">Купить</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <br><br>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dropdown-menu dropdown-menu-right modal" id="basket"></div>

@endsection

@section("custom-js")
    <script src="{{ asset("public/site/js/order.js") }}"></script>
@endsection
