@if(isset($activeType) && $activeType === 'failed')
    @if(isset($datas) && count($datas) > 0)
        @foreach($datas as $data)
        <tr id="transaction-bulk-delete">
            <td>
                <input type="checkbox" class="bulk-item" value="{{ $data->id }}" style="cursor: pointer; width: 16px; height: 16px;">
            </td>

            <td>
                <div class="d-flex align-items-center" style="gap: 10px;">
                    <div class="ticket-user-avatar" style="width: 34px; height: 34px; min-width: 34px; font-size: 13px; background: #fee2e2; color: #ef4444;">
                        <i class="fa-solid fa-user-xmark"></i>
                    </div>
                    <div>
                        <div class="ticket-user-name font-weight-bold" style="color: #0f172a;">
                            {{ $data->user_name ?: ($data->user && $data->user->id ? $data->user->displayName() : 'Guest Customer') }}
                        </div>
                        <div class="text-muted" style="font-size: 11px;">
                            {{ $data->email ?: ($data->user ? $data->user->email : '') }}
                            @if(!empty($data->phone)) • {{ $data->phone }} @endif
                        </div>
                    </div>
                </div>
            </td>

            <td>
                <span class="badge" style="background: #e0f2fe; color: #0284c7; font-weight: 700; padding: 4px 9px; border-radius: 6px; font-size: 11.5px; border: 1px solid #bae6fd;">
                    <i class="fa-solid fa-credit-card mr-1"></i> {{ $data->gateway ?: 'Online Gateway' }}
                </span>
            </td>

            <td>
                <div style="font-size: 12px; color: #b91c1c; font-weight: 600; line-height: 1.4;">
                    <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $data->error_message ?: __('Payment Cancelled / Gateway Error') }}
                </div>
                @if(!empty($data->ip_address))
                    <small class="text-muted font-monospace" style="font-size: 10.5px;">IP: {{ $data->ip_address }}</small>
                @endif
            </td>

            <td>
                @if($data->attempts >= 2)
                    <span class="badge badge-danger px-2.5 py-1.5 font-weight-bold d-inline-flex align-items-center" style="font-size: 11.5px; border-radius: 6px; background: #ef4444; color: #ffffff; box-shadow: 0 1px 3px rgba(239, 68, 68, 0.3);" title="{{ __('Customer encountered repeated payment failures') }}">
                        <i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $data->attempts }} Attempts
                    </span>
                @else
                    <span class="badge badge-secondary px-2.5 py-1.5 font-weight-bold" style="font-size: 11px; border-radius: 6px;">
                        1 Attempt
                    </span>
                @endif
            </td>

            <td>
                <span class="font-weight-bold" style="font-size: 14px; color: #dc2626;">
                    @if ($setting->currency_direction == 1)
                        {{ $data->currency_sign }}{{ number_format((float)$data->amount * (float)$data->currency_value, 2) }}
                    @else
                        {{ number_format((float)$data->amount * (float)$data->currency_value, 2) }}{{ $data->currency_sign }}
                    @endif
                </span>
            </td>

            <td>
                <span style="font-size: 11.5px; color: #475569; font-weight: 500;">
                    {{ $data->last_attempt_at ? $data->last_attempt_at->format('d M, Y • h:i A') : ($data->created_at ? $data->created_at->format('d M, Y • h:i A') : 'N/A') }}
                </span>
            </td>

            <td class="text-right">
                <div class="action-btn-group justify-content-end">
                    <a class="btn-action-icon btn-action-delete" data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.transaction.failed.delete', $data->id) }}" title="{{ __('Delete') }}">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8" class="text-center py-4 text-muted">
                <i class="fa-solid fa-circle-check text-success mr-2"></i> {{ __('No failed payment transactions recorded.') }}
            </td>
        </tr>
    @endif
@else
    {{-- Payment Transactions (All Placed Orders & Gateways) --}}
    @if(isset($datas) && count($datas) > 0)
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
                            <span class="ticket-user-name">{{ $data->user_email ?: ($data->order ? (json_decode($data->order->billing_info, true)['bill_email'] ?? 'Guest Customer') : 'Customer') }}</span>
                        @endif
                    </div>
                </div>
            </td>

            <td>
                @if($data->order_id)
                    <a href="{{ route('back.order.invoice', $data->order_id) }}" class="badge-txn-code" title="{{ __('View Order Invoice') }}">
                        <i class="fa-solid fa-receipt"></i>
                        <span>{{ $data->txn_id ?: ($data->order ? $data->order->transaction_number : 'ORD-'.$data->id) }}</span>
                    </a>
                @else
                    <span class="badge-txn-code">
                        <i class="fa-solid fa-receipt"></i>
                        <span>{{ $data->txn_id ?: 'TXN-'.$data->id }}</span>
                    </span>
                @endif
            </td>

            <td>
                <span class="badge" style="background: #f1f5f9; color: #334155; font-weight: 700; padding: 4px 8px; border-radius: 6px; font-size: 11.5px; border: 1px solid #e2e8f0;">
                    {{ $data->order ? $data->order->payment_method : 'Online Payment' }}
                </span>
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
                @if($data->order && strtolower($data->order->payment_status) == 'paid')
                    <span class="badge-status badge-status-paid"><i class="fa-solid fa-circle-check mr-1"></i> {{ __('Paid') }}</span>
                @else
                    <span class="badge-status badge-status-pending"><i class="fa-solid fa-clock mr-1"></i> {{ $data->order ? ($data->order->payment_status ?: __('Unpaid')) : __('Unpaid') }}</span>
                @endif
            </td>

            <td>
                <span class="font-weight-bold" style="font-size: 14.5px; color: #0f172a;">
                    @if ($setting->currency_direction == 1)
                        {{ $data->currency_sign }}{{ number_format((float)$data->amount * (float)$data->currency_value, 2) }}
                    @else
                        {{ number_format((float)$data->amount * (float)$data->currency_value, 2) }}{{ $data->currency_sign }}
                    @endif
                </span>
            </td>

            <td class="text-right">
                <div class="action-btn-group justify-content-end">
                    @if($data->order_id)
                    <a class="btn-action-icon btn-action-view" href="{{ route('back.order.invoice', $data->order_id) }}" title="{{ __('View Invoice') }}">
                        <i class="fa-solid fa-file-invoice"></i>
                    </a>
                    @endif
                    <a class="btn-action-icon btn-action-delete" data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.transaction.delete', $data->id) }}" title="{{ __('Delete') }}">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8" class="text-center py-4 text-muted">
                <i class="fa-solid fa-folder-open mr-2"></i> {{ __('No payment transactions found.') }}
            </td>
        </tr>
    @endif
@endif


