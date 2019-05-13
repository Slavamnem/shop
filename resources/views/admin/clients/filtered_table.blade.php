@forelse($clients as $client)
    <tr>
        <td>
            <a href="{{ route("admin-clients-show", ['id' => $client->id]) }}">
                {{ $client->name }}
            </a>
        </td>
        <td>{{ $client->last_name }}</td>
        <td>{{ $client->phone }}</td>
        <td>
            <a href="{{ route("admin-new-email", ['email' => $client->email]) }}">
                {{ $client->email }}
            </a>
        </td>
        <td>
            <a href="{{ route("admin-clients-edit", ['id' => $client->id]) }}">
                <img src="{{ asset("public/admin/assets/images/pencil.png") }}" alt="" style="max-width:20px; max-height:20px">
            </a>
            <a href="{{ route("admin-clients-delete", ['id' => $client->id]) }}">
                <img src="{{ asset("public/admin/assets/images/trash.jpg") }}" alt="" style="max-width:20px; max-height:20px">
            </a>
        </td>
    </tr>
@empty
    <p>Клиентов не найдено</p>
@endforelse