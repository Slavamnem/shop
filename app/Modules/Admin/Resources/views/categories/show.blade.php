@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

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
                                        <input id="inputText3" name="name" type="text" class="form-control" value="{{ $category->name }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Slug (имя на английском в строке браузера)</label>
                                        <input id="inputText3" name="slug" type="text" class="form-control" value="{{ $category->slug }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Сортировка</label>
                                        <input id="inputText3" name="ordering" type="number" class="form-control" value="{{ $category->ordering }}" readonly="readonly">
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

        </div>

    </div>
@endsection