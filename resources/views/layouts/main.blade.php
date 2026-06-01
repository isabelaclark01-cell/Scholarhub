<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScholarHub</title>
    
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            display: flex;
            overflow-x: hidden;
        }

        /* Mobile Top Action Header Bar Default State Hidden */
        .mobile-nav-header {
            display: none;
            background-color: #0f172a;
            color: white;
            padding: 16px;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 150;
            box-sizing: border-box;
            height: 60px;
        }
        .mobile-brand-title {
            font-weight: 700;
            font-size: 1.2rem;
        }
        .menu-toggle-btn {
            background: transparent;
            border: none;
            color: white;
            cursor: pointer;
        }
        .mobile-close-btn {
            display: none;
            background: transparent;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            margin-left: auto;
        }

        /* Fixed Sidebar Core Desktop Layout */
        .app-sidebar {
            width: 260px;
            height: 100vh;
            background-color: #0f172a;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 24px 16px;
            box-sizing: border-box;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 200;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-brand-wrapper {
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 0 8px;
            margin-bottom: 32px;
            width: 100%;
            box-sizing: border-box;
        }

        .brand-logo {
            background-color: #1e293b;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-right: 12px;
        }

        .brand-text {
            color: #ffffff;
            font-weight: 700;
            font-size: 1.25rem;
            letter-spacing: -0.025em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .sidebar-item {
            border-radius: 8px;
            transition: background-color 0.2s ease;
        }
        .sidebar-item.active {
            background-color: #1e293b;
        }

        .sidebar-item a {
            color: #94a3b8;
            text-decoration: none;
            padding: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: color 0.2s ease;
            display: flex;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
        }
        .sidebar-item.active a {
            color: #ffffff;
        }
        .sidebar-item a svg {
            margin-right: 12px;
            flex-shrink: 0;
        }

        .sidebar-bottom-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 100%;
            box-sizing: border-box;
        }

        .sidebar-profile-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 4px;
        }

        .sidebar-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }
        .sidebar-user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sidebar-user-info {
            display: flex;
            flex-direction: column;
            min-width: 0;
            flex-grow: 1;
        }
        .user-details-name {
            color: #ffffff;
            font-size: 0.9rem;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }
        .user-details-email {
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
            margin-top: 1px;
        }

        .sidebar-action-footer {
            width: 100%;
            box-sizing: border-box;
        }
        .logout-action-btn {
            background-color: transparent;
            border: 1px solid #334155;
            color: #94a3b8;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
        }
        .logout-action-btn svg {
            margin-right: 8px;
            flex-shrink: 0;
        }

        /* Main Workspace Desktop Layout Defaults */
        .main-workspace {
            margin-left: 260px; 
            flex-grow: 1;
            width: 0;           
            min-width: 0;       
            max-width: 100%;
            min-height: 100vh;
            padding: 24px;
            box-sizing: border-box;
            overflow-x: hidden; 
        }

        /* Dark Backdrop Shadow Frame overlay */
        .sidebar-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 190;
        }

        /* --- THE OFF-CANVAS RESPONSIVE VIEWPORTS CONTROLS --- */
        @media (max-width: 1024px) {
            .mobile-nav-header {
                display: flex; /* Shows the top navigation bar on mobile */
            }

            .mobile-close-btn {
                display: block; /* Shows individual close action X in navigation drawer drawer */
            }

            .app-sidebar {
                transform: translateX(-100%); /* Slides the sidebar completely out of view */
                position: fixed;
                height: 100vh;
                box-shadow: 10px 0 25px rgba(0,0,0,0.3);
            }

            .app-sidebar.open {
                transform: translateX(0); /* Smoothly slides in when opened */
            }

            .sidebar-backdrop.active {
                display: block; /* Turns background dim on when open */
            }

            .main-workspace {
                margin-left: 0 !important;
                width: 100%;
                padding-top: 84px; /* Padding safety clearance for the fixed top navbar header */
            }
        }
    </style>
</head>

<!-- Flash Toasts View Container Logic Block -->
@if(session('success') || session('error') || $errors->any())
    <div id="floating-toast" class="floating-toast-box toast-fade-in">
        <div class="toast-content-wrapper">
            <span class="toast-icon">
                @if(session('success'))
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                @else
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                @endif
            </span>
            <div class="toast-message-text">
                @if(session('success'))
                    {{ session('success') }}
                @elseif(session('error'))
                    {{ session('error') }}
                @else
                    {{ $errors->first() }}
                @endif
            </div>
        </div>
    </div>
@endif

<style>
    .floating-toast-box {
        position: fixed;
        top: 24px;
        right: 24px;
        background-color: #ffffff;
        color: #1e293b;
        padding: 16px 20px;
        border-radius: 12px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        z-index: 9999;
        min-width: 300px;
        max-width: 420px;
        display: flex;
        align-items: center;
        border-left: 5px solid {{ session('success') ? '#10b981' : '#ef4444' }};
        transition: opacity 0.4s ease, transform 0.4s ease;
    }
    .toast-content-wrapper { display: flex; align-items: center; gap: 12px; }
    .toast-icon { font-size: 1.25rem; }
    .toast-message-text { font-size: 0.9rem; font-weight: 500; color: #334155; }
    .toast-fade-in { opacity: 1; transform: translateY(0); animation: toastIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    .toast-fade-out { opacity: 0; transform: translateY(-20px); }
    @keyframes toastIn { from { opacity: 0; transform: translateY(-20px) scale(0.95); } to { opacity: 1; transform: translateY(0) scale(1); } }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastElement = document.getElementById('floating-toast');
        if (toastElement) {
            setTimeout(function () {
                toastElement.classList.add('toast-fade-out');
                setTimeout(function () { toastElement.remove(); }, 400); 
            }, 3000);
        }
    });
</script>

<body>

    <!-- Includes your dynamic off-canvas element drawer -->
    @include('sidebar')

    <div class="main-workspace">
        @yield('content')
    </div>

</body>
</html>