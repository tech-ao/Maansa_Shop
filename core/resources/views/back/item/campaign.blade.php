@extends('master.back')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/back/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/datepicker.css') }}">
@endsection
@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-bullhorn mr-2" style="font-size: 22px;"></i> {{ __('Campaign Offers & Flash Deals') }}</h2>
                <p>{{ __('Configure limited-time flash deals, promotional countdown timer, and manage curated campaign products.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.item.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-boxes-stacked mr-1"></i> {{ __('All Products') }}
                </a>
            </div>
        </div>
    </div>

	<!-- Campaign Settings Card -->
	<div class="card-modern mb-4">
		<div class="card-modern-body">
            @include('alerts.alerts')
            <div class="d-flex align-items-center mb-3">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary-light rounded-circle mr-2" style="width: 36px; height: 36px; background: #eef2ff; color: #4f46e5;">
                    <i class="fa-solid fa-clock" style="font-size: 15px;"></i>
                </div>
                <div>
                    <h5 class="font-weight-bold text-dark mb-0" style="font-size: 15px;">{{ __('Campaign Timer & Settings') }}</h5>
                    <p class="text-muted small mb-0">{{ __('Set campaign headline, countdown expiration date, and visibility status.') }}</p>
                </div>
            </div>

            <form action="{{ route('back.setting.update') }}" method="POST">
                @csrf
                <div class="row align-items-end">
                    <div class="col-lg-5 col-md-12 mb-3 mb-lg-0">
                        <label class="form-label font-weight-bold text-dark">{{ __('Campaign Title') }} *</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fa-solid fa-heading text-muted"></i></span>
                            </div>
                            <input type="text" required class="form-control" name="campaign_title" value="{{ $setting->campaign_title }}" placeholder="{{ __('e.g., Deals Of The Week') }}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
                        <label class="form-label font-weight-bold text-dark">{{ __('Campaign End Date & Time') }} *</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fa-solid fa-calendar-day text-muted"></i></span>
                            </div>
                            <input type="text" required class="form-control" name="campaign_end_date" value="{{ $setting->campaign_end_date }}" placeholder="{{ __('MM/DD/YYYY') }}" id="datepicker">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label font-weight-bold text-dark">{{ __('Status') }} *</label>
                        <div class="d-flex align-items-center">
                            <select name="campaign_status" class="form-control mr-2" id="campaign_status" style="border-radius: 10px; height: 42px;">
                                <option value="1" {{ $setting->campaign_status == 1 ? 'selected' : '' }}>{{ __('Publish') }}</option>
                                <option value="2" {{ $setting->campaign_status == 2 ? 'selected' : '' }}>{{ __('Unpublish') }}</option>
                            </select>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; height: 42px; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25); white-space: nowrap;">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
		</div>
	</div>

    <!-- Products in Campaign Card -->
	<div class="card-modern">
		<div class="card-modern-body">
            <div class="row align-items-center mb-4 pb-3 border-bottom">
                <div class="col-lg-6 col-md-5 mb-3 mb-md-0">
                    <div class="d-flex align-items-center">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-light rounded-circle mr-2" style="width: 36px; height: 36px; min-width: 36px; background: #eef2ff; color: #4f46e5;">
                            <i class="fa-solid fa-cart-plus" style="font-size: 15px;"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0" style="font-size: 15px;">{{ __('Products Added for Campaign') }}</h5>
                            <p class="text-muted small mb-0">{{ __('Choose products to feature in the countdown promotional flash deal grid.') }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-7">
                    <form action="{{ route('back.campaign.store') }}" method="POST">
                        @csrf
                        <div class="d-flex align-items-center w-100">
                            <div class="flex-grow-1" style="min-width: 0;">
                                <select id="basic" name="item_id" class="form-control w-100" required>
                                    <option value="" disabled selected>{{ __('Select Product to Add...') }}</option>
                                    @foreach ($datas as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('item_id')
                                    <p class="text-danger small mb-0 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary ml-2" style="border-radius: 10px; font-weight: 700; height: 38px; padding: 0 14px; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; white-space: nowrap; flex-shrink: 0; display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(79, 70, 229, 0.25);">
                                <i class="fa-solid fa-plus mr-1"></i> {{ __('Add') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table-modern" id="admin-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="10%" class="text-center">{{ __('Image') }}</th>
                            <th width="35%">{{ __('Name') }}</th>
                            <th width="15%">{{ __('Price') }}</th>
                            <th width="15%" class="text-center">{{ __('Status') }}</th>
                            <th width="15%" class="text-center">{{ __('Show Home Page') }}</th>
                            <th width="10%" class="text-center no-sort" data-orderable="false">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($items->count() > 0)
                          @foreach ($items as $data)
                              <tr>
                                  <td class="text-center" style="width: 70px;">
                                      <div class="mx-auto" style="width: 48px; height: 48px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04); padding: 2px;">
                                          <img src="{{ $data->item && $data->item->photo ? url('/core/public/storage/images/'.$data->item->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                              onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';"
                                              alt="{{ $data->item ? $data->item->name : 'Product' }}"
                                              style="max-width: 100%; max-height: 100%; object-fit: cover; border-radius: 8px;">
                                      </div>
                                  </td>
                                  <td style="min-width: 200px;">
                                      <div class="font-weight-bold text-dark" style="font-size: 13.5px;">
                                          {{ $data->item ? $data->item->name : __('Deleted Product') }}
                                      </div>
                                  </td>
                                  <td style="min-width: 110px;">
                                      <span class="font-weight-bold text-dark" style="font-size: 14px;">
                                          {{ $data->item ? PriceHelper::adminCurrencyPrice($data->item->discount_price) : '-' }}
                                      </span>
                                  </td>
                                  <td class="text-center" style="min-width: 120px;">
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownStatus-{{ $data->id }}" 
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            style="border-radius: 20px; font-size: 11.5px; font-weight: 700; padding: 4px 12px; {{ $data->status == 1 ? 'background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0;' : 'background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca;' }}">
                                            <i class="fa-solid {{ $data->status == 1 ? 'fa-circle-check' : 'fa-circle-xmark' }} mr-1"></i>
                                            {{ $data->status == 1 ? __('Publish') : __('Unpublish') }}
                                        </button>
                                        <div class="dropdown-menu animated--fade-in shadow border-0" aria-labelledby="dropdownStatus-{{ $data->id }}" style="border-radius: 12px; min-width: 160px;">
                                            <h6 class="dropdown-header text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">{{ __('Product Status') }}</h6>
                                            <a class="dropdown-item {{ $data->status == 1 ? 'active font-weight-bold' : '' }}" href="{{ route('back.campaign.status', [$data->id, 1, 'status']) }}">
                                                <i class="fa-solid fa-check text-success mr-2"></i> {{ __('Publish') }}
                                            </a>
                                            <a class="dropdown-item {{ $data->status == 0 ? 'active font-weight-bold' : '' }}" href="{{ route('back.campaign.status', [$data->id, 0, 'status']) }}">
                                                <i class="fa-solid fa-xmark text-danger mr-2"></i> {{ __('Unpublish') }}
                                            </a>
                                        </div>
                                    </div>
                                  </td>
                                  <td class="text-center" style="min-width: 130px;">
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownFeature-{{ $data->id }}" 
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            style="border-radius: 20px; font-size: 11.5px; font-weight: 700; padding: 4px 12px; {{ $data->is_feature == 1 ? 'background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0;' : 'background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0;' }}">
                                            <i class="fa-solid {{ $data->is_feature == 1 ? 'fa-house text-success' : 'fa-house text-muted' }} mr-1"></i>
                                            {{ $data->is_feature == 1 ? __('Active') : __('Inactive') }}
                                        </button>
                                        <div class="dropdown-menu animated--fade-in shadow border-0" aria-labelledby="dropdownFeature-{{ $data->id }}" style="border-radius: 12px; min-width: 160px;">
                                            <h6 class="dropdown-header text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">{{ __('Home Visibility') }}</h6>
                                            <a class="dropdown-item {{ $data->is_feature == 1 ? 'active font-weight-bold' : '' }}" href="{{ route('back.campaign.status', [$data->id, 1, 'is_feature']) }}">
                                                <i class="fa-solid fa-check text-success mr-2"></i> {{ __('Show on Home') }}
                                            </a>
                                            <a class="dropdown-item {{ $data->is_feature == 0 ? 'active font-weight-bold' : '' }}" href="{{ route('back.campaign.status', [$data->id, 0, 'is_feature']) }}">
                                                <i class="fa-solid fa-xmark text-danger mr-2"></i> {{ __('Hide from Home') }}
                                            </a>
                                        </div>
                                    </div>
                                  </td>
                                  <td class="text-center" style="min-width: 80px;">
                                      <a class="btn-action-icon btn-action-delete" data-toggle="modal"
                                          data-target="#confirm-delete" href="javascript:;"
                                          data-href="{{ route('back.campaign.destroy', $data->id) }}" title="{{ __('Remove from Campaign') }}">
                                          <i class="fa-solid fa-trash-can"></i>
                                      </a>
                                  </td>
                              </tr>
                          @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
		</div>
	</div>

</div>
<!-- End of Main Content -->

{{-- DELETE MODAL --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header bg-danger text-white border-0 py-3">
                <h5 class="modal-title d-flex align-items-center font-weight-bold" id="exampleModalLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i> {{ __('Confirm Product Removal') }}
                </h5>
                <button class="close text-white opacity-8" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center bg-danger-light text-danger rounded-circle" style="width: 60px; height: 60px; font-size: 24px; background: #fee2e2;">
                        <i class="fas fa-trash-can text-danger"></i>
                    </div>
                </div>
                <h5 class="font-weight-bold text-dark mb-2">{{ __('Remove From Campaign?') }}</h5>
                <p class="text-muted mb-0">
                    {{ __('You are going to remove this product from the campaign. The product itself will not be deleted.') }}
                </p>
            </div>
            <div class="modal-footer bg-light border-0 py-3 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4" style="border-radius: 10px; font-weight: 700;" data-dismiss="modal">{{ __('Cancel') }}</button>
                <form action="" class="d-inline btn-ok" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4" style="border-radius: 10px; font-weight: 700;">{{ __('Remove') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- DELETE MODAL ENDS --}}

@endsection

@section('scripts')
    <script type="" src="{{ asset('assets/back/js/select2.js') }}"></script>
    <script>
        $('#basic').select2({
			theme: "bootstrap"
		});
    </script>
@endsection