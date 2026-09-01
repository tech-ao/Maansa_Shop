@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-sitemap mr-2" style="font-size: 22px;"></i> {{ __('XML Sitemaps & Search Engine Indexing') }}</h2>
                <p>{{ __('Generate, download, and manage XML sitemaps to optimize storefront indexing across Google and search engines.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('back.setting.system') }}">{{ __('Settings') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('Sitemap') }}</li>
                </ul>
            </div>
            <div class="dash-hero-actions mt-2 mt-sm-0">
                <a class="btn btn-hero-white" href="{{ route('admin.sitemap.add') }}">
                    <i class="fa-solid fa-plus mr-1"></i> {{ __('Generate Sitemap') }}
                </a>
            </div>
        </div>
    </div>

    <!-- DataTales / Table Card -->
    <div class="card-modern">
        <div class="card-modern-body p-4">
            <div class="settings-tab-pane-title mb-4 pb-3 border-bottom d-flex align-items-center justify-content-between">
                <div>
                    <i class="fa-solid fa-file-code text-primary mr-2" style="font-size: 18px;"></i>
                    <span>{{ __('Generated Sitemaps') }}</span>
                </div>
                <span class="badge" style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; font-size: 12px; font-weight: 600; padding: 5px 12px; border-radius: 999px;">
                    <i class="fa-solid fa-layer-group mr-1"></i> {{ count($sitemaps) }} {{ __('Files') }}
                </span>
            </div>

            @include('alerts.alerts')

            <div class="table-responsive">
                <table class="table table-modern align-middle" id="admin-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="40%">{{ __('Target Website URL') }}</th>
                            <th width="35%">{{ __('XML File Name') }}</th>
                            <th width="25%" class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sitemaps as $key => $sitemap)
                            <tr>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <div style="width: 36px; height: 36px; border-radius: 8px; background: #f0fdf4; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 15px; margin-right: 12px; flex-shrink: 0;">
                                            <i class="fa-solid fa-globe"></i>
                                        </div>
                                        <div>
                                            <a href="{{ $sitemap->sitemap_url }}" target="_blank" class="font-weight-bold text-dark text-break" style="font-size: 13.5px; text-decoration: none;">
                                                {{ $sitemap->sitemap_url }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <code class="px-2 py-1" style="background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px; font-weight: 600;">
                                        <i class="fa-solid fa-file-code mr-1 text-primary"></i> {{ $sitemap->filename }}
                                    </code>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="d-inline-flex align-items-center">
                                        <form class="d-inline-block mr-2 mb-0" action="{{ route('admin.sitemap.download', $sitemap->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="filename" value="{{ $sitemap->filename }}">
                                            <button type="submit" class="btn btn-sm px-3 py-1 font-weight-bold" style="background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; border-radius: 8px; font-size: 12.5px; transition: all 0.2s;">
                                                <i class="fa-solid fa-download mr-1"></i> {{ __('Download') }}
                                            </button>
                                        </form>

                                        <a class="btn-action-icon btn-action-delete" 
                                           data-toggle="modal"
                                           data-target="#confirm-delete" 
                                           href="javascript:;"
                                           data-href="{{ route('admin.sitemap.delete', [$sitemap->id]) }}"
                                           title="{{ __('Delete Sitemap') }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15); overflow: hidden;">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div class="d-flex align-items-center">
                    <div style="width: 42px; height: 42px; border-radius: 10px; background: #fef2f2; color: #dc2626; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-right: 12px;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <h5 class="modal-title font-weight-bold text-dark" id="confirmDeleteModalLabel">{{ __('Delete Sitemap File?') }}</h5>
                </div>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" style="outline: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 py-3 text-muted" style="font-size: 14px;">
                {{ __('Are you sure you want to delete this sitemap? Search engines will no longer be able to reference this XML crawl map.') }}
            </div>
            <div class="modal-footer border-0 pt-0 pb-4 px-4">
                <button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px; font-size: 13px;">{{ __('Cancel') }}</button>
                <form action="" class="d-inline btn-ok" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 py-2 font-weight-bold" style="border-radius: 8px; font-size: 13px; background: #dc2626; border: none;">
                        <i class="fa-solid fa-trash-can mr-1"></i> {{ __('Delete Permanently') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
