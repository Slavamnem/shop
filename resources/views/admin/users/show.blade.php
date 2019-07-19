@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

                <div class="section-block">
                    <h1 class="section-title">
                        Пользователь: {{ $user->name }}
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
                                        <label for="inputText3" class="col-form-label">Имя</label>
                                        <input id="inputText3" name="name" type="text" class="form-control" value="{{ $user->name }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Фамилия</label>
                                        <input id="inputText3" name="last_name" type="text" class="form-control" value="{{ $user->last_name }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Логин</label>
                                        <input id="inputText3" name="login" type="text" class="form-control" value="{{ $user->login }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Пароль</label>
                                        <input id="inputText3" name="password" type="text" class="form-control" value="{{ $user->password }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Почта</label>
                                        <input id="inputText3" name="email" type="text" class="form-control" value="{{ $user->email }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Api Token</label>
                                        <input id="inputText3" name="api_token" type="text" class="form-control" value="{{ $user->api_token }}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Последний вход</label>
                                        <input id="inputText3" name="api_token" type="text" class="form-control" value="{{ $user->last_enter }}" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Роли</label>
                                        @forelse($user->roles as $role)
                                            <input type="text" class="form-control" value="{{ $role->name }}" readonly="readonly">
                                        @empty
                                            <p>-</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

        </div>

    </div>
@endsection