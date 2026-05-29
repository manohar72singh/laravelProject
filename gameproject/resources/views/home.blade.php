@extends('layouts.frontend')

@section('content')
<div class="home-container">
    <h2 class="main-title">ALL YONO GAMES India</h2>
    
    <!-- Promo Banner Card -->
    <section class="promo-section">
        <p class="promo-text">
            <strong>{{ $settings['site_title'] }}</strong> is a popular platform where players can explore a wide collection of real money gaming apps in one place. From rummy tables to slot spins and bingo games, users can enjoy multiple categories like Rummy, Slots, Bingo, Arcade, and Spin games with daily rewards. This collection includes many trending apps such as Yono Bonus, Club INR, INR Rummy, Rumble Rummy, Spin101, and more. Explore all latest releases with secure UPI withdrawals and quick signup bonuses!
        </p>
    </section>
    
    {{-- ===== TOP 5 LEADERBOARD CAROUSEL ===== --}}
    @if($topApps->count() > 0)
    <section class="leaderboard-section">
        <div class="leaderboard-header">
            <span class="lb-trophy"><i class="fas fa-trophy"></i></span>
            <h3 class="lb-title">🏆 Top Rated Apps</h3>
            <span class="lb-subtitle">Slide to explore</span>
        </div>

        <div class="lb-carousel-wrapper">
            <div class="lb-carousel" id="lbCarousel">
                @foreach($topApps as $index => $tApp)
                <a href="{{ route('game.detail', $tApp->slug) }}" class="lb-card" style="text-decoration:none;">
                    <div class="lb-rank rank-{{ $index + 1 }}">
                        @if($index === 0) 🥇 @elseif($index === 1) 🥈 @elseif($index === 2) 🥉 @else 🏅 @endif
                    </div>
                    <div class="lb-icon-wrap">
                        @if(!empty($tApp->icon_url))
                            <img src="{{ $tApp->icon_url }}" alt="{{ $tApp->name }}" class="lb-icon" loading="lazy" referrerpolicy="no-referrer"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        @endif
                        <div class="lb-icon-fb" style="background: {{ $tApp->fallback_bg }}; display: {{ empty($tApp->icon_url) ? 'flex' : 'none' }};">
                            {{ $tApp->initials }}
                        </div>
                    </div>
                    <div class="lb-info">
                        <div class="lb-name">{{ Str::limit($tApp->name, 18) }}</div>
                        <div class="lb-stars">
                            @for($s = 1; $s <= 5; $s++)
                                @if($s <= round($tApp->rating))
                                    <i class="fas fa-star" style="color:#fbbf24;font-size:10px;"></i>
                                @else
                                    <i class="far fa-star" style="color:#d1d5db;font-size:10px;"></i>
                                @endif
                            @endfor
                            <span class="lb-rating">{{ number_format($tApp->rating, 1) }}</span>
                        </div>
                        <div class="lb-bonus">💰 {{ $tApp->bonus_amount }}</div>
                    </div>
                </a>
                @endforeach
            </div>
            <button class="lb-nav lb-prev" id="lbPrev" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
            <button class="lb-nav lb-next" id="lbNext" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
        </div>
        <div class="lb-dots" id="lbDots">
            @foreach($topApps as $index => $tApp)
                <span class="lb-dot {{ $index === 0 ? 'active' : '' }}" data-idx="{{ $index }}"></span>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Download Title -->
    <section class="download-section">
        <h3 class="download-title">Download NEW YONO Games</h3>


        
        <!-- Premium Live Search Bar -->
        <div class="search-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="appSearch" placeholder="Search Rummy, Slots, Teen Patti apps..." aria-label="Search apps">
        </div>
        
        <!-- Dynamic Category Tabs -->
        <div class="tabs" role="tablist">
            <button class="tab active" id="tab-new" role="tab" aria-selected="true" aria-controls="new-games">
                <i class="fas fa-star"></i> New Games<span id="tab-new-count" class="tab-badge hidden"></span>
            </button>
            <button class="tab" id="tab-other" role="tab" aria-selected="false" aria-controls="other-games">
                <i class="fas fa-gamepad"></i> Other Games<span id="tab-other-count" class="tab-badge hidden"></span>
            </button>
        </div>
        
        <!-- Empty State for Search -->
        <div class="empty-state" id="emptyState" style="display: none;">
            <i class="fas fa-search-minus"></i>
            <p>No matching apps found. Try searching for another keyword!</p>
        </div>
        
        <!-- New Games Tab Panel -->
        <div class="games-list" id="new-games" role="tabpanel">
            @forelse($newGames as $index => $app)
                <article class="game-card" data-name="{{ strtolower($app->name) }}">
                    <!-- Top-Right Float Share Button -->
                    <button class="share-card-btn" onclick="event.preventDefault(); shareGame('{{ $app->name }}', '{{ route('game.detail', $app->slug) }}')" aria-label="Share {{ $app->name }} app">
                        <i class="fas fa-share-alt"></i>
                    </button>

                    <!-- Top-Left Game Number -->
                    <div class="game-number">{{ $index + 1 }}</div>
                    
                    <!-- Card Body Row -->
                    <div class="card-body-row">
                        <div class="game-icon-container">
                            @if(!empty($app->icon_url))
                                <img src="{{ $app->icon_url }}" alt="{{ $app->name }} App Icon" class="game-icon" loading="lazy" referrerpolicy="no-referrer" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            @endif
                            <div class="game-icon-fallback" style="background: {{ $app->fallback_bg }}; display: {{ empty($app->icon_url) ? 'flex' : 'none' }};">
                                {{ $app->initials }}
                            </div>
                        </div>
                        
                        <div class="game-info">
                            <h4 class="game-name">{{ $app->name }}</h4>
                            <div class="game-details">
                                <div class="bonus-info">
                                    <i class="fas fa-gift"></i>
                                    Sign Up Bonus {{ $app->bonus_amount }}
                                </div>
                                <div class="withdraw-info">
                                    <i class="fas fa-wallet"></i>
                                    Min. Withdraw {{ $app->min_withdrawal }}
                                </div>
                            </div>
                            @if(!empty($app->promo_code))
                            <div class="promo-badge" onclick="event.stopPropagation(); copyPromo('{{ $app->promo_code }}', this)">
                                <i class="fas fa-tag"></i>
                                <span class="promo-code-text">{{ strtoupper($app->promo_code) }}</span>
                                <span class="promo-copy-label">Tap to Copy</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Bottom Full-Width Download Button -->
                    <a href="{{ route('game.detail', $app->slug) }}" class="download-btn" aria-label="Download {{ $app->name }} app">
                        <i class="fas fa-download"></i>
                        Download App
                    </a>
                </article>
            @empty
                <div class="empty-state">
                    <i class="fas fa-gamepad"></i>
                    <p>No new games available.</p>
                </div>
            @endforelse
        </div>
        
        <!-- Other Games Tab Panel -->
        <div class="games-list hidden" id="other-games" role="tabpanel">
            @forelse($otherGames as $index => $app)
                <article class="game-card" data-name="{{ strtolower($app->name) }}">
                    <!-- Top-Right Float Share Button -->
                    <button class="share-card-btn" onclick="event.preventDefault(); shareGame('{{ $app->name }}', '{{ route('game.detail', $app->slug) }}')" aria-label="Share {{ $app->name }} app">
                        <i class="fas fa-share-alt"></i>
                    </button>

                    <!-- Top-Left Game Number -->
                    <div class="game-number">{{ $index + 1 }}</div>
                    
                    <!-- Card Body Row -->
                    <div class="card-body-row">
                        <div class="game-icon-container">
                            @if(!empty($app->icon_url))
                                <img src="{{ $app->icon_url }}" alt="{{ $app->name }} App Icon" class="game-icon" loading="lazy" referrerpolicy="no-referrer" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            @endif
                            <div class="game-icon-fallback" style="background: {{ $app->fallback_bg }}; display: {{ empty($app->icon_url) ? 'flex' : 'none' }};">
                                {{ $app->initials }}
                            </div>
                        </div>
                        
                        <div class="game-info">
                            <h4 class="game-name">{{ $app->name }}</h4>
                            <div class="game-details">
                                <div class="bonus-info">
                                    <i class="fas fa-gift"></i>
                                    Sign Up Bonus {{ $app->bonus_amount }}
                                </div>
                                <div class="withdraw-info">
                                    <i class="fas fa-wallet"></i>
                                    Min. Withdraw {{ $app->min_withdrawal }}
                                </div>
                            </div>
                            @if(!empty($app->promo_code))
                            <div class="promo-badge" onclick="event.stopPropagation(); copyPromo('{{ $app->promo_code }}', this)">
                                <i class="fas fa-tag"></i>
                                <span class="promo-code-text">{{ strtoupper($app->promo_code) }}</span>
                                <span class="promo-copy-label">Tap to Copy</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Bottom Full-Width Download Button -->
                    <a href="{{ route('game.detail', $app->slug) }}" class="download-btn" aria-label="Download {{ $app->name }} app">
                        <i class="fas fa-download"></i>
                        Download App
                    </a>
                </article>
            @empty
                <div class="empty-state">
                    <i class="fas fa-gamepad"></i>
                    <p>No other games available.</p>
                </div>
            @endforelse
        </div>
    </section>
    
    <!-- Keyword Clouds (Badge tags) -->
    <section class="badge-section">
        <h4 class="cloud-title"><i class="fas fa-tags"></i> Trending Searches</h4>
        <div class="keyword-cloud">
            @foreach(array_merge($newGames->pluck('name')->toArray(), $otherGames->pluck('name')->toArray()) as $appName)
                <span class="query-badge" onclick="fillSearch('{{ $appName }}')">{{ $appName }}</span>
                <span class="query-badge" onclick="fillSearch('{{ $appName }} APK')">{{ $appName }} APK</span>
                <span class="query-badge" onclick="fillSearch('{{ $appName }} download')">{{ $appName }} download</span>
            @endforeach
        </div>
    </section>
    
    <!-- Rich Informational Content Blocks for SEO -->
    <section class="seo-articles">
        <!-- Start Smart Tips -->
        <article class="info-card">
            <h3>Start Smart: Tips for New Players</h3>
            <p>Getting started with All New Yono Apps is simple, but a few pointers can help you feel right at home from the first click. Whether you’ve been playing for years or you’re trying something new, these tips can make your experience smoother and more enjoyable.</p>
            <ul>
                <li><strong>Begin with Simpler Games:</strong> If you’re new here, start with games that are easy to pick up. Titles like Yono Rummy and other card classics have clear instructions and familiar rules.</li>
                <li><strong>Check Reviews Before You Play:</strong> Every game page has specs and rating metrics. Reading these gives you a sense of what to expect, especially if you’re unsure which game to try first.</li>
                <li><strong>Don’t Play Continuously:</strong> Gaming is more fun when you pace yourself. Short breaks keep your mind fresh and help you enjoy each session without feeling tired.</li>
            </ul>
        </article>

        <!-- FAQ Section -->
        <article class="info-card">
            <h3>Frequently Asked Questions</h3>
            <div class="faq-list">
                <details>
                    <summary>What are Yono Gaming Apps?</summary>
                    <p>Yono Gaming Apps are popular Indian gaming applications offering real cash earnings through games like Rummy, Slots, Casino and more with instant withdrawals directly into Bank or UPI.</p>
                </details>
                <details>
                    <summary>How much bonus do I get?</summary>
                    <p>Each Yono app offers signup bonuses ranging from ₹50 to ₹5000 which varies by app. You can view each signup bonus amount on their cards above.</p>
                </details>
                <details>
                    <summary>Is withdrawal really fast?</summary>
                    <p>Yes, all our seeded apps support fast UPI and Bank withdrawals starting from ₹100 with instant processing, usually credited in minutes.</p>
                </details>
                <details>
                    <summary>Are these apps safe and legal?</summary>
                    <p>Yes, all Yono apps use secure encryption protocols, verified payment gateways, and comply with standard skill-based gaming regulations in eligible states.</p>
                </details>
            </div>
        </article>

        <!-- Dynamic Disclaimer -->
        @if(!empty($settings['disclaimer_text']))
            <article class="info-card border-danger">
                <h3 class="text-danger"><i class="fas fa-exclamation-triangle"></i> Disclaimer</h3>
                <p class="disclaimer-body">{!! nl2br(e($settings['disclaimer_text'])) !!}</p>
            </article>
        @endif

        <!-- Dynamic Ban States Alert -->
        @if(!empty($settings['states_ban_alert']))
            <article class="info-card border-warning">
                <h3 class="text-warning"><i class="fas fa-shield-alt"></i> Important Alert</h3>
                <p class="alert-body">{!! nl2br(e($settings['states_ban_alert'])) !!}</p>
            </article>
        @endif
    </section>
