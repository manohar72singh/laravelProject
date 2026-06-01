@extends('layouts.frontend')

@section('title', $app->seo_title ?: $app->name . ' App (Yono) – Signup Bonus ' . $app->bonus_amount . ' | Download APK')
@section('meta_description', $app->seo_description ?: 'Download ' . $app->name . ' today and claim a signup bonus ranging from ' . $app->bonus_amount . ' instantly. Get fast UPI withdrawals from ' . $app->min_withdrawal . '.')
@section('meta_keywords', $app->seo_keywords ?: $app->name . ', ' . $app->name . ' App, ' . $app->name . ' APK, ' . $app->name . ' Download, ' . $app->name . ' Yono, ' . $app->name . ' Bonus')

@section('head_extra')
<!-- Automated Google Rich Search Schemas (JSON-LD) -->
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "SoftwareApplication",
    "name": "{{ $app->name }}",
    "description": "{{ $app->seo_description ?: 'Download ' . $app->name . ' and claim welcome bonus.' }}",
    "image": "{{ $app->icon_url ?: $settings['logo_url'] }}",
    "applicationCategory": "GameApplication",
    "operatingSystem": "Android",
    "aggregateRating": {
        "@@type": "AggregateRating",
        "ratingValue": "{{ $app->rating }}",
        "ratingCount": "{{ str_replace(['K', 'M'], ['000', '000000'], $app->votes) }}"
    },
    "offers": {
        "@@type": "Offer",
        "price": "0",
        "priceCurrency": "INR"
    }
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "{{ route('home') }}"
        },
        {
            "@@type": "ListItem",
            "position": 2,
            "name": "{{ $app->name }}",
            "item": "{{ url()->current() }}"
        }
    ]
}
</script>
@if(is_array($app->download_steps) && count($app->download_steps) > 0)
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "HowTo",
    "name": "How to Download {{ $app->name }}",
    "description": "Step-by-step guide to download and install {{ $app->name }}",
    "image": "{{ $app->icon_url ?: $settings['logo_url'] }}",
    "totalTime": "PT3M",
    "step": [
        @foreach($app->download_steps as $stepIndex => $stepText)
        {
            "@@type": "HowToStep",
            "position": {{ $stepIndex + 1 }},
            "name": "Step {{ $stepIndex + 1 }}",
            "text": "{{ addslashes($stepText) }}"
        }{{ $stepIndex < count($app->download_steps) - 1 ? ',' : '' }}
        @endforeach
    ]
}
</script>
@endif
@endsection

