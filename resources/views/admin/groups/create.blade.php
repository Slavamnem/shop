@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

            <form method="POST" action="{{ route("admin-groups-store") }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="section-block">
                    <h1 class="section-title">
                        Новая группа товаров
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
                                        <input id="inputText3" name="name" type="text" class="form-control" value="">
                                    </div>
                                    @if($errors->has("name"))
                                        <span class="help-block" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
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

                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Создать все вариации товаров</label>
                                        <div class="col-12 col-sm-8 col-lg-6 pt-1">
                                            <div class="switch-button switch-button-yesno">
                                                <input type="checkbox" name="generator" class="generator" id="switch19">
                                                <span>
                                                     <label for="switch19"></label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="variations"></div>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Добавить группу</button>

                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>
@endsection

@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/groups/main.js") }}"></script>
@endsection