@extends('master.back')


@section('content')


<section class="content menu-builder-section">
    <div class="container-fluid">
        <!-- Page Header Banner -->
        <div class="dash-hero-banner mb-4">
            <div class="dash-hero-content">
                <div class="dash-hero-text">
                    <h2><i class="fa-solid fa-compass-drafting mr-2" style="font-size: 22px;"></i> {{ __('Navigation Menu Builder') }}</h2>
                    <p>{{ __('Customize your storefront navigation hierarchy, organize dropdown submenus, and manage custom links.') }}</p>
                </div>
                <div class="dash-hero-actions">
                    <button id="updateMenu" class="btn btn-hero-action btn-hero-primary" style="font-size: 13.5px; font-weight: 700; padding: 10px 22px; cursor: pointer;">
                        <i class="fa-solid fa-floppy-disk mr-1"></i>
                        <span>{{ __('Save Menu Changes') }}</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Col 1: Add / Edit Menu Item -->
            <div class="col-lg-4 mb-4">
                <div class="menu-builder-card">
                    <div class="menu-builder-card-header">
                        <h6>
                            <i class="fa-solid fa-pen-to-square text-primary"></i>
                            <span>{{ __('Add & Edit Menu Item') }}</span>
                        </h6>
                    </div>
                    <div class="menu-builder-card-body">
                        <form id="frmEdit" class="form-horizontal">
                            <input class="item-menu" type="hidden" name="type" value="">

                            <div id="withUrl">
                                <div class="form-group mb-3">
                                    <label for="text" class="form-label font-weight-bold">{{ __('Menu Label / Text') }} *</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa-solid fa-font"></i></span>
                                        </div>
                                        <input type="text" class="form-control item-menu" name="text" id="text" placeholder="{{ __('e.g. Special Offers') }}">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="href" class="form-label font-weight-bold">{{ __('Destination URL') }} *</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa-solid fa-link"></i></span>
                                        </div>
                                        <input type="text" class="form-control item-menu" name="href" id="href" placeholder="{{ __('https://yourstore.com/page or #') }}">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="target" class="form-label font-weight-bold">{{ __('Link Target') }} *</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa-solid fa-arrow-up-right-from-square"></i></span>
                                        </div>
                                        <select name="target" id="target" class="form-control item-menu">
                                            <option value="_self">{{ __('Same Window (_self)') }}</option>
                                            <option value="_blank">{{ __('New Tab / Window (_blank)') }}</option>
                                            <option value="_top">{{ __('Top Frame (_top)') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="withoutUrl" style="display: none;">
                                <div class="form-group mb-3">
                                    <label for="text_no_url" class="form-label font-weight-bold">{{ __('Menu Label / Text') }} *</label>
                                    <input type="text" class="form-control item-menu" name="text" id="text_no_url" placeholder="{{ __('Text') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="href_no_url" class="form-label font-weight-bold">{{ __('URL') }}</label>
                                    <input type="text" class="form-control item-menu" name="href" id="href_no_url" placeholder="{{ __('URL') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="target_no_url" class="form-label font-weight-bold">{{ __('Target') }}</label>
                                    <select name="target" id="target_no_url" class="form-control item-menu">
                                        <option value="_self">{{ __('Same Window (_self)') }}</option>
                                        <option value="_blank">{{ __('New Tab / Window (_blank)') }}</option>
                                        <option value="_top">{{ __('Top Frame (_top)') }}</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="menu-builder-card-footer">
                        <button type="button" id="btnUpdate" class="btn btn-primary btn-sm px-3" disabled style="border-radius: 9px; font-weight: 700;">
                            <i class="fa-solid fa-arrows-rotate mr-1"></i> {{ __('Update Selected') }}
                        </button>
                        <button type="button" id="btnAdd" class="btn btn-success btn-sm px-3" style="border-radius: 9px; font-weight: 700; background: #10b981; border-color: #10b981;">
                            <i class="fa-solid fa-plus mr-1"></i> {{ __('Add Custom Link') }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Col 2: Live Menu Hierarchy -->
            <div class="col-lg-4 mb-4">
                <div class="menu-builder-card">
                    <div class="menu-builder-card-header">
                        <h6>
                            <i class="fa-solid fa-sitemap text-primary"></i>
                            <span>{{ __('Active Menu Structure') }}</span>
                        </h6>
                    </div>
                    <div class="menu-builder-card-body">
                        <p style="font-size: 12.5px; color: #64748b; margin-bottom: 16px;">
                            <i class="fa-solid fa-circle-info mr-1 text-primary"></i> {{ __('Drag items or use arrow controls to reorder & indent dropdown submenus.') }}
                        </p>
                        <ul id="myEditor" class="sortableLists list-group"></ul>
                    </div>
                </div>
            </div>

            <!-- Col 3: Pre-Made Menu Items -->
            <div class="col-lg-4 mb-4">
                <div class="menu-builder-card">
                    <div class="menu-builder-card-header">
                        <h6>
                            <i class="fa-solid fa-boxes-stacked text-primary"></i>
                            <span>{{ __('Quick-Add Modules & Pages') }}</span>
                        </h6>
                    </div>
                    <div class="menu-builder-card-body">
                        <p style="font-size: 12.5px; color: #64748b; margin-bottom: 16px;">
                            {{ __('Click the "+" button to append any storefront route or CMS page to the main navigation.') }}
                        </p>
                        <ul class="list-group pre-made-menu-list">
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <span><i class="fa-solid fa-house text-primary mr-2"></i> {{ __('Home') }}</span>
                                <a data-text="{{ __('Home') }}" data-type="home" class="addToMenus" href="" title="{{ __('Add Home to Menu') }}"><i class="fa-solid fa-plus"></i></a>
                            </li>

                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <span><i class="fa-solid fa-bag-shopping text-info mr-2"></i> {{ __('Shop') }}</span>
                                <a data-text="{{ __('Shop') }}" data-type="shop" class="addToMenus" href="" title="{{ __('Add Shop to Menu') }}"><i class="fa-solid fa-plus"></i></a>
                            </li>

                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <span><i class="fa-solid fa-fire text-warning mr-2"></i> {{ __('Campaign / Deals') }}</span>
                                <a data-text="{{ __('Campaign') }}" data-type="campaign" class="addToMenus" href="" title="{{ __('Add Campaign to Menu') }}"><i class="fa-solid fa-plus"></i></a>
                            </li>

                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <span><i class="fa-solid fa-certificate text-success mr-2"></i> {{ __('Brands') }}</span>
                                <a data-text="{{ __('Brand') }}" data-type="brand" class="addToMenus" href="" title="{{ __('Add Brand to Menu') }}"><i class="fa-solid fa-plus"></i></a>
                            </li>

                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <span><i class="fa-solid fa-newspaper text-purple mr-2"></i> {{ __('Blog') }}</span>
                                <a data-text="{{ __('Blog') }}" data-type="blog" class="addToMenus" href="" title="{{ __('Add Blog to Menu') }}"><i class="fa-solid fa-plus"></i></a>
                            </li>

                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <span><i class="fa-solid fa-circle-question text-secondary mr-2"></i> {{ __('FAQ') }}</span>
                                <a data-text="{{ __('Faq') }}" data-type="faq" class="addToMenus" href="" title="{{ __('Add FAQ to Menu') }}"><i class="fa-solid fa-plus"></i></a>
                            </li>

                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <span><i class="fa-solid fa-envelope-open-text text-danger mr-2"></i> {{ __('Contact Us') }}</span>
                                <a data-text="{{ __('Contact') }}" data-type="contact" class="addToMenus" href="" title="{{ __('Add Contact to Menu') }}"><i class="fa-solid fa-plus"></i></a>
                            </li>

                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <span><i class="fa-solid fa-layer-group text-primary mr-2"></i> {{ __('Pages Mega Menu') }}</span>
                                <a data-text="{{ __('Pages') }}" data-type="pages" class="addToMenus" href="" title="{{ __('Add Pages Mega Menu') }}"><i class="fa-solid fa-plus"></i></a>
                            </li>

                            @foreach ($pages as $page)
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <span><i class="fa-solid fa-file-lines text-muted mr-2"></i> {{ $page->title }}</span>
                                <a data-text="{{ $page->title }}" data-type="{{ $page->id }}" data-custom="yes" class="addToMenus" href="" title="{{ __('Add to Menu') }}"><i class="fa-solid fa-plus"></i></a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('scripts')
<script src="{{ asset('assets/back/js/menu.js') }}"></script>

<script>
    jQuery(document).ready(function () {
 
    var arrayjson = {!! json_encode($prevMenu) !!};


    var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};

    var sortableListOptions = {
        placeholderCss: {'background-color': "#ddd"}
    };

    var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
    editor.setForm($('#frmEdit'));
    editor.setUpdateButton($('#btnUpdate'));


    editor.setData({!! $prevMenu !!});
 

    $('#updateMenu').on('click', function () {
        var str = editor.getString();
        let fd = new FormData();
        fd.append('str', str);
     

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{route('back.menu.update')}}",
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if(data.status == 'error') {
                    error(data.message);
                } else {
                    success(data.message);
                }
            }
        });
    });


    // Click on item in menu tree to start editing
    $(document).on('click', '#myEditor .list-group-item', function(e) {
        if ($(e.target).closest('.btn-group, .sortableListsOpener, a, button').length) {
            return;
        }
        $(this).find('.btnEdit').first().trigger('click');
    });

    $("#btnUpdate").click(function(e){
        e.preventDefault();
        if (!editor.getCurrentItem()) {
            Toast2.fire({
                icon: 'info',
                title: '{{ __("Please select a menu item to edit first by clicking on it or its pencil icon.") }}'
            });
            return;
        }
        disableWithoutUrl();
        editor.update();
        enableWithoutUrl();
        Toast2.fire({
            icon: 'success',
            title: '{{ __("Item updated in tree! Click \"Save Menu Changes\" to publish.") }}'
        });
    });

    $('#btnAdd').click(function(e){
        e.preventDefault();
        var labelVal = $("#withUrl input[name='text']").val().trim();
        if (!labelVal) {
            Toast2.fire({
                icon: 'warning',
                title: '{{ __("Please enter a Menu Label / Text first.") }}'
            });
            $("#withUrl input[name='text']").focus();
            return;
        }
        disableWithoutUrl();
        $("input[name='type']").val('custom');
        editor.add();
        enableWithoutUrl();
        Toast2.fire({
            icon: 'success',
            title: '{{ __("Custom link added! Click \"Save Menu Changes\" to save.") }}'
        });
    });


    $(".addToMenus").on('click', function(e) {
        e.preventDefault();
    
        $("input[name='type']").val($(this).data('type'));
        $("#withoutUrl input[name='text']").val($(this).data('text'));
        $("#withoutUrl input[name='target']").val('_self');
        editor.add();

        if ($(this).data('type').indexOf('mega') > -1) {
            $("#myEditor").find("span.txt").last().after(" <span class='ml-2 badge badge-danger'>Mega Menu</span>");
        }

        Toast2.fire({
            icon: 'success',
            title: '{{ __("Added to menu structure!") }}'
        });
    });


});
</script>
@endsection
