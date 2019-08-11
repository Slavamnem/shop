<table id="example4" class="table table-striped table-bordered" style="width:75%">
    <thead>
        <tr>
            <td>#</td>
            @foreach(array_keys($data[0]) as $key)
                <td>{{$key}}</td>
            @endforeach
        </tr>
    </thead>
    <tbody>
    @forelse($data as $id => $item)
        <tr>
            <td>{{ ($id + 1) }}</td>
            @foreach($item as $value)
                <td>{{ $value }}</td>
            @endforeach
        </tr>
    @empty
        <p>Данных нет</p>
    @endforelse
    </tbody>
</table>