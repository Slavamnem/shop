@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

            <form method="POST" action="{{ route("admin-users-update", ['id' => $user->id]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
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
                                        <input id="inputText3" name="name" type="text" class="form-control" value="{{ $user->name }}">
                                    </div>
                                    @if($errors->has("name"))
                                        <span class="help-block" style="color:red">
                                             <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Фамилия</label>
                                        <input id="inputText3" name="last_name" type="text" class="form-control" value="{{ $user->last_name }}">
                                    </div>
                                    @if($errors->has("last_name"))
                                        <span class="help-block" style="color:red">
                                             <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Логин</label>
                                        <input id="inputText3" name="login" type="text" class="form-control" value="{{ $user->login }}">
                                    </div>
                                    @if($errors->has("login"))
                                        <span class="help-block" style="color:red">
                                             <strong>{{ $errors->first('login') }}</strong>
                                        </span>
                                    @endif
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Пароль</label>
                                        <input id="inputText3" name="password" type="text" class="form-control" value="{{ $user->password }}">
                                    </div>
                                    @if($errors->has("password"))
                                        <span class="help-block" style="color:red">
                                             <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Почта</label>
                                        <input id="inputText3" name="email" type="text" class="form-control" value="{{ $user->email }}">
                                    </div>
                                    @if($errors->has("email"))
                                        <span class="help-block" style="color:red">
                                             <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Api Token</label>
                                        <input id="inputText3" name="api_token" type="text" class="form-control" value="{{ $user->api_token }}">
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h3>Роли</h3><br>
                                    @foreach($roles as $role)
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" name="roles[]"
                                                   @if(in_array($role->id, $user->roles->pluck('id')->toArray())) {{ 'checked' }} @endif
                                                   value="{{$role->id}}"
                                                   class="custom-control-input">
                                            <span class="custom-control-label">{{$role->name}}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Сохранить</button>

                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>
@endsection