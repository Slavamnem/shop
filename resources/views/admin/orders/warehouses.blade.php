<label for="name" class="col-form-label">Отделение:</label>
<select name="warehouse" class="form-control" id="warehouse">
    <option value="0">Выберите отделение</option>
    @forelse($warehouses as $warehouse)
        <option value="{{$warehouse->name}}">{{$warehouse->name}}</option>
    @empty
    @endforelse
</select>