@foreach($datas as $data)
    <tr>
        <td>
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mr-3 flex-shrink-0" style="width: 36px; height: 36px; background: #ecfdf5; color: #059669; font-size: 15px;">
                    <i class="fa-solid fa-sliders"></i>
                </div>
                <div>
                    <span class="font-weight-bold text-dark d-block" style="font-size: 14.5px;">{{ $data->name }}</span>
                    @if($data->keyword)
                        <small class="text-muted font-monospace">{{ $data->keyword }}</small>
                    @endif
                </div>
            </div>
        </td>
        <td class="text-center">
            <div class="action-btn-group">
                <a class="btn-action-icon btn-action-edit"
                    href="{{ route('back.attribute.edit', [$item->id, $data->id]) }}"
                    title="{{ __('Edit Attribute') }}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a class="btn-action-icon btn-action-delete" data-toggle="modal"
                    data-target="#confirm-delete" href="javascript:;"
                    data-href="{{ route('back.attribute.destroy', [$item->id, $data->id]) }}"
                    title="{{ __('Delete Attribute') }}">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </div>
        </td>
    </tr>
@endforeach
<tr class="text-center">
    <td colspan="2" class="py-3 bg-light">
        <a class="btn btn-hero-action btn-hero-secondary"
            href="{{ route('back.option.index', $item->id) }}"
            style="font-size: 13px; font-weight: 700; padding: 8px 18px;">
            <i class="fa-solid fa-list-check mr-1.5"></i> {{ __('Manage Attribute Options (Sizes, Colors, Prices)') }}
        </a>
    </td>
</tr>