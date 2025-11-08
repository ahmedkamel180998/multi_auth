<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        @include('backend.partials.logo')

        <!-- Toggle Menu for small screens -->
        <a href="https://github.com" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item @if(request()->routeIs('backend.home')) active @endif">
            <a href="{{ route('backend.home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Separator with title -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Actions</span>
        </li>
        <!-- Admins Settings -->
        <li class="menu-item @if(request()->routeIs('backend.admins.index')) active @endif">
            <a href="{{ route('backend.admins.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-contact"></i>
                <div data-i18n="Admin Settings">Admins</div>
            </a>
        </li>
        <!-- Roles Settings -->
        <li class="menu-item @if(request()->routeIs('backend.roles.index')) active @endif">
            <a href="{{ route('backend.roles.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-edit"></i>
                <div data-i18n="Role Settings">Roles</div>
            </a>
        </li>
        <!-- Users Settings -->
        <li class="menu-item @if(request()->routeIs('backend.users.index')) active @endif">
            <a href="{{ route('backend.users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="User Settings">Users</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->