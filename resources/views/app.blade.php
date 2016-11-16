<!DOCTYPE html>
<html lang="en">
<head>
    @include('global.partials._app-meta-content')

    @if(isset($page_title))
        <title>{{$page_title}}</title>
    @else
        <title>{{$site_name}}</title>
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Load additional, page-specific, header JS -->
    @yield('headscripts')

    <!-- Base CSS -->
    <link rel="stylesheet" href="{{ elixir('css/all.css') }}">

    <!-- Load additional, page-specific, header CSS -->
    @yield('headstyles')
</head>
<body>
    <div id="app">
        <!-- Load the main page content -->
        @yield('content')
    </div>

    <!-- Vue Core Script -->
    <script src="{{elixir('js/bundle.js')}}"></script>

    <!-- Base JS -->
    <script src="{{ elixir('js/all.js') }}"></script>

    <!-- Global JS Scripts -->
    @include('global.scripts.global-scripts')

    <!-- Load additional, page-specific, footer JS -->
    @yield('postscripts')
</body>
</html>
