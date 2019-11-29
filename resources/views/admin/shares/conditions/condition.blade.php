<div class="form-group share-condition">
    <div class="row">
        <div class="col-md-4">
            <select name="conditions[]" class="form-control condition1 condition-{{ $condition->getId() }}" data-id="{{ $condition->getId() }}">
                <option value="">{{ "Выберите условие" }}</option>
                @forelse($condition->getFieldsList()->getList() as $conditionCode => $conditionName)
                    <option @if(null !== $condition->getField() and $condition->getField() == $conditionCode) {{ "selected" }} @endif value="{{ $conditionCode }}">{{ $conditionName }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-md-2">
            <select name="operations[]" class="form-control operations-section-{{ $condition->getId() }}">
                @forelse($condition->getOperationsList()->getList() as $operationId => $operation)
                    <option @if(null !== $condition->getOperationId() and $condition->getOperationId() == $operationId) {{ "selected" }} @endif value="{{ $operation }}">{{ $operation }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-md-4 values-section-{{ $condition->getId() }}">
            @if(null !== $condition->getValuesList())
                @include("admin/shares/condition-values", ["values" => $condition->getValuesList(), "currentValue" => $condition->getValue()])
            @else
                {{--<input id="inputText3" name="conditions_values[]" type="text" class="form-control" value="{{ $condition->getValue or '' }}">--}}
            @endif
        </div>
        <div class="col-md-1">
            <button class="btn btn-danger delete-condition" type="button">Удалить</button>
        </div>
    </div>
    {{ $condition->getId() }}
</div>