<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="sidebar" id="appSidebar">
    <div class="sidebar-brand">
        <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" alt="Laravel Engine Asset Icon"
            class="laravel-logo-img">
        <span class="brand-name-text">Laravel</span>
        <button class="mobile-sidebar-close-btn d-lg-none" id="mobileSidebarCloseBtn">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <ul class="nav-menu">
        <li
            class="nav-item-custom has-submenu {{ (request()->routeIs('admin.dashboard') || request()->routeIs('employee.dashboard')) ? 'dropdown-expanded-node active' : '' }}">
            <a href="javascript:void(0);" class="submenu-toggle-trigger">
                <i class="fa-solid fa-house-chimney icon-box-left"></i>
                <span class="nav-text-label">Dashboard</span>
                <i class="fa-solid fa-chevron-right arrow-icon"></i>
            </a>

            <ul class="submenu-list"
                style="{{ (request()->routeIs('admin.dashboard') || request()->routeIs('employee.dashboard')) ? 'display: block;' : '' }}">
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <li
                        class="nav-sub-item-custom {{ request()->routeIs('admin.dashboard') ? 'active font-weight-bold' : '' }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <i
                                class="{{ request()->routeIs('admin.dashboard') ? 'fa-solid fa-circle text-cyan' : 'fa-regular fa-circle' }} dot-sub-icon"></i>
                            <span class="nav-text-label">Overview</span>
                        </a>
                    </li>
                    <li
                        class="nav-sub-item-custom {{ request()->routeIs('admin.analytics') ? 'active font-weight-bold' : '' }}">
                        <a href="#">
                            <i
                                class="{{ request()->routeIs('admin.analytics') ? 'fa-solid fa-circle text-cyan' : 'fa-regular fa-circle' }} dot-sub-icon"></i>
                            <span class="nav-text-label">Analytics</span>
                        </a>
                    </li>
                @elseif(Auth::check() && Auth::user()->role === 'employee')
                    <li
                        class="nav-sub-item-custom {{ request()->routeIs('employee.dashboard') ? 'active font-weight-bold' : '' }}">
                        <a href="{{ route('employee.dashboard') }}">
                            <i
                                class="{{ request()->routeIs('employee.dashboard') ? 'fa-solid fa-circle text-cyan' : 'fa-regular fa-circle' }} dot-sub-icon"></i>
                            <span class="nav-text-label">Overview</span>
                        </a>
                    </li>
                    <li
                        class="nav-sub-item-custom {{ request()->routeIs('employee.analytics') ? 'active font-weight-bold' : '' }}">
                        <a href="#">
                            <i
                                class="{{ request()->routeIs('employee.analytics') ? 'fa-solid fa-circle text-cyan' : 'fa-regular fa-circle' }} dot-sub-icon"></i>
                            <span class="nav-text-label">Analytics</span>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        <li class="nav-item-custom has-submenu">
            <a href="javascript:void(0);" class="submenu-toggle-trigger">
                <i class="fa-solid fa-users icon-box-left"></i>
                <span class="nav-text-label">Staff</span>
                <i class="fa-solid fa-chevron-right arrow-icon"></i>
            </a>
            <ul class="submenu-list">
                <li class="nav-sub-item-custom">
                    <a href="#">
                        <i class="fa-regular fa-circle dot-sub-icon"></i>
                        <span class="nav-text-label">Staff List</span>
                    </a>
                </li>
                <li class="nav-sub-item-custom">
                    <a href="#">
                        <i class="fa-regular fa-circle dot-sub-icon"></i>
                        <span class="nav-text-label">Attendance</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item-custom">
            <a href="#">
                <i class="fa-solid fa-id-card-clip icon-box-left"></i>
                <span class="nav-text-label">Employee</span>
            </a>
        </li>

        <li class="nav-item-custom has-submenu">
            <a href="javascript:void(0);" class="submenu-toggle-trigger">
                <i class="fa-regular fa-clock icon-box-left"></i>
                <span class="nav-text-label">Timesheet</span>
                <i class="fa-solid fa-chevron-right arrow-icon"></i>
            </a>
            <ul class="submenu-list">
                <li class="nav-sub-item-custom">
                    <a href="#">
                        <i class="fa-regular fa-circle dot-sub-icon"></i>
                        <span class="nav-text-label">Manage Logs</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item-custom {{ request()->routeIs('admin.branch.index') || request()->routeIs('admin.department.index') || request()->routeIs('admin.designation.index')|| request()->routeIs('admin.grade.index') || request()->routeIs('admin.holiday.index') || request()->routeIs('admin.religion.index')|| request()->routeIs('admin.section_line.index') || request()->routeIs('admin.shift.index') || request()->routeIs('admin.unit.index') ? 'active font-weight-bold' : '' }}">
            <a href="{{ route('admin.branch.index') }}">
                <i class="fa-solid fa-grip icon-box-left"></i>
                <span class="nav-text-label">HRM System Setup</span>
            </a>
        </li>

        <li class="nav-item-custom has-submenu">
            <a href="javascript:void(0);" class="submenu-toggle-trigger">
                <i class="fa-regular fa-file-lines icon-box-left"></i>
                <span class="nav-text-label">Report</span>
                <i class="fa-solid fa-chevron-right arrow-icon"></i>
            </a>
            <ul class="submenu-list">
                <li class="nav-sub-item-custom">
                    <a href="#">
                        <i class="fa-regular fa-circle dot-sub-icon"></i>
                        <span class="nav-text-label">Monthly Report</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item-custom has-submenu">
            <a href="javascript:void(0);" class="submenu-toggle-trigger">
                <i class="fa-solid fa-gear icon-box-left"></i>
                <span class="nav-text-label">System Setup</span>
                <i class="fa-solid fa-chevron-right arrow-icon"></i>
            </a>
            <ul class="submenu-list">
                <li class="nav-sub-item-custom">
                    <a href="#">
                        <i class="fa-regular fa-circle dot-sub-icon"></i>
                        <span class="nav-text-label">App Settings</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>