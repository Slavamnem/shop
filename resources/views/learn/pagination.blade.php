@extends('layouts.app')

@section("content")
    <div>
        @foreach($products as $product)
            <p>{{ $product->name }}</p>
        @endforeach
        {{ $products->appends(['with-meta' => true])->links() }}
    </div>

    <p>{{ $products->currentPage() }}</p>
    <p>{{ $products->count() }}</p>
    <p>{{ $products->nextPageUrl() }}</p>
@endsection