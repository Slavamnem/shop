@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

                <div class="section-block">
                    <h1 class="section-title">
                        Элемент: {{ $siteElement->key }}
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
                                        <label for="inputText3" class="col-form-label">Ключ элемента</label>
                                        <input id="inputText3" name="key" type="text" class="form-control" value="{{ $siteElement->key }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Тип элемента</label>
                                        <select id="inputText3" name="type" class="form-control" readonly>
                                            <option value="text" @if($siteElement->type == "text") {{ 'selected' }}@endif>Текст</option>
                                            <option value="image" @if($siteElement->type == "image") {{ 'selected' }}@endif>Изображение</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Значение элемента</label>
                                        <input id="inputText3" name="value" type="text" class="form-control" value="{{ $siteElement->value }}" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

        </div>

    </div>
@endsection