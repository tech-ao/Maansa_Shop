@foreach($datas as $data)
<tr>
    <td>
        <div class="d-flex align-items-center" style="gap: 12px;">
            <div class="ticket-user-avatar">
                <i class="fa-solid fa-user"></i>
            </div>
            <div>
                <span class="ticket-user-name">{{ $data->user && $data->user->first_name ? $data->user->first_name . ' ' . $data->user->last_name : __('Guest / Customer') }}</span>
                <span class="ticket-user-email">{{ $data->user->email ?? $data->email ?? '' }}</span>
            </div>
        </div>
    </td>

    <td>
        <a href="{{ route('back.ticket.edit', $data->id) }}" class="ticket-subject-link">
            {{ $data->subject }}
        </a>
    </td>

    <td>
        @if($data->status == 'Pending')
            <span class="badge-status badge-status-pending"><i class="fa-solid fa-clock mr-1"></i> {{ __('Pending') }}</span>
        @elseif($data->status == 'Open')
            <span class="badge-status badge-status-open"><i class="fa-solid fa-circle-dot mr-1"></i> {{ __('Open') }}</span>
        @elseif($data->status == 'Closed')
            <span class="badge-status badge-status-closed"><i class="fa-solid fa-check-circle mr-1"></i> {{ __('Closed') }}</span>
        @else
            <span class="badge-status badge-status-open">{{ $data->status }}</span>
        @endif
    </td>

    <td>
        <span class="ticket-time-text">
            <i class="fa-regular fa-clock mr-1"></i>
            @if ($data->lastMessage)
                {{ \Carbon\Carbon::parse($data->lastMessage->created_at)->diffForHumans() }}
            @else
                {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
            @endif
        </span>
    </td>

    <td class="text-right">
        <div class="action-btn-group justify-content-end">
            <a class="btn-action-icon btn-action-view" href="{{ route('back.ticket.edit', $data->id) }}" title="{{ __('View & Reply') }}">
                <i class="fa-solid fa-eye"></i>
            </a>
            <a class="btn-action-icon btn-action-delete" data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.ticket.destroy', $data->id) }}" title="{{ __('Delete') }}">
                <i class="fa-solid fa-trash-can"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
