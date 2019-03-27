@extends("layouts.test")
<p>2</p>

@section("title", "TEST PAGE")

@section("header")
    @parent
    Name: {{ $name or "Anonim" }}
@endsection

@section("content")
    <p>Age: {{ $age or 1000 }}</p>
    @if($name == "slava")
        <p>YES</p>
    @else
        <p>NO</p>
    @endif

    @foreach(range(1, 10) as $item)
        {{--  comments --}}
        {{ $item }} - ({{ $loop->count }}) -
        @if($item > 7)
            @break
        @endif
    @endforeach

    @php
        $arr = [1, 2, 3];
        dump($arr);
    @endphp

    @include("item", ["person" => "Ben"])
    @each("item", $peoples, "person")

@endsection

@section("footer")
    @parent
    <p>2019 Odessa</p>
@endsection