@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-end">
        <h3>{{ __('product.title') }}</h3>
        <b-button-toolbar aria-label="Toolbar for categories">
            <b-button-group class="mx-1">
                <p-create-button component="p-create-product">{{ __('app.buttons.new') }}</p-create-button>
            </b-button-group>
        </b-button-toolbar>
    </div>
    <div class="card-body">
        <p-products-table
            action="{{ route('products.index') }}"
            code="{{__('product.code.title')}}"
            description="{{ __('product.description.title') }}"
            name="{{ __('product.name.title') }}"
            price="{{__('product.price.title')}}"
            category="{{__('product.category.title')}}"
            updated_at="{{ __('app.updatedAt') }}"
            empty-message="{{ __('product.emptyMessage') }}"
        ></p-products-table>
    </div>
    @include('layouts.__crud_modal', [
        'item' => trans('product.item'),
        'gender' => 0,
        'action' => route( 'products.store' ),
    ])
</div>
@endsection
