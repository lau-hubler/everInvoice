@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        @include('layouts.__alert')
    </div>
    <div class="container-fluid row mt-4">
        <div class="col-2">
            @stack('left-top')
            @include('layouts.__sideBar')
            @stack('left-bottom')
        </div>
        <div class="col-10">
            @yield('auth-content')
        </div>
    </div>
@endsection
