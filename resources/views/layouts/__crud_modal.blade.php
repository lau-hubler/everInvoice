@push('modals')
<p-crud-modal
    action="{{ $action }}"
    object="category"

    discard-button="{{trans('app.buttons.discard')}}"
    save-changes-button="{{trans('app.buttons.saveChanges')}}"

    create-title="{{trans_choice('app.titles.create', $gender, ['item' => $item]) }}"
    update-title="{{trans_choice('app.titles.update', $gender, ['item' => $item])}}"
    details-title="{{trans_choice('app.titles.showDetails', $gender, ['item' => $item])}}"
    discard-title="{{trans('app.titles.discard')}}"

    create-message="{{ trans_choice('app.messages.create', $gender, ['item' => $item]) }}"
    discard-message="{{trans('app.messages.discard')}}"
    saved-message="{{ trans_choice('app.messages.saved', $gender, ['item' => $item]) }}"
></p-crud-modal>
@endpush
