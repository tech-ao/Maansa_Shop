@foreach($datas as $data)
    <tr>
        <td class="text-center align-middle">
            <div style="width: 54px; height: 54px; border-radius: 12px; overflow: hidden; background: #ffffff; border: 1px solid #e2e8f0; display: inline-flex; align-items: center; justify-content: center; padding: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <img style="max-width: 100%; max-height: 100%; object-fit: contain;" 
                     src="{{ $data->photo ? url('/core/public/storage/images/'.$data->photo) : url('/core/public/storage/images/placeholder.png') }}" 
                     alt="{{ $data->title }}"
                     onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';">
            </div>
        </td>
        <td class="align-middle">
            <div class="font-weight-bold text-dark" style="font-size: 14.5px;">
                {{ $data->title }}
            </div>
            @if(!empty($data->details))
                <small class="text-muted d-block mt-1 text-truncate" style="max-width: 400px; font-size: 12.5px;">
                    {{ $data->details }}
                </small>
            @endif
        </td>
        <td class="text-center align-middle">
            <div class="action-btn-group justify-content-center">
                <a class="btn-action-icon btn-action-edit" 
                   href="{{ route('back.service.edit', $data->id) }}" 
                   title="{{ __('Edit Service') }}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a class="btn-action-icon btn-action-delete" 
                   data-toggle="modal" 
                   data-target="#confirm-delete" 
                   href="javascript:;" 
                   data-href="{{ route('back.service.destroy', $data->id) }}" 
                   title="{{ __('Delete Service') }}">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </div>
        </td>
    </tr>
@endforeach
