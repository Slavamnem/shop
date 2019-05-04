@forelse($products as $product)
    <tr>
        <td>
            <a href="{{ route("admin-products-show", ['id' => $product->id]) }}">
                {{ $product->name }}
            </a>
        </td>
        <td>{{ $product->base_price }}</td>
        <td>{{ $product->quantity }}</td>
        <td>
            <a href="{{ route("admin-categories-show", ['id' => $product->category->id]) }}">
                {{ $product->category->name }}
            </a>
        </td>
        <td>
            <a href="{{ route("admin-groups-show", ['id' => $product->group->id]) }}">
                {{ $product->group->name }}
            </a>
        </td>
        <td>{{ $product->status->name }}</td>
        <td>{{ $product->color->name }}</td>
        <td>{{ $product->size->name }}</td>
        <td>
            <a href="{{ route("admin-products-edit", ['id' => $product->id]) }}">
                <img src="{{ asset("public/admin/assets/images/pencil.png") }}" alt="" style="max-width:20px; max-height:20px">
            </a>
            <a href="{{ route("admin-products-delete", ['id' => $product->id]) }}">
                <img src="{{ asset("public/admin/assets/images/trash.jpg") }}" alt="" style="max-width:20px; max-height:20px">
            </a>
        </td>
    </tr>
@empty
    <p>Товаров нет</p>
@endforelse