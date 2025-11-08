<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
      data-template="vertical-menu-template-free">

@include('backend.partials.head')

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('backend.partials.sidebar')

        <!-- Layout container -->
        <div class="layout-page">
            @include('backend.partials.navbar')

            <!-- Content wrapper -->
            <div class="content-wrapper">
                @yield('content')

                @include('backend.partials.footer')
                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

@include('backend.partials.scripts')
</body>
</html>
