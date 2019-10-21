@extends('layouts.admin-layout')
@section('content')
    <div class="container-fluid  dashboard-content">
        <h1>Отчеты</h1>

        <div>
            <form action="{{ route('admin-export') }}">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="inputText3" class="col-form-label">Дата начала:</label>
                            <input class="date form-control datepicker" name="from_date" type="text">
                        </div>
                        <div class="col-md-2">
                            <label for="inputText3" class="col-form-label">Дата конца:</label>
                            <input class="date form-control datepicker" name="till_date" type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Тип отчета</label>
                    <select name="period_type" class="form-control">
                        <option value="1">Годовой отчет</option>
                        <option value="2">Месячный отчет</option>
                        <option value="3">Дневной отчет</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Отчет</label>
                    <select name="report_type" class="form-control">
                        @forelse($reports as $typeId => $reportName)
                            <option value="{{ $typeId }}">{{ $reportName }}</option>
                        @empty
                            <option value="">Доступных экспортов нет</option>
                        @endforelse
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <button class="btn btn-success">Экспорт</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section("custom-js")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset("public/admin/assets/js/reports/main.js") }}"></script>
    <script>
        $(".datepicker").datepicker({
            format: "yyyy-mm-dd",
            weekStart: 0,
            calendarWeeks: true,
            autoclose: true,
            todayHighlight: true,
            //rtl: true,
            orientation: "auto"
        });
    </script>
@endsection