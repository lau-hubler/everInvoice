@push('modals')
<p-create-modal
    title = "{{ $modalTitle ?? trans_choice('app.create.modalTitle', $gender, ['item' => $item]) }}"
    message="{{ $createModalMessage ?? trans_choice('app.create.modalMessage', $gender, ['item' => $item]) }}"
    ok-text="{{ $createModalOkText ?? __('app.create.modalOkText') }}"
    cancel-text="{{ $createModalCancelText ?? __('app.create.modalCancelText') }}"
    action="{{ $action }}"
></p-create-modal>

<p-crud-modal
    title = "{{ $modalTitle ?? trans_choice('app.create.modalTitle', $gender, ['item' => $item]) }}"
    action="{{ $action }}"
></p-crud-modal>
@endpush
