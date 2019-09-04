@extends('layouts.main')

@section('content')

    <div class="container-fluid  dashboard-content">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5" id="product-card-container">

            <div class="section-block">
                <h1 class="section-title">
                    {{ $product->name }}
                    <button data-id="{{ $product->id }}" class="btn btn-primary add-to-basket">Купить</button>
                </h1>
                {{--<p>Takes the basic nav from above and adds the .nav-tabs class to generate a tabbed interface..</p>--}}
            </div>

            <div class="tab-outline">
                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-outline-one" data-toggle="tab" href="#outline-one" role="tab" aria-controls="home" aria-selected="true">Основные характеристики</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-outline-two" data-toggle="tab" href="#outline-two" role="tab" aria-controls="profile" aria-selected="false">Описание</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-outline-three" data-toggle="tab" href="#outline-three" role="tab" aria-controls="contact" aria-selected="false">Картинки</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-outline-four" data-toggle="tab" href="#outline-four" role="tab" aria-controls="profile" aria-selected="false">Доп. Свойства</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent2">
                    <div class="tab-pane fade show active" id="outline-one" role="tabpanel" aria-labelledby="tab-outline-one">

                        <div class="card">
                            <!--<h5 class="card-header"></h5>-->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputText3" class="col-form-label">Название товара</label>
                                    <input id="inputText3" name="name" type="text" class="form-control" value="{{ $product->name }}" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label for="inputText3" class="col-form-label">Цена</label>
                                    <input id="inputText3" name="base_price" type="number" class="form-control" value="{{ $product->base_price }}" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label for="inputText3" class="col-form-label">Количество на складе</label>
                                    <input id="inputText3" name="quantity" type="number" class="form-control" value="{{ $product->quantity }}" readonly="readonly">
                                </div>
                                <h4>Категория</h4>
                                <div class="form-group">
                                    <input id="inputText3" name="category" type="text" class="form-control" value="{{ $product->category->name }}" readonly="readonly">
                                </div>
                                <h4>Модель</h4>
                                <div class="form-group">
                                    <input id="inputText3" name="model_group" type="text" class="form-control" value="{{ $product->group->name }}" readonly="readonly">
                                </div>
                                <h4>Статус</h4>
                                <div class="form-group">
                                    <input id="inputText3" name="status" type="text" class="form-control" value="{{ $product->status->name }}" readonly="readonly">
                                </div>
                                <h4>Цвет</h4>
                                <div class="form-group">
                                    <input id="inputText3" name="color" type="text" class="form-control" value="{{ $product->color->name }}" readonly="readonly">
                                </div>
                                <h4>Размер</h4>
                                <div class="form-group">
                                    <input id="inputText3" name="size" type="text" class="form-control" value="{{ $product->size->name }}" readonly="readonly">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="outline-two" role="tabpanel" aria-labelledby="tab-outline-two">
                        <form>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Описание товара</label>
                                <textarea name="description" readonly="readonly" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $product->description }}</textarea>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="outline-three" role="tabpanel" aria-labelledby="tab-outline-three">
                        <table>
                            <tr>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h3>Фото</h3>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            <hr>
                            @forelse($product->images as $image)
                                <tr>
                                    <div class="form-group product-image">
                                        <div class="row">
                                            <input type="hidden" name="oldImages[]" value="{{ $image->id }}">
                                            <div class="col-md-10 col-md-offset-1">
                                                <img src="{{ asset("storage/app/{$image->url}") }}" alt="User Avatar" class=" img-fluid">
                                                {{--<input type="file" name="images[]" class="custom-file-input" id="customFile" style="opacity:1!important;">--}}
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </tr>
                            @empty
                                <h3></h3>
                            @endforelse
                        </table>
                    </div>
                    <div class="tab-pane fade" id="outline-four" role="tabpanel" aria-labelledby="tab-outline-four">
                        @forelse($product->properties as $property)
                            <div class="form-group">
                                <label for="inputText3" class="col-form-label">{{ $property->name }}</label>
                                <input id="inputText3" name="name" type="text" class="form-control" value="{{ $property->pivot->value }}" readonly="readonly">
                            </div>
                        @empty
                            <h3></h3>
                        @endforelse
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
