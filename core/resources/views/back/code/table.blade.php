@foreach($datas as $data)
    <tr>
        <td style="min-width: 180px;">
            <div class="font-weight-bold text-dark mb-1" style="font-size: 13.5px; line-height: 1.35;">
                {{ $data->title }}
            </div>
        </td>

        <td style="min-width: 140px;">
            <span class="badge-txn-code" style="font-size: 13px; font-weight: 800; text-transform: uppercase;">
                <i class="fa-solid fa-ticket mr-1"></i> {{ $data->code_name }}
            </span>
        </td>

        <td class="text-center" style="min-width: 110px;">
            <span class="badge badge-light border text-dark font-weight-bold px-3 py-1" style="font-size: 12px; border-radius: 8px;">
                <i class="fa-solid fa-users mr-1 text-muted"></i> {{ $data->no_of_times }} {{ __('uses') }}
            </span>
        </td>

        <td class="text-center" style="min-width: 130px;">
            @if ($data->type == 'amount')
                <span class="badge px-3 py-1 font-weight-bold" style="background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; font-size: 12.5px; border-radius: 8px;">
                    <i class="fa-solid fa-tag mr-1"></i> {{ PriceHelper::adminCurrencyPrice($data->discount) }}
                </span>
            @else
                <span class="badge px-3 py-1 font-weight-bold" style="background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; font-size: 12.5px; border-radius: 8px;">
                    <i class="fa-solid fa-percent mr-1"></i> {{ $data->discount }}% OFF
                </span>
            @endif
        </td>

        <td class="text-center" style="min-width: 115px;">
            <div class="dropdown d-inline-block">
                <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownStatus-{{ $data->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    style="border-radius: 20px; font-size: 11.5px; font-weight: 700; padding: 4px 12px; {{ $data->status == 1 ? 'background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0;' : 'background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca;' }}">
                    <i class="fa-solid {{ $data->status == 1 ? 'fa-circle-check' : 'fa-circle-xmark' }} mr-1"></i>
                    {{ $data->status == 1 ? __('Enabled') : __('Disabled') }}
                </button>
                <div class="dropdown-menu animated--fade-in shadow border-0" aria-labelledby="dropdownStatus-{{ $data->id }}" style="border-radius: 12px; min-width: 140px;">
                    <h6 class="dropdown-header text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">{{ __('Coupon Status') }}</h6>
                    <a class="dropdown-item {{ $data->status == 1 ? 'active font-weight-bold' : '' }}" href="{{ route('back.code.status', [$data->id, 1]) }}">
                        <i class="fa-solid fa-check text-success mr-2"></i> {{ __('Enable') }}
                    </a>
                    <a class="dropdown-item {{ $data->status == 0 ? 'active font-weight-bold' : '' }}" href="{{ route('back.code.status', [$data->id, 0]) }}">
                        <i class="fa-solid fa-xmark text-danger mr-2"></i> {{ __('Disable') }}
                    </a>
                </div>
            </div>
        </td>

        <td class="text-center" style="min-width: 100px;">
            <div class="action-btn-group justify-content-center">
                <a class="btn-action-icon btn-action-edit" href="{{ route('back.code.edit', [$data->id]) }}" title="{{ __('Edit Coupon') }}">
                    <i class="fa-solid fa-pen"></i>
                </a>
                <a class="btn-action-icon btn-action-delete" data-toggle="modal" data-target="#confirm-delete" href="javascript:;"
                    data-href="{{ route('back.code.destroy', [$data->id]) }}" title="{{ __('Delete Coupon') }}">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </div>
        </td>
    </tr>
@endforeach
