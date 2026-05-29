<div class="app-sidebar" style="width: 260px; max-width: 100%; height: 100vh; background-color: #0f172a; display: flex; flex-direction: column; justify-content: space-between; padding: 24px 16px; box-sizing: border-box; transition: all 0.3s ease;">
    
    <div class="sidebar-top">
        <!-- System Branding Header Block -->
        <div class="sidebar-brand" style="display: flex; flex-direction: row; align-items: center; padding: 0 8px; margin-bottom: 32px; width: 100%; box-sizing: border-box;">
            <div class="brand-logo" style="background-color: #1e293b; width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-right: 12px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#818cf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                    <path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"></path>
                </svg>
            </div>
            <span class="brand-text" style="color: #ffffff; font-weight: 700; font-size: 1.25rem; letter-spacing: -0.025em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1;">
                ScholarHub
            </span>
        </div>
        
        <!-- Sidebar Navigation List -->
        <ul class="sidebar-menu" style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 4px;">
            
            <!-- Link Module 1: Overview Dashboard Summary -->
            <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}" style="border-radius: 8px; transition: background-color 0.2s ease; {{ Request::is('dashboard') ? 'background-color: #1e293b;' : '' }}">
                <a href="/dashboard" class="d-flex align-items-center" style="color: {{ Request::is('dashboard') ? '#ffffff' : '#94a3b8' }}; text-decoration: none; padding: 12px; font-size: 0.95rem; font-weight: 500; transition: color 0.2s ease; display: flex; align-items: center; width: 100%; box-sizing: border-box;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 12px; flex-shrink: 0;">
                        <rect x="3" y="3" width="7" height="9"></rect>
                        <rect x="14" y="3" width="7" height="5"></rect>
                        <rect x="14" y="12" width="7" height="9"></rect>
                        <rect x="3" y="16" width="7" height="5"></rect>
                    </svg>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            <!-- Link Module 2: Separate Workspace Student Records Manager -->
            <li class="sidebar-item {{ Request::is('students*') ? 'active' : '' }}" style="border-radius: 8px; transition: background-color 0.2s ease; {{ Request::is('students*') ? 'background-color: #1e293b;' : '' }}">
                <a href="/students" class="d-flex align-items-center" style="color: {{ Request::is('students*') ? '#ffffff' : '#94a3b8' }}; text-decoration: none; padding: 12px; font-size: 0.95rem; font-weight: 500; transition: color 0.2s ease; display: flex; align-items: center; width: 100%; box-sizing: border-box;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 12px; flex-shrink: 0;">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span class="menu-text">Student Records</span>
                </a>
            </li>

            <!-- Link Module 3: Profile System Preferences -->
            <li class="sidebar-item {{ Request::is('profile') ? 'active' : '' }}" style="border-radius: 8px; transition: background-color 0.2s ease; {{ Request::is('profile') ? 'background-color: #1e293b;' : '' }}">
                <a href="/profile" class="d-flex align-items-center" style="color: {{ Request::is('profile') ? '#ffffff' : '#94a3b8' }}; text-decoration: none; padding: 12px; font-size: 0.95rem; font-weight: 500; transition: color 0.2s ease; display: flex; align-items: center; width: 100%; box-sizing: border-box;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 12px; flex-shrink: 0;">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span class="menu-text">Profile Settings</span>
                </a>
            </li>

        </ul>
    </div>

    <!-- Bottom Alignment Section Group -->
    <div class="sidebar-bottom-group" style="display: flex; flex-direction: column; gap: 12px; width: 100%; box-sizing: border-box;">
        
        <!-- Live Synchronized Identity Card Summary -->
        <div class="sidebar-profile-wrapper" style="display: flex; align-items: center; gap: 12px; padding: 0 4px;">
            <div class="sidebar-user-avatar" style="position: relative; width: 40px; height: 40px; border-radius: 50%; background-color: #f8fafc; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0;">
                @if(Auth::user()->profile_photo_path)
                    <img src="{{ asset(Auth::user()->profile_photo_path) }}" alt="User Profile" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                @endif
            </div>

            <div class="sidebar-user-info" style="display: flex; flex-direction: column; min-width: 0; flex-grow: 1;">
                <span class="user-details-name" style="color: #ffffff; font-size: 0.9rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block;">
                    {{ Auth::user()->name }}
                </span>
                <!-- Updated from static text to dynamic email -->
                <span class="user-details-email" style="color: #64748b; font-size: 0.75rem; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block; margin-top: 1px;">
                    {{ Auth::user()->email }}
                </span>
            </div>
        </div>

        <!-- Logout Action Utility -->
        <div class="sidebar-footer" style="width: 100%; box-sizing: border-box;">
            <form method="POST" action="/logout" style="margin: 0; width: 100%;">
                @csrf
                <button type="submit" class="logout-btn" style="background-color: transparent; border: 1px solid #334155; color: #94a3b8; padding: 12px; border-radius: 10px; font-weight: 600; cursor: pointer; width: 100%; font-size: 0.9rem; transition: all 0.2s ease; display: flex; flex-direction: row; align-items: center; justify-content: center; box-sizing: border-box;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px; flex-shrink: 0;">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span class="logout-text">Log Out</span>
                </button>
            </form>
        </div>
        
    </div>
</div>

<style>
    /* Responsive media rules for smaller viewport displays */
    @media (max-width: 768px) {
        .app-sidebar {
            width: 80px !important;
            padding: 24px 8px !important;
        }
        /* Added .user-details-email to ensure text hides perfectly on mobile views */
        .brand-text, .menu-text, .user-details-name, .user-details-email, .logout-text {
            display: none !important;
        }
        .sidebar-brand {
            justify-content: center !important;
            padding: 0 !important;
            margin-bottom: 24px !important;
        }
        .brand-logo {
            margin-right: 0 !important;
        }
        .sidebar-item a, .logout-btn {
            justify-content: center !important;
            padding: 12px 0 !important;
        }
        .sidebar-item a svg, .logout-btn svg {
            margin-right: 0 !important;
        }
        .sidebar-profile-wrapper {
            justify-content: center !important;
            padding: 0 !important;
        }
    }
</style>