@foreach($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>
            <div class="m-r-10"><img src="{{ @asset("storage/app/{$product->mainImage->url}") }}" alt="user" class="rounded" width="45"></div>
        </td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->quantity }}</td>
        <td>{{ $product->base_price }}</td>
        <td>{{ $product->profit }}</td>
    </tr>
@endforeach