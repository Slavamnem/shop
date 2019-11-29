<div class="form-group" style="border:5px solid darkblue; border-radius:1px; padding: 20px;">
    <div class="conditions-box">
         @foreach($box->getChildren() as $key => $child)
             {!! $child->show() !!}
            <hr>
            {{--@if ($key < count($box->getChildren()))--}}
                <input type="hidden" class="delimiter" name="conditions_delimiter" value="{{ $box->getDelimiter()->getKey() }}">
                <button class="btn btn-warning delimiter-button condition-delimiter-{{ $box->getDelimiter()->getKey() }}" type="button">{{ $box->getDelimiter()->getTitle() }}</button>
                <br><br>
            {{--@endif--}}
         @endforeach
    </div>
</div>