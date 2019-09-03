<table id="basket-table">
    <thead>
    <tr>
        <th>Название товара</th>
        <th>Цена</th>
        <th>Количество</th>
        <th>Сумма</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        @forelse($basketProducts as $basketProduct)
            <tr>
                <td>{{$basketProduct->getName()}}</td>
                <td>{{$basketProduct->getPrice()}}</td>
                <td>
                    <button data-id="{{ $basketProduct->product->id }}" data-action="decrement" class="btn btn-danger product-change-quantity">-</button>
                    <span id="product-{{$basketProduct->product->id}}-quantity">{{$basketProduct->getQuantity()}}</span>
                    @if($basketProduct->product->getQuantity() > $basketProduct->getQuantity())
                        <button data-id="{{ $basketProduct->product->id }}" data-action="increment" class="btn btn-danger product-change-quantity">+</button>
                    @endif
                </td>
                <td>{{$basketProduct->getTotalPrice()}}</td>
                <td>
                    <img data-id="{{ $basketProduct->product->id }}" class="card-img-top basket-trash img-fluid" src="{{ @asset("storage/app/trash.jpg") }}" alt="">
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">
                    <p align="center">Корзина пуста</p>
                </td>
            </tr>
        @endforelse
    </tbody>
    @if(!empty($sum))
        <tfoot>
        <tr>
            <th colspan="3">Сумма</th>
            <th>{{ $sum }}</th>
        </tr>
        </tfoot>
    @endif
</table>
