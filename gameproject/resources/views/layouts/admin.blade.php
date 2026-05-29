<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Admin Dashboard – Yono Apps Portal')</title>
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Admin Glassmorphic Stylesheet -->
    <style>
        :root {
            --admin-bg: #0f172a; /* Slate 900 */
            --glass-bg: rgba(30, 41, 59, 0.7); /* Translucent Slate 800 */
            --glass-border: rgba(255, 255, 255, 0.08);
            --accent-color: #3b82f6; /* Blue 500 */
            --accent-gradient: linear-gradient(135deg, #3b82f6, #8b5cf6); /* Blue to Purple */
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --card-radius: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--admin-bg);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        /* Sidebar Glassmorphic Nav */
        .sidebar {
            width: 260px;
            background: var(--glass-bg);
            border-right: 1px solid var(--glass-border);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            gap: 30px;
            position: fixed;
            height: 100vh;
            z-index: 100;
            transition: all 0.3s ease;
        }

        .brand-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            background: var(--accent-gradient);
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3);
        }

        .brand-name {
            font-size: 18px;
            font-weight: 800;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            list-style: none;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-muted);
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 600;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .nav-link i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .nav-link:hover {
            color: var(--text-main);
            background: rgba(255,255,255,0.05);
            border-color: rgba(255,255,255,0.03);
        }

        .nav-link.active {
            color: white;
            background: var(--accent-gradient);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Main Workspace container */
        .workspace {
            margin-left: 260px;
            flex: 1;
            padding: 40px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            gap: 24px;
            transition: all 0.3s ease;
        }

        /* Top Admin Profile strip */
        .top-strip {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(10px);
            padding: 16px 24px;
            border-radius: var(--card-radius);
        }

        .page-headline {
            font-size: 20px;
            font-weight: 700;
        }

        .user-widget {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            background: rgba(255,255,255,0.1);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--accent-color);
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
        }

        /* Custom notifications styling */
        .alert {
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.25);
            color: var(--success-color);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: var(--danger-color);
        }

        /* Glass Cards container styling */
        .glass-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(12px);
            border-radius: var(--card-radius);
            padding: 24px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        .admin-footer {
            margin-top: auto;
            text-align: center;
            font-size: 12px;
            color: var(--text-muted);
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-divider {
            margin-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 15px;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .sidebar {
                width: 70px;
                padding: 20px 10px;
                align-items: center;
            }
            .brand-name, .nav-link span {
                display: none;
            }
            .workspace {
                margin-left: 70px;
                padding: 20px;
            }
            .nav-link {
                padding: 12px;
                justify-content: center;
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                width: 100% !important;
                height: 64px !important;
                bottom: 0 !important;
                top: auto !important;
                left: 0 !important;
                right: 0 !important;
                border-right: none !important;
                border-top: 1px solid var(--glass-border) !important;
                flex-direction: row !important;
                padding: 4px 8px !important;
                z-index: 9999 !important;
                justify-content: center !important;
                align-items: center !important;
                gap: 0 !important;
            }
            .brand-section, .admin-footer, .hide-mobile {
                display: none !important;
            }
            .nav-list {
                flex-direction: row !important;
                justify-content: space-around !important;
                width: 100% !important;
                gap: 4px !important;
            }
            .nav-list li {
                flex: 1;
                text-align: center;
            }
            .nav-link {
                flex-direction: column !important;
                gap: 3px !important;
                font-size: 10px !important;
                padding: 6px 4px !important;
                justify-content: center !important;
                align-items: center !important;
                border-radius: 8px !important;
            }
            .nav-link span {
                display: block !important;
                font-size: 9px !important;
                font-weight: 700 !important;
                text-transform: uppercase;
                letter-spacing: 0.2px;
            }
            .nav-link i {
                font-size: 14px !important;
                width: auto !important;
            }
            .sidebar-divider {
                margin-top: 0 !important;
                border-top: none !important;
                padding-top: 0 !important;
            }
            .workspace {
                margin-left: 0 !important;
                padding: 15px 15px 85px 15px !important;
            }
            .top-strip {
                padding: 12px 16px !important;
                flex-direction: column !important;
                gap: 8px !important;
                align-items: flex-start !important;
            }
            .top-strip .user-widget {
                align-self: flex-end;
            }
            .page-headline {
                font-size: 16px !important;
            }
        }
    </style>
    @yield('admin_head_extra')
</head>
<body>
    <!-- Sidebar Navigation -->
    <nav class="sidebar">
        <div class="brand-section">
            <div class="brand-icon">
                <i class="fas fa-cubes"></i>
            </div>
            <span class="brand-name">Yono Portal</span>
        </div>
        
        <ul class="nav-list">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.apps.index') }}" class="nav-link {{ Route::is('admin.apps.index') || Route::is('admin.apps.edit') ? 'active' : '' }}">
                    <i class="fas fa-gamepad"></i>
                    <span>Manage Apps</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.apps.create') }}" class="nav-link {{ Route::is('admin.apps.create') ? 'active' : '' }}">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add New App</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.queries.index') }}" class="nav-link {{ Route::is('admin.queries.index') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i>
                    <span>User Queries</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.reviews.index') }}" class="nav-link {{ Route::is('admin.reviews.index') ? 'active' : '' }}">
                    <i class="fas fa-star-half-alt"></i>
                    <span>Reviews</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings') }}" class="nav-link {{ Route::is('admin.settings') ? 'active' : '' }}">
                    <i class="fas fa-sliders-h"></i>
                    <span>Portal Settings</span>
                </a>
            </li>
            <li class="sidebar-divider hide-mobile">
                <a href="{{ route('home') }}" target="_blank" class="nav-link">
                    <i class="fas fa-external-link-alt"></i>
                    <span>Public Website</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.logout') }}" class="nav-link text-danger-hover" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt" style="color: var(--danger-color)"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
        
        <div class="admin-footer">
            <span>v1.0.0</span>
        </div>
    </nav>

    <!-- Main Workspace -->
    <main class="workspace">
        <!-- Top admin widget bar -->
        <div class="top-strip">
            <h2 class="page-headline">@yield('page_title', 'Administrative Panel')</h2>
            <div class="user-widget">
                <div class="avatar">A</div>
                <div class="user-name">Administrator</div>
            </div>
        </div>

        <!-- Session Status alerts -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        @yield('admin_content')
    </main>
</body>
</html>
