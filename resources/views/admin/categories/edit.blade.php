@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

            <form method="POST" action="{{ route("admin-categories-update", ['id' => $category->id]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="section-block">
                    <h1 class="section-title">
                        {{ $category->name }}
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
                                        <label for="inputText3" class="col-form-label">Название категории</label>
                                        <input id="name" name="name" type="text" class="form-control" value="{{ $category->name }}">
                                    </div>
                                    @if($errors->has("name"))
                                        <span class="help-block" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Slug (имя на английском в строке браузера)</label>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <input id="slug" name="slug" type="text" class="form-control" value="{{ $category->slug }}">
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
                                        <label for="inputText3" class="col-form-label">Родительская категория</label>
                                        <select name="pid" class="form-control">
                                            <option value="">Выберите категорию</option>
                                            @forelse($categories as $cat)
                                                <option @if($category->pid == $cat->id) {{ 'selected' }} @endif value="{{$cat->id}}">{{$cat->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    @if($errors->has("pid"))
                                        <span class="help-block" style="color:red">
                                            <strong>{{ $errors->first('pid') }}</strong>
                                        </span>
                                    @endif
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Сортировка</label>
                                        <input id="inputText3" name="ordering" type="number" class="form-control" value="{{ $category->ordering }}">
                                    </div>
                                    @if($errors->has("ordering"))
                                        <span class="help-block" style="color:red">
                                            <strong>{{ $errors->first('ordering') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Сохранить категорию</button>

                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>
@endsection

@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/categories/index.js") }}"></script>
@endsection