<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{ url('/core/public/storage/images/' . $setting->favicon) }}" />
    <title>{{ __('Bulk Packing Labels') }} ({{ $orders->count() }} {{ __('Labels') }}) - {{ $setting->title }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #f1f5f9;
            color: #0f172a;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            padding: 30px 15px;
        }
        .no-print-bar {
            position: sticky;
            top: 15px;
            z-index: 1000;
            max-width: 620px;
            margin: 0 auto 24px;
            padding: 12px 18px;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.12);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }
        .btn-action {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid transparent;
        }
        .btn-back {
            background: #f8fafc;
            color: #475569;
            border-color: #cbd5e1;
        }
        .btn-back:hover {
            background: #e2e8f0;
            color: #0f172a;
        }
        .btn-invoices {
            background: #eff6ff;
            color: #2563eb;
            border-color: #bfdbfe;
        }
        .btn-invoices:hover {
            background: #dbeafe;
        }
        .btn-print {
            background: #059669;
            color: #ffffff;
            border-color: #059669;
        }
        .btn-print:hover {
            background: #047857;
        }

        .bulk-labels-wrapper {
            max-width: 620px;
            margin: 0 auto;
        }

        /* 4x6 Physical Packing Label Container */
        .packing-label-box {
            background: #ffffff;
            border: 2px solid #0f172a;
            border-radius: 8px;
            padding: 18px 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            position: relative;
            page-break-after: always;
            break-after: page;
        }
        .packing-label-box:last-child {
            margin-bottom: 0;
            page-break-after: auto;
            break-after: auto;
        }

        /* Top Header Row */
        .label-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 12px;
            border-bottom: 2px solid #0f172a;
            margin-bottom: 12px;
        }
        .brand-logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .brand-logo-area img {
            max-height: 44px;
            max-width: 140px;
            object-fit: contain;
        }
        .brand-title-text {
            font-size: 15px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
        }
        .brand-subtext {
            font-size: 10.5px;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .label-type-badge {
            text-align: right;
        }
        .label-type-title {
            font-size: 14px;
            font-weight: 900;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: #0f172a;
        }
        .order-date-text {
            font-size: 11px;
            color: #475569;
            font-weight: 600;
        }

        /* Routing & Courier Barcode Area */
        .routing-strip {
            display: flex;
            border: 1.5px solid #0f172a;
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 14px;
        }
        .routing-cell {
            flex: 1;
            padding: 8px 12px;
            border-right: 1.5px solid #0f172a;
            background: #ffffff;
        }
        .routing-cell:last-child {
            border-right: none;
        }
        .routing-label {
            font-size: 9.5px;
            font-weight: 800;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 0.4px;
            margin-bottom: 2px;
        }
        .routing-val {
            font-size: 13px;
            font-weight: 800;
            color: #0f172a;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, monospace;
        }
        .payment-cell {
            background: #f8fafc;
            text-align: center;
            min-width: 140px;
        }
        .badge-payment {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 11.5px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .payment-cod {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        .payment-prepaid {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }

        /* Barcode Generator Graphic */
        .barcode-card {
            text-align: center;
            padding: 8px 0;
            margin-bottom: 14px;
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 6px;
        }
        .barcode-visual {
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2px;
            margin: 0 auto 4px;
        }
        .barcode-bar {
            background: #0f172a;
            height: 100%;
        }
        .barcode-text {
            font-family: 'Courier New', Courier, monospace;
            font-weight: 800;
            font-size: 13px;
            letter-spacing: 3px;
            color: #0f172a;
        }

        /* Delivery & Return Addresses */
        .address-grid {
            display: flex;
            gap: 12px;
            margin-bottom: 14px;
        }
        .ship-to-box {
            flex: 1.35;
            border: 2px solid #0f172a;
            border-radius: 6px;
            padding: 12px 14px;
            background: #ffffff;
        }
        .return-box {
            flex: 1;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 10px 12px;
            background: #f8fafc;
        }
        .box-title {
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            padding-bottom: 4px;
            margin-bottom: 6px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .ship-to-title {
            color: #059669;
            border-color: #059669;
        }
        .recipient-name {
            font-size: 14px;
            font-weight: 900;
            color: #0f172a;
            margin-bottom: 4px;
        }
        .address-line {
            font-size: 11.5px;
            color: #1e293b;
            line-height: 1.45;
            margin-bottom: 4px;
        }
        .phone-highlight {
            font-size: 12.5px;
            font-weight: 800;
            color: #0f172a;
            margin-top: 6px;
            padding-top: 4px;
            border-top: 1px dashed #cbd5e1;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .pincode-badge {
            display: inline-block;
            font-size: 13px;
            font-weight: 900;
            color: #0f172a;
            background: #fef08a;
            padding: 2px 6px;
            border-radius: 4px;
            border: 1px solid #fde047;
            margin-top: 4px;
        }
        .seller-text {
            font-size: 10.5px;
            color: #475569;
            line-height: 1.4;
        }
        .seller-name {
            font-size: 12px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 2px;
        }

        /* Packed Items Table */
        .items-section {
            border: 1.5px solid #0f172a;
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 14px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
        }
        .items-table th {
            background: #0f172a;
            color: #ffffff;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 6px 10px;
            text-align: left;
        }
        .items-table th.text-center { text-align: center; }
        .items-table th.text-right { text-align: right; }
        .items-table td {
            padding: 7px 10px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 11px;
            color: #1e293b;
            vertical-align: middle;
        }
        .items-table tr:last-child td {
            border-bottom: none;
        }
        .items-table tr:nth-child(even) td {
            background: #f8fafc;
        }
        .item-title {
            font-weight: 800;
            color: #0f172a;
        }
        .item-options {
            font-size: 9.5px;
            color: #64748b;
        }
        .qty-badge {
            display: inline-block;
            font-weight: 900;
            font-size: 12px;
            color: #0f172a;
            background: #e2e8f0;
            padding: 2px 7px;
            border-radius: 4px;
        }

        /* Bottom Summary & Notes */
        .label-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
            border-top: 1.5px solid #0f172a;
            font-size: 10px;
            color: #64748b;
        }
        .footer-left {
            font-weight: 600;
        }
        .footer-right {
            text-align: right;
            font-weight: 700;
            color: #0f172a;
        }

        /* Print Media Query */
        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .no-print-bar {
                display: none !important;
            }
            .bulk-labels-wrapper {
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .packing-label-box {
                border: 2px solid #000000 !important;
                box-shadow: none !important;
                padding: 12px 14px !important;
                margin-bottom: 0 !important;
                page-break-after: always;
                break-after: page;
            }
            .packing-label-box:last-child {
                page-break-after: auto;
                break-after: auto;
            }
            .routing-strip,
            .ship-to-box,
            .items-section,
            .label-header,
            .label-footer {
                border-color: #000000 !important;
            }
            .items-table th {
                background: #000000 !important;
                color: #ffffff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <!-- Action Bar (Hidden when printing) -->
    <div class="no-print-bar">
        <div style="display: flex; gap: 8px; align-items: center;">
            <a href="{{ route('back.order.index') }}" class="btn-action btn-back">
                &larr; {{ __('Back to Orders') }}
            </a>
            <span style="font-weight: 800; font-size: 13.5px; color: #0f172a; margin-left: 6px;">
                {{ $orders->count() }} {{ __('Packing Label(s) Ready to Print') }}
            </span>
        </div>
        <div style="display: flex; gap: 8px; align-items: center;">
            <a href="{{ route('back.order.bulk.invoices', request()->all()) }}" class="btn-action btn-invoices">
                <svg style="width: 14px; height: 14px; margin-right: 5px; fill: currentColor;" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg> {{ __('Switch to Bulk Invoices') }}
            </a>
            <button onclick="window.print()" class="btn-action btn-print">
                <svg style="width: 14px; height: 14px; margin-right: 5px; fill: currentColor;" viewBox="0 0 24 24"><path d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z"/></svg> {{ __('Print All Labels') }}
            </button>
        </div>
    </div>

    <div class="bulk-labels-wrapper">
        @foreach($orders as $order)
            @php
                if ($order->state) {
                    $state = json_decode($order->state, true);
                } else {
                    $state = [];
                }
                $bill = json_decode($order->billing_info, true);
                $ship = json_decode($order->shipping_info, true);
                
                $recipient = !empty($ship['ship_first_name']) ? $ship : $bill;
                $isPaid = ($order->payment_status === 'Paid');
                $isCodMethod = (stripos($order->payment_method, 'Cash') !== false || stripos($order->payment_method, 'COD') !== false);
                $cartItems = json_decode($order->cart, true) ?: [];
                $totalQty = 0;
                foreach($cartItems as $cItem) {
                    $totalQty += ($cItem['qty'] ?? 1);
                }
            @endphp

            <div class="packing-label-box">
                <!-- Header: Store Branding & Label Type -->
                <div class="label-header">
                    <div class="brand-logo-area">
                        <img alt="{{ $setting->title }}" src="{{ url('/core/public/storage/images/' . $setting->logo) }}">
                        <div>
                            <div class="brand-title-text">{{ $setting->title ?: 'Maansa Rajashahi' }}</div>
                            <div class="brand-subtext">{{ __('Store Dispatch & Logistics') }}</div>
                        </div>
                    </div>
                    <div class="label-type-badge">
                        <div class="label-type-title">{{ __('PACKING LABEL') }}</div>
                        <div class="order-date-text">{{ __('Order Date') }}: {{ $order->created_at->format('d M, Y') }}</div>
                    </div>
                </div>

                <!-- Routing & Courier Details Strip -->
                <div class="routing-strip">
                    <div class="routing-cell">
                        <div class="routing-label">{{ __('Order / TXN No.') }}</div>
                        <div class="routing-val" style="color: #059669;">#{{ $order->transaction_number }}</div>
                    </div>
                    <div class="routing-cell">
                        <div class="routing-label">{{ __('Courier Service') }}</div>
                        <div class="routing-val">{{ $order->courier_name ?: ($order->shipping ? (json_decode($order->shipping, true)['title'] ?? 'Standard Shipping') : 'Standard Delivery') }}</div>
                    </div>
                    <div class="routing-cell">
                        <div class="routing-label">{{ __('AWB / Tracking') }}</div>
                        <div class="routing-val">{{ $order->tracking_number ?: ($order->txnid ?: 'PENDING') }}</div>
                    </div>
                    <div class="routing-cell payment-cell" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 6px 10px;">
                        <div class="routing-label" style="margin-bottom: 3px;">{{ __('Payment Mode') }}</div>
                        @if($isPaid || strtolower($order->payment_status) == 'paid')
                            <span class="badge-payment payment-prepaid" style="font-size: 13px; font-weight: 900; padding: 4px 14px; letter-spacing: 0.5px;">
                                {{ __('Paid') }}
                            </span>
                        @elseif($isCodMethod)
                            <span class="badge-payment payment-cod" style="font-size: 11.5px; font-weight: 900; padding: 4px 8px; letter-spacing: 0.3px; white-space: nowrap;">
                                {{ __('COD') }}: {{ $order->currency_sign }}{{ PriceHelper::OrderTotal($order) }}
                            </span>
                        @else
                            <span class="badge-payment payment-prepaid" style="font-size: 13px; font-weight: 900; padding: 4px 14px; letter-spacing: 0.5px;">
                                {{ __('Paid') }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Scannable Barcode Box -->
                <div class="barcode-card">
                    <div class="barcode-visual">
                        @php
                            $barSequence = [3,1,2,1,4,1,2,3,1,2,1,4,2,1,3,1,1,3,2,4,1,2,1,3,2,1,4,1,2,1,3,2,1,4,1,2,3,1,2,1,4,2,1,3,1,2,4,1,3,2,1,1,4,2,3,1,2,1,3,4,1,2,1,3,2,1];
                        @endphp
                        @foreach($barSequence as $idx => $w)
                            <div class="barcode-bar" style="width: {{ $w }}px; margin-right: {{ ($idx % 3 == 0) ? '2px' : '1px' }};"></div>
                        @endforeach
                    </div>
                    <div class="barcode-text">* {{ $order->transaction_number }} *</div>
                </div>

                <!-- Address Grid: SHIP TO (Large) vs RETURN ADDRESS (Seller) -->
                <div class="address-grid">
                    <!-- Recipient Delivery Address -->
                    <div class="ship-to-box">
                        <div class="box-title ship-to-title">
                            <span><svg style="width: 11px; height: 11px; margin-right: 4px; vertical-align: -1px; fill: currentColor;" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg> {{ __('SHIP TO (CUSTOMER)') }}</span>
                            <span style="font-size: 9px; font-weight: 700; color: #64748b;">{{ __('DELIVERY DESTINATION') }}</span>
                        </div>
                        <div class="recipient-name">
                            {{ $recipient['ship_first_name'] ?? ($bill['bill_first_name'] ?? '') }} {{ $recipient['ship_last_name'] ?? ($bill['bill_last_name'] ?? '') }}
                        </div>
                        @if(!empty($recipient['ship_company']) || !empty($bill['bill_company']))
                            <div style="font-weight: 700; color: #475569; font-size: 11px; margin-bottom: 2px;">
                                {{ $recipient['ship_company'] ?? $bill['bill_company'] }}
                            </div>
                        @endif
                        <div class="address-line">
                            {{ $recipient['ship_address1'] ?? ($bill['bill_address1'] ?? '') }}
                            @if(!empty($recipient['ship_address2']) || !empty($bill['bill_address2']))
                                , {{ $recipient['ship_address2'] ?? $bill['bill_address2'] }}
                            @endif
                            <br>
                            {{ $recipient['ship_city'] ?? ($bill['bill_city'] ?? '') }}{{ isset($state['name']) ? ', ' . $state['name'] : '' }}
                        </div>
                        <div>
                            <span class="pincode-badge">PIN: {{ $recipient['ship_zip'] ?? ($bill['bill_zip'] ?? 'N/A') }}</span>
                            <span style="font-weight: 700; font-size: 11.5px; margin-left: 4px;">{{ $recipient['ship_country'] ?? ($bill['bill_country'] ?? 'India') }}</span>
                        </div>
                        <div class="phone-highlight">
                            <svg style="width: 12px; height: 12px; fill: currentColor;" viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                            <span>{{ __('Phone') }}: {{ $recipient['ship_phone'] ?? ($bill['bill_phone'] ?? ($order->user->phone ?? 'N/A')) }}</span>
                        </div>
                    </div>

                    <!-- Seller / Return Dispatch Address -->
                    <div class="return-box">
                        <div class="box-title">
                            <span>{{ __('IF UNDELIVERED, RETURN TO') }}</span>
                        </div>
                        <div class="seller-name">{{ $setting->title ?: 'Maansa Rajashahi' }}</div>
                        <div class="seller-text">
                            {{ $setting->footer_address ?: 'Bhatipura, Gram Kuchera, Nagaur, Rajasthan-341024.' }}
                        </div>
                        <div class="seller-text" style="margin-top: 4px; font-weight: 600;">
                            {{ __('Ph') }}: {{ $setting->footer_phone ?: '+91 9521828754' }}<br>
                            {{ __('Email') }}: {{ $setting->footer_email ?: ($setting->contact_email ?: 'maansarajashahi@gmail.com') }}
                        </div>
                    </div>
                </div>

                <!-- Manifest / Packed Items List -->
                <div class="items-section">
                    <table class="items-table">
                        <thead>
                            <tr>
                                <th style="width: 58%;">{{ __('Package Contents / Items Manifest') }}</th>
                                <th style="width: 26%;">{{ __('Options / SKU') }}</th>
                                <th style="width: 16%;" class="text-center">{{ __('Qty') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr>
                                    <td>
                                        <div class="item-title">{{ $item['name'] }}</div>
                                    </td>
                                    <td>
                                        @if(isset($item['attribute']['option_name']) && $item['attribute']['option_name'])
                                            <div class="item-options">
                                                {{ implode(', ', $item['attribute']['option_name']) }}
                                            </div>
                                        @else
                                            <span style="color: #94a3b8;">—</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="qty-badge">{{ $item['qty'] }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Footer Details & Security Note -->
                <div class="label-footer">
                    <div class="footer-left">
                        <span>{{ __('Total Pieces') }}: <strong>{{ $totalQty }} {{ __('item(s)') }}</strong></span> &bull; 
                        <span>{{ __('Invoice Ref') }}: <strong>#{{ $order->transaction_number }}</strong></span>
                    </div>
                    <div class="footer-right">
                        <span>{{ __('Thank you for choosing') }} {{ $setting->title }}!</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
