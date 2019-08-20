@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Уведомления</h2>
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
                                <h5 class="mb-0">Список всех уведомлений</h5>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @if ($notifications->currentPage() != 1)
                                    <li class="page-item"><a class="page-link" href="{{ $notifications->url(1) }}">1</a></li>
                                @endif
                                @if ($notifications->currentPage() > 2)
                                    <li class="page-item"><a class="page-link" href="{{ $notifications->previousPageUrl() }}"><<</a></li>
                                @endif
                                <li class="page-item active"><a class="page-link " href="">{{ $notifications->currentPage() }}</a></li>
                                @if ($notifications->currentPage() < $notifications->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $notifications->nextPageUrl() }}">>></a></li>
                                @endif
                                @if ($notifications->currentPage() + 1 < $notifications->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $notifications->url($notifications->lastPage()) }}">{{ $notifications->lastPage() }}</a></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Заголовок</th>
                                    <th>Статус</th>
                                    <th>Приоритет</th>
                                    <th>Действия</th>
                                </tr>
                                <tr>
                                    <th><input type="text" class="admin-filter-input" data-name="preview"></th>
                                    <th><input type="text" class="admin-filter-input" data-name="status"></th>
                                </tr>
                                </thead>
                                <tbody class="tbody">
                                @forelse($notifications as $notification)
                                    <tr>
                                        <td>
                                            <a href="{{ route("admin-notifications-show", ['id' => $notification->id]) }}">
                                                {{ $notification->preview }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $notification->status }}
                                        </td>
                                        <td>
                                            {{ $notification->priority->name }}
                                        </td>
                                        <td>
                                            <a href="{{ route("admin-notifications-show", ['id' => $notification->id]) }}">
                                                <img src="{{ asset("public/admin/assets/images/show.jpg") }}" alt="" style="max-width:15px; max-height:20px">
                                            </a>
                                            <a href="{{ route("admin-notifications-delete", ['id' => $notification->id]) }}">
                                                <img src="{{ asset("public/admin/assets/images/trash.jpg") }}" alt="" style="max-width:20px; max-height:20px">
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <p>Групп нет</p>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Заголовок</th>
                                    <th>Статус</th>
                                    <th>Приоритет</th>
                                    <th>Действия</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @if ($notifications->currentPage() != 1)
                                    <li class="page-item"><a class="page-link" href="{{ $notifications->url(1) }}">1</a></li>
                                @endif
                                @if ($notifications->currentPage() > 2)
                                    <li class="page-item"><a class="page-link" href="{{ $notifications->previousPageUrl() }}"><<</a></li>
                                @endif
                                <li class="page-item active"><a class="page-link " href="">{{ $notifications->currentPage() }}</a></li>
                                @if ($notifications->currentPage() < $notifications->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $notifications->nextPageUrl() }}">>></a></li>
                                @endif
                                @if ($notifications->currentPage() + 1 < $notifications->lastPage())
                                    <li class="page-item"><a class="page-link" href="{{ $notifications->url($notifications->lastPage()) }}">{{ $notifications->lastPage() }}</a></li>
                                @endif
                            </ul>
                        </nav>
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
    <script src="{{ asset("public/admin/assets/js/groups/main.js") }}"></script>
@endsection