@foreach ($datas as $data)
    <tr>
        <td style="min-width: 110px;">
            <div style="width: 100px; height: 48px; border-radius: 8px; overflow: hidden; background: #f8fafc; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <img src="{{ $data->photo ? url('/core/public/storage/images/' . $data->photo) : url('/core/public/storage/images/placeholder.png') }}"
                     alt="{{ $data->title ?? 'Slider Image' }}"
                     style="width: 100%; height: 100%; object-fit: cover;"
                     onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';">
            </div>
        </td>

        <td style="min-width: 180px;">
            <div style="font-weight: 700; color: #0f172a; font-size: 13.5px; margin-bottom: 2px;">
                @if ($data->home_page != 'theme4')
                    {{ $data->title ? $data->title : __('Untitled Slider') }}
                @else
                    <span class="text-muted font-italic">{{ __('Grid Banner Item') }}</span>
                @endif
            </div>
            @if($data->link)
                <a href="{{ $data->link }}" target="_blank" class="text-muted d-inline-flex align-items-center" style="font-size: 11.5px; text-decoration: none; max-width: 220px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                    <i class="fa-solid fa-link text-primary mr-1" style="font-size: 10px;"></i> {{ $data->link }}
                </a>
            @endif
        </td>

        <td style="min-width: 120px;">
            @php
                $theme = strtolower($data->home_page ?? 'theme1');
            @endphp
            @if($theme == 'theme1')
                <span class="badge" style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; font-size: 11.5px; font-weight: 700; padding: 5px 10px; border-radius: 999px;">
                    <i class="fa-solid fa-store mr-1"></i> {{ __('Home 1') }}
                </span>
            @elseif($theme == 'theme2')
                <span class="badge" style="background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; font-size: 11.5px; font-weight: 700; padding: 5px 10px; border-radius: 999px;">
                    <i class="fa-solid fa-bag-shopping mr-1"></i> {{ __('Home 2') }}
                </span>
            @elseif($theme == 'theme3')
                <span class="badge" style="background: #fff7ed; color: #c2410c; border: 1px solid #fed7aa; font-size: 11.5px; font-weight: 700; padding: 5px 10px; border-radius: 999px;">
                    <i class="fa-solid fa-bolt mr-1"></i> {{ __('Home 3') }}
                </span>
            @elseif($theme == 'theme4')
                <span class="badge" style="background: #faf5ff; color: #7e22ce; border: 1px solid #e9d5ff; font-size: 11.5px; font-weight: 700; padding: 5px 10px; border-radius: 999px;">
                    <i class="fa-solid fa-gem mr-1"></i> {{ __('Home 4') }}
                </span>
            @else
                <span class="badge" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; font-size: 11.5px; font-weight: 700; padding: 5px 10px; border-radius: 999px;">
                    {{ strtoupper($data->home_page) }}
                </span>
            @endif
        </td>

        <td style="min-width: 200px;">
            @if ($data->home_page != 'theme4' && !empty($data->details))
                <span class="text-muted" style="font-size: 12.5px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                    {{ $data->details }}
                </span>
            @else
                <span class="text-muted font-italic" style="font-size: 12px;">--</span>
            @endif
        </td>

        <td class="text-right" style="min-width: 90px;">
            <div class="action-btn-group justify-content-end">
                <a class="btn-action-icon btn-action-edit" href="{{ route('back.slider.edit', $data->id) }}" title="{{ __('Edit Slider') }}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a class="btn-action-icon btn-action-delete" data-toggle="modal" data-target="#confirm-delete" href="javascript:;"
                    data-href="{{ route('back.slider.destroy', $data->id) }}" title="{{ __('Delete Slider') }}">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </div>
        </td>
    </tr>
@endforeach
