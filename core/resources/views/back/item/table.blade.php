@foreach($datas as $data)
<tr id="product-bulk-delete">
    <td class="text-center" style="width: 40px; vertical-align: middle;">
        <input type="checkbox" class="bulk-item cursor-pointer" value="{{ $data->id }}" style="width: 16px; height: 16px;">
    </td>

    <td class="text-center" style="width: 65px;">
        <div class="mx-auto" style="width: 48px; height: 48px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04); padding: 2px;">
            <img src="{{ $data->thumbnail ? url('/core/public/storage/images/'.$data->thumbnail) : url('/core/public/storage/images/placeholder.png') }}"
                onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';"
                alt="{{ $data->name }}"
                style="max-width: 100%; max-height: 100%; object-fit: cover; border-radius: 8px;">
        </div>
    </td>

    <td style="min-width: 200px;">
        <div class="font-weight-bold text-dark mb-1" style="font-size: 13.5px; line-height: 1.35;">
            {{ $data->name }}
        </div>
        @if($data->sku)
            <span class="badge badge-light border text-muted" style="font-size: 11px; font-family: monospace;">SKU: {{ $data->sku }}</span>
        @endif
    </td>

    <td style="min-width: 100px;">
        <span class="font-weight-bold text-dark" style="font-size: 13.5px;">
            {{ PriceHelper::adminCurrencyPrice($data->discount_price) }}
        </span>
        @if($data->previous_price && $data->previous_price > $data->discount_price)
            <div class="text-muted small" style="text-decoration: line-through; font-size: 11px;">
                {{ PriceHelper::adminCurrencyPrice($data->previous_price) }}
            </div>
        @endif
    </td>

    <td class="text-center" style="min-width: 115px;">
        <div class="dropdown d-inline-block">
            <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownStatus-{{ $data->id }}" 
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                style="border-radius: 20px; font-size: 11.5px; font-weight: 700; padding: 4px 12px; {{ $data->status == 1 ? 'background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0;' : 'background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca;' }}">
                <i class="fa-solid {{ $data->status == 1 ? 'fa-circle-check' : 'fa-circle-xmark' }} mr-1"></i>
                {{ $data->status == 1 ? __('Publish') : __('Unpublish') }}
            </button>
            <div class="dropdown-menu animated--fade-in shadow border-0" aria-labelledby="dropdownStatus-{{ $data->id }}" style="border-radius: 12px; min-width: 160px;">
                <h6 class="dropdown-header text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">{{ __('Product Status') }}</h6>
                <a class="dropdown-item {{ $data->status == 1 ? 'active font-weight-bold' : '' }}" href="{{ route('back.item.status', [$data->id, 1]) }}">
                    <i class="fa-solid fa-check text-success mr-2"></i> {{ __('Publish') }}
                </a>
                <a class="dropdown-item {{ $data->status == 0 ? 'active font-weight-bold' : '' }}" href="{{ route('back.item.status', [$data->id, 0]) }}">
                    <i class="fa-solid fa-xmark text-danger mr-2"></i> {{ __('Unpublish') }}
                </a>
            </div>
        </div>
    </td>

    <td class="text-center" style="min-width: 110px;">
        @if($data->is_type == 'feature')
            <span class="badge" style="background: #e0e7ff; color: #4338ca; font-weight: 700; font-size: 11px; padding: 4px 9px; border-radius: 8px;">
                {{ __('Featured') }}
            </span>
        @elseif($data->is_type == 'best')
            <span class="badge" style="background: #e0f2fe; color: #0369a1; font-weight: 700; font-size: 11px; padding: 4px 9px; border-radius: 8px;">
                {{ __('Best Seller') }}
            </span>
        @elseif($data->is_type == 'top')
            <span class="badge" style="background: #fef3c7; color: #b45309; font-weight: 700; font-size: 11px; padding: 4px 9px; border-radius: 8px;">
                {{ __('Top Rated') }}
            </span>
        @elseif($data->is_type == 'flash_deal')
            <span class="badge" style="background: #fee2e2; color: #b91c1c; font-weight: 700; font-size: 11px; padding: 4px 9px; border-radius: 8px;">
                {{ __('Flash Deal') }}
            </span>
        @elseif($data->is_type == 'new')
            <span class="badge" style="background: #dcfce7; color: #15803d; font-weight: 700; font-size: 11px; padding: 4px 9px; border-radius: 8px;">
                {{ __('New Arrival') }}
            </span>
        @else
            <span class="badge badge-light border text-muted" style="font-size: 11px; padding: 4px 8px; border-radius: 6px;">
                {{ __('Standard') }}
            </span>
        @endif
    </td>

    <td class="text-center" style="min-width: 110px;">
        @if($data->item_type == 'normal')
            <span class="badge badge-light border text-dark" style="font-size: 11px; font-weight: 600; padding: 4px 9px; border-radius: 8px;">
                <i class="fa-solid fa-box-open mr-1 text-primary"></i> {{ __('Physical') }}
            </span>
        @elseif($data->item_type == 'digital')
            <span class="badge badge-light border text-dark" style="font-size: 11px; font-weight: 600; padding: 4px 9px; border-radius: 8px;">
                <i class="fa-solid fa-cloud-arrow-down mr-1 text-info"></i> {{ __('Digital') }}
            </span>
        @elseif($data->item_type == 'license')
            <span class="badge badge-light border text-dark" style="font-size: 11px; font-weight: 600; padding: 4px 9px; border-radius: 8px;">
                <i class="fa-solid fa-key mr-1" style="color: #8b5cf6;"></i> {{ __('License') }}
            </span>
        @elseif($data->item_type == 'affiliate')
            <span class="badge badge-light border text-dark" style="font-size: 11px; font-weight: 600; padding: 4px 9px; border-radius: 8px;">
                <i class="fa-solid fa-arrow-up-right-from-square mr-1 text-success"></i> {{ __('Affiliate') }}
            </span>
        @else
            <span class="badge badge-light border text-dark" style="font-size: 11px; font-weight: 600; padding: 4px 9px; border-radius: 8px;">
                {{ ucfirst($data->item_type) }}
            </span>
        @endif
    </td>

    <td class="text-center" style="min-width: 110px;">
        <div class="dropdown d-inline-block">
            <button class="btn btn-sm btn-light border dropdown-toggle font-weight-bold" type="button" id="dropdownOptions-{{ $data->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-radius: 10px; font-size: 12px; padding: 5px 12px; background: #ffffff; color: #334155; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                {{ __('Options') }}
            </button>
            <div class="dropdown-menu dropdown-menu-right animated--fade-in shadow-lg border-0" aria-labelledby="dropdownOptions-{{ $data->id }}" style="border-radius: 12px; min-width: 180px; padding: 8px;">
                @php
                    $editRoute = route('back.item.edit', $data->id);
                    if ($data->item_type == 'digital') $editRoute = route('back.digital.item.edit', $data->id);
                    elseif ($data->item_type == 'affiliate') $editRoute = route('back.affiliate.edit', $data->id);
                    elseif ($data->item_type == 'license') $editRoute = route('back.license.item.edit', $data->id);
                @endphp
                <a class="dropdown-item py-2" href="{{ $editRoute }}" style="border-radius: 8px; font-size: 13px; font-weight: 600;">
                    <i class="fa-solid fa-pen-to-square text-primary mr-2"></i> {{ __('Edit Product') }}
                </a>
                @if($data->status == 1)
                    <a class="dropdown-item py-2" target="_blank" href="{{ route('front.product', $data->slug) }}" style="border-radius: 8px; font-size: 13px; font-weight: 600;">
                        <i class="fa-solid fa-arrow-up-right-from-square text-info mr-2"></i> {{ __('View Live') }}
                    </a>
                @endif
                @if ($data->item_type == 'normal')
                    <a class="dropdown-item py-2" href="{{ route('back.attribute.index', $data->id) }}" style="border-radius: 8px; font-size: 13px; font-weight: 600;">
                        <i class="fa-solid fa-sliders text-secondary mr-2"></i> {{ __('Attributes') }}
                    </a>
                    <a class="dropdown-item py-2" href="{{ route('back.option.index', $data->id) }}" style="border-radius: 8px; font-size: 13px; font-weight: 600;">
                        <i class="fa-solid fa-list-check text-secondary mr-2"></i> {{ __('Attribute Options') }}
                    </a>
                @endif
                <a class="dropdown-item py-2" href="{{ route('back.item.highlight', $data->id) }}" style="border-radius: 8px; font-size: 13px; font-weight: 600;">
                    <i class="fa-solid fa-star text-warning mr-2"></i> {{ __('Highlight') }}
                </a>
                <div class="dropdown-divider my-1"></div>
                <a class="dropdown-item py-2 text-danger font-weight-bold" data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.item.destroy', $data->id) }}" style="border-radius: 8px; font-size: 13px;">
                    <i class="fa-solid fa-trash-can text-danger mr-2"></i> {{ __('Delete') }}
                </a>
            </div>
        </div>
    </td>
</tr>
@endforeach
