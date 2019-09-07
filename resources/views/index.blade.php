@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-md-offset-0">
                        <div class="panel panel-default">
                            <h3 class="panel-heading" align="center">Фильтр</h3>


                            <form id="facet-form">
                                <div class="panel-body">
                                    <div class="card">
                                        <h5 class="card-header">Цена</h5>
                                        <div class="card-body">
                                            <span>От: </span><input type="text" class="price facet-form-trigger form-control" id="minPrice" name="minPrice">
                                            <span>До: </span><input type="text" class="price facet-form-trigger form-control" id="maxPrice" name="maxPrice">
                                        </div>
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
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-md-offset-0">
                        <div class="panel panel-default" id="total-products-block">
                            <h2 class="panel-heading" align="center">Товары</h2>
                            <div class="panel-body" id="products-block"></div>
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
    <script src="{{ asset("public/site/js/catalog_products.js") }}"></script>
@endsection
