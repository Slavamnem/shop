@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

            <form method="POST" action="{{ route("admin-clients-store") }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="section-block">
                    <h1 class="section-title">
                        <button class="btn btn-primary" type="submit">ДОБАВИТЬ КЛИЕНТА</button>
                    </h1>
                    <p>Takes the basic nav from above and adds the .nav-tabs class to generate a tabbed interface..</p>
                </div>

                <div class="tab-outline">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-outline-one" data-toggle="tab" href="#outline-one" role="tab" aria-controls="home" aria-selected="true">Основная инфа</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="outline-one" role="tabpanel" aria-labelledby="tab-outline-one">

                            <div class="card">
                                <!--<h5 class="card-header"></h5>-->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Имя</label>
                                        <input id="inputText3" name="name" type="text" class="form-control" value="{{ old('name') }}">
                                    </div>
                                    @if($errors->has("name"))
                                        <span class="help-block" style="color:red">
                                             <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Фамилия</label>
                                        <input id="inputText3" name="last_name" type="text" class="form-control" value="{{ old('last_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Телефон</label>
                                        <input id="inputText3" name="phone" type="text" class="form-control" value="{{ old('phone') }}">
                                    </div>
                                    @if($errors->has("phone"))
                                        <span class="help-block" style="color:red">
                                             <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Почта</label>
                                        <input id="inputText3" name="email" type="text" class="form-control" value="{{ old('email') }}">
                                    </div>
                                    @if($errors->has("email"))
                                        <span class="help-block" style="color:red">
                                             <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>
@endsection

@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/products/main.js") }}"></script>
@endsection