@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

                <div class="section-block">
                    <h1 class="section-title">
                        Группа товаров: {{ $group->name }}
                    </h1>
                    <p>Takes the basic nav from above and adds the .nav-tabs class to generate a tabbed interface..</p>
                </div>

                <div class="tab-outline">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-outline-one" data-toggle="tab" href="#outline-one" role="tab" aria-controls="home" aria-selected="true">Основные характеристики</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="outline-one" role="tabpanel" aria-labelledby="tab-outline-one">

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Название группы товаров</label>
                                        <input id="inputText3" name="name" type="text" class="form-control" value="{{ $group->name }}" readonly="readonly">
                                    </div>

                                    <h4>Категория</h4>
                                    <div class="form-group">
                                        <select name="category_id" class="form-control" readonly="readonly">
                                            @forelse($categories as $category)
                                                <option <?php if($category->id == $group->category->id) echo "selected"; ?> value="{{$category->id}}">{{$category->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="model-group-products">

                            <div class="table-responsive">
                                <table id="example4" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Товар</th>
                                        <th>Цена</th>
                                        <th>Количество</th>
                                        <th>Статус</th>
                                        <th>Цвет</th>
                                        <th>Размер</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($group->products as $product)
                                        <tr>
                                            <td>
                                                <a href="{{ route("admin-products-show", ['id' => $product->id]) }}">
                                                    {{ $product->name }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $product->base_price }}
                                            </td>
                                            <td>
                                                {{ $product->quantity }}
                                            </td>
                                            <td>
                                                {{ $product->status->name }}
                                            </td>
                                            <td>
                                                {{ $product->color->name }}
                                            </td>
                                            <td>
                                                {{ $product->size->name }}
                                            </td>
                                        </tr>
                                    @empty
                                        <p>Товаров нет</p>
                                    @endforelse
                                    </tbody>
                                    <tr>
                                        <th>Товар</th>
                                        <th>Цена</th>
                                        <th>Количество</th>
                                        <th>Статус</th>
                                        <th>Цвет</th>
                                        <th>Размер</th>
                                    </tr>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>

        </div>

    </div>
@endsection