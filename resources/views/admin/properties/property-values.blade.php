<select name="properties_values[]" class="form-control">
    @forelse($propertyValues as $propertyValue)
        <option value="{{$propertyValue->id}}">{{$propertyValue->value}}</option>
    @empty
    @endforelse
</select>