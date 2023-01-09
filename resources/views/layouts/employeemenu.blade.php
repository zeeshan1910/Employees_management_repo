<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">

            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">Employee</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
            <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-divider mt-0"></div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->route()->getName() === 'employee.dashboard'? 'active': '' }}">
            <a href="{{ route('employee.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>

        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Employee</span></li>
        <li class="menu-item {{ request()->route()->getName() === 'employee.profile'? 'active': '' }}">
            <a href="{{ route('employee.profile') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>My Details</div>
            </a>
        </li>




    </ul>
</aside>
