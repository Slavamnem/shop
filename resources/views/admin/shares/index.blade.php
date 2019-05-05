@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Акции</h2>
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
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9">
                                <h5 class="mb-0">Список всех акций</h5>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                <a href="{{ route("admin-shares-create") }}">
                                    <button class="btn btn-primary" type="submit">ДОБАВИТЬ АКЦИЮ</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Фиксированная цена</th>
                                    <th>Скидка</th>
                                    <th>Активна с</th>
                                    <th>Активна по</th>
                                    <th>Действия</th>
                                </tr>
                                <tr>
                                    <th><input type="text" class="admin-filter-input" data-name="name"></th>
                                    <th><input type="text" class="admin-filter-input" data-name="fix_price"></th>
                                    <th><input type="text" class="admin-filter-input" data-name="discount"></th>
                                    <th><input type="text" class="admin-filter-input" data-name="active_From"></th>
                                    <th><input type="text" class="admin-filter-input" data-name="active_to"></th>
                                </tr>
                                </thead>
                                <tbody class="tbody">
                                @forelse($shares as $share)
                                    <tr>
                                        <td>
                                            <a href="{{ route("admin-shares-show", ['id' => $share->id]) }}">
                                                {{ $share->name }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $share->fix_price }}
                                        </td>
                                        <td>
                                            {{ $share->discount }}
                                        </td>
                                        <td>
                                            {{ $share->active_from }}
                                        </td>
                                        <td>
                                            {{ $share->active_to }}
                                        </td>
                                        <td>
                                            <a href="{{ route("admin-shares-edit", ['id' => $share->id]) }}">
                                                <img src="{{ asset("public/admin/assets/images/pencil.png") }}" alt="" style="max-width:20px; max-height:20px">
                                            </a>
                                            <a href="{{ route("admin-shares-delete", ['id' => $share->id]) }}">
                                                <img src="{{ asset("public/admin/assets/images/trash.jpg") }}" alt="" style="max-width:20px; max-height:20px">
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <p>Акций нет</p>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Название</th>
                                    <th>Фиксированная цена</th>
                                    <th>Скидка</th>
                                    <th>Активна с</th>
                                    <th>Активна по</th>
                                    <th>Действия</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end fixed header  -->
            <!-- ============================================================== -->
        </div>
    </div>
@endsection

@section("custom-js")
    <script src="{{ asset("public/admin/assets/js/shares/main.js") }}"></script>
@endsection