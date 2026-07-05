/**
 * Manage Employee Dashboard Engine - Core Client Engine Module
 * Feature Specification: Multi-Level Accordion Dropdown Sidebars with Toggling Layouts
 */

document.addEventListener('DOMContentLoaded', () => {

    // Primary Module Dom Selectors Map Node
    const globalHamburgerToggleBtn = document.getElementById('globalHamburgerToggleBtn');
    const mobileSidebarCloseBtn = document.getElementById('mobileSidebarCloseBtn');
    const appSidebar = document.getElementById('appSidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const appThemeTogglerBtn = document.getElementById('appThemeTogglerBtn');
    const togglerConditionIcon = document.getElementById('togglerConditionIcon');
    const rootBodySelector = document.body;

    /* ==========================================================================
       1. SIDEBAR ACCORDION DROPDOWN ENGINE LOGIC
       ========================================================================== */
    const submenuToggleTriggers = document.querySelectorAll('.submenu-toggle-trigger');

    submenuToggleTriggers.forEach(trigger => {
        trigger.addEventListener('click', function (e) {
            // Prevent execution loop if sidebar is currently in desktop collapsed mode
            if (rootBodySelector.classList.contains('sidebar-desktop-collapsed')) {
                return;
            }

            const parentLiNode = this.parentElement;

            // Optional Accordion Pattern Behavior: Closes other open menus when a new one opens
            document.querySelectorAll('.nav-item-custom.has-submenu').forEach(item => {
                if (item !== parentLiNode) {
                    item.classList.remove('dropdown-expanded-node');
                }
            });

            // Toggle active state on current menu item node context
            parentLiNode.classList.toggle('dropdown-expanded-node');
        });
    });

    /* ==========================================================================
       2. UNIFIED TOGGLER SYSTEM (DESKTOP EXTENSION & MOBILE DRAWER LAYER)
       ========================================================================== */
    if (globalHamburgerToggleBtn) {
        globalHamburgerToggleBtn.addEventListener('click', () => {
            const isDesktopMode = window.innerWidth >= 992;

            if (isDesktopMode) {
                rootBodySelector.classList.toggle('sidebar-desktop-collapsed');
                // Auto close any expanded dropdown branches when collapsing sidebar layout framework
                if (rootBodySelector.classList.contains('sidebar-desktop-collapsed')) {
                    document.querySelectorAll('.nav-item-custom.has-submenu').forEach(item => {
                        item.classList.remove('dropdown-expanded-node');
                    });
                }
            } else {
                if (appSidebar && sidebarOverlay) {
                    appSidebar.classList.add('show-drawer-active');
                    sidebarOverlay.style.display = 'block';
                    document.body.style.overflow = 'hidden';
                }
            }
        });
    }

    function closeSidebarDrawer() {
        if (appSidebar && sidebarOverlay) {
            appSidebar.classList.remove('show-drawer-active');
            sidebarOverlay.style.display = 'none';
            document.body.style.overflow = '';
        }
    }

    if (mobileSidebarCloseBtn) mobileSidebarCloseBtn.addEventListener('click', closeSidebarDrawer);
    if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebarDrawer);

    /* ==========================================================================
       3. SYSTEM THEME CONTROLLER & INTERFACES REALTIME SEARCH
       ========================================================================== */
    // 1. AUTO-LOAD CONFIGURATION: Page load hobar sathe sathe puraton theme check kora
    const savedTheme = localStorage.getItem('app-user-theme');
    if (savedTheme === 'light') {
        rootBodySelector.classList.add('light-theme-active-node');
        if (togglerConditionIcon) togglerConditionIcon.className = 'fa-solid fa-sun';
    } else {
        rootBodySelector.classList.remove('light-theme-active-node');
        if (togglerConditionIcon) togglerConditionIcon.className = 'fa-solid fa-moon';
    }

    // 2. EVENT LISTENER: Button click-e theme toggle ebong memory-te save kora
    if (appThemeTogglerBtn) {
        appThemeTogglerBtn.addEventListener('click', () => {
            // Toggle the class on body
            rootBodySelector.classList.toggle('light-theme-active-node');

            // Check current active state matrix
            const isCurrentlyLight = rootBodySelector.classList.contains('light-theme-active-node');

            // Update Icons Dynamically
            if (togglerConditionIcon) {
                togglerConditionIcon.className = isCurrentlyLight ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
            }

            // CRITICAL STORAGE LINE: Browser local storage-e text track save kora
            localStorage.setItem('app-user-theme', isCurrentlyLight ? 'light' : 'dark');
        });
    }

    const searchInput = document.querySelector('.dark-themed-search-input');
    const tableRows = document.querySelectorAll('.core-structured-dark-table tbody tr');

    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const queryValue = e.target.value.toLowerCase().trim();
            tableRows.forEach(row => {
                const rowContentString = row.textContent.toLowerCase();
                row.style.display = rowContentString.includes(queryValue) ? '' : 'none';
            });
        });
    }
});

// Profile Action Panel Toggle Module Engine
const userProfileDropdown = document.getElementById('userProfileDropdown');

if (userProfileDropdown) {
    userProfileDropdown.addEventListener('click', function (e) {
        e.stopPropagation(); // Event bubbling stop jate baire click toggle loss na hoy
        this.classList.toggle('profile-active-node');
    });
}

// Baire click korle jeno profile dropdown auto bondho hoye jay
document.addEventListener('click', () => {
    if (userProfileDropdown) {
        userProfileDropdown.classList.remove('profile-active-node');
    }
});