@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">NewYorkTimes</h2>
                    <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tables</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <!-- ============================================================== -->
            <!-- fixed header  -->
            <!-- ============================================================== -->
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-outline-one" data-toggle="tab" href="#outline-one" role="tab" aria-controls="home" aria-selected="true">Новости</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-outline-two" data-toggle="tab" href="#outline-two" role="tab" aria-controls="profile" aria-selected="false">Отзывы фильмов</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent2">
                <div class="tab-pane fade show active" id="outline-one" role="tabpanel" aria-labelledby="tab-outline-one">
                    <br><br>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9">
                                        <h5 class="mb-0">Список всех новостей NewYorkTimes</h5>
                                        <p>Вся основная информация</p>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        @forelse($news as $new)
                                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                                <div class="card">
                                                    @if(!empty($new->mainImage))
                                                        <img class="card-img-top stock-img img-fluid" src="{{ $new->mainImage }}" alt="Card image cap">
                                                    @endif
                                                    <div class="card-body">
                                                        <h3 class="card-title">{{ $new->title }}</h3>
                                                        <p class="card-text">{{ $new->abstract }}</p>
                                                        <p class="card-text">Дата публикации: {{ $new->published_date }}</p>
                                                        <a href="{{ $new->url }}" class="btn btn-primary">Открыть новость</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p>Новостей нет</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end fixed header  -->
                    <!-- ============================================================== -->
                </div>
                <div class="tab-pane fade" id="outline-two" role="tabpanel" aria-labelledby="tab-outline-two">
                    <br><br>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9">
                                        <h5 class="mb-0">Список отзывов на фильмы NewYorkTimes</h5>
                                        <p>Вся основная информация</p>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="row">
                                        @forelse($reviews as $review)
                                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                                <div class="card">
                                                    @if(!empty($review->multimedia))
                                                        <img class="card-img-top stock-img img-fluid" src="{{ $review->multimedia->src }}" alt="Card image cap">
                                                    @endif
                                                    <div class="card-body">
                                                        <h3 class="card-title">{{ $review->display_title }}</h3>
                                                        <p class="card-text">{{ $review->headline }}</p>
                                                        <p class="card-text">Дата публикации: {{ $review->date_updated }}</p>
                                                        <a href="{{ $review->link->url }}" class="btn btn-primary">Открыть ревью</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p>Новостей нет</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end fixed header  -->
                    <!-- ============================================================== -->
                </div>
            </div>


        </div>
    </div>
@endsection

@section("custom-js")
    {{--<script src="{{ asset("public/admin/assets/js/categories/index.js") }}"></script>--}}
@endsection