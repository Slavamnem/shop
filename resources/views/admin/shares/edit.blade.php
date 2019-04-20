@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

            <form method="POST" action="{{ route("admin-shares-update", ['id' => $share->id]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="section-block">
                    <h1 class="section-title">
                        {{ $share->name }}
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
                                        <label for="inputText3" class="col-form-label">Название акции</label>
                                        <input id="inputText3" name="name" type="text" class="form-control" value="{{ $share->name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="slug" class="col-form-label">Slug (имя на английском в строке браузера)</label>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <input id="slug" name="slug" type="text" class="form-control" value="{{ $share->slug }}">
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-primary generate-slug" type="button">Сгенерировать slug</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Описание акции</label>
                                        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $share->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Фиксированная цена</label>
                                        <input id="inputText3" name="fix_price" type="number" class="form-control" value="{{ $share->fix_price }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Скидка %</label>
                                        <input id="inputText3" name="discount" type="number" class="form-control" value="{{ $share->discount }}">
                                    </div>

                                    <div class="form-group" style="border:2px solid grey; border-radius:10px; padding: 20px;">
                                        <label for="inputText3" class="col-form-label">Условия</label>

                                        <div id="conditions" data-amount="{{ count($share->conditions) }}">
                                            @foreach($share->conditions as $num => $condition)
                                                @include("admin/shares/condition", $conditionsData[$num])
                                            @endforeach
                                        </div>

                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button class="btn btn-success add-new-condition" type="button" data-type="and" data-token="{{ csrf_token() }}">Добавить условие 'И'</button>
                                            <button class="btn btn-primary add-new-condition" type="button" data-type="or" data-token="{{ csrf_token() }}">Добавить условие 'ИЛИ'</button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Активна с:</label>
                                        <input class="date form-control datepicker" name="active_from" type="text" value="{{ $share->active_from }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Активна до:</label>
                                        <input class="date form-control datepicker" name="active_to" type="text" value="{{ $share->active_to }}">
                                    </div>

                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Сохранить акцию</button>

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