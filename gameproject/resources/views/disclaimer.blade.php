@extends('layouts.frontend')

@section('title', 'Disclaimer & Legal Notices – ' . $settings['site_title'])

@section('content')
<div class="content-page">
    
    <!-- Premium Legal Banner -->
    <div class="disclaimer-banner">
        <span class="banner-icon"><i class="fas fa-shield-alt"></i></span>
        <h2 class="banner-title">Legal & Disclaimer Center</h2>
        <p class="banner-subtitle">Official regulations, restricted states, and responsible gaming policies</p>
    </div>
    
    <!-- Dynamic General Disclaimer Card -->
    <div class="page-card border-danger">
        <h3 class="text-danger"><i class="fas fa-exclamation-triangle"></i> Independent Platform Notice</h3>
        <p class="disclaimer-body">{!! nl2br(e($settings['disclaimer_text'])) !!}</p>
    </div>

    <!-- 18+ Responsible Gaming Block -->
    <div class="page-card responsible-card">
        <div class="responsible-header">
            <span class="age-badge">18+</span>
            <div class="responsible-title-block">
                <h3>Responsible Gaming & Financial Risk</h3>
                <span class="responsible-alert">Attention: Real money games involve financial risk.</span>
            </div>
        </div>
        <p class="responsible-desc">
            Real money gaming applications (like Rummy, Slots, Casino, and Teen Patti) carry financial risk and may be addictive. We strongly encourage players to maintain self-control and practice healthy gaming habits:
        </p>
        <ul class="responsible-tips">
            <li>
                <i class="fas fa-wallet" style="color: #ef4444;"></i>
                <span><strong>Set Strict Budgets:</strong> Never play with funds needed for rent, groceries, bills, or everyday living expenses.</span>
            </li>
            <li>
                <i class="fas fa-clock" style="color: #3b82f6;"></i>
                <span><strong>Limit Your Time:</strong> Set daily time limits to ensure gaming does not interfere with your personal or professional life.</span>
            </li>
            <li>
                <i class="fas fa-hand-holding-usd" style="color: #10b981;"></i>
                <span><strong>Entertainment Only:</strong> Treat online gaming as a recreational activity, not a reliable source of primary or secondary income.</span>
            </li>
        </ul>
    </div>

    <!-- Banned States Information Card -->
    <div class="page-card border-warning">
        <h3 class="text-warning"><i class="fas fa-ban"></i> Legality & Restricted States</h3>
        <p class="alert-body">{!! nl2br(e($settings['states_ban_alert'])) !!}</p>
        <p style="margin-top: 12px; font-weight: 700; font-size: 12.5px; color: var(--text-main);">
            By using this website and downloading any gaming applications, you confirm that you are at least 18 years old and do not reside in any of the restricted states mentioned above.
        </p>
    </div>

    <!-- Aggregator & Referral Disclosure -->
    <div class="page-card border-info">
        <h3 class="text-info"><i class="fas fa-handshake"></i> Referral & Affiliation Disclosure</h3>
        <p>
            <strong>{{ $settings['site_title'] }}</strong> is a free public directory and review platform. The app download buttons may direct you to partner or referral landing pages. While we compile statistics, signup bonuses, and ratings with the utmost care, we are not responsible for any subsequent modifications, policy updates, or financial outcomes applied by external publishers. Please review the official terms and conditions of each app prior to registering or making any deposits.
        </p>
    </div>

    <!-- Brand IP & Copyright Disclaimer -->
    <div class="page-card border-secondary">
        <h3 class="text-secondary"><i class="fas fa-copyright"></i> Copyrights & Brand Takedown Requests</h3>
        <p>
            All game logos, graphics, trademarks, and product names displayed belong entirely to their respective copyright holders. If you are an app developer or brand representative and wish to update listing metrics, update icons, or request the removal of your application, please reach out via our secure <a href="{{ route('contact') }}" style="color: var(--theme-color); font-weight: 700; text-decoration: none;">Contact Page</a>. We process all valid inquiries and takedown notices within 24-48 hours.
        </p>
    </div>
</div>

<style>
    .content-page {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    
    /* Premium Legal Banner */
    .disclaimer-banner {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        padding: 28px 20px;
        border-radius: 16px;
        color: white;
        text-align: center;
        margin-bottom: 4px;
        border: 1px solid rgba(255,255,255,0.06);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }
    .banner-icon {
        font-size: 32px;
        color: #ef4444;
        margin-bottom: 10px;
        display: inline-block;
        filter: drop-shadow(0 2px 4px rgba(239, 68, 68, 0.3));
    }
    .banner-title {
        font-size: 20px;
        font-weight: 900;
        margin-bottom: 6px;
        letter-spacing: -0.5px;
    }
    .banner-subtitle {
        font-size: 11.5px;
        color: #94a3b8;
        font-weight: 500;
        max-width: 480px;
        margin: 0 auto;
        line-height: 1.4;
    }
    
    .page-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 20px;
        box-shadow: var(--card-shadow);
    }
    
    .page-card h3 {
        font-size: 15px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 12px;
    }
    
    .page-card p {
        font-size: 13px;
        line-height: 1.6;
        color: #475569;
    }
    
    /* Responsible Card custom styling */
    .responsible-card {
        border: 1px solid #fee2e2;
        background: linear-gradient(135deg, #ffffff, #fef2f2);
    }
    .responsible-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 12px;
    }
    .age-badge {
        background: #ef4444;
        color: white;
        font-weight: 900;
        font-size: 15px;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(239, 68, 68, 0.35);
        border: 2px solid white;
    }
    .responsible-title-block h3 {
        margin-bottom: 2px !important;
    }
    .responsible-alert {
        font-size: 10px;
        font-weight: 800;
        color: #dc2626;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .responsible-desc {
        margin-bottom: 14px;
    }
    .responsible-tips {
        list-style: none !important;
        padding-left: 0 !important;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .responsible-tips li {
        font-size: 12.5px;
        color: #475569;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        line-height: 1.5;
    }
    .responsible-tips li i {
        font-size: 14px;
        margin-top: 2px;
        flex-shrink: 0;
    }

    /* Left accent borders */
    .border-danger {
        border-left: 4px solid #ef4444;
    }
    .text-danger {
        color: #ef4444 !important;
    }
    
    .border-warning {
        border-left: 4px solid #f59e0b;
    }
    .text-warning {
        color: #f59e0b !important;
    }

    .border-info {
        border-left: 4px solid #0ea5e9;
    }
    .text-info {
        color: #0ea5e9 !important;
    }

    .border-secondary {
        border-left: 4px solid #64748b;
    }
    .text-secondary {
        color: #64748b !important;
    }
</style>
@endsection
