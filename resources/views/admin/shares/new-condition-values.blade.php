<select name="conditions_values[]" class="form-control condition">
    @forelse($values as $value)
        <option value="{{ $value }}">{{ $value }}</option>
    @empty
    @endforelse
</select>