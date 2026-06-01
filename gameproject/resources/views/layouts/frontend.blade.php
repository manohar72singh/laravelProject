<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- PWA Manifest & Apple Mobile Web App Support -->
    <link rel="manifest" href="/manifest.json">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="{{ $settings['site_title'] }}">

    
    <!-- Dynamic SEO and Meta Tags -->
    <title>@yield('title', $settings['site_title'] . ' – ' . $settings['site_tagline'])</title>
    <meta name="description" content="@yield('meta_description', $settings['site_description'])">
    <meta name="keywords" content="@yield('meta_keywords', $settings['site_keywords'])">
    <meta name="author" content="All New Yono Apps - Yono Games">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="theme-color" content="{{ $settings['theme_color'] }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', $settings['site_title'] . ' – ' . $settings['site_tagline'])">
    <meta property="og:description" content="@yield('meta_description', $settings['site_description'])">
    <meta property="og:image" content="{{ $settings['logo_url'] }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $settings['site_title'] }}">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', $settings['site_title'] . ' – ' . $settings['site_tagline'])">
    <meta name="twitter:description" content="@yield('meta_description', $settings['site_description'])">
    <meta name="twitter:image" content="{{ $settings['logo_url'] }}">
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Premium Core Styling -->
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, {{ $settings['header_gradient_start'] }}, {{ $settings['header_gradient_end'] }});
            --theme-color: {{ $settings['theme_color'] }};
            --bg-color: #f8fafc;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --card-bg: #ffffff;
            --card-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.1);
            --card-hover-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--bg-color);
            color: var(--text-main);
            line-height: 1.5;
            font-size: 14px;
            overflow-x: hidden;
        }
        
        /* Dynamic Fully Responsive Layout Wrapper */
        .wrapper {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            min-height: 100vh;
            box-shadow: 0 0 40px rgba(0,0,0,0.08);
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        
        /* Header styling */
        .header {
            background: var(--primary-gradient);
            padding: 16px 24px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 10;
        }
        
        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: white;
        }
        
        .logo-img {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            border: 2px solid rgba(255, 255, 255, 0.4);
        }
        
        .site-title {
            font-size: 22px;
            font-weight: 900;
            letter-spacing: -0.5px;
            line-height: 1.1;
        }

        /* Desktop Header Navbar */
        .desktop-nav {
            display: none;
            gap: 8px;
            align-items: center;
        }

        .desktop-nav-item {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            padding: 8px 14px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .desktop-nav-item:hover {
            color: white;
            background: rgba(255,255,255,0.15);
        }

        .desktop-nav-item.active {
            color: white;
            background: rgba(255,255,255,0.22);
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        }
        
        .menu-toggle {
            background: rgba(255,255,255,0.18);
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
            cursor: pointer;
            padding: 10px;
            border-radius: 10px;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        
        .menu-toggle:hover {
            background: rgba(255,255,255,0.28);
        }
        
        /* Navigation menu bar */
        .nav-menu {
            display: flex;
            justify-content: space-between;
            padding: 6px 10px;
            background: white;
            border-bottom: 1px solid var(--border-color);
            font-size: 11px;
            font-weight: 600;
            overflow-x: auto;
            white-space: nowrap;
        }
        
        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            text-decoration: none;
            color: var(--text-muted);
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.2s ease;
            flex: 1;
            text-align: center;
            min-width: 70px;
        }
        
        .nav-item i {
            font-size: 16px;
        }
        
        .nav-item:hover {
            color: var(--theme-color);
            background: #f1f5f9;
        }
        
        .nav-item.active {
            color: var(--theme-color);
            background: #ffebeb;
        }
        
        /* Main Content container */
        .main-content {
            padding: 24px;
            background: #f8fafc;
            flex: 1;
        }
        
        /* Dynamic Drawer Menu */
        .sidebar-drawer {
            position: fixed;
            top: 0;
            right: -280px;
            width: 280px;
            height: 100vh;
            background: white;
            z-index: 9999;
            box-shadow: -5px 0 25px rgba(0,0,0,0.15);
            transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .sidebar-drawer.open {
            right: 0;
        }
        
        .drawer-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(2px);
            z-index: 9998;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        
        .drawer-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }
        
        .drawer-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 15px;
        }
        
        .drawer-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-main);
        }
        
        .close-drawer {
            background: none;
            border: none;
            font-size: 20px;
            color: var(--text-muted);
            cursor: pointer;
        }
        
        .drawer-links {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .drawer-link {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text-main);
            font-size: 14px;
            font-weight: 600;
            padding: 10px 14px;
            border-radius: 8px;
            transition: background 0.2s;
        }
        
        .drawer-link:hover {
            background: #f1f5f9;
            color: var(--theme-color);
        }
        
        /* Combined Floating Support Widget */
        .support-widget {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }
        
        .support-trigger {
            background: linear-gradient(135deg, var(--theme-color), #f43f5e);
            color: white;
            border: none;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(244, 63, 94, 0.4);
            position: relative;
            z-index: 1002;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            outline: none;
        }
        .support-trigger:hover {
            transform: scale(1.08);
            box-shadow: 0 6px 20px rgba(244, 63, 94, 0.6);
        }
        .support-trigger .trigger-icon {
            font-size: 24px;
            transition: transform 0.3s ease, opacity 0.2s;
        }
        .support-trigger .close-icon {
            font-size: 24px;
            position: absolute;
            opacity: 0;
            transform: rotate(-90deg);
            transition: transform 0.3s ease, opacity 0.2s;
        }
        .support-widget.open .support-trigger {
            background: #475569;
            box-shadow: 0 4px 15px rgba(71, 85, 105, 0.4);
        }
        .support-widget.open .support-trigger .trigger-icon {
            opacity: 0;
            transform: rotate(90deg);
        }
        .support-widget.open .support-trigger .close-icon {
            opacity: 1;
            transform: rotate(0deg);
        }
        
        /* Pulse Animation on Support Button */
        .support-pulse {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: rgba(244, 63, 94, 0.4);
            z-index: -1;
            animation: supportPulse 2s infinite;
        }
        @keyframes supportPulse {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(1.6); opacity: 0; }
        }
        .support-widget.open .support-pulse {
            display: none;
        }

        /* Support options stack */
        .support-options {
            display: flex;
            flex-direction: column;
            gap: 10px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px) scale(0.8);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            pointer-events: none;
        }
        .support-widget.open .support-options {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }
        
        .support-btn {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            font-size: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            transition: all 0.2s ease;
            position: relative;
        }
        .support-btn:hover {
            transform: scale(1.1);
        }
        .telegram-btn {
            background: #0088cc;
        }
        .telegram-btn:hover {
            box-shadow: 0 6px 15px rgba(0, 136, 204, 0.5);
        }
        .whatsapp-btn {
            background: #25d366;
        }
        .whatsapp-btn:hover {
            box-shadow: 0 6px 15px rgba(37, 211, 102, 0.5);
        }
        
        /* Tooltip style */
        .support-tooltip {
            position: absolute;
            right: 60px;
            background: #1e293b;
            color: white;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transform: translateX(10px);
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        .support-tooltip::after {
            content: '';
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            border-width: 5px;
            border-style: solid;
            border-color: transparent transparent transparent #1e293b;
        }
        .support-btn:hover .support-tooltip {
            opacity: 1;
            visibility: visible;
            transform: translateX(0);
        }
        
        /* Avoid overlapping on mobile if bottom download bar exists */
        @media (max-width: 768px) {
            .support-widget {
                bottom: 16px;
                right: 16px;
            }
            .support-trigger {
                width: 48px;
                height: 48px;
            }
            .support-trigger .trigger-icon,
            .support-trigger .close-icon {
                font-size: 20px;
            }
            .support-btn {
                width: 42px;
                height: 42px;
                font-size: 18px;
            }
        }
        
        @media (min-width: 768px) {
            .menu-toggle {
                display: none;
            }
        }
        
        @media (max-width: 768px) {
            .wrapper {
                max-width: 100vw;
                box-shadow: none;
            }
            .header {
                padding: 12px 16px;
            }
            .logo-img {
                width: 36px;
                height: 36px;
            }
            .site-title {
                font-size: 16px;
            }
            .nav-menu {
                padding: 6px 8px;
                font-size: 10px;
            }
            .nav-item {
                padding: 6px 8px;
                min-width: 65px;
            }
            .nav-item i {
                font-size: 14px;
            }
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Premium Header Search Bar styling */
        .header-search {
            flex: 1;
            max-width: 320px;
            margin: 0 16px;
            position: relative;
        }

        .header-search form {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 30px;
            padding: 2px 6px 2px 14px;
            transition: all 0.3s ease;
        }

        .header-search form:focus-within {
            background: rgba(255, 255, 255, 0.25);
            border-color: white;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }

        .header-search input {
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            color: white;
            font-size: 13px;
            font-weight: 500;
            padding: 6px 0;
        }

        .header-search input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .header-search button {
            background: transparent;
            border: none;
            color: white;
            cursor: pointer;
            padding: 6px;
            font-size: 14px;
            transition: opacity 0.2s;
        }

        .header-search button:hover {
            opacity: 0.8;
        }

        /* Glassmorphic Toast styling */
        .share-toast {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            background: rgba(30, 41, 59, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 12px 24px;
            border-radius: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            z-index: 10000;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        .share-toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
            pointer-events: auto;
        }
        .toast-content {
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
            font-weight: 700;
            font-size: 13px;
        }
        .toast-icon {
            color: #10b981;
            font-size: 16px;
        }

        @media (max-width: 600px) {
            .header-search {
                display: none; /* Hide header search on very small viewports */
            }
        }
    </style>
    @yield('head_extra')
</head>
<body>
    <div class="wrapper">
        <!-- Header -->
        <header class="header">
            <a href="{{ route('home') }}" class="logo-section">
                <img src="{{ $settings['logo_url'] }}" alt="{{ $settings['site_title'] }} Logo" class="logo-img" referrerpolicy="no-referrer">
                <h1 class="site-title">{{ $settings['site_title'] }}</h1>
            </a>

            <!-- Premium Header Search Bar -->
            <div class="header-search">
                <form action="{{ route('home') }}" method="GET" id="headerSearchForm">
                    <input type="text" name="search" id="headerSearchInput" placeholder="Search Rummy, Slots, Teen Patti apps..." autocomplete="off">
                    <button type="submit" aria-label="Search"><i class="fas fa-search"></i></button>
                </form>
            </div>


            <button class="menu-toggle" id="openDrawer" aria-label="Open side menu">
                <i class="fas fa-bars"></i>
            </button>
        </header>


        <!-- Top Navigation Menu -->
        <nav class="nav-menu" role="navigation">
            <a href="{{ route('home') }}" class="nav-item {{ Route::is('home') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <a href="{{ route('about') }}" class="nav-item {{ Route::is('about') ? 'active' : '' }}">
                <i class="fas fa-info-circle"></i>
                <span>About</span>
            </a>
            <a href="{{ route('contact') }}" class="nav-item {{ Route::is('contact') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i>
                <span>Contact</span>
            </a>
            <a href="{{ route('disclaimer') }}" class="nav-item {{ Route::is('disclaimer') ? 'active' : '' }}">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Disclaimer</span>
            </a>
            <a href="{{ $settings['telegram_url'] }}" target="_blank" class="nav-item">
                <i class="fab fa-telegram-plane"></i>
                <span>TG Join</span>
            </a>
        </nav>
        

        <!-- Main Slot Content -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <!-- Navigation Drawer Sidebar -->
    <div class="drawer-overlay" id="drawerOverlay"></div>
    <div class="sidebar-drawer" id="sidebarDrawer">
        <div class="drawer-header">
            <span class="drawer-title">Navigation Menu</span>
            <button class="close-drawer" id="closeDrawer" aria-label="Close menu">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="drawer-links">
            <a href="{{ route('home') }}" class="drawer-link">
                <i class="fas fa-home" style="color: var(--theme-color)"></i> Home
            </a>
            <a href="{{ route('about') }}" class="drawer-link">
                <i class="fas fa-info-circle" style="color: var(--theme-color)"></i> About Us
            </a>
            <a href="{{ route('contact') }}" class="drawer-link">
                <i class="fas fa-envelope" style="color: var(--theme-color)"></i> Contact Us
            </a>
            <a href="{{ route('disclaimer') }}" class="drawer-link">
                <i class="fas fa-exclamation-triangle" style="color: var(--theme-color)"></i> Disclaimer
            </a>
            <a href="{{ $settings['telegram_url'] }}" target="_blank" class="drawer-link">
                <i class="fab fa-telegram-plane" style="color: #0088cc"></i> Join our Telegram
            </a>
        </div>
    </div>

    <!-- Combined Floating Support Widget -->
    @if((!empty($settings['telegram_url']) && $settings['telegram_url'] !== '#') || !empty($settings['whatsapp_number']))
    <div class="support-widget" id="supportWidget">
        <!-- Expanded buttons container -->
        <div class="support-options" id="supportOptions">
            @if(!empty($settings['telegram_url']) && $settings['telegram_url'] !== '#')
            <a href="{{ $settings['telegram_url'] }}" target="_blank" class="support-btn telegram-btn" title="Join Telegram Channel">
                <i class="fab fa-telegram-plane"></i>
                <span class="support-tooltip">Telegram Channel</span>
            </a>
            @endif
            @if(!empty($settings['whatsapp_number']))
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number']) }}" target="_blank" class="support-btn whatsapp-btn" title="Contact WhatsApp Support">
                <i class="fab fa-whatsapp"></i>
                <span class="support-tooltip">WhatsApp Support</span>
            </a>
            @endif
        </div>
        <!-- Main Toggle Trigger Button -->
        <button class="support-trigger" id="supportTrigger" aria-label="Open support menu" title="Customer Support">
            <i class="fas fa-headset trigger-icon"></i>
            <i class="fas fa-times close-icon"></i>
            <span class="support-pulse"></span>
        </button>
    </div>
    @endif

    <!-- Glassmorphic Toast Notification -->
    <div id="share-toast" class="share-toast hidden">
        <div class="toast-content">
            <i class="fas fa-check-circle toast-icon"></i>
            <span id="toast-message">Link copied to clipboard!</span>
        </div>
    </div>

    <!-- Drawer Toggling and Share Javascript -->
    <script>
        const openDrawerBtn = document.getElementById('openDrawer');
        const closeDrawerBtn = document.getElementById('closeDrawer');
        const drawer = document.getElementById('sidebarDrawer');
        const overlay = document.getElementById('drawerOverlay');

        function toggleDrawer(open) {
            if (open) {
                drawer.classList.add('open');
                overlay.classList.add('open');
            } else {
                drawer.classList.remove('open');
                overlay.classList.remove('open');
            }
        }

        openDrawerBtn.addEventListener('click', () => toggleDrawer(true));
        closeDrawerBtn.addEventListener('click', () => toggleDrawer(false));
        overlay.addEventListener('click', () => toggleDrawer(false));

        // Premium Sharing functionality
        window.shareGame = function(name, url) {
            const absoluteUrl = url.startsWith('http') ? url : window.location.origin + url;
            const shareText = `Hey! Download ${name} app and claim instant Signup Bonus! Secure UPI cash withdrawals. Get it here:`;
            
            if (navigator.share) {
                navigator.share({
                    title: name,
                    text: shareText,
                    url: absoluteUrl
                }).catch(err => {
                    console.log('Share canceled or failed', err);
                });
            } else {
                // Fallback: Copy to Clipboard
                const dummy = document.createElement('input');
                document.body.appendChild(dummy);
                dummy.value = `${shareText} ${absoluteUrl}`;
                dummy.select();
                document.execCommand('copy');
                document.body.removeChild(dummy);
                
                showToast('Link copied to clipboard!');
            }
        };

        window.showToast = function(message) {
            const toast = document.getElementById('share-toast');
            const toastMsg = document.getElementById('toast-message');
            toastMsg.textContent = message;
            toast.classList.remove('hidden');
            // Trigger reflow
            toast.offsetHeight;
            toast.classList.add('show');
            
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 300);
            }, 2500);
        };

        // Floating Support Widget Toggle
        const supportWidget = document.getElementById('supportWidget');
        const supportTrigger = document.getElementById('supportTrigger');
        const supportOptions = document.getElementById('supportOptions');
        if (supportTrigger && supportWidget && supportOptions) {
            supportTrigger.addEventListener('click', (e) => {
                e.stopPropagation();
                supportWidget.classList.toggle('open');
            });
            document.addEventListener('click', () => {
                supportWidget.classList.remove('open');
            });
            supportOptions.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        }
    </script>


    <!-- PWA Service Worker Registration -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js')
                    .then(function(reg) { console.log('PWA SW registered'); })
                    .catch(function(err) { console.log('SW registration failed:', err); });
            });
        }
    </script>

    @yield('page_scripts')
</body>
</html>
