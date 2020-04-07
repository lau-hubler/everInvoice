@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-end">
        <h3>{{ __('invoice.title') }}</h3>
        <b-button-toolbar aria-label="Toolbar for invoices">
            <b-button-group class="mx-1">
                <p-search-input item="invoice" ></p-search-input>
            </b-button-group>
            <b-button-group class="mx-1">
                <p-create-button component="p-create-invoice">{{ __('app.buttons.new') }}</p-create-button>
            </b-button-group>
        </b-button-toolbar>
    </div>
    <div class="card-body">
        <p-invoices-table
            action="{{ route('invoices.index') }}"
        ></p-invoices-table>
    </div>
    @include('layouts.__crud_modal', [
        'item' => trans('invoice.item'),
        'object' => 'invoice',
        'gender' => 1,
        'action' => route( 'api.invoices.store' ),
        'modalSize' => 'xl',
    ])
</div>
@endsection
