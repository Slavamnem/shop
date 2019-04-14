@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

            <form method="POST" action="{{ route("admin-shares-store") }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="section-block">
                    <h1 class="section-title">
                        Новая акция
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
                                        <label for="name" class="col-form-label">Название акции</label>
                                        <input id="name" name="name" type="text" class="form-control" value="">
                                    </div>
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
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Описание акции</label>
                                        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Фиксированная цена</label>
                                        <input id="inputText3" name="fix_price" type="number" class="form-control" value="{{ old('fix_price') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Скидка</label>
                                        <input id="inputText3" name="discount" type="number" class="form-control" value="{{ old('discount') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Условия</label>

                                        <div id="new-conditions"></div>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button class="btn btn-success add-new-condition" type="button" data-type="and" data-token="{{ csrf_token() }}">Добавить условие 'И'</button>
                                            <button class="btn btn-primary add-new-condition" type="button" data-type="or" data-token="{{ csrf_token() }}">Добавить условие 'ИЛИ'</button>
                                        </div>
                                        {{--<button class="btn btn-success add-new-condition" type="button" data-token="{{ csrf_token() }}">Добавить условие</button>--}}
                                    </div>

                                    {{--<select id="demo" multiple="multiple">--}}
                                        {{--<option value="Javascript">Javascript</option>--}}
                                        {{--<option value="Python">Python</option>--}}
                                        {{--<option value="LISP">LISP</option>--}}
                                        {{--<option value="C++">C++</option>--}}
                                        {{--<option value="jQuery">jQuery</option>--}}
                                        {{--<option value="Ruby">Ruby</option>--}}
                                    {{--</select>--}}

                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Добавить акцию</button>

                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>
@endsection

@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/shares/main.js") }}"></script>
@endsection