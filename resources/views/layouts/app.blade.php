<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('style')
</head>
<body class="font-sans">
<div id="app">
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex items-center justify-between">
            <a class="text-white text-lg font-semibold" href="{{ url('/') }}">
                Laravel Algolia Full Text Search Example jQuery
            </a>
            <div class="flex items-center space-x-4">
                <!-- Left Side Of Navbar -->
                <ul class="flex items-center space-x-4">
                    <!-- Add any left-side navigation items here -->
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="flex items-center space-x-4">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li>
                                <a class="text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li>
                                <a class="text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="relative">
                            <a id="navbarDropdown" class="text-white" href="#" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg p-2 hidden" aria-labelledby="navbarDropdown">
                                <a class="block px-4 py-2 text-sm text-gray-700" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
@stack('script')
</body>
</html>
