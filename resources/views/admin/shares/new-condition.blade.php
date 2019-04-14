<div class="form-group share-condition">
    <button class="btn btn-warning" type="button">{{ $type }}</button>
    <br><br>
    <div class="row">
        <div class="col-md-4">
            <select name="conditions[]" class="form-control condition">
                @forelse($conditions as $condition => $name)
                    <option value="{{ $condition }}">{{ $name }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-md-2">
            <select name="operations[]" class="form-control">
                @forelse($operations as $operation)
                    <option value="{{ $operation }}">{{ $operation }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-md-4 values-section">
            <input id="inputText3" name="conditions_values[]" type="text" class="form-control" value="">
        </div>
        <div class="col-md-1">
            <button class="btn btn-danger delete-condition" type="button">Удалить</button>
        </div>
    </div>
    <hr>
</div>