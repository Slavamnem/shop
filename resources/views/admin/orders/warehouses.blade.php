<label for="name" class="col-form-label">Отделение Новой Почты:</label>
<select name="warehouse" class="form-control" id="warehouse">
    <option value="0">Выберите отделение</option>
    @forelse($warehouses as $warehouse)
        <option value="{{$warehouse->Number}}">{{$warehouse->DescriptionRu}}</option>
    @empty
    @endforelse
</select>