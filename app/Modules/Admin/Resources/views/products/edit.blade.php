@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

            <form method="POST" action="{{ route("admin-products-update", ['id' => $product->id]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="section-block">
                    <h1 class="section-title">
                        {{ $product->name }}
                        <button class="btn btn-primary" type="submit">СОХРАНИТЬ ТОВАР</button>
                    </h1>
                    <p>Takes the basic nav from above and adds the .nav-tabs class to generate a tabbed interface..</p>
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
                        <li class="nav-item">
                            <a class="nav-link" id="tab-outline-five" data-toggle="tab" href="#outline-five" role="tab" aria-controls="contact" aria-selected="false">Демо</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="outline-one" role="tabpanel" aria-labelledby="tab-outline-one">

                            <div class="card">
                                <!--<h5 class="card-header"></h5>-->
                                <div class="card-body">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">Название товара</label>
                                            <input id="name" name="name" type="text" class="form-control" value="{{ $product->name }}">
                                        </div>
                                        @if($errors->has("name"))
                                            <span class="help-block" style="color:red">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                        <div class="form-group">
                                            <label for="slug" class="col-form-label">Slug (имя на английском в строке браузера)</label>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input id="slug" name="slug" type="text" class="form-control" value="{{ $product->slug }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-primary generate-slug" type="button">Сгенерировать slug</button>
                                                </div>
                                            </div>
                                        </div>
                                        @if($errors->has("slug"))
                                            <span class="help-block" style="color:red">
                                                <strong>{{ $errors->first('slug') }}</strong>
                                            </span>
                                        @endif
                                        <div class="form-group">
                                            <label for="inputText3" class="col-form-label">Цена</label>
                                            <input id="inputText3" name="base_price" type="number" class="form-control" value="{{ $product->base_price }}">
                                        </div>
                                        @if($errors->has("base_price"))
                                            <span class="help-block" style="color:red">
                                                <strong>{{ $errors->first('base_price') }}</strong>
                                            </span>
                                        @endif
                                        <div class="form-group">
                                            <label for="inputText3" class="col-form-label">Количество</label>
                                            <input id="inputText3" name="quantity" type="number" class="form-control" value="{{ $product->quantity }}">
                                        </div>
                                        @if($errors->has("quantity"))
                                            <span class="help-block" style="color:red">
                                                <strong>{{ $errors->first('quantity') }}</strong>
                                            </span>
                                        @endif
                                        <h4>Категория</h4>
                                        <div class="form-group">
                                            <select name="category_id" class="form-control">
                                                @forelse($categories as $category)
                                                    <option <?php if($category->id == $product->category->id) echo "selected"; ?> value="{{$category->id}}">{{$category->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                        @if($errors->has("category_id"))
                                            <span class="help-block" style="color:red">
                                                <strong>{{ $errors->first('category_id') }}</strong>
                                            </span>
                                        @endif
                                        <h4>Группа</h4>
                                        <div class="form-group">
                                            <select name="group_id" class="form-control">
                                                @forelse($groups as $group)
                                                    <option <?php if($group->id == $product->group->id) echo "selected"; ?> value="{{$group->id}}">{{$group->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                        @if($errors->has("group_id"))
                                            <span class="help-block" style="color:red">
                                                <strong>{{ $errors->first('group_id') }}</strong>
                                            </span>
                                        @endif
                                        <h4>Статус</h4>
                                        <div class="form-group">
                                            <select name="status_id" class="form-control">
                                                @forelse($statuses as $status)
                                                    <option <?php if($status->id == $product->status->id) echo "selected"; ?> value="{{$status->id}}">{{$status->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                        @if($errors->has("status_id"))
                                            <span class="help-block" style="color:red">
                                                <strong>{{ $errors->first('status_id') }}</strong>
                                            </span>
                                        @endif
                                        <h4>Цвет</h4>
                                        <div class="form-group">
                                            <select name="color_id" class="form-control">
                                                @forelse($colors as $color)
                                                    <option <?php if($color->id == $product->color->id) echo "selected"; ?> value="{{$color->id}}">{{$color->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                        <h4>Размер</h4>
                                        <div class="form-group">
                                            <select name="size_id" class="form-control">
                                                @forelse($sizes as $size)
                                                    <option <?php if($size->id == $product->size->id) echo "selected"; ?> value="{{$size->id}}">{{$size->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="outline-two" role="tabpanel" aria-labelledby="tab-outline-two">
                            <form>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Описание товара</label>
                                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $product->description }}</textarea>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="outline-three" role="tabpanel" aria-labelledby="tab-outline-three">
                            {{--<h4>Основное изображение</h4>--}}
                            {{--<div class="custom-file mb-3">--}}
                                {{--<input type="file" name="image" class="custom-file-input" id="customFile">--}}
                                {{--<label class="custom-file-label" for="customFile">Загрузить</label>--}}
                            {{--</div>--}}
                            {{--@if($product->image)--}}
                                {{--<div class="card-body text-center">--}}
                                    {{--<img src="{{ asset("storage/app/{$product->image}") }}" alt="User Avatar" class=" img-fluid product-image">--}}
                                {{--</div>--}}
                            {{--@endif--}}
                            {{--<h4>Маленькое изображение</h4>--}}
                            {{--<div class="custom-file mb-3">--}}
                                {{--<input type="file" name="small_image" class="custom-file-input" id="customFile">--}}
                                {{--<label class="custom-file-label" for="customFile">Загрузить</label>--}}
                            {{--</div>--}}
                            {{--@if($product->small_image)--}}
                                {{--<div class="card-body text-center">--}}
                                    {{--<img src="{{ asset("storage/app/{$product->small_image}") }}" alt="User Avatar" class=" img-fluid product-image">--}}
                                {{--</div>--}}
                            {{--@endif--}}

                            <table>
                                <tr>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h3>Фото</h3>
                                            </div>
                                            <div class="col-md-2">
                                                <h3>Основное</h3>
                                            </div>
                                            <div class="col-md-2">
                                                <h3>Превью</h3>
                                            </div>
                                            <div class="col-md-2">
                                                <h3>Сортировка</h3>
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
                                            <div class="col-md-4">
                                                <img src="{{ asset("storage/app/{$image->url}") }}" alt="User Avatar" class=" img-fluid">
                                                {{--<input type="file" name="images[]" class="custom-file-input" id="customFile" style="opacity:1!important;">--}}
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" name="oldImagesMain[{{$image->id}}]" value="1" class="generator" id="switch19" @if($image->main) {{ "checked" }} @endif>
                                                <span>
                                                     <label for="switch19"></label>
                                                </span>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" name="oldImagesPreview[{{$image->id}}]" value="1" class="generator" id="switch19" @if($image->preview) {{ "checked" }} @endif>
                                                <span>
                                                     <label for="switch19"></label>
                                                </span>
                                            </div>
                                            <div class="col-md-2">
                                                <input id="inputText4" name="oldImagesOrdering[{{$image->id}}]" type="number" class="form-control" value="{{ $image->ordering }}">
                                            </div>
                                            <div class="col-md-1">
                                                <button class="btn btn-danger delete-image" type="button">Удалить</button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </tr>
                                @empty
                                    <h3></h3>
                                @endforelse
                                <div id="new-images"></div>
                            </table>
                            <button class="btn btn-success add-new-image" type="button" data-token="{{ csrf_token() }}">Добавить изображение</button>

                        </div>
                        <div class="tab-pane fade" id="outline-four" role="tabpanel" aria-labelledby="tab-outline-four">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3>Название</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>Значение</h3>
                                    </div>
                                    <div class="col-md-2">
                                        <h3>Сортировка</h3>
                                    </div>
                                </div>
                            </div>
                            @forelse($product->propertyValues as $propertyValue)
                                <div class="form-group product-property">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select name="properties[]" class="form-control">
                                                @forelse($properties as $propertyItem)
                                                    <option <?php if($propertyValue->property_id == $propertyItem->id) echo "selected"; ?> value="{{$propertyItem->id}}">{{$propertyItem->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                        <h2>=</h2>
                                        <div class="col-md-4">
                                            <select name="properties_values[]" class="form-control">
                                                @foreach($propertyValue->property->values as $propertyVal)
                                                    <option <?php if($propertyValue->id == $propertyVal->id) echo "selected"; ?> value="{{$propertyVal->id}}">{{$propertyVal->value}}</option>
                                                @endforeach
                                            </select>
                                            {{--<input id="inputText3" name="properties_values[]" type="text" class="form-control" value="{{ $propertyValue->value }}">--}}
                                        </div>
                                        <div class="col-md-2">
                                            <input id="inputText4" name="properties_ordering[]" type="number" class="form-control" value="{{ $propertyValue->pivot->ordering }}">
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-danger delete-property" type="button">Удалить</button>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            @empty
                                <h3></h3>
                            @endforelse
                            <div id="new-properties"></div>
                            <button class="btn btn-success add-new-property" type="button" data-token="{{ csrf_token() }}">Добавить свойство</button>
                        </div>
                        <div class="tab-pane fade" id="outline-five" role="tabpanel" aria-labelledby="tab-outline-five">
                            В разработке
                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>
@endsection

@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/products/main.js") }}"></script>
@endsection

@section("custom-css")
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/css/main.css") }}">
@endsection