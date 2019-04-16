@if($values)
    <select name="conditions_values[]" class="form-control condition">
        @forelse($values as $value)
            <option value="{{ $value }}">{{ $value }}</option>
        @empty
        @endforelse
    </select>
@else
    <input id="inputText3" name="conditions_values[]" type="text" class="form-control" value="">
@endif