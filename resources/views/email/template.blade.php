<div>
    <h1>{{ $theme }}</h1>
    <label for="">Name</label>
    <p>{{ $name }}</p>
    <label for="">Age</label>
    <p>{{ $age }}</p>
    <img src="{{ $message->embed(storage_path("app/products/product__image.jpeg")) }}">
</div>