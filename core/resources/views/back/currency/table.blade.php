@foreach($datas as $data)
<tr>
    <td style="min-width: 160px;">
        <div class="font-weight-bold text-dark d-flex align-items-center" style="font-size: 13.5px;">
            <div class="d-inline-flex align-items-center justify-content-center bg-primary-light rounded-circle mr-2" style="width: 32px; height: 32px; min-width: 32px; background: #eef2ff; color: #4f46e5; font-size: 13px;">
                <i class="fa-solid fa-coins"></i>
            </div>
            <span>{{ $data->name }}</span>
        </div>
    </td>

    <td class="text-center" style="min-width: 120px;">
        <span class="badge-txn-code" style="font-size: 14px; font-weight: 800;">
            {{ $data->sign }}
        </span>
    </td>

    <td class="text-center" style="min-width: 130px;">
        <span class="font-weight-bold text-dark" style="font-size: 13.5px;">
            {{ $data->value }}
        </span>
    </td>

    <td class="text-center" style="min-width: 140px;">
        @if ($data->is_default == 1)
            <span class="badge px-3 py-1 font-weight-bold" style="background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; font-size: 12px; border-radius: 8px;">
                <i class="fa-solid fa-circle-check mr-1"></i> {{ __('Default') }}
            </span>
        @else
            <div class="dropdown d-inline-block">
                <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownDefault-{{ $data->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    style="border-radius: 20px; font-size: 11.5px; font-weight: 700; padding: 4px 12px; background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0;">
                    <i class="fa-solid fa-sliders mr-1"></i> {{ __('Set Default') }}
                </button>
                <div class="dropdown-menu animated--fade-in shadow border-0" aria-labelledby="dropdownDefault-{{ $data->id }}" style="border-radius: 12px; min-width: 150px;">
                    <h6 class="dropdown-header text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">{{ __('Base Currency') }}</h6>
                    <a class="dropdown-item" href="{{ route('back.currency.status', [$data->id, 1]) }}">
                        <i class="fa-solid fa-check text-success mr-2"></i> {{ __('Set As Default') }}
                    </a>
                </div>
            </div>
        @endif
    </td>

    <td class="text-center" style="min-width: 100px;">
        <div class="action-btn-group justify-content-center">
            <a class="btn-action-icon btn-action-edit" href="{{ route('back.currency.edit', $data->id) }}" title="{{ __('Edit Currency') }}">
                <i class="fa-solid fa-pen"></i>
            </a>
            @if ($data->id != 1)
                <a class="btn-action-icon btn-action-delete" data-toggle="modal" data-target="#confirm-delete" href="javascript:;"
                    data-href="{{ route('back.currency.destroy', $data->id) }}" title="{{ __('Delete Currency') }}">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            @endif
        </div>
    </td>
</tr>
@endforeach
