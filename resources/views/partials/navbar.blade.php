<?php 
function routeName($string){
    return str_contains(Route::currentRouteName(), $string);
}
?>

<div id="navbar-container" class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark shadow">

    {{-- logo --}}
    <div id="logo-title" class="d-flex gap-3">

        <a href="{{ url('/') }}" class="mb-3 mb-md-0 text-white text-decoration-none">
    
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1969px-Laravel.svg.png" style="width: 40px" alt="laravel-logo">
    
        </a>
    
        <span class="fs-4">Portfolio</span>

    </div>

    <hr>

    {{-- link list --}}
    <ul id="nav-links" class="nav nav-pills flex-column mb-auto">

        <li class="nav-item">
            <a href="{{ url('/') }}" class="{{routeName('/') ? '_active' : ''}}" aria-current="page">
                <i class="fa-solid fa-house me-2"></i>
                Home
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="{{routeName('admin.dashboard') ? '_active' : ''}}">
                <i class="fa-solid fa-gauge me-2"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.projects.index') }}" class=" {{routeName('admin.projects.index') ? '_active' : ''}}">
                <i class="fa-solid fa-grip me-2"></i>
                Projects
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.projects.create') }}" class=" {{routeName('admin.projects.create') ? '_active' : ''}}">
                <i class="fa-solid fa-plus me-2"></i>
                Add a new project
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.types.index') }}" class=" {{routeName('admin.types.index') ? '_active' : ''}}">
                <i class="fa-solid fa-keyboard me-2"></i>
                Types
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.types.create') }}" class=" {{routeName('admin.types.create') ? '_active' : ''}}">
                <i class="fa-solid fa-plus me-2"></i>
                Add a new type
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.technologies.index') }}" class=" {{routeName('admin.technologies.index') ? '_active' : ''}}">
                <i class="fa-solid fa-microchip me-2"></i>
                Technologies
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.technologies.create') }}" class=" {{routeName('admin.technologies.create') ? '_active' : ''}}">
                <i class="fa-solid fa-plus me-2"></i>
                Add a new technology
            </a>
        </li>
      
    </ul>

    <hr>

    {{-- profile + dropdown menu --}}
    <div class="dropdown">

        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">

                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center text-white text-decoration-none" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img src="https://avatars.githubusercontent.com/u/113367092?v=4" alt="" width="32" height="32" class="rounded-circle me-2">
                    {{ Auth::user()->name }}
                </a>    

                <div class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profile')}}</a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>

            </li>
            @endguest

        </ul>

    </div>

</div>
