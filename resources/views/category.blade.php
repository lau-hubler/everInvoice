@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-end">
    <h3>{{ __('category.title') }}</h3>
    <b-button-toolbar aria-label="Toolbar for categories">
      <b-button-group class="mx-1">
        <p-create-button component="p-create-category">+ {{ __('app.create.button') }}</p-create-button>
      </b-button-group>
    </b-button-toolbar>
  </div>
  <div class="card-body">
    <p-categories-table
            action="{{ route('categories.index') }}"
            description="{{ __('category.description.title') }}"
            name="{{ __('category.name.title') }}"
            updated_at="{{ __('category.updatedAt') }}"
    ></p-categories-table>
  </div>
  @include('layouts.__crud_modal', [
    'item' => trans('category.item'),
    'gender' => 1,
    'action' => '/categories',
  ])
</div>
@endsection
