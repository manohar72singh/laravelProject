<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>404 – Page Not Found | Yono Apps</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --red: #fb3737;
            --red-dark: #c0392b;
            --red-glow: rgba(251, 55, 55, 0.35);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #0a0a0f;
            color: #f1f5f9;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* ── Animated Background ── */
        .bg-layer {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }

        .bg-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            animation: orbFloat 8s ease-in-out infinite alternate;
        }

        .bg-orb-1 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(251,55,55,0.22) 0%, transparent 70%);
            top: -150px;
            left: -100px;
            animation-delay: 0s;
        }

        .bg-orb-2 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(139,92,246,0.18) 0%, transparent 70%);
            bottom: -100px;
            right: -80px;
            animation-delay: 2s;
        }

        .bg-orb-3 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(251,55,55,0.12) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: 4s;
        }

        @keyframes orbFloat {
            0%   { transform: translateY(0) scale(1); }
            100% { transform: translateY(-40px) scale(1.1); }
        }

        /* Grid lines */
        .bg-grid {
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: 0;
        }

        /* ── Main Card ── */
        .page-wrapper {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 40px 24px;
            max-width: 560px;
            width: 100%;
        }

        /* Glowing 404 Number */
        .error-number {
            font-size: clamp(100px, 22vw, 160px);
            font-weight: 900;
            line-height: 1;
            letter-spacing: -8px;
            background: linear-gradient(135deg, #fb3737 0%, #ff6b6b 40%, #fbbf24 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            margin-bottom: 8px;
            animation: numberPulse 3s ease-in-out infinite;
            filter: drop-shadow(0 0 40px rgba(251,55,55,0.5));
        }

        @keyframes numberPulse {
            0%, 100% { filter: drop-shadow(0 0 30px rgba(251,55,55,0.4)); }
            50%       { filter: drop-shadow(0 0 60px rgba(251,55,55,0.7)); }
        }

        /* Broken robot / icon animation */
        .broken-icon {
            font-size: 54px;
            margin-bottom: 22px;
            display: inline-block;
            animation: wobble 2.5s ease-in-out infinite;
            filter: drop-shadow(0 4px 12px rgba(251,55,55,0.4));
        }

        @keyframes wobble {
            0%, 100% { transform: rotate(-8deg); }
            50%       { transform: rotate(8deg); }
        }

        .divider-line {
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--red), #fbbf24);
            border-radius: 999px;
            margin: 16px auto;
            animation: lineGrow 1s ease-out forwards;
        }

        @keyframes lineGrow {
            from { width: 0; opacity: 0; }
            to   { width: 60px; opacity: 1; }
        }

        .error-title {
            font-size: clamp(20px, 5vw, 28px);
            font-weight: 800;
            color: #f1f5f9;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .error-subtitle {
            font-size: 15px;
            color: #94a3b8;
            line-height: 1.7;
            margin-bottom: 36px;
            max-width: 400px;
        }

        .error-subtitle strong {
            color: #fbbf24;
        }

        /* Action Buttons */
        .btn-group {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 40px;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #fb3737, #c0392b);
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            padding: 13px 28px;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(251,55,55,0.4);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.15), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .btn-primary:hover::before { opacity: 1; }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(251,55,55,0.55);
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.06);
            color: #cbd5e1;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            padding: 13px 24px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,0.1);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(255,255,255,0.12);
            color: white;
            border-color: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }

        /* Quick Links */
        .quick-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .quick-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #64748b;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.06);
            transition: all 0.2s;
            letter-spacing: 0.3px;
        }

        .quick-link:hover {
            color: var(--red);
            border-color: rgba(251,55,55,0.3);
            background: rgba(251,55,55,0.06);
        }

        /* Floating particles */
        .particles {
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: rgba(251,55,55,0.6);
            animation: particleDrift linear infinite;
        }

        @keyframes particleDrift {
            0%   { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10%  { opacity: 1; }
            90%  { opacity: 0.8; }
            100% { transform: translateY(-100px) rotate(720deg); opacity: 0; }
        }

        /* Status pill */
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(251,55,55,0.1);
            border: 1px solid rgba(251,55,55,0.25);
            color: #fb8080;
            font-size: 11px;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 50px;
            margin-bottom: 20px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--red);
            animation: blink 1.2s ease-in-out infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.2; }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .error-number { letter-spacing: -4px; margin-bottom: 4px; }
            .btn-group { flex-direction: column; align-items: center; }
            .btn-primary, .btn-secondary { width: 100%; max-width: 280px; justify-content: center; }
        }
    </style>
