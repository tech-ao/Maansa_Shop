@foreach($datas as $data)
<tr id="blog-bulk-delete">
    <td style="width: 4%;">
        <input type="checkbox" class="bulk-item" value="{{ $data->id }}">
    </td>

    <td style="min-width: 90px;">
        <img src="{{ isset(json_decode($data->photo, true)[0]) ? url('/core/public/storage/images/' . json_decode($data->photo, true)[0]) : url('/core/public/storage/images/placeholder.png') }}"
            onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';"
            alt="{{ $data->title }}"
            style="width: 68px; height: 46px; border-radius: 8px; object-fit: cover; border: 1px solid #e2e8f0; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);">
    </td>

    <td style="min-width: 220px;">
        <a href="{{ route('back.post.edit', $data->id) }}" class="font-weight-bold text-dark d-block" style="font-size: 14px; text-decoration: none; line-height: 1.3;">
            {{ $data->title }}
        </a>
    </td>

    <td style="min-width: 160px;">
        <span class="badge badge-light border text-dark font-weight-bold" style="font-size: 12.5px; padding: 6px 12px; border-radius: 8px;">
            <i class="fa-solid fa-folder-open text-primary mr-1"></i>
            {{ $data->category ? $data->category->name : __('Uncategorized') }}
        </span>
    </td>

    <td class="text-right" style="min-width: 100px;">
        <div class="action-btn-group justify-content-end">
            <a class="btn-action-icon btn-action-edit" href="{{ route('back.post.edit', $data->id) }}" title="{{ __('Edit Blog Post') }}">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <a class="btn-action-icon btn-action-delete" data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.post.destroy', $data->id) }}" title="{{ __('Delete Blog Post') }}">
                <i class="fa-solid fa-trash-can"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
