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
            display: flex; /* Positions sidebar and content blocks side-by-side */
        }

        /* Fixed Sidebar Core Styling Layout */
        .app-sidebar {
            width: 260px;
            background-color: #1e3a8a; /* Deep corporate blue matching your profile setup */
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 24px 20px;
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
            margin: 0;
            flex-grow: 1;
        }

        .sidebar-item a {
            display: block;
            padding: 14px 24px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar-item a:hover, .sidebar-item.active a {
            color: white;
            background-color: rgba(255, 255, 255, 0.15);
            border-left: 4px solid #b71c1c; /* Crimson active accent line indicators */
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout-btn {
            width: 100%;
            background-color: #dc2626;
            color: white;
            border: none;
            padding: 11px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .logout-btn:hover {
            background-color: #b91c1c;
        }

        /* Main Workspace Shift to accommodate the fixed left panel width */
        .main-workspace {
            margin-left: 260px; 
            flex-grow: 1;
            min-height: 100vh;
            box-sizing: border-box;
        }
    </style>
</head>
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
    /* Top-Right Floating Position */
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

    .toast-content-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .toast-icon {
        font-size: 1.25rem;
    }

    .toast-message-text {
        font-size: 0.9rem;
        font-weight: 500;
        color: #334155;
    }

    /* Entry Animations */
    .toast-fade-in {
        opacity: 1;
        transform: translateY(0);
        animation: toastIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    /* Exit Class applied by JavaScript */
    .toast-fade-out {
        opacity: 0;
        transform: translateY(-20px);
    }

    @keyframes toastIn {
        from {
            opacity: 0;
            transform: translateY(-20px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
</style>
<script>
    // Automatically dismiss toast after exactly 3 seconds (3000ms)
    document.addEventListener('DOMContentLoaded', function () {
        const toastElement = document.getElementById('floating-toast');
        if (toastElement) {
            setTimeout(function () {
                // Apply the fade out animation styling
                toastElement.classList.add('toast-fade-out');
                
                // Remove entirely from DOM after transition completes
                setTimeout(function () {
                    toastElement.remove();
                }, 400); 
            }, 3000);
        }
    });
</script>
<body>

    @include('sidebar')

    <div class="main-workspace">
        @yield('content')
    </div>

</body>
</html>