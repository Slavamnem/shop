<div class="card-body">
    <div class="table-responsive">
        <table id="example4" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Цена</th>
                <th>Кол-во</th>
                <th>Цвет</th>
                <th>Size</th>
                <th></th>
            </tr>
            <tbody>
            @forelse($products["hits"]["hits"] as $product)
                <tr>
                    <td>
                        <a href="{{ route("admin-products-show", ['id' => $product["_id"]]) }}">
                            {{ $product["_source"]["name"] }}
                        </a>
                    </td>
                    <td>{{ $product["_source"]["base_price"] }}</td>
                    <td>{{ $product["_source"]["quantity"] }}</td>
                    <td>{{ $product["_source"]["color"] }}</td>
                    <td>{{ $product["_source"]["size"] }}</td>
                    <td>
                        <button class="btn btn-primary add-product-to-basket" data-id="{{ $product["_id"] }}" type="button">+</button>
                    </td>
                </tr>
            @empty
                <p>Товаров не найдено</p>
            @endforelse
            </tbody>
        </table>
        {{--<table id="example4" class="table table-striped table-bordered" style="width:100%">--}}
            {{--<thead>--}}
            {{--<tr>--}}
                {{--<th>Name</th>--}}
                {{--<th>Цена</th>--}}
                {{--<th>Кол-во</th>--}}
                {{--<th>Цвет</th>--}}
                {{--<th>Size</th>--}}
                {{--<th></th>--}}
            {{--</tr>--}}
            {{--<tbody>--}}
                {{--@forelse($products as $product)--}}
                    {{--<tr>--}}
                        {{--<td>--}}
                            {{--<a href="{{ route("admin-products-show", ['id' => $product->id]) }}">--}}
                                {{--{{ $product->name }}--}}
                            {{--</a>--}}
                        {{--</td>--}}
                        {{--<td>{{ $product->base_price }}</td>--}}
                        {{--<td>{{ $product->quantity }}</td>--}}
                        {{--<td>{{ $product->color->name }}</td>--}}
                        {{--<td>{{ $product->size->name }}</td>--}}
                        {{--<td>--}}
                            {{--<button class="btn btn-primary add-product-to-basket" data-id="{{ $product->id }}" type="button">+</button>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@empty--}}
                    {{--<p>Товаров не найдено</p>--}}
                {{--@endforelse--}}
            {{--</tbody>--}}
        {{--</table>--}}
    </div>
</div>