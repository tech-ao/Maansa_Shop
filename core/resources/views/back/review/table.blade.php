
@foreach($datas as $data)
<tr>
    <td style="min-width: 160px;">
        <div class="d-flex align-items-center">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mr-2 font-weight-bold" style="width: 36px; height: 36px; min-width: 36px; background: #f0fdf4; color: #059669; font-size: 13px;">
                {{ substr($data->user ? $data->user->first_name : 'U', 0, 1) }}
            </div>
            <div>
                <div class="font-weight-bold text-dark" style="font-size: 13.5px;">{{ $data->user ? $data->user->displayName() : __('Anonymous') }}</div>
                @if($data->user && $data->user->email)
                    <div class="text-muted small" style="font-size: 11.5px;">{{ $data->user->email }}</div>
                @endif
            </div>
        </div>
    </td>

    <td style="min-width: 220px;">
        @if($data->item)
            <a href="{{ route('front.product', $data->item->slug) }}" target="_blank" class="font-weight-bold text-dark hover-primary d-inline-flex align-items-center" style="font-size: 13.5px; line-height: 1.35; text-decoration: none;">
                {{ $data->item->name }}
                <i class="fa-solid fa-arrow-up-right-from-square ml-1 text-primary small" style="font-size: 10px;"></i>
            </a>
        @else
            <span class="text-muted font-italic">{{ __('Deleted Product') }}</span>
        @endif
    </td>

    <td class="text-center" style="min-width: 120px;">
        <div class="d-inline-flex align-items-center px-2 py-1" style="background: #fefce8; border: 1px solid #fef08a; border-radius: 8px;">
            <div class="text-warning mr-1" style="font-size: 12px;">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $data->rating)
                        <i class="fa-solid fa-star" style="color: #f59e0b;"></i>
                    @else
                        <i class="fa-regular fa-star" style="color: #cbd5e1;"></i>
                    @endif
                @endfor
            </div>
            <span class="font-weight-bold text-dark small">({{ $data->rating }}/5)</span>
        </div>
    </td>

    <td class="text-center" style="min-width: 115px;">
        <div class="dropdown d-inline-block">
            <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownStatus-{{ $data->id }}" 
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                style="border-radius: 20px; font-size: 11.5px; font-weight: 700; padding: 4px 12px; {{ $data->status == 1 ? 'background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0;' : 'background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca;' }}">
                <i class="fa-solid {{ $data->status == 1 ? 'fa-circle-check' : 'fa-circle-xmark' }} mr-1"></i>
                {{ $data->status == 1 ? __('Enabled') : __('Disabled') }}
            </button>
            <div class="dropdown-menu animated--fade-in shadow border-0" aria-labelledby="dropdownStatus-{{ $data->id }}" style="border-radius: 12px; min-width: 140px;">
                <h6 class="dropdown-header text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">{{ __('Review Status') }}</h6>
                <a class="dropdown-item {{ $data->status == 1 ? 'active font-weight-bold' : '' }}" href="{{ route('back.review.status', [$data->id, 1]) }}">
                    <i class="fa-solid fa-check text-success mr-2"></i> {{ __('Enable') }}
                </a>
                <a class="dropdown-item {{ $data->status == 0 ? 'active font-weight-bold' : '' }}" href="{{ route('back.review.status', [$data->id, 0]) }}">
                    <i class="fa-solid fa-xmark text-danger mr-2"></i> {{ __('Disable') }}
                </a>
            </div>
        </div>
    </td>

    <td class="text-center" style="min-width: 100px;">
        <div class="action-btn-group justify-content-center">
            <a class="btn-action-icon btn-action-view" href="{{ route('back.review.show', $data->id) }}" title="{{ __('View Details') }}">
                <i class="fa-solid fa-eye"></i>
            </a>
            <a class="btn-action-icon btn-action-delete" data-toggle="modal"
                data-target="#confirm-delete" href="javascript:;"
                data-href="{{ route('back.review.destroy', $data->id) }}" title="{{ __('Delete Review') }}">
                <i class="fa-solid fa-trash-can"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
