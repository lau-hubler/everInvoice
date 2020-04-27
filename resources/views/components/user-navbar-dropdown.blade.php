<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="{{ route('roles.index') }}">{{ __('My Profile') }}</a>
    <hr/>
    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault();
       document.getElementById('logout-form').submit();"
    >
        {{ __('auth.logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
