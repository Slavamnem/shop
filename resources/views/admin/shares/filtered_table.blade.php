@forelse($shares as $share)
    <tr>
        <td>
            <a href="{{ route("admin-shares-show", ['id' => $share->id]) }}">
                {{ $share->name }}
            </a>
        </td>
        <td>
            {{ $share->fix_price }}
        </td>
        <td>
            {{ $share->discount }}
        </td>
        <td>
            {{ $share->active_from }}
        </td>
        <td>
            {{ $share->active_to }}
        </td>
        <td>
            <a href="{{ route("admin-shares-edit", ['id' => $share->id]) }}">
                <img src="{{ asset("public/admin/assets/images/pencil.png") }}" alt="" style="max-width:20px; max-height:20px">
            </a>
            <a href="{{ route("admin-shares-delete", ['id' => $share->id]) }}">
                <img src="{{ asset("public/admin/assets/images/trash.jpg") }}" alt="" style="max-width:20px; max-height:20px">
            </a>
        </td>
    </tr>
@empty
    <p>Акций нет</p>
@endforelse