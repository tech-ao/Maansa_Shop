@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-file-lines mr-2" style="font-size: 22px;"></i> {{ __('Manage Custom Pages') }}</h2>
                <p>{{ __('Create and manage informational pages, policies, about us, and terms & services for your storefront.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.page.create') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-plus mr-1"></i> {{ __('Create New Page') }}
                </a>
            </div>
        </div>
    </div>

    <!-- DataTales -->
    <div class="card-modern">
        <div class="card-modern-body">
            @include('alerts.alerts')
            <div class="table-responsive">
                <table class="table-modern" id="admin-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="22%">{{ __('Page Title') }}</th>
                            <th width="48%">{{ __('Summary / Excerpt') }}</th>
                            <th width="15%">{{ __('Display Position') }}</th>
                            <th width="15%" class="text-right">{{ __('Actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @include('back.page.table', compact('datas'))
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- DELETE MODAL --}}

  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

		<!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('Confirm Delete?') }}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
		</div>

		<!-- Modal Body -->
        <div class="modal-body">
			{{ __('You are going to delete this page. All contents related with this page will be lost.') }} {{ __('Do you want to delete it?') }}
		</div>

		<!-- Modal footer -->
        <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
			<form action="{{ route('back.page.destroy.direct') }}" class="d-inline btn-ok" method="POST">

                @csrf

                @method('DELETE')

                <input type="hidden" name="id" class="delete-page-id" id="delete-page-id" value="">

                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>

			</form>
		</div>

      </div>
    </div>
  </div>

{{-- DELETE MODAL ENDS --}}

@endsection

@section('scripts')
<script>
    $(document).on('click', '.btn-action-delete, [data-target="#confirm-delete"]', function(e) {
        var href = $(this).attr('data-href') || $(this).data('href') || $(this).closest('[data-href]').attr('data-href');
        var id = $(this).attr('data-id') || $(this).data('id') || $(this).closest('[data-id]').attr('data-id');
        if (href) {
            $('#confirm-delete form.btn-ok').attr('action', href);
        }
        if (id) {
            $('#confirm-delete #delete-page-id').val(id);
        }
    });

    $('#confirm-delete').on('show.bs.modal', function (e) {
        var related = $(e.relatedTarget);
        var href = related.attr('data-href') || related.data('href') || related.closest('[data-href]').attr('data-href') || related.closest('[data-href]').data('href');
        var id = related.attr('data-id') || related.data('id') || related.closest('[data-id]').attr('data-id') || related.closest('[data-id]').data('id');
        if (href) {
            $(this).find('.btn-ok').attr('action', href);
        }
        if (id) {
            $(this).find('#delete-page-id').val(id);
        }
    });

    $('#confirm-delete form.btn-ok').on('submit', function(e) {
        var action = $(this).attr('action');
        var id = $(this).find('#delete-page-id').val();
        if ((!action || action === '') && !id) {
            e.preventDefault();
            console.error('Delete form action is missing and no page ID is provided.');
            return false;
        }
    });
</script>
@endsection
