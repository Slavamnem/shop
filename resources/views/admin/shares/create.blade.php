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
                                        <label for="exampleFormControlTextarea1">Описание акции</label>
                                        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Фиксированная цена</label>
                                        <input id="inputText3" name="fix_price" type="number" class="form-control" value="{{ old('fix_price') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Скидка %</label>
                                        <input id="inputText3" name="discount" type="number" class="form-control" value="{{ old('discount') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Приоритет</label>
                                        <input id="inputText3" name="priority" type="number" class="form-control" value="{{ old('priority') }}">
                                    </div>

                                    <div class="form-group" style="border:2px solid grey; border-radius:10px; padding: 20px;">
                                        <label for="inputText3" class="col-form-label">Условия</label>

                                        <div id="conditions" data-amount="0"></div>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button class="btn btn-success add-new-condition" type="button" data-type="and" data-token="{{ csrf_token() }}">Добавить условие 'И'</button>
                                            <button class="btn btn-primary add-new-condition" type="button" data-type="or" data-token="{{ csrf_token() }}">Добавить условие 'ИЛИ'</button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Активна с:</label>
                                        <input class="date form-control datepicker" name="active_from" type="text" value="{{ old('active_from') }}">
                                    </div>
                                    @if($errors->has("active_from"))
                                        <span class="help-block" style="color:red">
                                            <strong>{{ $errors->first('active_from') }}</strong>
                                        </span>
                                    @endif

                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Активна до:</label>
                                        <input class="date form-control datepicker" name="active_to" type="text" value="{{ old('active_to') }}">
                                    </div>
                                    @if($errors->has("active_to"))
                                        <span class="help-block" style="color:red">
                                            <strong>{{ $errors->first('active_to') }}</strong>
                                        </span>
                                    @endif

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset("public/admin/assets/js/shares/main.js") }}"></script>
    <script>
        $(".datepicker").datepicker({
            format: "yyyy-mm-dd",
            weekStart: 0,
            calendarWeeks: true,
            autoclose: true,
            todayHighlight: true,
            //rtl: true,
            orientation: "auto"
        });
    </script>
@endsection