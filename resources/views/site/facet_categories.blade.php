<div class="row">
    <div class="col-md-{{ 12 - $level }} col-md-offset-{{$level}}">
        {{--<br>--}}
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $category->name }}
            <span class="badge badge-primary badge-pill">{{ $category->productsCount() }}</span>
            <input type="checkbox">
        </li>

        @foreach($category->children as $subCategory)
            @include('site.facet_categories', ['category' => $subCategory, 'level' => $level + 1])
        @endforeach
    </div>
</div>