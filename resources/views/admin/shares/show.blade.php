@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

                <div class="section-block">
                    <h1 class="section-title">
                        Просмотр акции: {{ $share->name }}
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
                                        <input id="inputText3" name="name" type="text" class="form-control" value="{{ $share->name }}" readonly="readonly">
                                    </div>

                                    <div class="form-group">
                                        <label for="slug" class="col-form-label">Slug (имя на английском в строке браузера)</label>
                                        <input id="slug" name="slug" type="text" class="form-control" value="{{ $share->slug }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Описание акции</label>
                                        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" readonly="readonly">{{ $share->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Фиксированная цена</label>
                                        <input id="inputText3" name="fix_price" type="number" class="form-control" value="{{ $share->fix_price }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Скидка %</label>
                                        <input id="inputText3" name="discount" type="number" class="form-control" value="{{ $share->discount }}" readonly="readonly">
                                    </div>

                                    <div class="form-group" style="border:2px solid grey; border-radius:10px; padding: 20px;">
                                        <label for="inputText3" class="col-form-label">Условия</label>

                                        {{--<div id="conditions" data-amount="{{ @count($share->conditions) }}">--}}
                                            {{--@if(is_array($share->conditions))--}}
                                                {{--@foreach($share->conditions as $id => $condition)--}}
                                                    {{--@include("admin/shares/condition", ['condition' => $conditionsBox->getCondition($id)])--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}
                                        {{--</div>--}}
                                        <div id="conditions" data-amount="{{ @count($share->conditions) }}">
                                            @if(is_array($share->conditions))
                                                @foreach($share->conditions as $id => $condition)
                                                    @include("admin/shares/condition", [
                                                        'conditionsList' => $conditionsBox->getConditionsList(),
                                                        'operationsList' => $conditionsBox->getOperationsList(),
                                                        'delimiter'      => $conditionsBox->getDelimiter(),
                                                        'delimiterTrans' => $conditionsBox->getDelimiterTrans(),
                                                        'condition'      => $conditionsBox->getCondition($id)
                                                    ])
                                                @endforeach
                                            @endif
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Активна с:</label>
                                        <input class="date form-control datepicker" name="active_from" type="text" value="{{ $share->active_from }}" readonly="readonly">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Активна до:</label>
                                        <input class="date form-control datepicker" name="active_to" type="text" value="{{ $share->active_to }}" readonly="readonly">
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

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