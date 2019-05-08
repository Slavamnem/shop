@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

            <form method="POST" action="{{ route("admin-products-store") }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="section-block">
                    <h1 class="section-title">
                        <button class="btn btn-primary" type="submit">ДОБАВИТЬ ТОВАР</button>
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
                                        <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}">
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
                                                <input id="slug" name="slug" type="text" class="form-control" value="{{ old('slug') }}">
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
                                        <input id="inputText3" name="base_price" type="number" class="form-control" value="{{ old('base_price') }}">
                                    </div>
                                    @if($errors->has("base_price"))
                                        <span class="help-block" style="color:red">
                                            <strong>{{ $errors->first('base_price') }}</strong>
                                        </span>
                                    @endif
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Количество</label>
                                        <input id="inputText3" name="quantity" type="number" class="form-control" value="{{ old('quantity') }}">
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
                                                <option value="{{$category->id}}">{{$category->name}}</option>
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
                                                <option value="{{$group->id}}">{{$group->name}}</option>
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
                                                <option value="{{$status->id}}">{{$status->name}}</option>
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
                                                <option value="{{$color->id}}">{{$color->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    @if($errors->has("color_id"))
                                        <span class="help-block" style="color:red">
                                            <strong>{{ $errors->first('color_id') }}</strong>
                                        </span>
                                    @endif
                                    <h4>Размер</h4>
                                    <div class="form-group">
                                        <select name="size_id" class="form-control">
                                            @forelse($sizes as $size)
                                                <option value="{{$size->id}}">{{$size->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    @if($errors->has("size_id"))
                                        <span class="help-block" style="color:red">
                                            <strong>{{ $errors->first('size_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="outline-two" role="tabpanel" aria-labelledby="tab-outline-two">
                            <form>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Описание товара</label>
                                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('description') }}</textarea>
                                </div>
                                @if($errors->has("description"))
                                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
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