<div class="form-group share-condition">
    @if($conditionsAmount > 0)
        <input type="hidden" class="delimiter" name="conditions_delimiter" value="{{ $delimiterType }}">
        <button class="btn btn-warning delimiter-button condition-delimiter-{{$conditionId}}" type="button">{{ $delimiterTypeTrans }}</button>
        <br><br>
    @endif
    <div class="row">
        <div class="col-md-4">
            <select name="conditions[]" class="form-control condition condition-{{$conditionId}}" data-id="{{$conditionId}}">
                <option value="">{{ "Выберите условие" }}</option>
                @forelse($conditions as $condition => $name)
                    <option @if(isset($currentCondition) and $currentCondition == $condition) {{ "selected" }} @endif value="{{ $condition }}">{{ $name }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-md-2">
            <select name="operations[]" class="form-control operations-section-{{$conditionId}}">
                @forelse($operations as $operation)
                    <option @if(isset($currentOperation) and $currentOperation == $operation) {{ "selected" }} @endif value="{{ $operation }}">{{ $operation }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-md-4 values-section-{{$conditionId}}">
            @if(isset($currentValues))
                @include("admin/shares/condition-values", ["values" => $currentValues, "currentValue" => $currentValue])
            @else
                <input id="inputText3" name="conditions_values[]" type="text" class="form-control" value="{{ $currentValue or "" }}">
            @endif
        </div>
        <div class="col-md-1">
            <button class="btn btn-danger delete-condition" type="button">Удалить</button>
        </div>
    </div>
    <hr>
</div>