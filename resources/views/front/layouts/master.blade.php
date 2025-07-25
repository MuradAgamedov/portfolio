<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('front.partials.head')

@yield('meta')

<body class="template-color-1 spybody" data-spy="scroll" data-target=".navbar-example2" data-offset="70">

    @include('front.partials.header')

    <main class="main-page-wrapper">
        @yield('content')
    </main>

    @include('front.partials.footer')

    @stack('scripts')

</body>

</html> 