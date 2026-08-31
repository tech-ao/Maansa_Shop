<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/x-icon" href="{{ url('/core/public/storage/images/'.$setting->favicon) }}"/>
  <title>{{ __('Invoice') }} #{{ $order->transaction_number }} - {{ $setting->title }}</title>

  <!-- Bootstrap -->
  <link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/front/css/fontawesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/front/css/main.css') }}" rel="stylesheet">

  <style>
    body {
      background: #f8fafc;
      color: #1e293b;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      padding: 30px 15px;
    }
    .print-invoice-card {
      background: #ffffff;
      max-width: 860px;
      margin: 0 auto;
      padding: 40px;
      border-radius: 16px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    }
    .print-brand-logo {
      max-height: 52px;
      width: auto;
      margin-bottom: 8px;
    }
    .invoice-table th {
      background: #f8fafc;
      color: #475569;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.04em;
      padding: 12px 16px;
      border-top: 1px solid #e2e8f0;
      border-bottom: 1px solid #e2e8f0;
    }
    .invoice-table td {
      padding: 14px 16px;
      font-size: 13.5px;
      border-bottom: 1px solid #f1f5f9;
      vertical-align: middle;
    }
    .print-summary-box {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      padding: 18px 22px;
      max-width: 380px;
      margin-left: auto;
    }
    .print-summary-row {
      display: flex;
      justify-content: space-between;
      padding: 6px 0;
      font-size: 13.5px;
    }
    .print-summary-row.total {
      border-top: 2px dashed #cbd5e1;
      margin-top: 8px;
      padding-top: 12px;
      font-size: 16px;
      font-weight: 800;
      color: #0f172a;
    }
    @media print {
      body {
        background: #ffffff;
        padding: 0;
      }
      .print-invoice-card {
        border: none;
        box-shadow: none;
        padding: 0;
        max-width: 100%;
      }
    }
  </style>
</head>

