<!-- Mobile Navigation Header (Only visible on cellphones) -->
<div class="mobile-nav-header">
    <div class="mobile-brand-title">ScholarHub</div>
    <button class="menu-toggle-btn" id="openSidebarBtn" onclick="toggleOffCanvasMenu()">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
    </button>
</div>

<!-- Backdrop Overlay for Mobile view closing drawer mechanics -->
<div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleOffCanvasMenu()"></div>

<!-- Master Sidebar Element Container -->
<aside class="app-sidebar" id="appSidebar">
    
    <div class="sidebar-top">
        <!-- System Branding Header Block -->
        <div class="sidebar-brand-wrapper">
            <div class="brand-logo">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#818cf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                    <path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"></path>
                </svg>
            </div>
            <span class="brand-text">ScholarHub</span>
            
            <!-- Mobile Close Button inside the Drawer -->
            <button class="mobile-close-btn" onclick="toggleOffCanvasMenu()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        
        <!-- Sidebar Navigation List -->
        <ul class="sidebar-menu">
            <!-- Link Module 1: Overview Dashboard Summary -->
            <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="9"></rect>
                        <rect x="14" y="3" width="7" height="5"></rect>
                        <rect x="14" y="12" width="7" height="9"></rect>
                        <rect x="3" y="16" width="7" height="5"></rect>
                    </svg>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            <!-- Link Module 2: Separate Workspace Student Records Manager -->
            <li class="sidebar-item {{ Request::is('students*') ? 'active' : '' }}">
                <a href="/students">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span class="menu-text">Student Records</span>
                </a>
            </li>

            <!-- Link Module 3: Profile System Preferences -->
            <li class="sidebar-item {{ Request::is('profile') ? 'active' : '' }}">
                <a href="/profile">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span class="menu-text">Profile Settings</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Bottom Alignment Section Group -->
    <div class="sidebar-bottom-group">
        <!-- Live Synchronized Identity Card Summary -->
        <div class="sidebar-profile-wrapper">
            <div class="sidebar-user-avatar">
                @if(Auth::user()->profile_photo_path)
                    <img src="{{ asset(Auth::user()->profile_photo_path) }}" alt="User Profile">
                @else
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                @endif
            </div>

            <div class="sidebar-user-info">
                <span class="user-details-name">{{ Auth::user()->name }}</span>
                <span class="user-details-email">{{ Auth::user()->email }}</span>
            </div>
        </div>

        <!-- Logout Action Utility -->
        <div class="sidebar-action-footer">
            <form method="POST" action="/logout" style="margin: 0; width: 100%;">
                @csrf
                <button type="submit" class="logout-action-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span class="logout-text">Log Out</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<script>
    function toggleOffCanvasMenu() {
        const sidebar = document.getElementById('appSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        
        sidebar.classList.toggle('open');
        backdrop.classList.toggle('active');
    }
</script>