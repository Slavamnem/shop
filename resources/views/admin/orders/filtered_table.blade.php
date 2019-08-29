@forelse($orders as $order)
    <tr class="{{ $order->getStatusClass() }}">
        <td>
            <a href="{{ route("admin-orders-show", ['id' => $order->id]) }}">
                {{ $order->id }}
            </a>
        </td>
        <td>
            {{ $order->status->name }}
        </td>
        <td>
            {{ $order->sum }}
        </td>
        <td>
            {{ $order->client->phone }}
        </td>
        <td>
            <a href="{{ route("admin-new-email", ['email' => $order->client->email]) }}">
                {{ $order->client->email }}
            </a>
        </td>
        <td>
            {{ $order->payment_type->name }}
        </td>
        <td>
            {{ $order->delivery_type->name }}
        </td>
        <td>
            {{ $order->created_at }}
        </td>
        <td>
            <a href="{{ route("admin-orders-edit", ['id' => $order->id]) }}">
                <img src="{{ asset("public/admin/assets/images/pencil.png") }}" alt="" style="max-width:15px; max-height:20px">
            </a>
            <a href="{{ route("admin-orders-show", ['id' => $order->id]) }}">
                <img src="{{ asset("public/admin/assets/images/show.jpg") }}" alt="" style="max-width:15px; max-height:20px">
            </a>
            <a href="{{ route("admin-orders-delete", ['id' => $order->id]) }}">
                <img src="{{ asset("public/admin/assets/images/trash.jpg") }}" alt="" style="max-width:15px; max-height:20px">
            </a>
        </td>
    </tr>
@empty
    <p>Заказов нет</p>
@endforelse