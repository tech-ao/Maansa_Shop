@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-language mr-2" style="font-size: 22px;"></i> {{ __('Language & Multi-Lingual Translations') }}</h2>
                <p>{{ __('Manage active languages, storefront internationalization, RTL/LTR layout directions, and translation keys.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('back.setting.system') }}">{{ __('Settings') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('Language') }}</li>
                </ul>
            </div>
            <div class="dash-hero-actions mt-2 mt-sm-0">
                <a class="btn btn-hero-white" href="{{ route('back.language.create') }}">
                    <i class="fa-solid fa-plus mr-1"></i> {{ __('Add New Language') }}
                </a>
            </div>
        </div>
    </div>

    @include('alerts.alerts')

    <!-- 1. FRONTEND TRANSLATIONS CARD -->
    <div class="card-modern mb-4">
        <div class="card-modern-body p-4">
            <div class="settings-tab-pane-title mb-4 pb-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div style="width: 36px; height: 36px; border-radius: 8px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 15px; margin-right: 12px;">
                        <i class="fa-solid fa-store"></i>
                    </div>
                    <div>
                        <span class="font-weight-bold text-dark" style="font-size: 16px;">{{ __('Frontend Storefront Translations') }}</span>
                        <small class="text-muted d-block" style="font-size: 12px;">{{ __('Languages available to customers browsing the public storefront.') }}</small>
                    </div>
                </div>
                <span class="badge" style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; font-size: 12px; font-weight: 600; padding: 5px 12px; border-radius: 999px;">
                    <i class="fa-solid fa-globe mr-1"></i> {{ __('Storefront') }}
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-modern align-middle" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="30%">{{ __('Language Name') }}</th>
                            <th width="20%">{{ __('Text Direction') }}</th>
                            <th width="25%">{{ __('Default Status') }}</th>
                            <th width="25%" class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            @if ($data->type == 'Website')
                                <tr>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div style="width: 34px; height: 34px; border-radius: 8px; background: #f8fafc; color: #475569; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; font-size: 14px; margin-right: 10px; flex-shrink: 0;">
                                                <i class="fa-solid fa-earth-americas text-primary"></i>
                                            </div>
                                            <span class="font-weight-bold text-dark" style="font-size: 14px;">{{ $data->language }}</span>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        @if ($data->rtl == 0)
                                            <span class="badge" style="background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; font-weight: 700; font-size: 12px; padding: 4px 10px; border-radius: 6px;">
                                                <i class="fa-solid fa-align-left mr-1 text-primary"></i> {{ __('LTR (Left to Right)') }}
                                            </span>
                                        @else
                                            <span class="badge" style="background: #fdf4ff; color: #a21caf; border: 1px solid #f5d0fe; font-weight: 700; font-size: 12px; padding: 4px 10px; border-radius: 6px;">
                                                <i class="fa-solid fa-align-right mr-1 text-purple"></i> {{ __('RTL (Right to Left)') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div class="dropdown">
                                            @if ($data->is_default == 1)
                                                <button class="btn btn-sm dropdown-toggle font-weight-bold px-3 py-1"
                                                        style="background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; border-radius: 8px; font-size: 12px;"
                                                        type="button" id="dropdownMenuButton{{ $data->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa-solid fa-circle-check mr-1"></i> {{ __('Default') }}
                                                </button>
                                            @else
                                                <button class="btn btn-sm dropdown-toggle font-weight-bold px-3 py-1"
                                                        style="background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; border-radius: 8px; font-size: 12px;"
                                                        type="button" id="dropdownMenuButton{{ $data->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa-solid fa-circle-xmark mr-1"></i> {{ __('Set as Default') }}
                                                </button>
                                            @endif
                                            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton{{ $data->id }}">
                                                <a class="dropdown-item" href="{{ route('back.language.status', [$data->id, 1]) }}">
                                                    <i class="fa-solid fa-check mr-1 text-success"></i> {{ __('Set as Default') }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="d-inline-flex align-items-center gap-2">
                                            <a class="btn btn-sm px-3 py-1 mr-2" 
                                               style="background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; font-weight: 600; border-radius: 8px; font-size: 12.5px; transition: all 0.2s;"
                                               href="{{ route('back.language.edit', $data->id) }}">
                                                <i class="fa-solid fa-pen-to-square mr-1"></i> {{ __('Edit') }}
                                            </a>
                                            @if($data->id != 1)
                                                <a class="btn-action-icon btn-action-delete" 
                                                   data-toggle="modal"
                                                   data-target="#confirm-delete" 
                                                   href="javascript:;"
                                                   data-href="{{ route('back.language.destroy', $data->id) }}"
                                                   title="{{ __('Delete Language') }}">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 2. DASHBOARD TRANSLATIONS CARD -->
    <div class="card-modern mb-4">
        <div class="card-modern-body p-4">
            <div class="settings-tab-pane-title mb-4 pb-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div style="width: 36px; height: 36px; border-radius: 8px; background: #f0fdf4; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 15px; margin-right: 12px;">
                        <i class="fa-solid fa-gauge-high"></i>
                    </div>
                    <div>
                        <span class="font-weight-bold text-dark" style="font-size: 16px;">{{ __('Admin Dashboard Translations') }}</span>
                        <small class="text-muted d-block" style="font-size: 12px;">{{ __('Languages available to administrators in the control panel.') }}</small>
                    </div>
                </div>
                <span class="badge" style="background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; font-size: 12px; font-weight: 600; padding: 5px 12px; border-radius: 999px;">
                    <i class="fa-solid fa-sliders mr-1"></i> {{ __('Admin Panel') }}
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-modern align-middle" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="30%">{{ __('Language Name') }}</th>
                            <th width="20%">{{ __('Text Direction') }}</th>
                            <th width="25%">{{ __('Active Status') }}</th>
                            <th width="25%" class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            @if ($data->type == 'Dashboard')
                                <tr>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div style="width: 34px; height: 34px; border-radius: 8px; background: #f8fafc; color: #475569; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; font-size: 14px; margin-right: 10px; flex-shrink: 0;">
                                                <i class="fa-solid fa-earth-americas text-primary"></i>
                                            </div>
                                            <span class="font-weight-bold text-dark" style="font-size: 14px;">{{ $data->language }}</span>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        @if ($data->rtl == 0)
                                            <span class="badge" style="background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; font-weight: 700; font-size: 12px; padding: 4px 10px; border-radius: 6px;">
                                                <i class="fa-solid fa-align-left mr-1 text-primary"></i> {{ __('LTR (Left to Right)') }}
                                            </span>
                                        @else
                                            <span class="badge" style="background: #fdf4ff; color: #a21caf; border: 1px solid #f5d0fe; font-weight: 700; font-size: 12px; padding: 4px 10px; border-radius: 6px;">
                                                <i class="fa-solid fa-align-right mr-1 text-purple"></i> {{ __('RTL (Right to Left)') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div class="dropdown">
                                            @if ($data->is_default == 1)
                                                <button class="btn btn-sm dropdown-toggle font-weight-bold px-3 py-1"
                                                        style="background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; border-radius: 8px; font-size: 12px;"
                                                        type="button" id="dropdownDashButton{{ $data->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa-solid fa-circle-check mr-1"></i> {{ __('Active') }}
                                                </button>
                                            @else
                                                <button class="btn btn-sm dropdown-toggle font-weight-bold px-3 py-1"
                                                        style="background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; border-radius: 8px; font-size: 12px;"
                                                        type="button" id="dropdownDashButton{{ $data->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa-solid fa-circle-xmark mr-1"></i> {{ __('Inactive') }}
                                                </button>
                                            @endif
                                            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownDashButton{{ $data->id }}">
                                                <a class="dropdown-item" href="{{ route('back.language.status', [$data->id, 1]) }}">
                                                    <i class="fa-solid fa-check mr-1 text-success"></i> {{ __('Set as Active') }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">
                                        <a class="btn btn-sm px-3 py-1" 
                                           style="background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; font-weight: 600; border-radius: 8px; font-size: 12.5px; transition: all 0.2s;"
                                           href="{{ route('back.language.edit', $data->id) }}">
                                            <i class="fa-solid fa-pen-to-square mr-1"></i> {{ __('Edit') }}
                                        </a>
                                    </td>
                                </tr>
                            @endif
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
                    <h5 class="modal-title font-weight-bold text-dark" id="confirmDeleteModalLabel">{{ __('Delete Language?') }}</h5>
                </div>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" style="outline: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 py-3 text-muted" style="font-size: 14px;">
                {{ __('You are going to delete this Language. All storefront translation files and contents related to this language will be permanently lost.') }}
            </div>
            <div class="modal-footer border-0 pt-0 pb-4 px-4">
                <button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px; font-size: 13px;">{{ __('Cancel') }}</button>
                <form action="" class="d-inline btn-ok" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 py-2 font-weight-bold" style="border-radius: 8px; font-size: 13px; background: #dc2626; border: none;">
                        <i class="fa-solid fa-trash-can mr-1"></i> {{ __('Delete Language') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
