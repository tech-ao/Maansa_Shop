@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-file-csv mr-2" style="font-size: 22px;"></i> {{ __('Product CSV Import & Export') }}</h2>
                <p>{{ __('Bulk import large product catalogs using spreadsheet CSV files or export existing store inventory.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.item.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-boxes-stacked mr-1"></i> {{ __('Back to Products') }}
                </a>
            </div>
        </div>
    </div>

    @include('alerts.alerts')

    <!-- Top Quick Action Cards -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="card-modern h-100" style="margin-bottom: 0;">
                <div class="card-modern-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="d-inline-flex align-items-center justify-content-center mr-3 rounded-circle" style="width: 46px; height: 46px; min-width: 46px; background: #e0f2fe; color: #0284c7; font-size: 20px;">
                            <i class="fa-solid fa-file-export"></i>
                        </div>
                        <div>
                            <h6 class="font-weight-bold text-dark mb-1">{{ __('Export All Products') }}</h6>
                            <p class="text-muted small mb-0">{{ __('Download current store items into a CSV spreadsheet.') }}</p>
                        </div>
                    </div>
                    <a href="{{ route('back.csv.export') }}" class="btn btn-outline-primary btn-sm font-weight-bold ml-2 text-nowrap" style="border-radius: 10px; padding: 8px 16px;">
                        <i class="fa-solid fa-download mr-1"></i> {{ __('Export CSV') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card-modern h-100" style="margin-bottom: 0;">
                <div class="card-modern-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="d-inline-flex align-items-center justify-content-center mr-3 rounded-circle" style="width: 46px; height: 46px; min-width: 46px; background: #fef3c7; color: #b45309; font-size: 20px;">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                        <div>
                            <h6 class="font-weight-bold text-dark mb-1">{{ __('Sample CSV Template') }}</h6>
                            <p class="text-muted small mb-0">{{ __('Download pre-formatted blank template with correct headers.') }}</p>
                        </div>
                    </div>
                    <a href="{{ asset('assets/test_csv_file.csv') }}" download class="btn btn-outline-secondary btn-sm font-weight-bold ml-2 text-nowrap" style="border-radius: 10px; padding: 8px 16px;">
                        <i class="fa-solid fa-file-arrow-down mr-1"></i> {{ __('Download Sample') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

	<!-- Main CSV Upload Section -->
	<div class="row">
		<div class="col-lg-12">
			<div class="card-modern">
				<div class="card-modern-body">
                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-light rounded-circle mr-2" style="width: 36px; height: 36px; background: #f0fdf4; color: #059669;">
                            <i class="fa-solid fa-cloud-arrow-up font-size-15"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">{{ __('Bulk Import Products via CSV') }}</h5>
                            <p class="text-muted small mb-0">{{ __('Upload your populated spreadsheet file to automatically create or update catalog products.') }}</p>
                        </div>
                    </div>

					<form class="admin-form" action="{{ route('back.csv.import') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" value="normal" name="item_type">
                        @csrf

                        <!-- Drag & Drop Upload Container -->
                        <div class="text-center p-4 p-md-5 mb-4" style="background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 16px; transition: all 0.2s ease;">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 70px; height: 70px; background: #f0fdf4; color: #059669; font-size: 28px; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);">
                                <i class="fa-solid fa-file-csv"></i>
                            </div>
                            <h5 class="font-weight-bold text-dark mb-1">{{ __('Select or Drop Your CSV File Here') }}</h5>
                            <p class="text-muted small mb-3">{{ __('Supported format: .csv (Comma Separated Values) max size 10MB.') }}</p>
                            
                            <label class="btn btn-primary px-4 py-2 cursor-pointer font-weight-bold" style="border-radius: 10px; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);">
                                <i class="fa-solid fa-folder-open mr-1"></i> {{ __('Browse CSV File') }}
                                <input type="file" accept=".csv, text/csv, application/vnd.ms-excel" class="d-none" name="csv" id="csv-file-input" required>
                            </label>
                            
                            <div id="file-name-display" class="mt-3 text-success font-weight-bold d-none" style="font-size: 13.5px;">
                                <i class="fa-solid fa-circle-check mr-1"></i> <span id="file-name-text"></span>
                            </div>
                        </div>

                        <!-- Instructions / CSV Guidance -->
                        <div class="p-3 mb-4" style="background: #f1f5f9; border-radius: 12px; border: 1px solid #e2e8f0;">
                            <h6 class="font-weight-bold text-dark mb-2" style="font-size: 13px;">
                                <i class="fa-solid fa-circle-info text-info mr-1"></i> {{ __('CSV Import Guidelines:') }}
                            </h6>
                            <ul class="text-muted small mb-0 pl-3" style="line-height: 1.6;">
                                <li>{{ __('Always use the exact column headers from the Sample CSV template.') }}</li>
                                <li>{{ __('Make sure Category IDs and Brand IDs correspond to existing IDs in your system.') }}</li>
                                <li>{{ __('Prices must be numerical values without currency symbols (e.g., 29.99).') }}</li>
                            </ul>
                        </div>

						<div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('back.item.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
							<button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-file-import mr-1"></i> {{ __('Start Bulk Import') }}
                            </button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#csv-file-input').on('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : '';
            if (fileName) {
                $('#file-name-text').text(fileName);
                $('#file-name-display').removeClass('d-none');
            } else {
                $('#file-name-display').addClass('d-none');
            }
        });
    });
</script>
@endpush

@endsection
