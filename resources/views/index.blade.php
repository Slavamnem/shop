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
                                                            <a href="{{ route('admin-products-show', ['id' => $product->id]) }}" class="btn btn-primary">Купить</a>
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

@endsection
