@if($colors)
    <h3>Цвета</h3>
@endif
@foreach($colors as $color)
    <label class="custom-control custom-checkbox">
        <input type="checkbox" name="colors[]" checked="" value="{{$color->id}}" class="custom-control-input"><span class="custom-control-label">{{$color->name}}</span>
    </label>
@endforeach

<hr>

@if($sizes)
    <h3>Размеры</h3>
@endif
@foreach($sizes as $size)
    <label class="custom-control custom-checkbox">
        <input type="checkbox" name="sizes[]" checked="" value="{{$size->id}}" class="custom-control-input"><span class="custom-control-label">{{$size->name}}</span>
    </label>
@endforeach