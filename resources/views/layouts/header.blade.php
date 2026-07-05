<div class="top-header">
    <button class="global-hamburger-toggle-btn" id="globalHamburgerToggleBtn">
        <i class="fa-solid fa-bars"></i>
    </button>

    <div class="ml-auto d-flex align-items-center gap-container">
        <button class="theme-mode-toggler-btn" id="appThemeTogglerBtn">
            <i class="fa-solid fa-moon" id="togglerConditionIcon"></i>
        </button>

        <div class="profile-dropdown-wrapper" id="userProfileDropdown">
            <div class="user-avatar-initial-box"></div>
            <span class="profile-display-title d-none d-sm-inline">Hi, Westmark Apparel Limited!</span>
            <i class="fa-solid fa-chevron-down caret-arrow-dropdown"></i>

            <ul class="profile-extended-menu">
                <li><a href="#"><i class="fa-regular fa-user"></i> Profile</a></li>
                <li><a href="#"><i class="fa-solid fa-gear"></i> Settings</a></li>
                <li class="divider-line"></li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-link"><i class="fa-solid fa-power-off"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>