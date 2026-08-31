@foreach($datas as $data)
<tr>
    <td style="min-width: 180px;">
        <div class="role-name-cell">
            <div class="role-avatar-badge">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div>
                <h6 class="role-name-title">{{ $data->name }}</h6>
                <p class="role-name-subtitle">{{ __('Custom Staff Role') }}</p>
            </div>
        </div>
    </td>

    <td style="min-width: 320px;">
        @if($data->section && $data->section != 'null')
            <div class="d-flex flex-wrap align-items-center">
                @foreach (json_decode($data->section, true) as $item)
                    <span class="badge-perm-tag">
                        <i class="fa-solid fa-circle-check text-primary"></i>
                        {{ $item }}
                    </span>
                @endforeach
            </div>
        @else
            <span class="badge badge-light text-muted border px-2 py-1">{{ __('No Permissions Assigned') }}</span>
        @endif
    </td>

    <td class="text-right" style="min-width: 100px;">
        <div class="action-btn-group justify-content-end">
            <a class="btn-action-icon btn-action-edit" href="{{ route('back.role.edit', $data->id) }}" title="{{ __('Edit Role') }}">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <a class="btn-action-icon btn-action-delete" data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.role.destroy', $data->id) }}" title="{{ __('Delete Role') }}">
                <i class="fa-solid fa-trash-can"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
