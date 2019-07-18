@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

                <div class="section-block">
                    <h1 class="section-title">
                        #{{ $auth->id }}
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
                                        <label for="inputText3" class="col-form-label">Пользователь</label>
                                        <input id="inputText3" name="name" type="text" class="form-control" value="{{ $auth->user->name . " " . $auth->user->last_name }}" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Ip address</label>
                                        <input id="inputText3" name="name" type="text" class="form-control" value="{{ $auth->ip_address }}" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Trace</label>
                                        <textarea id="inputText3" rows="10" name="name" type="text" class="form-control" readonly="readonly">
                                            {{ json_encode($auth->trace) }}
                                        </textarea>

                                        <br><br><br>

                                        @foreach(array_slice($auth->trace, 0, 100) as $item)
                                            <input id="inputText3" name="name" type="text" class="form-control" value="{{ "File: " . @$item['file'] . " : " . @$item['line'] }}" readonly="readonly">
                                            <input id="inputText3" name="name" type="text" class="form-control" value="{{ "Function: " . @$item['function'] }}" readonly="readonly">
                                            <hr><hr><hr>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

        </div>

    </div>
@endsection