@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

            <form method="POST" action="{{ route("admin-site-elements-store") }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="section-block">
                    <h1 class="section-title">
                        Новый элемент
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
                                        <input id="inputText3" name="key" type="text" class="form-control" value="{{ old('key') }}">
                                    </div>
                                    @if($errors->has("key"))
                                        <span class="help-block" style="color:red">
                                            <strong>{{ $errors->first('key') }}</strong>
                                        </span>
                                    @endif

                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Тип элемента</label>
                                        <select id="element-type" name="type" class="form-control">
                                            <option value="text">Текст</option>
                                            <option value="image">Изображение</option>
                                        </select>
                                    </div>
                                    @if($errors->has("type"))
                                        <span class="help-block" style="color:red">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif

                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Значение элемента</label>
                                        <div id="value-block">
                                            <input id="inputText3" name="value" type="text" class="form-control" value="{{ old('value') }}">
                                        </div>
                                    </div>
                                    @if($errors->has("value"))
                                        <span class="help-block" style="color:red">
                                            <strong>{{ $errors->first('value') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Добавить элемент</button>

                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>
@endsection

@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/elements/main.js") }}"></script>
@endsection