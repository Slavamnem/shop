@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
            <div class="section-block">
                <h1 class="section-title">{{ $product->name }}</h1>
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
                </ul>
                <div class="tab-content" id="myTabContent2">
                    <div class="tab-pane fade show active" id="outline-one" role="tabpanel" aria-labelledby="tab-outline-one">

                        <div class="card">
                            <!--<h5 class="card-header"></h5>-->
                            <div class="card-body">
                                <form action="">
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Название товара</label>
                                        <input id="inputText3" type="text" class="form-control" value="{{ $product->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Slug (имя на английском в строке браузера)</label>
                                        <input id="inputText3" type="text" class="form-control" value="{{ $product->slug }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Цена</label>
                                        <input id="inputText3" type="number" class="form-control" value="{{ $product->base_price }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Количество</label>
                                        <input id="inputText3" type="number" class="form-control" value="{{ $product->quantity }}">
                                    </div>
                                    <h4>Категория</h4>
                                    <div class="form-group">
                                        <select class="form-control">
                                            @forelse($categories as $category)
                                                <option <?php if($category->id == $product->category->id) echo "selected"; ?> value="{{$category->id}}">{{$category->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <h4>Группа</h4>
                                    <div class="form-group">
                                        <select class="form-control">
                                            @forelse($groups as $group)
                                                <option <?php if($group->id == $product->group->id) echo "selected"; ?> value="{{$group->id}}">{{$group->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <h4>Статус</h4>
                                    <div class="form-group">
                                        <select class="form-control">
                                            @forelse($statuses as $status)
                                                <option <?php if($status->id == $product->status->id) echo "selected"; ?> value="{{$status->id}}">{{$status->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <h4>Цвет</h4>
                                    <div class="form-group">
                                        <select class="form-control">
                                            @forelse($colors as $color)
                                                <option <?php if($color->id == $product->color->id) echo "selected"; ?> value="{{$color->id}}">{{$color->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <h4>Размер</h4>
                                    <div class="form-group">
                                        <select class="form-control">
                                            @forelse($sizes as $size)
                                                <option <?php if($size->id == $product->size->id) echo "selected"; ?> value="{{$size->id}}">{{$size->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="outline-two" role="tabpanel" aria-labelledby="tab-outline-two">
                        <form>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Описание товара</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $product->description }}</textarea>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="outline-three" role="tabpanel" aria-labelledby="tab-outline-three">
                        <h3>Heading Title of Outline Tabs</h3>
                        <p>Vivamus pellentesque vestibulum lectus vitae auctor. Maecenas eu sodales arcu. Fusce lobortis, libero ac cursus feugiat, nibh ex ultricies tortor, id dictum massa nisl ac nisi. Fusce a eros pellentesque, ultricies urna nec, consectetur dolor. Nam dapibus scelerisque risus, a commodo mi tempus eu.</p>
                        <p>Maecenas eu sodales arcu. Fusce lobortis, libero ac cursus feugiat, nibh ex ultricies tortor, id dictum massa nisl ac nisi. Fusce a eros pellentesque, ultricies urna nec, consectetur dolor.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection