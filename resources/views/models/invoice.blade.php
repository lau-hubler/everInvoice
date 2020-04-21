@extends('layouts.app')

@section('content')
@include('layouts.__alert')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-end">
        <h3>{{ __('invoice.title') }}</h3>
        <b-button-toolbar aria-label="Toolbar for invoices">
            <b-button-group class="mx-1">
                <p-search-input item="invoice" ></p-search-input>
            </b-button-group>
            <b-button-group class="mx-1">
                <b-button v-b-toggle.import-collapse class="font-weight-bold">
                    <span><font-awesome-icon icon="upload" size="xs" /></span>
                    <span class="pl-1">{{__('Import')}}</span>
                </b-button>
                <form action="{{ route('invoices.export') }}">
                    <b-button type="submit" class="font-weight-bold">
                        <span><font-awesome-icon icon="upload" size="xs" /></span>
                        <span class="pl-1">{{__('Export')}}</span>
                    </b-button>
                </form>
                <p-create-button component="p-create-invoice">{{ __('app.buttons.new') }}</p-create-button>
            </b-button-group>
        </b-button-toolbar>
    </div>
    <div class="card-body">
        @include('models.__importCollapse')
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
