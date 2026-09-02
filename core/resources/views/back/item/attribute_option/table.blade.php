@foreach($datas as $data)
    <tr>
        <td>
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mr-2 flex-shrink-0" style="width: 32px; height: 32px; background: #ecfdf5; color: #059669; font-size: 13px;">
                    <i class="fa-solid fa-shapes"></i>
                </div>
                <div>
                    <span class="font-weight-bold text-dark d-block" style="font-size: 14px;">{{ $data->name }}</span>
                    @if($data->keyword)
                        <small class="text-muted font-monospace">{{ $data->keyword }}</small>
                    @endif
                </div>
            </div>
        </td>
        <td>
            <span class="badge badge-light border px-2.5 py-1 text-dark" style="border-radius: 8px; font-weight: 600; font-size: 12.5px; background: #f8fafc;">
                <i class="fa-solid fa-tag text-muted mr-1"></i>{{ $data->attribute }}
            </span>
        </td>
        <td>
            @if($data->price == 0)
                <span class="badge badge-success px-2.5 py-1" style="border-radius: 8px; font-weight: 700; font-size: 12px; background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                    <i class="fa-solid fa-check mr-1"></i>{{ __('Free / Base Price') }}
                </span>
            @else
                <span class="font-weight-bold text-dark" style="font-size: 14px;">
                    <span class="text-success font-weight-bold">+</span> {{ PriceHelper::adminCurrencyPrice($data->price) }}
                </span>
            @endif
        </td>
        <td>
            @if ($data->stock == 'unlimited')
                <span class="badge badge-info px-2.5 py-1" style="background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; border-radius: 999px; font-weight: 700; font-size: 12px;">
                    <i class="fa-solid fa-infinity mr-1"></i>{{ __('Unlimited') }}
                </span>
            @elseif ($data->stock === '0' || $data->stock === 0)
                <span class="badge badge-danger px-2.5 py-1" style="background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; border-radius: 999px; font-weight: 700; font-size: 12px;">
                    <i class="fa-solid fa-triangle-exclamation mr-1"></i>{{ __('Out of Stock') }}
                </span>
            @elseif ($data->stock < 10)
                <span class="badge badge-warning px-2.5 py-1" style="background: #fffbeb; color: #d97706; border: 1px solid #fde68a; border-radius: 999px; font-weight: 700; font-size: 12px;">
                    <i class="fa-solid fa-box-open mr-1"></i>{{ $data->stock }} {{ __('Left (Low)') }}
                </span>
            @else
                <span class="badge badge-light border px-2.5 py-1 text-dark" style="border-radius: 999px; font-weight: 700; font-size: 12px; background: #f8fafc;">
                    <i class="fa-solid fa-boxes-stacked text-primary mr-1"></i>{{ $data->stock }} {{ __('Units') }}
                </span>
            @endif
        </td>
        <td class="text-center">
            <div class="action-list d-inline-flex align-items-center gap-1">
                <a class="btn btn-action-edit btn-sm"
                    href="{{ route('back.option.edit', [$item->id, $data->id]) }}"
                    title="{{ __('Edit Option') }}"
                    style="width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe;">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a class="btn btn-action-delete btn-sm" data-toggle="modal"
                    data-target="#confirm-delete" href="javascript:;"
                    data-href="{{ route('back.option.destroy', [$item->id, $data->id]) }}"
                    title="{{ __('Delete Option') }}"
                    style="width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: #fef2f2; color: #dc2626; border: 1px solid #fecaca;">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </div>
        </td>
    </tr>
@endforeach
