<div class="panel-body">
    <div class="card">

        <h5 class="card-header">Цена</h5>
        <div class="card-body">
            <span>От: </span><input type="text" class="price facet-form-trigger form-control" id="minPrice" name="minPrice" value="{{ $facetObject->getPriceRange()->getMinPrice() }}">
            <span>До: </span><input type="text" class="price facet-form-trigger form-control" id="maxPrice" name="maxPrice" value="{{ $facetObject->getPriceRange()->getMaxPrice() }}">
        </div>

        <h5 class="card-header">Категории</h5>
        <div class="card-body">
            <ul class="list-group">
                @foreach($facetObject->getItems() as $facetItem)
                    @include('site.catalog.facet_items', ['facetItem' => $facetItem, 'level' => 0])
                @endforeach
            </ul>
        </div>

    </div>
</div>