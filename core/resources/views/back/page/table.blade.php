@foreach ($datas as $data)
    <tr>
        <td style="min-width: 180px;">
            <div class="d-flex align-items-center" style="gap: 10px;">
                <div class="ticket-user-avatar" style="width: 36px; height: 36px; min-width: 36px; font-size: 14px; background: #f0fdf4; color: #059669; border-radius: 10px;">
                    <i class="fa-solid fa-file-lines"></i>
                </div>
                <div>
                    <a href="{{ route('back.page.edit', [$data->id]) }}" class="font-weight-bold text-dark d-block" style="font-size: 14px; text-decoration: none;">
                        {{ $data->title }}
                    </a>
                    <span class="text-muted" style="font-size: 11.5px; font-family: monospace;">
                        /{{ $data->slug }}
                    </span>
                </div>
            </div>
        </td>

        <td style="min-width: 260px;">
            <p class="text-muted mb-0" style="font-size: 13px; line-height: 1.5; max-width: 460px;">
                {{ Str::limit(strip_tags($data->details ?? $data->content ?? ''), 120, '...') ?: __('No content details provided yet.') }}
            </p>
        </td>

        <td style="min-width: 130px;">
            <div class="dropdown d-inline-block">
                <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton-{{ $data->id }}"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    style="border-radius: 20px; font-size: 12px; font-weight: 700; padding: 5px 14px; background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; white-space: nowrap;">
                    <i class="fa-solid fa-layer-group mr-1"></i>
                    {{ $data->pos == 2 ? __('Both') : ($data->pos == 0 ? __('Header') : __('Footer')) }}
                </button>
                <div class="dropdown-menu dropdown-menu-right animated--fade-in shadow border-0" aria-labelledby="dropdownMenuButton-{{ $data->id }}" style="border-radius: 12px; min-width: 190px;">
                    <h6 class="dropdown-header text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase;">{{ __('Set Display Position') }}</h6>
                    <a class="dropdown-item {{ $data->pos == 2 ? 'active font-weight-bold' : '' }}" href="{{ route('back.page.pos', [$data->id, 2]) }}">
                        <i class="fa-solid fa-arrows-up-down mr-2 text-muted"></i> {{ __('Both (Header & Footer)') }}
                    </a>
                    <a class="dropdown-item {{ $data->pos == 0 ? 'active font-weight-bold' : '' }}" href="{{ route('back.page.pos', [$data->id, 0]) }}">
                        <i class="fa-solid fa-arrow-up mr-2 text-muted"></i> {{ __('Header Menu Only') }}
                    </a>
                    <a class="dropdown-item {{ $data->pos == 1 ? 'active font-weight-bold' : '' }}" href="{{ route('back.page.pos', [$data->id, 1]) }}">
                        <i class="fa-solid fa-arrow-down mr-2 text-muted"></i> {{ __('Footer Menu Only') }}
                    </a>
                </div>
            </div>
        </td>

        <td class="text-right" style="min-width: 100px;">
            <div class="action-btn-group justify-content-end">
                <a class="btn-action-icon btn-action-edit" href="{{ route('back.page.edit', [$data->id]) }}" title="{{ __('Edit Page') }}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a class="btn-action-icon btn-action-delete" data-toggle="modal" data-target="#confirm-delete"
                    href="javascript:;" data-href="{{ route('back.page.destroy', [$data->id]) }}" title="{{ __('Delete Page') }}">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </div>
        </td>
    </tr>
@endforeach
