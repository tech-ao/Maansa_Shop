@foreach ($datas as $data)
    <tr id="order-bulk-delete">
        <td class="text-center" style="width: 40px; vertical-align: middle;">
            <input type="checkbox" class="bulk-item cursor-pointer" value="{{ $data->id }}" style="width: 16px; height: 16px;">
        </td>

        <td style="min-width: 140px;">
            <a href="{{ route('back.order.invoice', $data->id) }}" class="badge-txn-code" title="{{ __('View Invoice') }}">
                <i class="fa-solid fa-receipt mr-1"></i> {{ $data->transaction_number }}
            </a>
        </td>

        <td style="min-width: 160px;">
            @php
                $billingInfo = json_decode(@$data->billing_info, true);
                $customerName = @$billingInfo['bill_first_name'] . ' ' . @$billingInfo['bill_last_name'];
                if(trim($customerName) == '') {
                    $customerName = @$data->user ? $data->user->displayName() : __('Guest Checkout');
                }
            @endphp
            <div class="font-weight-bold text-dark" style="font-size: 13.5px;">
                {{ $customerName }}
            </div>
            @if(@$billingInfo['bill_email'])
                <div class="text-muted small" style="font-size: 11.5px;">{{ $billingInfo['bill_email'] }}</div>
            @endif
        </td>

        <td style="min-width: 110px;">
            <span class="font-weight-bold text-dark" style="font-size: 14px;">
                @if ($setting->currency_direction == 1)
                    {{ $data->currency_sign }}{{ PriceHelper::OrderTotal($data) }}
                @else
                    {{ PriceHelper::OrderTotal($data) }}{{ $data->currency_sign }}
                @endif
            </span>
        </td>

        <td class="text-center" style="min-width: 115px;">
            <div class="dropdown d-inline-block">
                <button
                    class="btn btn-sm dropdown-toggle"
                    type="button" id="dropdownPayment-{{ $data->id }}" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"
                    style="border-radius: 20px; font-size: 11.5px; font-weight: 700; padding: 4px 12px; {{ $data->payment_status == 'Paid' ? 'background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0;' : 'background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca;' }}">
                    <i class="fa-solid {{ $data->payment_status == 'Paid' ? 'fa-circle-check' : 'fa-circle-xmark' }} mr-1"></i>
                    {{ $data->payment_status == 'Paid' ? __('Paid') : __('Unpaid') }}
                </button>
                <div class="dropdown-menu animated--fade-in shadow border-0" aria-labelledby="dropdownPayment-{{ $data->id }}" style="border-radius: 12px; min-width: 150px;">
                    <h6 class="dropdown-header text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">{{ __('Payment Status') }}</h6>
                    <a class="dropdown-item {{ $data->payment_status == 'Paid' ? 'active font-weight-bold' : '' }}" data-toggle="modal" data-target="#statusModal" href="javascript:;"
                        data-href="{{ route('back.order.status', [$data->id, 'payment_status', 'Paid']) }}">
                        <i class="fa-solid fa-check text-success mr-2"></i> {{ __('Paid') }}
                    </a>
                    <a class="dropdown-item {{ $data->payment_status == 'Unpaid' ? 'active font-weight-bold' : '' }}" data-toggle="modal" data-target="#statusModal" href="javascript:;"
                        data-href="{{ route('back.order.status', [$data->id, 'payment_status', 'Unpaid']) }}">
                        <i class="fa-solid fa-xmark text-danger mr-2"></i> {{ __('Unpaid') }}
                    </a>
                </div>
            </div>
        </td>

        <td class="text-center" style="min-width: 130px;">
            @php
                $statusBg = '#f1f5f9';
                $statusColor = '#475569';
                $statusBorder = '#e2e8f0';
                $statusIcon = 'fa-clock';

                if ($data->order_status == 'Delivered') {
                    $statusBg = '#dcfce7';
                    $statusColor = '#15803d';
                    $statusBorder = '#bbf7d0';
                    $statusIcon = 'fa-truck-fast';
                } elseif ($data->order_status == 'In Progress') {
                    $statusBg = '#e0f2fe';
                    $statusColor = '#0369a1';
                    $statusBorder = '#bae6fd';
                    $statusIcon = 'fa-spinner';
                } elseif ($data->order_status == 'Canceled') {
                    $statusBg = '#fee2e2';
                    $statusColor = '#b91c1c';
                    $statusBorder = '#fecaca';
                    $statusIcon = 'fa-ban';
                } elseif ($data->order_status == 'Pending') {
                    $statusBg = '#fef3c7';
                    $statusColor = '#b45309';
                    $statusBorder = '#fde68a';
                    $statusIcon = 'fa-clock';
                }
            @endphp
            <div class="dropdown d-inline-block">
                <button class="btn btn-sm dropdown-toggle" type="button"
                    id="dropdownOrder-{{ $data->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    style="border-radius: 20px; font-size: 11.5px; font-weight: 700; padding: 4px 12px; background: {{ $statusBg }}; color: {{ $statusColor }}; border: 1px solid {{ $statusBorder }};">
                    <i class="fa-solid {{ $statusIcon }} mr-1"></i>
                    {{ $data->order_status }}
                </button>
                <div class="dropdown-menu animated--fade-in shadow border-0" aria-labelledby="dropdownOrder-{{ $data->id }}" style="border-radius: 12px; min-width: 160px;">
                    <h6 class="dropdown-header text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">{{ __('Fulfillment State') }}</h6>
                    <a class="dropdown-item {{ $data->order_status == 'Pending' ? 'active font-weight-bold' : '' }}" data-toggle="modal" data-target="#statusModal" href="javascript:;"
                        data-href="{{ route('back.order.status', [$data->id, 'order_status', 'Pending']) }}">
                        <i class="fa-solid fa-clock text-warning mr-2"></i> {{ __('Pending') }}
                    </a>
                    <a class="dropdown-item {{ $data->order_status == 'In Progress' ? 'active font-weight-bold' : '' }}" data-toggle="modal" data-target="#statusModal" href="javascript:;"
                        data-href="{{ route('back.order.status', [$data->id, 'order_status', 'In Progress']) }}">
                        <i class="fa-solid fa-spinner text-info mr-2"></i> {{ __('In Progress') }}
                    </a>
                    <a class="dropdown-item {{ $data->order_status == 'Delivered' ? 'active font-weight-bold' : '' }}" data-toggle="modal" data-target="#statusModal" href="javascript:;"
                        data-href="{{ route('back.order.status', [$data->id, 'order_status', 'Delivered']) }}">
                        <i class="fa-solid fa-truck-fast text-success mr-2"></i> {{ __('Delivered') }}
                    </a>
                    <a class="dropdown-item {{ $data->order_status == 'Canceled' ? 'active font-weight-bold' : '' }}" data-toggle="modal" data-target="#statusModal" href="javascript:;"
                        data-href="{{ route('back.order.status', [$data->id, 'order_status', 'Canceled']) }}">
                        <i class="fa-solid fa-ban text-danger mr-2"></i> {{ __('Canceled') }}
                    </a>
                </div>
            </div>
        </td>

        <td class="text-center" style="min-width: 120px;">
            <div class="action-btn-group justify-content-center">
                <a class="btn-action-icon btn-action-view" href="{{ route('back.order.invoice', $data->id) }}" title="{{ __('Invoice & Details') }}">
                    <i class="fa-solid fa-file-invoice"></i>
                </a>
                <a class="btn-action-icon btn-action-edit" href="{{ route('back.order.edit', $data->id) }}" title="{{ __('Edit Order ID') }}">
                    <i class="fa-solid fa-pen"></i>
                </a>
                <a class="btn-action-icon btn-action-delete" data-toggle="modal" data-target="#confirm-delete" href="javascript:;"
                    data-href="{{ route('back.order.delete', $data->id) }}" title="{{ __('Delete Order') }}">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </div>
        </td>
    </tr>
@endforeach
