<div class="form-group product-property">
    <div class="row">
        <div class="col-md-4">
            <select name="properties[]" class="form-control">
                @forelse($properties as $property)
                    <option value="{{$property->id}}">{{$property->name}}</option>
                @empty
                @endforelse
            </select>
        </div>
        <h2>=</h2>
        <div class="col-md-4">
            <input id="inputText3" name="properties_values[]" type="text" class="form-control" value="">
        </div>
        <div class="col-md-2">
            <input id="inputText3" name="properties_ordering[]" type="number" class="form-control" value="">
        </div>
        <div class="col-md-1">
            <button class="btn btn-danger delete-property" type="button">Удалить</button>
        </div>
    </div>
    <hr>
</div>
