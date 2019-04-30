
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
        <p>Корзина пуста</p>
    @endforelse
    </tbody>
    <tfoot>
    <tr>
        <th colspan="3">Сумма</th>
        <th>{{ $sum }}</th>
    </tr>
    </tfoot>
