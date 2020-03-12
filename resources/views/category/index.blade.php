@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-end">
    <h3>{{ __('category.title') }}</h3>
    <b-button-toolbar aria-label="Toolbar for categories">
      <b-button-group class="mx-1">
        <b-button variant="primary">+ {{ __('app.create') }}</b-button>
      </b-button-group>
    </b-button-toolbar>
  </div>
  <div class="card-body">
    <p-categories-table />
  </div>
</div>
@endsection