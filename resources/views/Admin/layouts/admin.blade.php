@include('Admin.partials.head')
@include('Admin.components.header')
@include('Admin.pages.sidebar')
@yield('content')
@include('Admin.partials.foot')
@stack('css')
@stack('js')
