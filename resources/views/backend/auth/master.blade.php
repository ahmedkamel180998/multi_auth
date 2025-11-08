<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
      data-assets-path="{{ asset('assets/') }}"
      data-template="vertical-menu-template-free">
@include('backend.auth.partials.head')

<body>
@yield('content')
@include('backend.auth.partials.scripts')
</body>
</html>
