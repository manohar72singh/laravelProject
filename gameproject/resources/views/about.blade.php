@extends('layouts.frontend')

@section('title', 'About Us – ' . $settings['site_title'])

@section('content')
<div class="content-page">
    <h2 class="page-title">About Us</h2>
    
    <div class="page-card">
        <h3>Welcome to {{ $settings['site_title'] }}</h3>
        <p>
            {{ $settings['site_title'] }} was born with a simple yet ambitious vision: to create the ultimate discovery portal for real money mobile gaming enthusiasts in India. We notice how challenging it can be for players to browse, compare, and safely download mobile gaming apps. 
        </p>
        <p>
            Our dedicated team aggregates the finest Rummy, Slots, and Teen Patti games from trusted Yono developers under one fast, responsive mobile catalog. We are constantly reviewing applications to provide you with verified stats, signup bonuses, and withdrawal speed records.
        </p>
    </div>

    <!-- Our Mission Gradient Card -->
    <div class="mission-card">
        <div class="mission-icon">
            <i class="fas fa-star"></i>
        </div>
        <h3 class="mission-title">Our Mission</h3>
        <p class="mission-text">
            To provide the best gaming and app experience for Indian users with secure downloads and reliable service.
        </p>
    </div>

    <!-- Feature 2x2 Grid -->
    <div class="about-features-grid">
        <div class="about-feature-card">
            <div class="about-feature-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h4 class="about-feature-title">Secure Downloads</h4>
            <p class="about-feature-desc">All apps are verified and safe</p>
        </div>
        
        <div class="about-feature-card">
            <div class="about-feature-icon">
                <i class="fas fa-mobile-alt"></i>
            </div>
            <h4 class="about-feature-title">Mobile Optimized</h4>
            <p class="about-feature-desc">Perfect experience on all devices</p>
        </div>
        
        <div class="about-feature-card">
            <div class="about-feature-icon">
                <i class="fas fa-users"></i>
            </div>
            <h4 class="about-feature-title">Community Focused</h4>
            <p class="about-feature-desc">Built for Indian users</p>
        </div>
        
        <div class="about-feature-card">
            <div class="about-feature-icon">
                <i class="fas fa-clock"></i>
            </div>
            <h4 class="about-feature-title">24/7 Support</h4>
            <p class="about-feature-desc">Always here to help you</p>
        </div>
    </div>

    <div class="page-card">
        <h3>Our Core Values</h3>
        <ul>
            <li><strong>Transparency:</strong> We present precise signup bonus amounts and withdrawal specs without fluff.</li>
            <li><strong>Security First:</strong> We ensure that every link seeded on our portal points directly to safe, official channels.</li>
            <li><strong>User Focus:</strong> We optimized our mobile-first template so you can search and download in just two taps!</li>
        </ul>
    </div>

    <div class="page-card border-warning">
        <h3 class="text-warning"><i class="fas fa-shield-alt"></i> Responsible Gaming</h3>
        <p>
            While real money card and board gaming is incredibly engaging and strategic, it carries inherent financial risks. We strongly advocate for self-control and responsible bankroll budgeting. Set strict gaming limits and pace yourself during play!
        </p>
    </div>

    <!-- Back to Home Button -->
    <div class="back-btn-container">
        <a href="{{ route('home') }}" class="btn-back-home">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>
    </div>
</div>

<style>
    .content-page {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    
    .page-title {
        font-size: 22px;
        font-weight: 900;
        letter-spacing: -0.5px;
        color: var(--text-main);
        text-align: center;
        margin-bottom: 8px;
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
        margin-bottom: 12px;
    }
    
    .page-card p:last-child {
        margin-bottom: 0;
    }
    
    .page-card ul {
        list-style: none;
        padding-left: 0;
    }
    
    .page-card li {
        font-size: 13px;
        line-height: 1.6;
        color: #475569;
        margin-bottom: 8px;
        position: relative;
        padding-left: 20px;
    }
    
    .page-card li::before {
        content: "✓";
        position: absolute;
        left: 0;
        color: var(--theme-color);
        font-weight: 800;
    }
    
    .border-warning {
        border-left: 4px solid #f59e0b;
    }
    .text-warning {
        color: #f59e0b !important;
    }

    /* Mission Gradient Card */
    .mission-card {
        background: linear-gradient(135deg, #004d40, #00acc1); /* Rich dark emerald teal to light cyan */
        color: white;
        text-align: center;
        border-radius: 16px;
        padding: 26px 20px;
        box-shadow: 0 10px 25px rgba(0, 77, 64, 0.2);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }
    .mission-icon {
        font-size: 24px;
        color: white;
        margin-bottom: 4px;
    }
    .mission-title {
        font-size: 17px;
        font-weight: 800;
        letter-spacing: 0.5px;
    }
    .mission-text {
        font-size: 13px;
        line-height: 1.6;
        opacity: 0.95;
        max-width: 460px;
        margin: 0;
    }

    /* Feature Grid */
    .about-features-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-top: 4px;
        margin-bottom: 4px;
    }
    .about-feature-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 22px 12px;
        text-align: center;
        box-shadow: var(--card-shadow);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .about-feature-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--card-hover-shadow);
    }
    .about-feature-icon {
        width: 44px;
        height: 44px;
        background: #fff1f2;
        color: #ef4444; /* Vibrant Red */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 6px;
        box-shadow: 0 4px 10px rgba(239, 68, 68, 0.1);
    }
    .about-feature-title {
        font-size: 13.5px;
        font-weight: 800;
        color: var(--text-main);
    }
    .about-feature-desc {
        font-size: 11px;
        color: var(--text-muted);
        line-height: 1.4;
        margin: 0;
    }

    /* Back to Home Button */
    .back-btn-container {
        display: flex;
        justify-content: center;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .btn-back-home {
        background: #ef4444; /* Crimson Red */
        color: white;
        text-decoration: none;
        font-weight: 800;
        font-size: 14px;
        padding: 12px 28px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.25);
        border: none;
        cursor: pointer;
    }
    .btn-back-home:hover {
        background: #dc2626;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
    }

    @media (max-width: 480px) {
        .about-features-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
    }
</style>
@endsection
