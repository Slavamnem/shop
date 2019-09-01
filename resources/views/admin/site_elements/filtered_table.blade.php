@forelse($siteElements as $siteElement)
    <tr>
        <td>
            <a href="{{ route("admin-site-elements-show", ['id' => $siteElement->id]) }}">
                {{ $siteElement->key }}
            </a>
        </td>
        <td>{{ $siteElement->value }}</td>
        <td>{{ $siteElement->type }}</td>
        <td>
            <a href="{{ route("admin-site-elements-edit", ['id' => $siteElement->id]) }}" class="btn btn-sm btn-outline-light">
                Edit
            </a>
            <a href="{{ route("admin-site-elements-delete", ['id' => $siteElement->id]) }}" class="btn btn-sm btn-outline-light">
                <i class="far fa-trash-alt"></i>
            </a>
        </td>
    </tr>
@empty
    <p>Элементов нет</p>
@endforelse