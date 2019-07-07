
    <thead>
    <tr>
        <th>Название товара</th>
        <th>Цена</th>
        <th>Количество</th>
        <th>Сумма</th>
    </tr>
    </thead>
    <tbody>
        @forelse($basketProducts as $product)
        <tr>
            <td>{{$product->getName()}}</td>
            <td>{{$product->getPrice()}}</td>
            <td>{{$product->getQuantity()}}</td>
            <td>{{$product->getTotalPrice()}}</td>
        </tr>
        @empty
            <tr>
                <td colspan="4">
                    <p align="center">Корзина пуста</p>
                </td>
            </tr>
        @endforelse
    </tbody>
    @if(isset($sum))
        <tfoot>
        <tr>
            <th colspan="3">Сумма</th>
            <th>{{ $sum }}</th>
        </tr>
        </tfoot>
    @endif
