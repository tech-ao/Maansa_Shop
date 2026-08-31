@foreach($datas as $data)
<tr>
    <td>
        <div class="d-flex align-items-center" style="gap: 12px;">
            <div class="ticket-user-avatar">
                <i class="fa-solid fa-user"></i>
            </div>
            <div>
                <a href="{{ route('back.user.show', $data->id) }}" class="ticket-user-name" style="text-decoration: none;">
                    {{ $data->first_name }} {{ $data->last_name }}
                </a>
                <span class="ticket-user-email">
                    <i class="fa-regular fa-clock mr-1"></i> {{ __('Joined') }} {{ $data->created_at ? $data->created_at->diffForHumans() : __('N/A') }}
                </span>
            </div>
        </div>
    </td>

    <td>
        <a href="mailto:{{ $data->email }}" class="text-dark font-weight-600" style="font-size: 13.5px; text-decoration: none;">
            <i class="fa-regular fa-envelope text-primary mr-1"></i> {{ $data->email }}
        </a>
    </td>

    <td>
        @if($data->phone)
            <a href="tel:{{ $data->phone }}" class="text-muted" style="font-size: 13.5px; text-decoration: none;">
                <i class="fa-solid fa-phone text-success mr-1"></i> {{ $data->phone }}
            </a>
        @else
            <span class="text-muted" style="font-size: 12.5px;">{{ __('Not Provided') }}</span>
        @endif
    </td>

    <td class="text-right">
        <div class="action-btn-group justify-content-end">
            <a class="btn-action-icon btn-action-view" href="{{ route('back.user.show', $data->id) }}" title="{{ __('View Details') }}">
                <i class="fa-solid fa-eye"></i>
            </a>
            <a class="btn-action-icon btn-action-delete" data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.user.destroy', $data->id) }}" title="{{ __('Delete') }}">
                <i class="fa-solid fa-trash-can"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
