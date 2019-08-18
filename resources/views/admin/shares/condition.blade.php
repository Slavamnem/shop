<div class="form-group share-condition">
    @if($condition->getId() > 0)
        <input type="hidden" class="delimiter" name="conditions_delimiter" value="{{ $delimiter }}">
        <button class="btn btn-warning delimiter-button condition-delimiter-{{ $condition->getId() }}" type="button">{{ $delimiterTrans }}</button>
        <br><br>
    @endif
    <div class="row">
        <div class="col-md-4">
            <select name="conditions[]" class="form-control condition1 condition-{{ $condition->getId() }}" data-id="{{ $condition->getId() }}">
                <option value="">{{ "Выберите условие" }}</option>
                @forelse($conditionsList as $conditionCode => $name)
                    <option @if(null !== $condition->getField() and $condition->getField() == $conditionCode) {{ "selected" }} @endif value="{{ $conditionCode }}">{{ $name }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-md-2">
            <select name="operations[]" class="form-control operations-section-{{ $condition->getId() }}">
                @forelse($operationsList as $operation)
                    <option @if(null !== $condition->getOperation() and $condition->getOperation() == $operation) {{ "selected" }} @endif value="{{ $operation }}">{{ $operation }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-md-4 values-section-{{ $condition->getId() }}">
            @if(null !== $condition->getValuesList())
                @include("admin/shares/condition-values", ["values" => $condition->getValuesList(), "currentValue" => $condition->getCurrentValue()])
            @else
                <input id="inputText3" name="conditions_values[]" type="text" class="form-control" value="{{ $condition->getCurrentValue or '' }}">
            @endif
        </div>
        <div class="col-md-1">
            <button class="btn btn-danger delete-condition" type="button">Удалить</button>
        </div>
    </div>
    <hr>
</div>