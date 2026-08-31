@foreach($datas as $data)
<tr>
    <td class="align-middle">
        <div class="d-flex align-items-center">
            <div style="width: 36px; height: 36px; border-radius: 10px; background: #f0fdf4; color: #059669; border: 1px solid #c7d2fe; display: flex; align-items: center; justify-content: center; font-size: 15px; margin-right: 12px; flex-shrink: 0;">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <div>
                <span class="font-weight-bold text-dark d-block" style="font-size: 14px;">{{ $data->name }}</span>
                <small class="text-muted font-monospace" style="font-size: 11.5px;">{{ $data->slug }}</small>
            </div>
        </div>
    </td>
    <td class="align-middle">
        <span class="text-secondary" style="font-size: 13.5px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
            {{ $data->text ?? __('No description provided.') }}
        </span>
    </td>
    <td class="align-middle">
        <div class="dropdown">
            @if ($data->status == 1)
                <button class="btn btn-sm dropdown-toggle font-weight-bold px-3 py-1"
                        style="background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; border-radius: 8px; font-size: 12px;"
                        type="button" id="dropdownStatus{{ $data->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-circle-check mr-1"></i> {{ __('Enabled') }}
                </button>
            @else
                <button class="btn btn-sm dropdown-toggle font-weight-bold px-3 py-1"
                        style="background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; border-radius: 8px; font-size: 12px;"
                        type="button" id="dropdownStatus{{ $data->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-circle-xmark mr-1"></i> {{ __('Disabled') }}
                </button>
            @endif
            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownStatus{{ $data->id }}">
                <a class="dropdown-item" href="{{ route('back.fcategory.status', [$data->id, 1]) }}">
                    <i class="fa-solid fa-check mr-1 text-success"></i> {{ __('Enable') }}
                </a>
                <a class="dropdown-item" href="{{ route('back.fcategory.status', [$data->id, 0]) }}">
                    <i class="fa-solid fa-ban mr-1 text-danger"></i> {{ __('Disable') }}
                </a>
            </div>
        </div>
    </td>
    <td class="text-center align-middle">
        <div class="d-inline-flex align-items-center gap-2">
            <a class="btn-action-icon btn-action-edit mr-1"
               href="{{ route('back.fcategory.edit', $data->id) }}"
               title="{{ __('Edit Category') }}">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <a class="btn-action-icon btn-action-delete"
               data-toggle="modal"
               data-target="#confirm-delete"
               href="javascript:;"
               data-href="{{ route('back.fcategory.destroy', $data->id) }}"
               title="{{ __('Delete Category') }}">
                <i class="fa-solid fa-trash-can"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
