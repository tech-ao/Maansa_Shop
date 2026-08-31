@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-boxes-stacked mr-2" style="font-size: 22px;"></i> {{ __('All Products Catalog') }}</h2>
                <p>{{ __('Manage your entire inventory, prices, promotional tags, stock statuses, and product channels.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a href="{{ route('back.csv.export') }}" class="btn btn-hero-action" style="background: rgba(255, 255, 255, 0.15); color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.25); font-weight: 700; font-size: 13px; padding: 9px 16px; border-radius: 10px;">
                    <i class="fa-solid fa-file-csv mr-1"></i> {{ __('CSV Export') }}
                </a>
                <form class="d-inline-block" action="{{ route('back.bulk.delete') }}" method="get">
                    <input type="hidden" value="" name="ids[]" id="bulk_delete">
                    <input type="hidden" value="items" name="table">
                    <button type="submit" class="btn btn-hero-action" style="background: rgba(239, 68, 68, 0.25); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.4); font-weight: 700; font-size: 13px; padding: 9px 16px; border-radius: 10px;">
                        <i class="fa-solid fa-trash-can mr-1"></i> {{ __('Bulk Delete') }}
                    </button>
                </form>
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.item.add') }}" style="font-size: 13.5px; font-weight: 700; padding: 9px 20px;">
                    <i class="fa-solid fa-plus mr-1"></i> {{ __('Add Product') }}
                </a>
            </div>
        </div>
    </div>

    <input type="hidden" id="product_url" value="{{ route('back.item.index') }}">

	<!-- DataTales Container -->
	<div class="card-modern">
		<div class="card-modern-body">
            @include('alerts.alerts')
            
            <!-- Modern Filter Toolbar -->
            <div class="mb-4" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 20px;">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center" style="font-size: 14px;">
                        <i class="fa-solid fa-filter text-primary mr-2"></i> {{ __('Filter Catalog') }}
                    </h6>
                    @if(request()->has('item_type') || request()->has('is_type') || request()->has('category_id') || request()->has('orderby'))
                        <a href="{{ route('back.item.index') }}" class="btn btn-sm btn-light border text-muted" style="border-radius: 8px; font-size: 12px; font-weight: 600;">
                            <i class="fa-solid fa-rotate-left mr-1"></i> {{ __('Reset Filter') }}
                        </a>
                    @endif
                </div>
                <form action="{{ route('back.item.index') }}" method="GET">
                    <div class="row align-items-end">
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-3 mb-lg-0">
                            <label class="form-label small font-weight-bold text-muted mb-1">{{ __('Product Format') }}</label>
                            <select class="form-control" name="item_type" style="border-radius: 10px; font-size: 13px; height: 42px;">
                                <option value="">{{ __('All Products') }}</option>
                                <option value="normal" {{ request()->input('item_type') == 'normal' ? 'selected' : '' }}>{{ __('Physical Product') }}</option>
                                <option value="digital" {{ request()->input('item_type') == 'digital' ? 'selected' : '' }}>{{ __('Digital Product') }}</option>
                                <option value="license" {{ request()->input('item_type') == 'license' ? 'selected' : '' }}>{{ __('Licence Product') }}</option>
                                <option value="affiliate" {{ request()->input('item_type') == 'affiliate' ? 'selected' : '' }}>{{ __('Affiliate Product') }}</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-3 mb-lg-0">
                            <label class="form-label small font-weight-bold text-muted mb-1">{{ __('Highlight Tag') }}</label>
                            <select class="form-control" name="is_type" style="border-radius: 10px; font-size: 13px; height: 42px;">
                                <option value="">{{ __('All Tags') }}</option>
                                <option value="undefine" {{ request()->input('is_type') == 'undefine' ? 'selected' : '' }}>{{ __('Undefine / Standard') }}</option>
                                <option value="new" {{ request()->input('is_type') == 'new' ? 'selected' : '' }}>{{ __('New Arrival') }}</option>
                                <option value="flash_deal" {{ request()->input('is_type') == 'flash_deal' ? 'selected' : '' }}>{{ __('Flash Deal') }}</option>
                                <option value="feature" {{ request()->input('is_type') == 'feature' ? 'selected' : '' }}>{{ __('Featured') }}</option>
                                <option value="best" {{ request()->input('is_type') == 'best' ? 'selected' : '' }}>{{ __('Best Seller') }}</option>
                                <option value="top" {{ request()->input('is_type') == 'top' ? 'selected' : '' }}>{{ __('Top Product') }}</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-3 mb-lg-0">
                            <label class="form-label small font-weight-bold text-muted mb-1">{{ __('Category') }}</label>
                            <select class="form-control" name="category_id" style="border-radius: 10px; font-size: 13px; height: 42px;">
                                <option value="">{{ __('All Categories') }}</option>
                                @foreach(DB::table('categories')->whereStatus(1)->get() as $cat)
                                <option value="{{ $cat->id }}" {{ request()->input('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6 mb-3 mb-lg-0">
                            <label class="form-label small font-weight-bold text-muted mb-1">{{ __('Sort Order') }}</label>
                            <select class="form-control" name="orderby" style="border-radius: 10px; font-size: 13px; height: 42px;">
                                <option value="asc" {{ request()->input('orderby') == 'asc' ? 'selected' : '' }}>{{ __('Ascending (A-Z)') }}</option>
                                <option value="desc" {{ request()->input('orderby') == 'desc' || !request()->has('orderby') ? 'selected' : '' }}>{{ __('Descending (Z-A)') }}</option>
                            </select>
                        </div>
                        <div class="col-lg-1 col-md-12">
                            <button type="submit" class="btn btn-primary btn-block" style="border-radius: 10px; height: 42px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none;">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

			<div class="table-responsive">
				<table class="table-modern" id="admin-table" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="4%" class="text-center no-sort" data-orderable="false">
                                <input type="checkbox" data-target="product-bulk-delete" class="bulk_all_delete cursor-pointer" style="width: 16px; height: 16px;">
                            </th>
							<th width="7%" class="text-center">{{ __('Image') }}</th>
                            <th width="28%">{{ __('Name') }}</th>
                            <th width="11%">{{ __('Price') }}</th>
							<th width="12%" class="text-center">{{ __('Status') }}</th>
							<th width="12%" class="text-center">{{ __('Tag') }}</th>
							<th width="12%" class="text-center">{{ __('Format') }}</th>
							<th width="14%" class="text-center no-sort" data-orderable="false">{{ __('Actions') }}</th>
						</tr>
					</thead>
					<tbody>
                        @include('back.item.table', compact('datas'))
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
                    <i class="fas fa-exclamation-triangle mr-2"></i> {{ __('Confirm Product Deletion') }}
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
                <h5 class="font-weight-bold text-dark mb-2">{{ __('Delete This Product?') }}</h5>
                <p class="text-muted mb-0">
                    {{ __('You are going to delete this item. All contents, attributes, gallery media, and reviews related with this item will be lost.') }}
                </p>
            </div>
            <div class="modal-footer bg-light border-0 py-3 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4" style="border-radius: 10px; font-weight: 700;" data-dismiss="modal">{{ __('Cancel') }}</button>
                <form action="" class="d-inline btn-ok" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4" style="border-radius: 10px; font-weight: 700;">{{ __('Delete Product') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- DELETE MODAL ENDS --}}

@endsection



