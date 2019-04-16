<div class="form-group share-condition">
    @if($conditionId)
        <input type="hidden" name="conditions_delimiters[]" value="{{ $type }}">
        <button class="btn btn-warning delimiter new-condition-delimiter-{{$conditionId}}" type="button">{{ $type }}</button>
        <br><br>
    @endif
    <div class="row">
        <div class="col-md-4">
            <select name="conditions[]" class="form-control condition new-condition-{{$conditionId}}" data-id="{{$conditionId}}">
                <option value="">{{ "Выберите условие" }}</option>
                @forelse($conditions as $condition => $name)
                    <option value="{{ $condition }}">{{ $name }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-md-2">
            <select name="operations[]" class="form-control new-operations-section-{{$conditionId}}">
                @forelse($operations as $operation)
                    <option value="{{ $operation }}">{{ $operation }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-md-4 new-values-section-{{$conditionId}}">
            <input id="inputText3" name="conditions_values[]" type="text" class="form-control" value="">
        </div>
        <div class="col-md-1">
            <button class="btn btn-danger delete-condition" type="button">Удалить</button>
        </div>
    </div>
    <hr>
</div>