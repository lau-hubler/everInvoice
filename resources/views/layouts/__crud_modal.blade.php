@push('modals')
<p-crud-modal
    create-title="{{ $modalTitle ?? trans_choice('app.create.modalTitle', $gender, ['item' => $item]) }}"
    update-title="Update Title"
    details-title="Detail Title"
    object="category"
    create-message="{{ $createModalMessage ?? trans_choice('app.create.modalMessage', $gender, ['item' => $item]) }}"
    action="{{ $action }}"
></p-crud-modal>
@endpush
