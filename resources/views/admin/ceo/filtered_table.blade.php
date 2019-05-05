@forelse($categories as $category)
    <tr>
        <td>
            <a href="{{ route("admin-categories-show", ['id' => $category->id]) }}">
                {{ $category->name }}
            </a>
        </td>
        <td>{{ $category->slug }}</td>
        <td>{{ $category->ordering }}</td>
        <td>
            <a href="{{ route("admin-categories-edit", ['id' => $category->id]) }}" class="btn btn-sm btn-outline-light">
                Edit
            </a>
            <a href="{{ route("admin-categories-delete", ['id' => $category->id]) }}" class="btn btn-sm btn-outline-light">
                <i class="far fa-trash-alt"></i>
            </a>
        </td>
    </tr>
@empty
    <p>Категорий нет</p>
@endforelse