@extends('layouts.auth')

@section('auth-content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-end">
    <h3>{{ __('stakeholder.title') }}</h3>
    <b-button-toolbar aria-label="Toolbar for stakeholders">
      <b-button-group class="mx-1">
          @can('create', \App\Stakeholder::class)
              <p-create-button component="p-create-stakeholder">{{ __('app.buttons.new') }}</p-create-button>
          @endcan
      </b-button-group>
    </b-button-toolbar>
  </div>
  <div class="card-body">
    <p-stakeholders-table
            action="{{ route('stakeholders.index') }}"
            document="{{ __('stakeholder.document.title') }}"
            name="{{ __('stakeholder.name.title') }}"
            email="{{__('stakeholder.email.title')}}"
            mobile="{{ __('stakeholder.mobile.title') }}"
            empty-message="{{ __('stakeholder.emptyMessage') }}"
    ></p-stakeholders-table>
  </div>
  @include('layouts.__crud_modal', [
    'item' => trans('stakeholder.item'),
    'object' => 'stakeholder',
    'gender' => 0,
    'action' => route( 'api.stakeholders.store' ),
    'modalSize' => 'lg',
    'createMessage' => ' ',
  ])
</div>
@endsection
