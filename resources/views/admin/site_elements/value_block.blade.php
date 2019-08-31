@if($type == "image")
    @if($siteElement)
        <img class="stock-img" src="{{ @asset("storage/app/{$siteElement->value}") }}" alt="">
        <br><br>
    @endif
    <input type="file" name="value" class="custom-file-input" id="customFile2" style="opacity:1!important;">
@else
    <input id="inputText3" name="value" type="text" class="form-control" value="@if($siteElement) {{ $siteElement->value }} @endif">
@endif