<div class="row">
    <div class="col-md-{{$level}}"></div>
    <div class="col-md-10 col-lg-10">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $facetItem->getTitle() . " " }}
            @if(!$facetItem->isSection())
                <span class="badge badge-primary badge-pill">{{ $facetItem->getMatchProductCount() }}</span>
                <input type="checkbox" name="{{ $facetItem->getAttributeName() }}" class="facet-form-trigger" @if($facetItem->getIsMarked()) {{ 'checked' }} @endif>
            @endif
        </li>

        @foreach($facetItem->getChildren() as $subItem)
            @include('site.catalog.facet_items', ['facetItem' => $subItem, 'level' => $level + 1])
        @endforeach
    </div>
</div>