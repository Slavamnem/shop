@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

                <div class="section-block">
                    <h1 class="section-title">
                        {{ $product->name }}
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
                                        <label for="inputText3" class="col-form-label">Название товара</label>
                                        <input id="inputText3" name="name" type="text" class="form-control" value="{{ $product->name }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Slug (имя на английском в строке браузера)</label>
                                        <input id="inputText3" name="slug" type="text" class="form-control" value="{{ $product->slug }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Цена</label>
                                        <input id="inputText3" name="base_price" type="number" class="form-control" value="{{ $product->base_price }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Количество</label>
                                        <input id="inputText3" name="quantity" type="number" class="form-control" value="{{ $product->quantity }}" readonly="readonly">
                                    </div>
                                    <h4>Категория</h4>
                                    <div class="form-group">
                                        <select name="category_id" class="form-control" readonly="readonly">
                                            @forelse($categories as $category)
                                                <option <?php if($category->id == $product->category->id) echo "selected"; ?> value="{{$category->id}}">{{$category->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <h4>Группа</h4>
                                    <div class="form-group">
                                        <select name="group_id" class="form-control" readonly="readonly">
                                            @forelse($groups as $group)
                                                <option <?php if($group->id == $product->group->id) echo "selected"; ?> value="{{$group->id}}">{{$group->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <h4>Статус</h4>
                                    <div class="form-group">
                                        <select name="status_id" class="form-control" readonly="readonly">
                                            @forelse($statuses as $status)
                                                <option <?php if($status->id == $product->status->id) echo "selected"; ?> value="{{$status->id}}">{{$status->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <h4>Цвет</h4>
                                    <div class="form-group">
                                        <select name="color_id" class="form-control" readonly="readonly">
                                            @forelse($colors as $color)
                                                <option <?php if($color->id == $product->color->id) echo "selected"; ?> value="{{$color->id}}">{{$color->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <h4>Размер</h4>
                                    <div class="form-group">
                                        <select name="size_id" class="form-control" readonly="readonly">
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
                                    <textarea name="description" readonly="readonly" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $product->description }}</textarea>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="outline-three" role="tabpanel" aria-labelledby="tab-outline-three">
                            <h4>Основное изображение</h4>
                            @if($product->image)
                                <div class="card-body text-center">
                                    <img src="{{ asset("storage/app/{$product->image}") }}" alt="User Avatar" class=" img-fluid">
                                </div>
                            @endif
                            <h4>Маленькое изображение</h4>
                            @if($product->small_image)
                                <div class="card-body text-center">
                                    <img src="{{ asset("storage/app/{$product->small_image}") }}" alt="User Avatar" class=" img-fluid">
                                </div>
                            @endif
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
                        <div class="tab-pane fade" id="outline-five" role="tabpanel" aria-labelledby="tab-outline-five">
                            2
                        </div>
                    </div>
                </div>

        </div>

    </div>
@endsection