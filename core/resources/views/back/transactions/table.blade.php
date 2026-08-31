@foreach($datas as $data)
<tr id="transaction-bulk-delete">
    <td>
        <input type="checkbox" class="bulk-item" value="{{ $data->id }}" style="cursor: pointer; width: 16px; height: 16px;">
    </td>

    <td>
        <div class="d-flex align-items-center" style="gap: 10px;">
            <div class="ticket-user-avatar" style="width: 34px; height: 34px; min-width: 34px; font-size: 13px;">
                <i class="fa-solid fa-user"></i>
            </div>
            <div>
                @if ($data->user && $data->user->id)
                    <a href="{{ route('back.user.show', $data->user->id) }}" class="ticket-user-name" style="text-decoration: none;">
                        {{ $data->user_email }}
                    </a>
                @else
                    <span class="ticket-user-name">{{ $data->user_email }}</span>
                @endif
            </div>
        </div>
    </td>

    <td>
        <a href="{{ route('back.order.invoice', $data->order_id) }}" class="badge-txn-code" title="{{ __('View Order Invoice') }}">
            <i class="fa-solid fa-receipt"></i>
            <span>{{ $data->txn_id }}</span>
        </a>
    </td>

    <td>
        @if($data->order && $data->order->order_status == 'Delivered')
            <span class="badge-status badge-status-paid"><i class="fa-solid fa-truck mr-1"></i> {{ __('Delivered') }}</span>
        @elseif($data->order && $data->order->order_status == 'Canceled')
            <span class="badge-status badge-status-unpaid"><i class="fa-solid fa-ban mr-1"></i> {{ __('Canceled') }}</span>
        @elseif($data->order && $data->order->order_status == 'In Progress')
            <span class="badge-status badge-status-open"><i class="fa-solid fa-spinner mr-1"></i> {{ __('In Progress') }}</span>
        @else
            <span class="badge-status badge-status-pending"><i class="fa-solid fa-clock mr-1"></i> {{ $data->order ? $data->order->order_status : __('Pending') }}</span>
        @endif
    </td>

    <td>
        @if($data->order && $data->order->payment_status == 'Paid')
            <span class="badge-status badge-status-paid"><i class="fa-solid fa-circle-check mr-1"></i> {{ __('Paid') }}</span>
        @else
            <span class="badge-status badge-status-unpaid"><i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $data->order ? $data->order->payment_status : __('Unpaid') }}</span>
        @endif
    </td>

    <td>
        <span class="font-weight-bold" style="font-size: 14.5px; color: #0f172a;">
            @if ($setting->currency_direction == 1)
                {{ $data->currency_sign }}{{ round($data->amount * $data->currency_value, 2) }}
            @else
                {{ round($data->amount * $data->currency_value, 2) }}{{ $data->currency_sign }}
            @endif
        </span>
    </td>

    <td class="text-right">
        <div class="action-btn-group justify-content-end">
            <a class="btn-action-icon btn-action-view" href="{{ route('back.order.invoice', $data->order_id) }}" title="{{ __('View Invoice') }}">
                <i class="fa-solid fa-file-invoice"></i>
            </a>
            <a class="btn-action-icon btn-action-delete" data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.transaction.delete', $data->id) }}" title="{{ __('Delete') }}">
                <i class="fa-solid fa-trash-can"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
