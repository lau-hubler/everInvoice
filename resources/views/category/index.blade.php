@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-end">
    <h3>{{ __('app.category.title') }}</h3>
    <b-button-toolbar aria-label="Toolbar for categories">
      <b-button-group class="mx-1">
        <p-create-buttom component="p-category-form">+ {{ __('app.create.buttom') }}</p-create-buttom>
      </b-button-group>
    </b-button-toolbar>
  </div>
  <div class="card-body">
    <p-categories-table 
      name = "{{ __('app.category.name') }}"
      description = "{{ __('app.category.description') }}"
      updated_at = "{{ __('app.category.updatedAt') }}"
    />
  </div>
  @include('layouts.__create_modal', [
    'item' => trans('app.category.item'),
    'gender' => 1,
    'action' => "route",
  ])
</div>
@endsection