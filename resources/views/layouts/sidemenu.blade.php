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
        <li class="menu-item {{ request()->route()->getName() === 'home'? 'active': '' }}">
            <a href="" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>

        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Employees</span></li>
        <li class="menu-item {{ request()->route()->getName() === 'employees.index'? 'active': '' }}">
            <a href="{{ route('employees.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>Employees</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Setting</span></li>
        <li class="menu-item {{ request()->route()->getName() === 'departments.index'? 'active': '' }}">
            <a href="{{ route('departments.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div>Departments</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('designations.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div>Designation</div>
            </a>
        </li>



    </ul>
</aside>
