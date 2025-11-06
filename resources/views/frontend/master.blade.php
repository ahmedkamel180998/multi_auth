<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
      data-template="vertical-menu-template-free">

@include('frontend.partials.head')

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('frontend.partials.sidebar')

        <!-- Layout container -->
        <div class="layout-page">
            @include('frontend.partials.navbar')

            <!-- Content wrapper -->
            <div class="content-wrapper">
                @yield('content')

                @include('frontend.partials.footer')
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

@include('frontend.partials.scripts')
</body>
</html>
