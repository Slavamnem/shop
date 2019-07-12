@forelse($groups as $group)
    <tr>
        <td>
            <a href="{{ route("admin-groups-show", ['id' => $group->id]) }}">
                {{ $group->name }}
            </a>
        </td>
        <td>
            <a href="{{ route("admin-groups-edit", ['id' => $group->id]) }}">
                <img src="{{ asset("public/admin/assets/images/pencil.png") }}" alt="" style="max-width:20px; max-height:20px">
            </a>
            <a href="{{ route("admin-groups-delete", ['id' => $group->id]) }}">
                <img src="{{ asset("public/admin/assets/images/trash.jpg") }}" alt="" style="max-width:20px; max-height:20px">
            </a>
        </td>
    </tr>
@empty
    <br><h3 align="center">Групп не найдено</h3><br>
@endforelse