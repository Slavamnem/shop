{{--@foreach($categories as $category)--}}
    {{--@if(count($category->products))--}}
        {{--<div class="stock-cat-block">--}}
            {{--<div class="cat_border">--}}
                {{--<h2 align="center">{{$category->name}}</h2>--}}
            {{--</div>--}}

            <div class="row">
                <div class="col-md-2">
                    <h4>Сортировка</h4>
                </div>
                <div class="col-md-3">
                    <select name="sorting" id="sorting" data-page="{{ $products->currentPage() }}">
                        <option value="popular" @if($sorting == "popular") {{ 'selected' }} @endif>По попуярности</option>
                        <option value="price-asc" @if($sorting == "price-asc") {{ 'selected' }} @endif>По возрастанию цены</option>
                        <option value="price-desc" @if($sorting == "price-desc") {{ 'selected' }} @endif>По убыванию цены</option>
                    </select>
                </div>
            </div>

            @if($products->total() > $products->perPage())
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            @if ($products->currentPage() != 1)
                                <li class="page-item" data-page="1"><a class="page-link">1</a></li>
                            @endif
                            @if ($products->currentPage() > 2)
                                <li class="page-item" data-page="{{ $products->currentPage() - 1 }}"><a class="page-link"><<</a></li>
                            @endif
                            <li class="page-item active" data-page="{{ $products->currentPage() }}"><a class="page-link ">{{ $products->currentPage() }}</a></li>
                            @if ($products->currentPage() < $products->lastPage())
                                <li class="page-item" data-page="{{ $products->currentPage() + 1 }}"><a class="page-link">>></a></li>
                            @endif
                            @if ($products->currentPage() + 1 < $products->lastPage())
                                <li class="page-item" data-page="{{ $products->lastPage() }}"><a class="page-link">{{ $products->lastPage() }}</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @endif

            <div class="row">
                @foreach($products as $product)
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <a href="{{ route('product-card', ['id' => $product->id, 'slug' => $product->getFullSlug()]) }}" class="">
                                @if(!empty($product->mainImage->url))
                                    <img class="card-img-top stock-img img-fluid" src="{{ @asset("storage/app/{$product->mainImage->url}") }}" alt="Card image cap">
                                @else
                                    <img class="card-img-top stock-img img-fluid" src="{{ @asset("storage/app/default-image.jpg") }}" alt="Card image cap">
                                @endif
                            </a>
                            <div class="card-body">
                                <h3 class="card-title">{{ $product->name }}</h3>
                                <h3 class="card-title">Продано: {{ $product->orders->sum("quantity") }}</h3>
                                <p class="card-text">Цена: {{ $product->realPrice }}</p>
                                <p class="card-text">Количество: {{ $product->quantity }}</p>
                                <button data-id="{{ $product->id }}" class="btn btn-primary add-to-basket">Купить</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($products->total() > $products->perPage())
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            @if ($products->currentPage() != 1)
                                <li class="page-item" data-page="1"><a class="page-link">1</a></li>
                            @endif
                            @if ($products->currentPage() > 2)
                                <li class="page-item" data-page="{{ $products->currentPage() - 1 }}"><a class="page-link"><<</a></li>
                            @endif
                            <li class="page-item active" data-page="{{ $products->currentPage() }}"><a class="page-link ">{{ $products->currentPage() }}</a></li>
                            @if ($products->currentPage() < $products->lastPage())
                                <li class="page-item" data-page="{{ $products->currentPage() + 1 }}"><a class="page-link">>></a></li>
                            @endif
                            @if ($products->currentPage() + 1 < $products->lastPage())
                                <li class="page-item" data-page="{{ $products->lastPage() }}"><a class="page-link">{{ $products->lastPage() }}</a></li>
                            @endif

                            {{--@if ($products->currentPage() != 1)--}}
                                {{--<li class="page-item" data-page="1"><a class="page-link" href="{{ route('main') }}">1</a></li>--}}
                            {{--@endif--}}
                            {{--@if ($products->currentPage() > 2)--}}
                                {{--<li class="page-item" data-page="{{ $products->currentPage() - 1 }}"><a class="page-link" href="{{ route('main', ['page' => $products->currentPage() - 1]) }}"><<</a></li>--}}
                            {{--@endif--}}
                            {{--<li class="page-item active" data-page="{{ $products->currentPage() }}"><a class="page-link " href="">{{ $products->currentPage() }}</a></li>--}}
                            {{--@if ($products->currentPage() < $products->lastPage())--}}
                                {{--<li class="page-item" data-page="{{ $products->currentPage() + 1 }}"><a class="page-link" href="{{ route('main', ['page' => $products->currentPage() + 1]) }}">>></a></li>--}}
                            {{--@endif--}}
                            {{--@if ($products->currentPage() + 1 < $products->lastPage())--}}
                                {{--<li class="page-item" data-page="{{ $products->lastPage() }}"><a class="page-link" href="{{ route('main', ['page' => $products->lastPage()]) }}">{{ $products->lastPage() }}</a></li>--}}
                            {{--@endif--}}
                        </ul>
                    </nav>
                </div>
            @endif
            {{--<br><br>--}}
        {{--</div>--}}
    {{--@endif--}}
{{--@endforeach--}}