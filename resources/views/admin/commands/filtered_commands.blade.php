<table id="example4" class="table table-striped table-bordered" style="width:75%">
    <tbody>
    @forelse($commands as $command)
        <tr>
            <td class="command_list_item" data-code="{{ $command->code }}" data-checked="false">
                {{--<a href="{{ route("admin-colors-show", ['id' => $color->id]) }}">--}}
                    {{ $command->name }}
                {{--</a>--}}
            </td>
        </tr>
    @empty
        <p>По Вашему запросу ничего не найдено</p>
    @endforelse
    </tbody>
</table>