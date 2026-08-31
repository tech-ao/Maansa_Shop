@foreach($datas as $data)
<tr>
    <td style="min-width: 180px;">
        <div class="font-weight-bold text-dark" style="font-size: 14px;">
            {{ $data->name }}
        </div>
    </td>

    <td style="min-width: 160px;">
        <span class="badge badge-light border text-muted" style="font-family: monospace; font-size: 12px; padding: 5px 10px; border-radius: 6px;">
            /{{ $data->slug }}
        </span>
    </td>

    <td style="min-width: 130px;">
        <div class="dropdown d-inline-block">
            <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownStatus-{{ $data->id }}" 
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                style="border-radius: 20px; font-size: 12px; font-weight: 700; padding: 5px 14px; {{ $data->status == 1 ? 'background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0;' : 'background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca;' }}">
                <i class="fa-solid {{ $data->status == 1 ? 'fa-circle-check' : 'fa-circle-xmark' }} mr-1"></i>
                {{ $data->status == 1 ? __('Enabled') : __('Disabled') }}
            </button>
            <div class="dropdown-menu animated--fade-in shadow border-0" aria-labelledby="dropdownStatus-{{ $data->id }}" style="border-radius: 12px; min-width: 170px;">
                <h6 class="dropdown-header text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">{{ __('Change Status') }}</h6>
                <a class="dropdown-item {{ $data->status == 1 ? 'active font-weight-bold' : '' }}" href="{{ route('back.bcategory.status', [$data->id, 1]) }}">
                    <i class="fa-solid fa-check text-success mr-2"></i> {{ __('Enable Category') }}
                </a>
                <a class="dropdown-item {{ $data->status == 0 ? 'active font-weight-bold' : '' }}" href="{{ route('back.bcategory.status', [$data->id, 0]) }}">
                    <i class="fa-solid fa-xmark text-danger mr-2"></i> {{ __('Disable Category') }}
                </a>
            </div>
        </div>
    </td>

    <td class="text-right" style="min-width: 100px;">
        <div class="action-btn-group justify-content-end">
            <a class="btn-action-icon btn-action-edit" href="{{ route('back.bcategory.edit', $data->id) }}" title="{{ __('Edit Category') }}">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <a class="btn-action-icon btn-action-delete" data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.bcategory.destroy', $data->id) }}" title="{{ __('Delete Category') }}">
                <i class="fa-solid fa-trash-can"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
