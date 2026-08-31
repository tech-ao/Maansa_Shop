@foreach($datas as $data)
<tr>
    <td style="min-width: 160px;">
        <div class="font-weight-bold text-dark" style="font-size: 14px;">
            {{ $data->name }}
        </div>
    </td>

    <td style="min-width: 100px;">
        <div style="width: 64px; height: 44px; border-radius: 8px; overflow: hidden; background: #ffffff; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; padding: 3px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);">
            <img src="{{ $data->photo ? url('/core/public/storage/images/'.$data->photo) : url('/core/public/storage/images/placeholder.png') }}"
                onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';"
                alt="{{ $data->name }}"
                style="max-width: 100%; max-height: 100%; object-fit: contain;">
        </div>
    </td>

    <td style="min-width: 150px;">
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
                <h6 class="dropdown-header text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">{{ __('Brand Status') }}</h6>
                <a class="dropdown-item {{ $data->status == 1 ? 'active font-weight-bold' : '' }}" href="{{ route('back.brand.status', [$data->id, 1, 'status']) }}">
                    <i class="fa-solid fa-check text-success mr-2"></i> {{ __('Enable Brand') }}
                </a>
                <a class="dropdown-item {{ $data->status == 0 ? 'active font-weight-bold' : '' }}" href="{{ route('back.brand.status', [$data->id, 0, 'status']) }}">
                    <i class="fa-solid fa-xmark text-danger mr-2"></i> {{ __('Disable Brand') }}
                </a>
            </div>
        </div>
    </td>

    <td style="min-width: 130px;">
        <div class="dropdown d-inline-block">
            <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownPopular-{{ $data->id }}" 
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                style="border-radius: 20px; font-size: 12px; font-weight: 700; padding: 5px 14px; {{ $data->is_popular == 1 ? 'background: #fef3c7; color: #b45309; border: 1px solid #fde68a;' : 'background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0;' }}">
                <i class="fa-solid {{ $data->is_popular == 1 ? 'fa-star text-warning' : 'fa-star text-muted' }} mr-1"></i>
                {{ $data->is_popular == 1 ? __('Popular') : __('Normal') }}
            </button>
            <div class="dropdown-menu animated--fade-in shadow border-0" aria-labelledby="dropdownPopular-{{ $data->id }}" style="border-radius: 12px; min-width: 170px;">
                <h6 class="dropdown-header text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">{{ __('Popular Tag') }}</h6>
                <a class="dropdown-item {{ $data->is_popular == 1 ? 'active font-weight-bold' : '' }}" href="{{ route('back.brand.status', [$data->id, 1, 'is_popular']) }}">
                    <i class="fa-solid fa-star text-warning mr-2"></i> {{ __('Set Popular') }}
                </a>
                <a class="dropdown-item {{ $data->is_popular == 0 ? 'active font-weight-bold' : '' }}" href="{{ route('back.brand.status', [$data->id, 0, 'is_popular']) }}">
                    <i class="fa-solid fa-minus text-muted mr-2"></i> {{ __('Set Normal') }}
                </a>
            </div>
        </div>
    </td>

    <td class="text-right" style="min-width: 100px;">
        <div class="action-btn-group justify-content-end">
            <a class="btn-action-icon btn-action-edit" href="{{ route('back.brand.edit', $data->id) }}" title="{{ __('Edit Brand') }}">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <a class="btn-action-icon btn-action-delete" data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.brand.destroy', $data->id) }}" title="{{ __('Delete Brand') }}">
                <i class="fa-solid fa-trash-can"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