@section('content')
<div class="detail-container">
    
    <!-- Top Back Navigation Header -->
    <div class="detail-back-strip">
        <a href="{{ route('home') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Games
        </a>
    </div>

    <!-- Layout Grid -->
    <div class="detail-layout">
        
        <!-- Left Sidebar (App identity & quick actions) -->
        <aside class="detail-sidebar">
            <!-- App Identity Section -->
            <section class="app-identity">
                <div class="app-logo-box">
                    @if(!empty($app->icon_url))
                        <img src="{{ $app->icon_url }}" alt="{{ $app->name }} Logo" class="app-detail-logo" loading="lazy" referrerpolicy="no-referrer" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    @endif
                    <div class="app-detail-fallback" style="background: {{ $app->fallback_bg }}; display: {{ empty($app->icon_url) ? 'flex' : 'none' }};">
                        {{ $app->initials }}
                    </div>
                </div>
                <h2 class="app-detail-name">{{ $app->name }}</h2>
            </section>

            <!-- App Stats Ribbon Grid -->
            <section class="app-stats">
                <div class="stat-card">
                    <div class="stat-val"><i class="fas fa-star text-gold"></i> {{ $app->rating }}</div>
                    <div class="stat-lbl">Rating</div>
                </div>
                <div class="stat-card">
                    <div class="stat-val">{{ $app->size }}</div>
                    <div class="stat-lbl">Size</div>
                </div>
                <div class="stat-card">
                    <div class="stat-val">{{ $app->votes }}</div>
                    <div class="stat-lbl">Downloads</div>
                </div>
                <div class="stat-card">
                    <div class="stat-val text-bonus">{{ $app->bonus_amount }}</div>
                    <div class="stat-lbl">Free Bonus</div>
                </div>
            </section>

            <!-- Primary Action Download Cards -->
            <section class="action-section">
                @if(!empty($app->promo_code))
                <div class="detail-promo-box" onclick="copyPromo('{{ $app->promo_code }}', this)">
                    <div class="promo-box-title"><i class="fas fa-tag"></i> EXCLUSIVE PROMO CODE</div>
                    <div class="promo-box-body">
                        <span class="detail-promo-code">{{ strtoupper($app->promo_code) }}</span>
                        <span class="detail-promo-copy-btn"><i class="far fa-copy"></i> Tap to Copy</span>
                    </div>
                </div>
                @endif
                <a href="{{ $app->download_url }}" class="btn btn-primary" target="_blank" rel="nofollow">
                    <i class="fas fa-download"></i>
                    DOWNLOAD {{ strtoupper($app->name) }} APK
                </a>
                <button class="btn btn-share" onclick="shareGame('{{ $app->name }}', '{{ url()->current() }}')">
                    <i class="fas fa-share-alt"></i>
                    SHARE THIS APP WITH FRIENDS
                </button>
                <a href="{{ $settings['telegram_url'] }}" class="btn btn-secondary" target="_blank">
                    <i class="fab fa-telegram-plane"></i>
                    JOIN TELEGRAM FOR REWARD CODES
                </a>
            </section>

            <!-- Intro Text Area -->
            @if(!empty($app->intro_text))
                <section class="intro-box">
                    <p>{{ $app->intro_text }}</p>
                </section>
            @endif
        </aside>

        <!-- Right Main Content Column -->
        <div class="detail-main-content">
            <!-- About Content Section -->
            <section class="info-block">
                <h3><i class="fas fa-info-circle"></i> About {{ $app->name }}</h3>
                @if(!empty($app->about_text))
                    <p>{{ $app->about_text }}</p>
                @else
                    <p>{{ $app->name }} is a premium gaming application that offers an immersive and rewarding experience. With a wide variety of games including rummy, slots, and spin games, it provides players with the opportunity to win real cash daily. The app is designed with a user-friendly interface, ensuring smooth gameplay and fast, secure transactions for all its users.</p>
                @endif
            </section>

            <!-- Dynamic Features list -->
            <section class="info-block">
                <h3><i class="fas fa-gift"></i> Key Features & Benefits</h3>
                <ul>
                    @if(is_array($app->features) && count($app->features) > 0)
                        @foreach($app->features as $feature)
                            <li>{!! e($feature) !!}</li>
                        @endforeach
                    @else
                        <li>Instant Signup Bonus of {{ $app->bonus_amount }}</li>
                        <li>Smooth and fast gameplay</li>
                        <li>Real money rewards and daily bonuses</li>
                        <li>100% Safe and Secure</li>
                        <li>Quick withdrawal starting from {{ $app->min_withdrawal }}</li>
                    @endif
                </ul>
            </section>

            <!-- Download & Signup Claim Bonus Section -->
            <section class="info-block">
                <h3><i class="fas fa-hand-holding-usd"></i> {{ $app->name }} Download & Signup Claim Bonus {{ $app->bonus_amount }}</h3>
                
                <div style="margin-top: 12px;">
                    <h4 style="font-size: 14px; font-weight: 700; color: var(--text-main); margin-bottom: 4px;">ऐप डाउनलोड:</h4>
                    <p>First, click on the download button provided above to download the {{ $app->name }} APK file and install it on your device.</p>
                </div>

                <div style="margin-top: 16px;">
                    <h4 style="font-size: 14px; font-weight: 700; color: var(--text-main); margin-bottom: 4px;">{{ $app->name }} रजिस्टर करें:</h4>
                    <p>Open the app and complete the registration process by entering your mobile number and verifying it via OTP.</p>
                </div>

                <div style="margin-top: 16px;">
                    <h4 style="font-size: 14px; font-weight: 700; color: var(--text-main); margin-bottom: 4px;">{{ $app->name }} Bonus Claim:</h4>
                    <p>Once your registration is successful, your signup bonus of {{ $app->bonus_amount }} will be automatically credited to your game wallet to play and win real cash.</p>
                </div>
            </section>

            <!-- Dynamic Download steps guide -->
            <section class="info-block bg-steps">
                <h3><i class="fas fa-mobile-alt"></i> How to Download & Install</h3>
                <ol class="step-ol">
                    @if(is_array($app->download_steps) && count($app->download_steps) > 0)
                        @foreach($app->download_steps as $step)
                            <li>{!! e($step) !!}</li>
                        @endforeach
                    @else
                        <li>Click on the "DOWNLOAD {{ strtoupper($app->name) }} APK" button above.</li>
                        <li>If prompted, allow installation from "Unknown Sources" in your Android settings.</li>
                        <li>Install the downloaded APK file on your device.</li>
                        <li>Open {{ $app->name }}, register your account, and get your {{ $app->bonus_amount }} bonus instantly!</li>
                    @endif
                </ol>
            </section>

            <!-- Security Information -->
            <section class="info-block">
                <h3><i class="fas fa-shield-alt"></i> Safety & Secure Transactions</h3>
                <p>Your safety and security are of utmost priority. {{ $app->name }} utilizes advanced 128-bit SSL encryption to protect your financial transactions and player credentials. All payout processing is handled through standard payment gateways, ensuring that withdrawals reach your Bank Account or UPI wallet securely and instantly.</p>
            </section>

            <!-- ===== User Reviews Section ===== -->
            <section class="reviews-section">
                <h3><i class="fas fa-star-half-alt"></i> User Reviews <span class="reviews-count">({{ $reviews->count() }})</span></h3>

                @if(session('review_success'))
                    <div class="review-alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('review_success') }}
                    </div>
                @endif

                {{-- Approved reviews list --}}
                @if($reviews->count() > 0)
                    <div class="reviews-list">
                        @foreach($reviews as $rev)
                        <div class="review-item">
                            <div class="review-avatar">{{ strtoupper(substr($rev->name, 0, 1)) }}</div>
                            <div class="review-body">
                                <div class="review-header-row">
                                    <span class="reviewer-name">{{ $rev->name }}</span>
                                    <span class="review-stars">
                                        @for($s = 1; $s <= 5; $s++)
                                            @if($s <= $rev->rating) ★ @else ☆ @endif
                                        @endfor
                                    </span>
                                </div>
                                <p class="review-text">{{ $rev->comment }}</p>
                                <span class="review-date">{{ $rev->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="no-reviews-text">No reviews yet. Be the first to review this app!</p>
                @endif

                {{-- Review submission form --}}
                <div class="write-review-box">
                    <h4 class="write-review-title"><i class="fas fa-pen"></i> Write a Review</h4>
                    <form action="{{ route('review.submit') }}" method="POST" class="review-form">
                        @csrf
                        <input type="hidden" name="app_id" value="{{ $app->id }}">

                        <div class="review-form-row">
                            <input type="text" name="name" class="review-input" placeholder="Your name" required maxlength="80">
                            <div class="star-rating" id="starRating">
                                <input type="hidden" name="rating" id="ratingInput" value="5" required>
                                <span class="star-btn active" data-val="1">★</span>
                                <span class="star-btn active" data-val="2">★</span>
                                <span class="star-btn active" data-val="3">★</span>
                                <span class="star-btn active" data-val="4">★</span>
                                <span class="star-btn active" data-val="5">★</span>
                            </div>
                        </div>
                        <textarea name="comment" class="review-textarea" placeholder="Share your experience with {{ $app->name }}..." required maxlength="600" rows="3"></textarea>
                        <button type="submit" class="review-submit-btn">
                            <i class="fas fa-paper-plane"></i> Submit Review
                        </button>
                    </form>
                </div>
            </section>

            <!-- Related Recommendations Grid -->
            <section class="related-section">
                <h3><i class="fas fa-gamepad"></i> More Exciting Yono Games</h3>
                <p class="related-subtitle">Explore other recommended platforms for daily rewards and secure gaming:</p>

                
                <div class="related-grid">
                    @foreach($relatedGames as $related)
                        <a href="{{ route('game.detail', $related->slug) }}" class="related-card">
                            <div class="related-img-container">
                                @if(!empty($related->icon_url))
                                    <img src="{{ $related->icon_url }}" alt="{{ $related->name }}" loading="lazy" referrerpolicy="no-referrer" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                @endif
                                <div class="related-fallback" style="background: {{ $related->fallback_bg }}; display: {{ empty($related->icon_url) ? 'flex' : 'none' }};">
                                    {{ $related->initials }}
                                </div>
                            </div>
                            <div class="related-content">
                                <div class="related-title">{{ $related->name }}</div>
                                <div class="related-bonus">Bonus: {{ $related->bonus_amount }}</div>
                                <div class="related-withdraw">Min. Cashout: {{ $related->min_withdrawal }}</div>
                                <div class="related-rating"><i class="fas fa-star text-gold"></i> {{ $related->rating }}</div>
                                <button class="related-btn">Install App</button>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        </div>

    </div>

</div>

<!-- Details Page Styling -->
<style>
    /* Back strip header */
    .detail-back-strip {
        margin-bottom: 16px;
    }
    
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--text-muted);
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        transition: color 0.2s;
    }
    
    .back-btn:hover {
        color: var(--theme-color);
    }
    
    /* App branding */
    .app-identity {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .app-logo-box {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
        border: 2px solid var(--border-color);
    }
    
    .app-detail-logo {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .app-detail-fallback {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 900;
        font-size: 18px;
        text-align: center;
        line-height: 1;
    }
    
    .app-detail-name {
        font-size: 20px;
        font-weight: 800;
        color: var(--text-main);
    }
    
    /* Stats banner grid */
    .app-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
        background: #f1f5f9;
        padding: 12px 10px;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: var(--card-shadow);
    }
    
    .stat-card {
        text-align: center;
        border-right: 1px solid var(--border-color);
    }
    
    .stat-card:last-child {
        border-right: none;
    }
    
    .stat-val {
        font-size: 13px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 2px;
    }
    
    .text-gold {
        color: #eab308;
    }
    
    .text-bonus {
        color: var(--theme-color);
    }
    
    .stat-lbl {
        font-size: 9.5px;
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    
    /* Action Buttons Design */
    .action-section {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 20px;
    }
    
    .btn {
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: 12px;
        font-weight: 800;
        font-size: 13.5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #e91e63, #ad1457);
        color: white;
        box-shadow: 0 4px 12px rgba(233, 30, 99, 0.3);
    }
    
    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(233, 30, 99, 0.5);
    }
    
    .btn-secondary {
        background: transparent;
        color: var(--theme-color);
        border: 2px solid var(--theme-color);
    }
    
    .btn-secondary:hover {
        background: #ffebeb;
    }

    .btn-share {
        background: linear-gradient(135deg, #0284c7, #0369a1);
        color: white;
        box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
    }
    
    .btn-share:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(2, 132, 199, 0.5);
    }
    
    /* Content Blocks design */
    .intro-box {
        background: white;
        border: 1px solid var(--border-color);
        padding: 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: var(--card-shadow);
    }
    
    .intro-box p {
        font-size: 13px;
        line-height: 1.6;
        color: #475569;
        font-weight: 500;
    }
    
    .info-block {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: var(--card-shadow);
    }
    
    .info-block h3 {
        font-size: 15px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 12px;
    }
    
    .info-block p {
        font-size: 12.5px;
        line-height: 1.6;
        color: #475569;
    }
    
    .info-block ul {
        list-style: none;
        padding-left: 0;
    }
    
    .info-block li {
        font-size: 12.5px;
        line-height: 1.6;
        color: #475569;
        margin-bottom: 8px;
        position: relative;
        padding-left: 20px;
    }
    
    .info-block li::before {
        content: "✓";
        position: absolute;
        left: 0;
        color: var(--theme-color);
        font-weight: 800;
    }
    
    .bg-steps {
        background: #fafafa;
    }
    
    .step-ol {
        padding-left: 18px;
        font-size: 12.5px;
        color: #475569;
    }
    
    .step-ol li {
        padding: 4px 0;
        line-height: 1.6;
    }
    
    /* Related games recommended grid */
    .related-section {
        margin-top: 24px;
        margin-bottom: 16px;
    }
    
    .related-section h3 {
        font-size: 16px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 4px;
    }
    
    .related-subtitle {
        font-size: 11px;
        color: var(--text-muted);
        margin-bottom: 16px;
        font-weight: 600;
    }
    
    .related-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
    
    .related-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        box-shadow: var(--card-shadow);
        transition: all 0.2s ease;
    }
    
    .related-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--card-hover-shadow);
        border-color: #cbd5e1;
    }
    
    .related-img-container {
        width: 100%;
        height: 100px;
        background: #f1f5f9;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid var(--border-color);
    }
    
    .related-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .related-fallback {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 900;
        font-size: 14px;
        text-align: center;
    }
    
    .related-content {
        padding: 12px;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    
    .related-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 2px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    
    .related-bonus {
        font-size: 10.5px;
        color: var(--theme-color);
        font-weight: 700;
    }
    
    .related-withdraw {
        font-size: 10.5px;
        color: var(--text-muted);
        font-weight: 600;
    }
    
    .related-rating {
        font-size: 10.5px;
        font-weight: 600;
        color: var(--text-main);
    }
    
    .related-btn {
        background: linear-gradient(135deg, var(--theme-color), #ff0000);
        color: white;
        padding: 8px;
        border: none;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        width: 100%;
        margin-top: 8px;
        text-align: center;
        transition: opacity 0.2s;
    }
    
    .related-btn:hover {
        opacity: 0.9;
    }
    
        /* Elegant Desktop Split Layout Grid */
        @media (min-width: 768px) {
            .detail-layout {
                display: grid;
                grid-template-columns: 320px 1fr;
                gap: 24px;
                align-items: start;
            }
            
            .detail-sidebar {
                display: flex;
                flex-direction: column;
                gap: 16px;
            }
            
            .detail-main-content {
                display: flex;
                flex-direction: column;
                gap: 16px;
            }
            
            .app-stats {
                grid-template-columns: repeat(2, 1fr) !important;
                padding: 12px 6px;
                gap: 6px;
            }
            
            .stat-card {
                border-right: none;
                border-bottom: 1px solid var(--border-color);
                padding: 8px 0;
            }
            
            .stat-card:nth-child(even) {
                border-left: 1px solid var(--border-color);
                border-right: none;
            }
            
            .stat-card:nth-child(3), 
            .stat-card:nth-child(4) {
                border-bottom: none;
            }
        }

        @media (max-width: 480px) {
            .app-stats {
                grid-template-columns: repeat(2, 1fr) !important;
                padding: 12px 6px !important;
                gap: 6px !important;
            }
            .stat-card {
                border-right: none !important;
                border-bottom: 1px solid var(--border-color) !important;
                padding: 6px 0 !important;
            }
            .stat-card:nth-child(even) {
                border-left: 1px solid var(--border-color) !important;
            }
            .stat-card:nth-child(3), 
            .stat-card:nth-child(4) {
                border-bottom: none !important;
            }
        }

        /* ===== Reviews Section ===== */
        .reviews-section {
            margin-top: 20px;
            padding-bottom: 4px;
        }
        .reviews-section h3 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .reviews-count {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
        }
        .review-alert-success {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #166534;
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 14px;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .reviews-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 16px;
        }
        .review-item {
            display: flex;
            gap: 10px;
            background: var(--card-bg, #fff);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 12px;
        }
        .review-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--theme-color), #8b5cf6);
            color: white;
            font-weight: 700;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .review-body { flex: 1; min-width: 0; }
        .review-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 4px;
        }
        .reviewer-name { font-size: 13px; font-weight: 700; color: var(--text-main); }
        .review-stars { color: #fbbf24; font-size: 14px; letter-spacing: 1px; }
        .review-text {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.5;
            margin-bottom: 4px;
        }
        .review-date { font-size: 11px; color: #94a3b8; }
        .no-reviews-text { font-size: 13px; color: var(--text-muted); font-style: italic; margin-bottom: 14px; }

        /* Write Review Box */
        .write-review-box {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 16px;
        }
        .write-review-title {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .review-form-row {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 10px;
            flex-wrap: wrap;
        }
        .review-input {
            flex: 1;
            min-width: 120px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 9px 12px;
            font-size: 13px;
            background: white;
            color: var(--text-main);
            outline: none;
            transition: border-color 0.2s;
        }
        .review-input:focus { border-color: var(--theme-color); }
        .star-rating {
            display: flex;
            gap: 3px;
            font-size: 22px;
            cursor: pointer;
            user-select: none;
        }
        .star-btn { color: #fbbf24; transition: transform 0.15s; }
        .star-btn:not(.active) { color: #d1d5db; }
        .star-btn:hover { transform: scale(1.2); }
        .review-textarea {
            width: 100%;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 9px 12px;
            font-size: 13px;
            background: white;
            color: var(--text-main);
            resize: vertical;
            outline: none;
            font-family: inherit;
            margin-bottom: 10px;
            transition: border-color 0.2s;
            display: block;
        }
        .review-textarea:focus { border-color: var(--theme-color); }
        .review-submit-btn {
            background: var(--theme-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: all 0.2s;
        }
        .review-submit-btn:hover { opacity: 0.88; transform: translateY(-1px); }

        /* Detail Promo Code Box */
        .detail-promo-box {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border: 2px dashed #d97706;
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 12px;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            gap: 6px;
            box-shadow: 0 4px 6px -1px rgba(217, 119, 6, 0.1);
        }
        .detail-promo-box:hover {
            background: linear-gradient(135deg, #fde68a, #fcd34d);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(217, 119, 6, 0.2);
            border-color: #b45309;
        }
        .promo-box-title {
            font-size: 11px;
            font-weight: 800;
            color: #b45309;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .promo-box-body {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        .detail-promo-code {
            font-size: 18px;
            font-weight: 900;
            color: #78350f;
            letter-spacing: 2px;
        }
        .detail-promo-copy-btn {
            font-size: 11px;
            font-weight: 700;
            color: white;
            background: #d97706;
            padding: 4px 8px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: background 0.2s;
        }
        .detail-promo-box:hover .detail-promo-copy-btn {
            background: #b45309;
        }
        .detail-promo-box.copied {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            border-color: #059669;
            border-style: solid;
            box-shadow: 0 4px 6px -1px rgba(5, 150, 105, 0.1);
        }
        .detail-promo-box.copied .promo-box-title {
            color: #047857;
        }
        .detail-promo-box.copied .detail-promo-code {
            color: #064e3b;
        }
        .detail-promo-box.copied .detail-promo-copy-btn {
            background: #059669;
            color: white;
        }
    </style>
@endsection

@section('page_scripts')
<script>
function copyPromo(code, el) {
    if (!navigator.clipboard) {
        const textArea = document.createElement("textarea");
        textArea.value = code;
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            document.execCommand('copy');
            el.classList.add('copied');
            el.querySelector('.detail-promo-copy-btn').innerHTML = '<i class="fas fa-check"></i> Copied!';
            setTimeout(() => {
                el.classList.remove('copied');
                el.querySelector('.detail-promo-copy-btn').innerHTML = '<i class="far fa-copy"></i> Tap to Copy';
            }, 2000);
        } catch (err) {
            console.error('Fallback copy failed', err);
        }
        document.body.removeChild(textArea);
        return;
    }
    navigator.clipboard.writeText(code).then(() => {
        el.classList.add('copied');
        el.querySelector('.detail-promo-copy-btn').innerHTML = '<i class="fas fa-check"></i> Copied!';
        setTimeout(() => {
            el.classList.remove('copied');
            el.querySelector('.detail-promo-copy-btn').innerHTML = '<i class="far fa-copy"></i> Tap to Copy';
        }, 2000);
    }).catch(err => {
        console.error('Failed to copy', err);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Star rating interaction
    const stars = document.querySelectorAll('.star-btn');
    const ratingInput = document.getElementById('ratingInput');

    if (stars.length && ratingInput) {
        stars.forEach(function(star) {
            star.addEventListener('click', function() {
                const val = parseInt(this.dataset.val);
                ratingInput.value = val;
                stars.forEach(function(s) {
                    s.classList.toggle('active', parseInt(s.dataset.val) <= val);
                });
            });
            star.addEventListener('mouseenter', function() {
                const val = parseInt(this.dataset.val);
                stars.forEach(function(s) {
                    s.classList.toggle('active', parseInt(s.dataset.val) <= val);
                });
            });
        });
        document.querySelector('.star-rating').addEventListener('mouseleave', function() {
            const current = parseInt(ratingInput.value);
            stars.forEach(function(s) {
                s.classList.toggle('active', parseInt(s.dataset.val) <= current);
            });
        });
    }
});
</script>
@endsection