</head>
<body>

    <!-- Background Layers -->
    <div class="bg-layer">
        <div class="bg-orb bg-orb-1"></div>
        <div class="bg-orb bg-orb-2"></div>
        <div class="bg-orb bg-orb-3"></div>
    </div>
    <div class="bg-grid"></div>

    <!-- Floating Particles -->
    <div class="particles" id="particles"></div>

    <!-- Main Content -->
    <div class="page-wrapper">

        <div class="status-pill">
            <span class="status-dot"></span>
            Error 404
        </div>

        <div class="broken-icon">🎮</div>

        <div class="error-number">404</div>

        <div class="divider-line"></div>

        <h1 class="error-title">Oops! Page Not Found</h1>

        <p class="error-subtitle">
            Yeh page exist nahi karta ya delete ho gaya hai.<br>
            <strong>Galat URL</strong> enter ki hai ya page moved ho gayi hai.<br>
            Ghabrao mat — neechey se home page pe wapas jao! 👇
        </p>

        <div class="btn-group">
            <a href="/" class="btn-primary" id="homeBtn">
                <i class="fas fa-home"></i>
                Back to Home
            </a>
            <a href="javascript:history.back()" class="btn-secondary" id="backBtn">
                <i class="fas fa-arrow-left"></i>
                Go Back
            </a>
        </div>

        <div class="quick-links">
            <a href="/" class="quick-link">
                <i class="fas fa-gamepad"></i> All Games
            </a>
            <a href="/about" class="quick-link">
                <i class="fas fa-info-circle"></i> About
            </a>
            <a href="/contact" class="quick-link">
                <i class="fas fa-envelope"></i> Contact
            </a>
            <a href="/disclaimer" class="quick-link">
                <i class="fas fa-exclamation-triangle"></i> Disclaimer
            </a>
        </div>

    </div>

    <script>
        // Generate floating particles
        const container = document.getElementById('particles');
        const colors = ['rgba(251,55,55,0.7)', 'rgba(251,191,36,0.5)', 'rgba(139,92,246,0.5)'];

        for (let i = 0; i < 18; i++) {
            const p = document.createElement('div');
            p.className = 'particle';
            p.style.left          = Math.random() * 100 + 'vw';
            p.style.width         = (Math.random() * 4 + 2) + 'px';
            p.style.height        = p.style.width;
            p.style.background    = colors[Math.floor(Math.random() * colors.length)];
            p.style.animationDuration  = (Math.random() * 10 + 8) + 's';
            p.style.animationDelay     = (Math.random() * 8) + 's';
            p.style.borderRadius  = Math.random() > 0.5 ? '50%' : '2px';
            container.appendChild(p);
        }

        // Subtle button click ripple
        document.querySelectorAll('.btn-primary, .btn-secondary').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255,255,255,0.3);
                    transform: scale(0);
                    animation: rippleOut 0.5s linear;
                    width: 100px; height: 100px;
                    left: ${e.offsetX - 50}px;
                    top: ${e.offsetY - 50}px;
                    pointer-events: none;
                `;
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                setTimeout(() => ripple.remove(), 500);
            });
        });
    </script>

    <style>
        @keyframes rippleOut {
            to { transform: scale(4); opacity: 0; }
        }
    </style>

</body>
</html>
