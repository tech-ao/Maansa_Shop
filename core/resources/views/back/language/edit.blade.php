@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-language mr-2" style="font-size: 22px;"></i> {{ __('Edit Language Translations') }}</h2>
                <p>{{ __('Translate phrases, customize dictionary strings, and manage localization keys for') }} <strong>{{ $data->language }}</strong>.</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('back.language.index') }}">{{ __('Languages') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ $data->language }}</li>
                </ul>
            </div>
            <div class="dash-hero-actions mt-2 mt-sm-0">
                <a class="btn btn-hero-action" href="{{ route('back.language.index') }}" style="font-size: 13px; font-weight: 600; padding: 9px 16px; background: rgba(255,255,255,0.15); color: #ffffff; border: 1px solid rgba(255,255,255,0.25);">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Languages') }}
                </a>
            </div>
        </div>
    </div>

    @include('alerts.alerts')

    <form class="geniusform" action="{{ route('back.language.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Left Info Card -->
            <div class="col-xl-4 col-lg-5 col-12 mb-4">
                <div class="card-modern">
                    <div class="card-modern-body p-4">
                        <div class="settings-tab-pane-title mb-3 pb-2 border-bottom">
                            <i class="fa-solid fa-sliders text-primary mr-1"></i> {{ __('Language Settings') }}
                        </div>

                        <div class="settings-section-card mb-4">
                            <div class="form-group mb-0">
                                <label for="language_name" class="form-label font-weight-bold">{{ __('Language Display Name') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-language"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="language" id="language_name" value="{{ $data->language }}" placeholder="{{ __('Enter Language Name') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="settings-section-card mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted" style="font-size: 13px;">{{ __('Type') }}</span>
                                <span class="badge" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 6px;">
                                    {{ $data->type }}
                                </span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="text-muted" style="font-size: 13px;">{{ __('Layout Direction') }}</span>
                                <span class="badge" style="background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 6px;">
                                    {{ $data->rtl == 1 ? 'RTL' : 'LTR' }}
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block w-100 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                            <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save All Changes') }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Translations Table Card -->
            <div class="col-xl-8 col-lg-7 col-12 mb-4">
                <div class="card-modern">
                    <div class="card-modern-body p-4">
                        <div class="settings-tab-pane-title mb-4 pb-3 border-bottom d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fa-solid fa-file-code text-primary mr-1"></i> {{ __('Phrases & Translations') }}
                            </div>
                            <button type="button" class="btn btn-sm font-weight-bold px-3 py-1" id="add_more_language" style="background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; border-radius: 8px; font-size: 12.5px;">
                                <i class="fa-solid fa-plus mr-1"></i> {{ __('Add More Key') }}
                            </button>
                        </div>

                        <div class="table-responsive" style="max-height: 650px; overflow-y: auto;">
                            <table class="table table-modern align-middle" width="100%" cellspacing="0">
                                <thead style="position: sticky; top: 0; z-index: 2;">
                                    <tr>
                                        <th width="45%">{{ __('Original Key / Text') }}</th>
                                        <th width="45%">{{ __('Translated Value') }}</th>
                                        <th width="10%" class="text-center">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="new-field">
                                    @foreach($lang as $key => $val)
                                        <tr>
                                            <td class="align-middle">
                                                <input type="text" class="form-control font-monospace text-muted" style="background: #f8fafc; font-size: 13px; font-weight: 600;" readonly name="keys[]" value="{{ $key }}">
                                            </td>
                                            <td class="align-middle">
                                                <input type="text" class="form-control font-weight-bold text-dark" style="font-size: 13.5px;" name="values[]" value="{{ $val }}">
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="delete_language_field">
                                                    <button type="button" class="btn-action-icon btn-action-delete" title="{{ __('Delete Key') }}">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <button type="button" class="btn btn-sm font-weight-bold px-3 py-2" id="add_more_language_bottom" onclick="$('#add_more_language').click()" style="background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; border-radius: 8px; font-size: 13px;">
                                <i class="fa-solid fa-plus mr-1"></i> {{ __('Add More Key') }}
                            </button>
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Update Translations') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

</div>

@endsection
