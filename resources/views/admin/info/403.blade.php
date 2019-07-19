@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
            <div class="section-block">
                <br><br><br><br><br>
                <h1 class="section-title center-block" align="center">
                    <pre>{{ $message or '403 Access Denied' }}</pre>
                </h1>
                <br>
            </div>
        </div>
    </div>
@endsection