<body id="invoice-print" onload="window.print()" id="page-top">

  @php
    if($order->state){
        $state = json_decode($order->state,true);
    }else{
        $state = [];
    }
    $bill = json_decode($order->billing_info,true);
    $ship = json_decode($order->shipping_info,true);
  @endphp

  <div class="print-invoice-card">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-start pb-4 mb-4 border-bottom">
      <div>
        <img class="print-brand-logo" alt="Logo" src="{{ url('/core/public/storage/images/'.$setting->logo) }}">
        <p class="text-muted mb-0" style="font-size: 13px;">
          <strong>{{ $setting->title }}</strong><br>
          {{ __('Official Store Receipt') }}
        </p>
      </div>
      <div class="text-right">
        <h2 class="font-weight-bold text-primary mb-1" style="letter-spacing: -0.02em;">{{ __('INVOICE') }}</h2>
        <div class="mb-2">
          <span style="font-family: monospace; font-size: 13px; font-weight: 700; background: #f0fdf4; color: #059669; padding: 3px 8px; border-radius: 6px;">#{{ $order->transaction_number }}</span>
        </div>
        <p class="text-muted mb-0" style="font-size: 13px;">
          <strong>{{ __('Transaction ID:') }}</strong> <span style="font-family: monospace;">{{ $order->txnid }}</span><br>
          <strong>{{ __('Order Date:') }}</strong> {{ $order->created_at->format('M d, Y') }}<br>
          <strong>{{ __('Payment Method:') }}</strong> {{ $order->payment_method }}<br>
          <strong>{{ __('Payment Status:') }}</strong> <span class="badge {{ $order->payment_status == 'Paid' ? 'badge-success' : 'badge-danger' }}">{{ $order->payment_status }}</span>
        </p>
      </div>
    </div>

    <!-- Addresses -->
    <div class="row mb-4">
      <div class="col-6">
        <div class="p-3 rounded" style="background: #f8fafc; border: 1px solid #e2e8f0;">
          <h6 class="font-weight-bold mb-2 text-dark">{{ __('Billing Address') }}</h6>
          <p class="mb-0 text-muted" style="font-size: 13px; line-height: 1.6;">
            <strong class="text-dark">{{ $bill['bill_first_name'] ?? '' }} {{ $bill['bill_last_name'] ?? '' }}</strong><br>
            @if(isset($bill['bill_company']) && $bill['bill_company'])
              {{ $bill['bill_company'] }}<br>
            @endif
            {{ $bill['bill_email'] ?? '' }} &bull; {{ $bill['bill_phone'] ?? '' }}<br>
            @if(isset($bill['bill_address1']))
              {{ $bill['bill_address1'] }}{{ isset($bill['bill_address2']) && $bill['bill_address2'] ? ', '.$bill['bill_address2'] : '' }}<br>
            @endif
            {{ $bill['bill_city'] ?? '' }}{{ isset($state['name']) ? ', '.$state['name'] : '' }} {{ $bill['bill_zip'] ?? '' }}<br>
            {{ $bill['bill_country'] ?? '' }}
          </p>
        </div>
      </div>

      <div class="col-6">
        <div class="p-3 rounded" style="background: #f8fafc; border: 1px solid #e2e8f0;">
          <h6 class="font-weight-bold mb-2 text-dark">{{ __('Shipping Address') }}</h6>
          <p class="mb-0 text-muted" style="font-size: 13px; line-height: 1.6;">
            <strong class="text-dark">{{ $ship['ship_first_name'] ?? '' }} {{ $ship['ship_last_name'] ?? '' }}</strong><br>
            @if(isset($ship['ship_company']) && $ship['ship_company'])
              {{ $ship['ship_company'] }}<br>
            @endif
            {{ $ship['ship_email'] ?? '' }} &bull; {{ $ship['ship_phone'] ?? '' }}<br>
            @if(isset($ship['ship_address1']))
              {{ $ship['ship_address1'] }}{{ isset($ship['ship_address2']) && $ship['ship_address2'] ? ', '.$ship['ship_address2'] : '' }}<br>
            @endif
            {{ $ship['ship_city'] ?? '' }}{{ isset($state['name']) ? ', '.$state['name'] : '' }} {{ $ship['ship_zip'] ?? '' }}<br>
            {{ $ship['ship_country'] ?? '' }}
          </p>
        </div>
      </div>
    </div>

    <!-- Items Table -->
    <table class="w-100 invoice-table mb-4">
      <thead>
        <tr>
          <th width="50%">{{ __('Purchased Item') }}</th>
          <th width="22%">{{ __('Attributes') }}</th>
          <th width="10%" class="text-center">{{ __('Qty') }}</th>
          <th width="18%" class="text-right">{{ __('Price') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach (json_decode($order->cart, true) as $item)
          <tr>
            <td>
              <strong class="text-dark">{{ $item['name'] }}</strong>
            </td>
            <td>
              @if(isset($item['attribute']['option_name']) && $item['attribute']['option_name'])
                @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
                  <span class="badge badge-light border text-muted">
                    {{ $option_name }}: 
                    @if ($setting->currency_direction == 1)
                      {{ $order->currency_sign }}{{ round($item['attribute']['option_price'][$optionkey]*$order->currency_value,2) }}
                    @else
                      {{ round($item['attribute']['option_price'][$optionkey]*$order->currency_value,2) }}{{ $order->currency_sign }}
                    @endif
                  </span>
                @endforeach
              @else
                <span class="text-muted">--</span>
              @endif
            </td>
            <td class="text-center font-weight-bold">{{ $item['qty'] }}</td>
            <td class="text-right font-weight-bold text-dark">
              @if ($setting->currency_direction == 1)
                {{ $order->currency_sign }}{{ round($item['main_price']*$order->currency_value,2) }}
              @else
                {{ round($item['main_price']*$order->currency_value,2) }}{{ $order->currency_sign }}
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <!-- Totals -->
    <div class="row">
      <div class="col-6">
        <p class="text-muted" style="font-size: 12px; line-height: 1.6;">
          {{ __('Thank you for shopping with us!') }}<br>
          {{ __('For any inquiry or support, please contact our team referencing invoice number.') }}
        </p>
      </div>
      <div class="col-6">
        <div class="print-summary-box">
          @if($order->tax != 0)
            <div class="print-summary-row">
              <span class="text-muted">{{ __('Tax / VAT') }}</span>
              <span class="font-weight-bold">
                @if ($setting->currency_direction == 1)
                  {{ $order->currency_sign }}{{ round($order->tax*$order->currency_value,2) }}
                @else
                  {{ round($order->tax*$order->currency_value,2) }}{{ $order->currency_sign }}
                @endif
              </span>
            </div>
          @endif

          @if(json_decode($order->discount, true))
            @php $discount = json_decode($order->discount, true); @endphp
            <div class="print-summary-row">
              <span class="text-muted">{{ __('Coupon Discount') }}</span>
              <span class="font-weight-bold text-danger">
                @if ($setting->currency_direction == 1)
                  -{{ $order->currency_sign }}{{ round($discount['discount'] * $order->currency_value,2) }}
                @else
                  -{{ round($discount['discount'] * $order->currency_value,2) }}{{ $order->currency_sign }}
                @endif
              </span>
            </div>
          @endif

          @if(json_decode($order->shipping, true))
            @php $shipping = json_decode($order->shipping, true); @endphp
            <div class="print-summary-row">
              <span class="text-muted">{{ __('Shipping Fee') }}</span>
              <span class="font-weight-bold">
                @if ($setting->currency_direction == 1)
                  {{ $order->currency_sign }}{{ round($shipping['price']*$order->currency_value,2) }}
                @else
                  {{ round($shipping['price']*$order->currency_value,2) }}{{ $order->currency_sign }}
                @endif
              </span>
            </div>
          @endif

          @if(json_decode($order->state_price, true))
            <div class="print-summary-row">
              <span class="text-muted">{{ __('State Tax') }}</span>
              <span class="font-weight-bold">
                @if ($setting->currency_direction == 1)
                  {{ $order->currency_sign }}{{ round($order['state_price']*$order->currency_value,2) }}
                @else
                  {{ round($order['state_price']*$order->currency_value,2) }}{{ $order->currency_sign }}
                @endif
              </span>
            </div>
          @endif

          <div class="print-summary-row total">
            <span>{{ __('Grand Total Due') }}</span>
            <span style="color: #059669;">
              @if ($setting->currency_direction == 1)
                {{ $order->currency_sign }}{{ PriceHelper::OrderTotal($order) }}
              @else
                {{ PriceHelper::OrderTotal($order) }}{{ $order->currency_sign }}
              @endif
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>