</div>

<!-- Home Styling -->
<style>
    .main-title {
        font-size: 24px;
        font-weight: 900;
        text-align: center;
        margin-bottom: 16px;
        letter-spacing: -0.5px;
    }
    
    /* Promo banner styling */
    .promo-section {
        background: linear-gradient(135deg, #1e293b, #334155);
        color: #f8fafc;
        padding: 16px;
        border-radius: 16px;
        margin-bottom: 20px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255,255,255,0.05);
    }
    
    .promo-text {
        font-size: 12px;
        line-height: 1.6;
        opacity: 0.9;
    }
    
    .download-section {
        margin-bottom: 24px;
    }
    
    .download-title {
        font-size: 20px;
        font-weight: 800;
        text-align: center;
        margin-bottom: 16px;
    }
    
    /* Search Bar Design */
    .search-wrapper {
        position: relative;
        margin-bottom: 20px;
        box-shadow: var(--card-shadow);
        border-radius: 12px;
        overflow: hidden;
    }
    
    .search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 16px;
    }
    
    #appSearch {
        width: 100%;
        padding: 14px 16px 14px 46px;
        border: 1px solid var(--border-color);
        background: white;
        font-size: 14px;
        font-family: inherit;
        border-radius: 12px;
        outline: none;
        transition: all 0.2s ease;
    }
    
    #appSearch:focus {
        border-color: var(--theme-color);
        box-shadow: 0 0 0 4px rgba(251, 55, 55, 0.15);
    }
    
    /* Tab buttons */
    .tabs {
        display: flex;
        gap: 8px;
        margin-bottom: 16px;
        background: #f1f5f9;
        padding: 4px;
        border-radius: 10px;
    }
    
    .tab {
        flex: 1;
        padding: 12px;
        border: none;
        background: transparent;
        color: var(--text-muted);
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s ease;
    }
    
    .tab.active {
        background: white;
        color: var(--theme-color);
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    /* Games list */
    .games-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    @media (min-width: 600px) {
        .games-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 16px;
        }
    }
    
    .game-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 18px;
        padding: 14px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        position: relative;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: var(--card-shadow);
    }
    
    .game-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -10px rgba(0, 0, 0, 0.15);
        border-color: var(--theme-color);
    }

    .card-body-row {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        padding-right: 24px; /* Space for the top-right float share button */
    }
    
    .game-number {
        position: absolute;
        top: -6px;
        left: -6px;
        background: var(--theme-color);
        color: white;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 800;
        box-shadow: 0 2px 4px rgba(251, 55, 55, 0.3);
    }
    
    .game-icon-container {
        width: 54px;
        height: 54px;
        border-radius: 12px;
        overflow: hidden;
        flex-shrink: 0;
    }
    
    .game-icon {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .game-icon-fallback {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 900;
        font-size: 11px;
        text-align: center;
        line-height: 1;
        border-radius: 12px;
    }
    
    .game-info {
        flex: 1;
        min-width: 0;
    }
    
    .game-name {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 4px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    
    .game-details {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }
    
    .bonus-info, .withdraw-info {
        font-size: 11px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .bonus-info {
        color: var(--theme-color);
    }
    
    .withdraw-info {
        color: var(--text-muted);
    }
    
    .download-btn {
        background: var(--text-main);
        color: white;
        border: none;
        padding: 11px 16px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
        width: 100%;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    }
    
    .download-btn:hover {
        background: var(--theme-color);
        box-shadow: 0 4px 12px rgba(251, 55, 55, 0.35);
        transform: translateY(-1px);
    }

    .share-card-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #f1f5f9;
        color: var(--text-muted);
        border: 1px solid var(--border-color);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        transition: all 0.2s ease;
        z-index: 5;
    }
    
    .share-card-btn:hover {
        background: var(--theme-color);
        color: white;
        border-color: var(--theme-color);
        transform: scale(1.05);
    }

    .tab-badge {
        background: var(--theme-color);
        color: white;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 10px;
        margin-left: 6px;
        box-shadow: 0 2px 4px rgba(251, 55, 55, 0.2);
        display: inline-block;
    }
    
    /* Keyword tags cloud */
    .badge-section {
        margin-bottom: 24px;
    }
    
    .cloud-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 10px;
    }
    
    .keyword-cloud {
        display: flex;
        gap: 8px;
        overflow-x: auto;
        padding: 10px 4px;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
    }
    
    .query-badge {
        display: inline-block;
        padding: 8px 14px;
        background: #f1f5f9;
        color: var(--text-main);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .query-badge:hover {
        background: var(--theme-color);
        color: white;
        border-color: var(--theme-color);
        transform: translateY(-1px);
    }
    
    /* SEO Info cards */
    .seo-articles {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    @media (min-width: 768px) {
        .seo-articles {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .info-card.border-danger {
            grid-column: span 2;
        }
        .info-card.border-warning {
            grid-column: span 2;
        }
    }
    
    .info-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 20px;
        box-shadow: var(--card-shadow);
    }
    
    .info-card h3 {
        font-size: 16px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 12px;
    }
    
    .info-card p {
        font-size: 13px;
        line-height: 1.6;
        color: #475569;
        margin-bottom: 12px;
    }
    
    .info-card ul {
        list-style: none;
        padding-left: 0;
    }
    
    .info-card li {
        font-size: 13px;
        line-height: 1.6;
        color: #475569;
        margin-bottom: 8px;
        position: relative;
        padding-left: 20px;
    }
    
    .info-card li::before {
        content: "✓";
        position: absolute;
        left: 0;
        color: var(--theme-color);
        font-weight: 800;
    }
    
    /* FAQ list */
    .faq-list details {
        border: 1px solid var(--border-color);
        border-radius: 10px;
        margin-bottom: 8px;
        padding: 12px;
        background: #f8fafc;
        transition: background 0.2s;
    }
    
    .faq-list summary {
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
        color: var(--text-main);
        outline: none;
    }
    
    .faq-list p {
        margin-top: 10px;
        margin-bottom: 0;
        font-size: 12.5px;
        color: #475569;
    }
    
    /* Specific alert borders */
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
    
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: var(--text-muted);
    }
    
    .empty-state i {
        font-size: 40px;
        opacity: 0.3;
        margin-bottom: 12px;
    }
    
    .empty-state p {
        font-size: 13px;
    }
    
    .hidden {
        display: none !important;
    }

    /* Promo Code Badge */
    .promo-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        border: 1px dashed #f59e0b;
        border-radius: 8px;
        padding: 5px 10px;
        margin-top: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
        width: fit-content;
        max-width: 100%;
    }
    .promo-badge:hover {
        background: linear-gradient(135deg, #fde68a, #fbbf24);
        transform: scale(1.02);
    }
    .promo-code-text {
        font-size: 11px;
        font-weight: 800;
        color: #92400e;
        letter-spacing: 1px;
    }
    .promo-copy-label {
        font-size: 9px;
        font-weight: 700;
        color: #b45309;
        background: rgba(245,158,11,0.2);
        padding: 2px 5px;
        border-radius: 4px;
    }
    .promo-badge i {
        color: #f59e0b;
        font-size: 10px;
    }
    .promo-badge.copied {
        background: linear-gradient(135deg, #d1fae5, #6ee7b7);
        border-color: #10b981;
    }
    .promo-badge.copied .promo-copy-label {
        background: rgba(16,185,129,0.2);
        color: #065f46;
    }
    .promo-badge.copied .promo-code-text { color: #065f46; }
    .promo-badge.copied i { color: #10b981; }
</style>

<!-- Interactive Live Search and Toggling JS -->
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
                el.querySelector('.promo-copy-label').textContent = 'Copied!';
                setTimeout(() => {
                    el.classList.remove('copied');
                    el.querySelector('.promo-copy-label').textContent = 'Tap to Copy';
                }, 2000);
            } catch (err) {
                console.error('Fallback copy failed', err);
            }
            document.body.removeChild(textArea);
            return;
        }
        navigator.clipboard.writeText(code).then(() => {
            el.classList.add('copied');
            el.querySelector('.promo-copy-label').textContent = 'Copied!';
            setTimeout(() => {
                el.classList.remove('copied');
                el.querySelector('.promo-copy-label').textContent = 'Tap to Copy';
            }, 2000);
        }).catch(err => {
            console.error('Failed to copy', err);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const tabNew = document.getElementById('tab-new');
        const tabOther = document.getElementById('tab-other');
        const panelNew = document.getElementById('new-games');
        const panelOther = document.getElementById('other-games');
        
        const tabNewCount = document.getElementById('tab-new-count');
        const tabOtherCount = document.getElementById('tab-other-count');
        
        const searchInput = document.getElementById('appSearch');
        const headerSearchInput = document.getElementById('headerSearchInput');
        const emptyState = document.getElementById('emptyState');

        let activeTab = 'new'; // 'new' or 'other'

        // 1. Tabbing logic
        function switchTab(tab, runFilter = true) {
            activeTab = tab;
            if (tab === 'new') {
                tabNew.classList.add('active');
                tabNew.setAttribute('aria-selected', 'true');
                tabOther.classList.remove('active');
                tabOther.setAttribute('aria-selected', 'false');
                
                panelNew.classList.remove('hidden');
                panelOther.classList.add('hidden');
            } else {
                tabOther.classList.add('active');
                tabOther.setAttribute('aria-selected', 'true');
                tabNew.classList.remove('active');
                tabNew.setAttribute('aria-selected', 'false');
                
                panelOther.classList.remove('hidden');
                panelNew.classList.add('hidden');
            }
            
            if (runFilter) {
                // Re-run search filter on the newly active panel
                filterApps();
            }
        }

        tabNew.addEventListener('click', () => switchTab('new'));
        tabOther.addEventListener('click', () => switchTab('other'));

        // 2. Global Search Logic
        function filterApps() {
            const query = searchInput.value.toLowerCase().trim();
            
            const newCards = panelNew.querySelectorAll('.game-card');
            const otherCards = panelOther.querySelectorAll('.game-card');
            
            let newMatches = 0;
            let otherMatches = 0;
            
            newCards.forEach(card => {
                const name = card.getAttribute('data-name');
                if (name.includes(query)) {
                    card.style.display = 'flex';
                    newMatches++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            otherCards.forEach(card => {
                const name = card.getAttribute('data-name');
                if (name.includes(query)) {
                    card.style.display = 'flex';
                    otherMatches++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Update tab badges with match count
            if (query !== "") {
                tabNewCount.textContent = newMatches;
                tabNewCount.classList.remove('hidden');
                tabOtherCount.textContent = otherMatches;
                tabOtherCount.classList.remove('hidden');
            } else {
                tabNewCount.textContent = '';
                tabNewCount.classList.add('hidden');
                tabOtherCount.textContent = '';
                tabOtherCount.classList.add('hidden');
            }

            // Auto-switch tabs if current tab has no matches but other does
            if (query !== "") {
                if (activeTab === 'new' && newMatches === 0 && otherMatches > 0) {
                    switchTab('other', false);
                } else if (activeTab === 'other' && otherMatches === 0 && newMatches > 0) {
                    switchTab('new', false);
                }
            }
            
            // Show empty state if no matching apps found in active category
            const activeMatches = activeTab === 'new' ? newMatches : otherMatches;
            const activeCardsCount = activeTab === 'new' ? newCards.length : otherCards.length;
            
            if (activeMatches === 0 && activeCardsCount > 0) {
                emptyState.style.display = 'block';
            } else {
                emptyState.style.display = 'none';
            }
        }

        searchInput.addEventListener('input', filterApps);

        // Sync header search bar with home page search bar
        if (headerSearchInput) {
            headerSearchInput.addEventListener('input', (e) => {
                searchInput.value = e.target.value;
                filterApps();
            });
        }

        // Helper to trigger searches from query clouds
        window.fillSearch = function(query) {
            searchInput.value = query;
            if (headerSearchInput) {
                headerSearchInput.value = query;
            }
            searchInput.focus();
            filterApps();
        };

        // Parse search query parameter from URL (e.g. /?search=rummy)
        const urlParams = new URLSearchParams(window.location.search);
        const searchParam = urlParams.get('search') || urlParams.get('q');
        if (searchParam) {
            const cleanQuery = decodeURIComponent(searchParam).trim();
            searchInput.value = cleanQuery;
            if (headerSearchInput) {
                headerSearchInput.value = cleanQuery;
            }
            filterApps();
        }
    });
</script>
@endsection

@section('head_extra')
<style>
    /* ===== Leaderboard Carousel ===== */
    .leaderboard-section {
        margin-bottom: 20px;
        padding: 0 0 4px;
    }
    .leaderboard-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
    }
    .lb-trophy { color: #f59e0b; font-size: 18px; }
    .lb-title {
        font-size: 15px;
        font-weight: 800;
        color: var(--text-main);
        margin: 0;
        flex: 1;
    }
    .lb-subtitle {
        font-size: 11px;
        color: var(--text-muted);
        font-weight: 500;
    }
    .lb-carousel-wrapper {
        position: relative;
        overflow: hidden;
    }
    .lb-carousel {
        display: flex;
        gap: 12px;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        will-change: transform;
    }
    .lb-card {
        flex: 0 0 calc(33.333% - 8px);
        min-width: 130px;
        background: linear-gradient(135deg, #fff 0%, #f8fafc 100%);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 14px 10px;
        text-align: center;
        position: relative;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .lb-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--card-hover-shadow);
    }
    .lb-rank {
        font-size: 18px;
        margin-bottom: 8px;
        line-height: 1;
    }
    .lb-icon-wrap { position: relative; margin: 0 auto 8px; width: 52px; height: 52px; }
    .lb-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        object-fit: cover;
        border: 2px solid rgba(255,255,255,0.5);
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }
    .lb-icon-fb {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 14px;
        color: white;
        letter-spacing: 0.5px;
    }
    .lb-name {
        font-size: 11.5px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 4px;
        line-height: 1.3;
    }
    .lb-stars {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1px;
        margin-bottom: 4px;
    }
    .lb-rating {
        font-size: 10px;
        font-weight: 700;
        color: var(--text-muted);
        margin-left: 3px;
    }
    .lb-bonus {
        font-size: 10.5px;
        font-weight: 700;
        color: #16a34a;
        background: #dcfce7;
        border-radius: 6px;
        padding: 2px 6px;
        display: inline-block;
    }
    .lb-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.9);
        border: 1px solid var(--border-color);
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 12px;
        color: var(--text-main);
        box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        transition: all 0.2s;
        z-index: 5;
    }
    .lb-nav:hover { background: var(--theme-color); color: white; border-color: var(--theme-color); }
    .lb-prev { left: -4px; }
    .lb-next { right: -4px; }
    .lb-dots {
        display: flex;
        justify-content: center;
        gap: 6px;
        margin-top: 10px;
    }
    .lb-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--border-color);
        cursor: pointer;
        transition: all 0.3s;
    }
    .lb-dot.active { background: var(--theme-color); width: 18px; border-radius: 3px; }

    @media (max-width: 480px) {
        .lb-card { flex: 0 0 calc(50% - 6px); min-width: 110px; }
    }
</style>
@endsection

@section('page_scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('lbCarousel');
    if (!carousel) return;

    const cards    = carousel.querySelectorAll('.lb-card');
    const dots     = document.querySelectorAll('.lb-dot');
    const prevBtn  = document.getElementById('lbPrev');
    const nextBtn  = document.getElementById('lbNext');
    let current    = 0;
    let autoTimer;

    const visibleCount = () => window.innerWidth <= 480 ? 2 : 3;

    function goTo(idx) {
        const maxIdx = Math.max(0, cards.length - visibleCount());
        current = Math.max(0, Math.min(idx, maxIdx));
        const cardW = cards[0].offsetWidth + 12;
        carousel.style.transform = `translateX(-${current * cardW}px)`;
        dots.forEach((d, i) => d.classList.toggle('active', i === current));
    }

    function next() { goTo(current + 1 >= cards.length - visibleCount() + 1 ? 0 : current + 1); }
    function prev() { goTo(current <= 0 ? Math.max(0, cards.length - visibleCount()) : current - 1); }

    function startAuto() { autoTimer = setInterval(next, 3000); }
    function stopAuto()  { clearInterval(autoTimer); }

    nextBtn && nextBtn.addEventListener('click', function() { stopAuto(); next(); startAuto(); });
    prevBtn && prevBtn.addEventListener('click', function() { stopAuto(); prev(); startAuto(); });
    dots.forEach((d, i) => d.addEventListener('click', function() { stopAuto(); goTo(i); startAuto(); }));

    // Touch support
    let touchStartX = 0;
    carousel.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; stopAuto(); }, { passive: true });
    carousel.addEventListener('touchend', e => {
        const diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 40) { diff > 0 ? next() : prev(); }
        startAuto();
    }, { passive: true });

    startAuto();
    window.addEventListener('resize', () => goTo(current));
});
</script>
@endsection
