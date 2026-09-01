@foreach($datas as $data)
<tr>
    <td class="align-middle">
        <div class="d-flex align-items-center">
            <div style="width: 36px; height: 36px; border-radius: 10px; background: #f0fdf4; color: #059669; border: 1px solid #c7d2fe; display: flex; align-items: center; justify-content: center; font-size: 15px; margin-right: 12px; flex-shrink: 0;">
                <i class="fa-solid fa-circle-question"></i>
            </div>
            <span class="font-weight-bold text-dark" style="font-size: 14px;">{{ $data->title }}</span>
        </div>
    </td>
    <td class="align-middle">
        <span class="badge" style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 6px;">
            <i class="fa-solid fa-folder mr-1"></i> {{ $data->category->name ?? __('Uncategorized') }}
        </span>
    </td>
    <td class="align-middle">
        <span class="text-secondary" style="font-size: 13.5px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
            {{ $data->details }}
        </span>
    </td>
    <td class="text-center align-middle">
        <div class="d-inline-flex align-items-center gap-2">
            <a class="btn-action-icon btn-action-edit mr-1"
               href="{{ route('back.faq.edit', $data->id) }}"
               title="{{ __('Edit FAQ') }}">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <a class="btn-action-icon btn-action-delete"
               data-toggle="modal"
               data-target="#confirm-delete"
               href="javascript:;"
               data-href="{{ route('back.faq.destroy', $data->id) }}"
               title="{{ __('Delete FAQ') }}">
                <i class="fa-solid fa-trash-can"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
