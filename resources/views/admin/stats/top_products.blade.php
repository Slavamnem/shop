@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid dashboard-content">


        <div class="row">
            <!-- ============================================================== -->
            <!-- top selling products  -->
            <!-- ============================================================== -->
            <div class="col-xl-10 col-xl-offset-1 col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-12">
                <div class="card">

                    <div class="form-group row">
                        <label class="col-12 col-sm-8 col-md-7 col-lg-7 col-form-label text-md-left">
                            <h2>Топ продаваемых товаров <span style="font-size: 20px; margin-left:50px;">(По общей прибыли)</span></h2>
                        </label>
                        <div class="col-12 col-sm-4 col-lg-4 pt-1">
                            <div class="switch-button switch-button-yesno">
                                <input type="checkbox" name="active" class="generator stats-sort-button" id="switch19" value="1">
                                <span>
                                    <label for="switch19"></label>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">Id</th>
                                    <th class="border-0">Фото</th>
                                    <th class="border-0">Название</th>
                                    <th class="border-0">Продано</th>
                                    <th class="border-0">Цена</th>
                                    <th class="border-0">Общая прибыль</th>
                                </tr>
                                </thead>
                                <tbody id="top-products-list">
                                    @foreach($products as $number => $product)
                                        <tr>
                                            <td>{{ $number + 1 }}</td>
                                            <td>
                                                @if($product->mainImage)
                                                    <div class="m-r-10"><img src="{{ @asset("storage/app/{$product->mainImage->url}") }}" alt="user" class="rounded" width="45"></div>
                                                @else
                                                    <div class="m-r-10"><img src="{{ @asset("storage/app/default-image.jpg") }}" alt="user" class="rounded" width="45"></div>
                                                @endif
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ $product->base_price }}</td>
                                            <td>{{ $product->profit }}</td>
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
