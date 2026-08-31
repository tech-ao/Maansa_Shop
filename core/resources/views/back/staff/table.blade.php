@foreach($datas as $data)
<tr>
    <td style="min-width: 80px;">
        <img class="admin-img"
            src="{{ $data->photo ? url('/core/public/storage/images/' . $data->photo) : url('/core/public/storage/images/placeholder.png') }}"
            onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';"
            alt="{{ $data->name }}"
            style="width: 44px; height: 44px; border-radius: 10px; object-fit: cover; border: 1px solid #e2e8f0; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);">
    </td>

    <td style="min-width: 160px;">
        <div class="font-weight-bold text-dark" style="font-size: 14px;">
            {{ $data->name }}
        </div>
    </td>

    <td style="min-width: 160px;">
        <span class="badge badge-light border text-dark font-weight-bold" style="font-size: 12.5px; padding: 6px 12px; border-radius: 8px;">
            <i class="fa-solid fa-shield-halved text-primary mr-1"></i>
            {{ $data->role ? $data->role->name : __('No Role') }}
        </span>
    </td>

    <td style="min-width: 180px;">
        <span class="text-dark">{{ $data->email }}</span>
    </td>

    <td style="min-width: 130px;">
        <span class="text-muted">{{ $data->phone ?: '--' }}</span>
    </td>

    <td class="text-right" style="min-width: 100px;">
        <div class="action-btn-group justify-content-end">
            <a class="btn-action-icon btn-action-edit" href="{{ route('back.staff.edit', $data->id) }}" title="{{ __('Edit Staff User') }}">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <a class="btn-action-icon btn-action-delete" data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.staff.destroy', $data->id) }}" title="{{ __('Delete Staff User') }}">
                <i class="fa-solid fa-trash-can"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
