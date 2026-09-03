@if((isset($datas) && count($datas) > 0) || (isset($failedOrders) && count($failedOrders) > 0))
    @foreach($datas as $data)
    <tr id="transaction-bulk-delete">
        <td>
            <input type="checkbox" class="bulk-item" value="{{ $data->id }}" style="cursor: pointer; width: 16px; height: 16px;">
        </td>

        <td>
            <div class="d-flex align-items-center" style="gap: 10px;">
                <div class="ticket-user-avatar" style="width: 34px; height: 34px; min-width: 34px; font-size: 13px; @if($data->order && strtolower($data->order->payment_status) != 'paid') background: #fee2e2; color: #ef4444; @endif">
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
                    <span>{{ $data->txn_id }}</span>
                </a>
            @else
                <span class="badge-txn-code">
                    <i class="fa-solid fa-receipt"></i>
                    <span>{{ $data->txn_id ?: 'TXN-'.$data->id }}</span>
                </span>
            @endif
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
            @elseif($data->order && strtolower($data->order->payment_status) == 'failed')
                <span class="badge-status badge-status-unpaid"><i class="fa-solid fa-circle-xmark mr-1"></i> {{ __('Failed') }}</span>
            @else
                <span class="badge-status badge-status-unpaid"><i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $data->order ? ($data->order->payment_status ?: __('Unpaid')) : __('Unpaid') }}</span>
            @endif
        </td>

        <td>
            <span class="font-weight-bold" style="font-size: 14.5px; color: @if($data->order && strtolower($data->order->payment_status) != 'paid') #dc2626; @else #0f172a; @endif">
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

    @if(isset($failedOrders) && count($failedOrders) > 0)
        @foreach($failedOrders as $fOrder)
        @php
            $fBill = json_decode($fOrder->billing_info, true) ?: [];
            $fEmail = $fBill['bill_email'] ?? ($fOrder->user->email ?? 'Guest Customer');
        @endphp
        <tr id="transaction-bulk-delete">
            <td>
                <span class="badge badge-secondary" style="font-size: 11px;">#{{ $fOrder->id }}</span>
            </td>

            <td>
                <div class="d-flex align-items-center" style="gap: 10px;">
                    <div class="ticket-user-avatar" style="width: 34px; height: 34px; min-width: 34px; font-size: 13px; background: #fee2e2; color: #ef4444;">
                        <i class="fa-solid fa-user-xmark"></i>
                    </div>
                    <div>
                        @if ($fOrder->user && $fOrder->user->id)
                            <a href="{{ route('back.user.show', $fOrder->user->id) }}" class="ticket-user-name" style="text-decoration: none;">
                                {{ $fEmail }}
                            </a>
                        @else
                            <span class="ticket-user-name">{{ $fEmail }}</span>
                        @endif
                    </div>
                </div>
            </td>

            <td>
                <a href="{{ route('back.order.invoice', $fOrder->id) }}" class="badge-txn-code" style="background: #fef2f2; border-color: #fecaca; color: #b91c1c;" title="{{ __('View Order') }}">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>{{ $fOrder->txnid ?: $fOrder->transaction_number }}</span>
                </a>
            </td>

            <td>
                <span class="badge-status badge-status-unpaid"><i class="fa-solid fa-ban mr-1"></i> {{ $fOrder->order_status ?: __('Canceled') }}</span>
            </td>

            <td>
                <span class="badge-status badge-status-unpaid"><i class="fa-solid fa-circle-xmark mr-1"></i> {{ strtoupper($fOrder->payment_status ?: __('FAILED')) }}</span>
            </td>

            <td>
                <span class="font-weight-bold" style="font-size: 14.5px; color: #dc2626;">
                    @php
                        $fCost = PriceHelper::OrderTotal($fOrder, 'trns');
                    @endphp
                    @if ($setting->currency_direction == 1)
                        {{ $fOrder->currency_sign ?: '₹' }}{{ number_format((float)$fCost, 2) }}
                    @else
                        {{ number_format((float)$fCost, 2) }}{{ $fOrder->currency_sign ?: '₹' }}
                    @endif
                </span>
            </td>

            <td class="text-right">
                <div class="action-btn-group justify-content-end">
                    <a class="btn-action-icon btn-action-view" href="{{ route('back.order.invoice', $fOrder->id) }}" title="{{ __('View Order Details') }}">
                        <i class="fa-solid fa-file-invoice"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    @endif
@else
    <tr>
        <td colspan="7" class="text-center py-4 text-muted">
            <i class="fa-solid fa-folder-open mr-2"></i> {{ __('No transactions found.') }}
        </td>
    </tr>
@endif

