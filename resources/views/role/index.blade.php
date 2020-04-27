@extends('layouts.auth')

@section('auth-content')
<b-card no-body>

    <b-tabs card>
        @include('role.partials.__profileTab')

        @can('create', \App\Role::class)
            @include('role.partials.__rolesTab', ['permissions' => $permissions] )
            @include('role.partials.__usersTab', ['roles' => $roles, 'users' => $users])
        @endcan
    </b-tabs>

</b-card>
@endsection
