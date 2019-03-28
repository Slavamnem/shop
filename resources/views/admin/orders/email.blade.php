@extends('layouts.admin-layout')
@section('content')
<div class="container-fluid  dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">

        <form method="POST" action="{{ route("admin-orders-send-email") }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="section-block">
            <h1 class="section-title">
                Отправка письма
            </h1>
            <p>Takes the basic nav from above and adds the .nav-tabs class to generate a tabbed interface..</p>
        </div>

        <div class="tab-outline">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-outline-one" data-toggle="tab" href="#outline-one" role="tab" aria-controls="home" aria-selected="true">Форма отправки</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent2">
                <div class="tab-pane fade show active" id="outline-one" role="tabpanel" aria-labelledby="tab-outline-one">

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputText3" class="col-form-label">Логин отправителя</label>
                                <input id="inputText3" name="sender_login" type="text" class="form-control" value="{{ $login }}">
                            </div>
                            <div class="form-group">
                                <label for="inputText3" class="col-form-label">Пароль отправителя</label>
                                <input id="inputText3" name="sender_password" type="password" class="form-control" value="{{ $password }}">
                            </div>
                            <div class="form-group">
                                <label for="inputText3" class="col-form-label">Адрес получателя</label>
                                <input id="inputText3" name="receiver_email" type="text" class="form-control" value="{{ $email }}">
                            </div>
                            <div class="form-group">
                                <label for="inputText3" class="col-form-label">Сообщение</label>
                                <textarea id="inputText3" name="message" type="text" class="form-control">
                                </textarea>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Отправить письмо</button>

                </div>
            </div>
        </div>

        </form>

    </div>

</div>
@endsection

@section("custom-js")
<script src="{{ asset("public/admin/assets/js/orders/main.js") }}"></script>
@endsection