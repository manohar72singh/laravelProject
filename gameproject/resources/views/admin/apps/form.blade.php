@extends('layouts.admin')

@section('title', $title . ' – Yono Apps Portal')
@section('page_title', $app->id ? 'Edit Application' : 'Create Application')

@section('admin_content')
<div class="glass-card">
    <div class="form-header-strip">
        <h3 class="form-title"><i class="fas fa-edit text-accent"></i> {{ $title }}</h3>
        <a href="{{ route('admin.apps.index') }}" class="btn-back">
            <i class="fas fa-chevron-left"></i> Cancel and Return
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger" style="flex-direction: column; align-items: flex-start; gap: 4px;">
            <strong><i class="fas fa-exclamation-circle"></i> Please correct the validation errors:</strong>
            <ul style="list-style: none; padding-left: 10px; font-size: 12.5px;">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $app->id ? route('admin.apps.update', $app->id) : route('admin.apps.store') }}" method="POST" class="admin-form">
        @csrf
        
        <div class="form-grid">
            <!-- 1. Essential Information -->
            <div class="grid-section span-2">
                <h4 class="section-title">1. Primary Information</h4>
                
                <div class="form-row">
                    <div class="form-group flex-1">
                        <label for="name">App Name <span class="required">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" required placeholder="e.g. Club INR" value="{{ old('name', $app->name) }}">
                    </div>
                    
                    <div class="form-group flex-1">
                        <label for="slug">URL Slug (leave blank to auto-slug)</label>
                        <input type="text" name="slug" id="slug" class="form-control" placeholder="e.g. club-inr" value="{{ old('slug', $app->slug) }}">
                    </div>
                </div>

                <div class="form-row" style="margin-top: 14px;">
                    <div class="form-group flex-2">
                        <label for="download_url">Download Link (Affiliate / APK direct) <span class="required">*</span></label>
                        <input type="url" name="download_url" id="download_url" class="form-control" required placeholder="https://example.com/apk-download" value="{{ old('download_url', $app->download_url) }}">
                    </div>
                    
                    <div class="form-group flex-1" style="display: flex; align-items: flex-end; padding-bottom: 8px;">
                        <label class="checkbox-container">
                            <input type="checkbox" name="is_new" value="1" {{ old('is_new', $app->is_new) ? 'checked' : '' }} style="accent-color: #3b82f6;">
                            <span class="checkbox-lbl">New Release Category</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- 2. Specifications Banner -->
            <div class="grid-section span-1">
                <h4 class="section-title">2. Card Specifications</h4>
                
                <div class="form-group">
                    <label for="bonus_amount">Sign Up Bonus <span class="required">*</span></label>
                    <input type="text" name="bonus_amount" id="bonus_amount" class="form-control" required placeholder="e.g. ₹505" value="{{ old('bonus_amount', $app->bonus_amount ?: '₹50') }}">
                </div>
                
                <div class="form-group" style="margin-top: 10px;">
                    <label for="min_withdrawal">Min. Withdrawal <span class="required">*</span></label>
                    <input type="text" name="min_withdrawal" id="min_withdrawal" class="form-control" required placeholder="e.g. ₹100" value="{{ old('min_withdrawal', $app->min_withdrawal ?: '₹100') }}">
                </div>

                <div class="form-row" style="margin-top: 10px;">
                    <div class="form-group flex-1">
                        <label for="rating">Rating <span class="required">*</span></label>
                        <input type="number" name="rating" id="rating" step="0.1" min="0" max="5" class="form-control" required placeholder="4.5" value="{{ old('rating', $app->rating ?: 4.5) }}">
                    </div>
                    <div class="form-group flex-1">
                        <label for="votes">Votes <span class="required">*</span></label>
                        <input type="text" name="votes" id="votes" class="form-control" required placeholder="e.g. 550K" value="{{ old('votes', $app->votes ?: '10K') }}">
                    </div>
                    <div class="form-group flex-1">
                        <label for="size">App Size <span class="required">*</span></label>
                        <input type="text" name="size" id="size" class="form-control" required placeholder="e.g. 45MB" value="{{ old('size', $app->size ?: '45MB') }}">
                    </div>
                </div>
            </div>

            <!-- 3. Visual Logo Assets -->
            <div class="grid-section span-3" style="margin-top: 20px;">
                <h4 class="section-title">3. Branding Visual Assets</h4>
                <div class="branding-flex" style="display: flex; gap: 20px; align-items: center; flex-wrap: wrap;">
                    <div class="preview-box-container" style="width: 80px; height: 80px; border-radius: 16px; overflow: hidden; border: 2px solid var(--glass-border); flex-shrink: 0; background: rgba(0,0,0,0.2); display: flex; align-items: center; justify-content: center; position: relative;">
                        <img id="logoPreview" src="{{ old('icon_url', $app->icon_url) }}" alt="Logo Preview" referrerpolicy="no-referrer" style="width: 100%; height: 100%; object-fit: cover; display: {{ !empty(old('icon_url', $app->icon_url)) ? 'block' : 'none' }};" onerror="this.style.display='none'; document.getElementById('logoFallback').style.display='flex';">
                        <div id="logoFallback" style="background: {{ $app->id ? $app->fallback_bg : '#3b82f6' }}; width: 100%; height: 100%; font-size: 24px; font-weight: 800; color: white; display: {{ empty(old('icon_url', $app->icon_url)) ? 'flex' : 'none' }}; align-items: center; justify-content: center; text-transform: uppercase;">
                            {{ $app->id ? $app->initials : 'APP' }}
                        </div>
                    </div>
                    <div class="form-group flex-1">
                        <label for="icon_url">App Logo/Icon Image URL (Leave blank to use elegant Dynamic Initial fallback!)</label>
                        <input type="url" name="icon_url" id="icon_url" class="form-control" placeholder="https://example.com/logo.webp" value="{{ old('icon_url', $app->icon_url) }}" oninput="updateLogoPreview(this.value)">
                    </div>
                </div>
            </div>

            <!-- 4. Text Descriptions & Content Guides -->
            <div class="grid-section span-3" style="margin-top: 20px;">
                <h4 class="section-title">4. Explanations & Content Guides</h4>
                
                <div class="form-group">
                    <label for="intro_text">Short Introduction / Hinglish Review Summary</label>
                    <textarea name="intro_text" id="intro_text" rows="3" class="form-control text-area" placeholder="Hinglish intro text detailing registration rewards, withdraw minimums, etc.">{{ old('intro_text', $app->intro_text) }}</textarea>
                </div>

                <div class="form-group" style="margin-top: 14px;">
                    <label for="about_text">Detailed About Paragraph (SEO Guide)</label>
                    <textarea name="about_text" id="about_text" rows="4" class="form-control text-area" placeholder="A comprehensive paragraph about the app's history, reliability, and security...">{{ old('about_text', $app->about_text) }}</textarea>
                </div>

                <div class="form-row" style="margin-top: 14px;">
                    <div class="form-group flex-1">
                        <label for="features_raw">Key Features & Benefits (One feature per line)</label>
                        <textarea name="features_raw" id="features_raw" rows="6" class="form-control text-area" placeholder="Welcome Bonus: Claim up to ₹500 instantly&#10;Low withdrawal: Minimum is ₹100&#10;Multi-language Support">{{ old('features_raw', $featuresText) }}</textarea>
                    </div>
                    
                    <div class="form-group flex-1">
                        <label for="steps_raw">How to Download Steps (One step per line)</label>
                        <textarea name="steps_raw" id="steps_raw" rows="6" class="form-control text-area" placeholder="Click Download to get the APK file&#10;Go to Settings > Enable Unknown Sources&#10;Open APK and tap Install&#10;Verify phone number and get bonus">{{ old('steps_raw', $stepsText) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- 5. SEO Optimization Parameters -->
            <div class="grid-section span-3" style="margin-top: 20px;">
                <h4 class="section-title">5. Search Engine Optimization (SEO) Fields</h4>
                
                <div class="form-row">
                    <div class="form-group flex-1">
                        <label for="seo_title">SEO Override Title Tag</label>
                        <input type="text" name="seo_title" id="seo_title" class="form-control" placeholder="Club INR App Yono – Free Welcome Bonus ₹505" value="{{ old('seo_title', $app->seo_title) }}">
                    </div>
                    
                    <div class="form-group flex-1">
                        <label for="seo_keywords">SEO Keywords (Comma Separated)</label>
                        <input type="text" name="seo_keywords" id="seo_keywords" class="form-control" placeholder="Club INR, Club INR download, Club INR APK" value="{{ old('seo_keywords', $app->seo_keywords) }}">
                    </div>
                </div>

                <div class="form-group" style="margin-top: 14px;">
                    <label for="seo_description">SEO Meta Description Override</label>
                    <textarea name="seo_description" id="seo_description" rows="3" class="form-control text-area" placeholder="Enter a highly compelling, keyword-rich SEO description summarize page details...">{{ old('seo_description', $app->seo_description) }}</textarea>
                </div>
            </div>

            <!-- 6. Promo Code / Offers -->
            <div class="grid-section span-3" style="margin-top: 20px;">
                <h4 class="section-title"><i class="fas fa-ticket-alt" style="margin-right:6px;"></i>6. Exclusive Promo Code (Optional)</h4>
                <div class="form-group">
                    <label for="promo_code">Promo / Referral Code <span style="color: var(--text-muted); font-weight: 500;">(Leave blank if no promo code available)</span></label>
                    <input type="text" name="promo_code" id="promo_code" class="form-control" 
                           placeholder="e.g. YONO500, RUMMY100, CLUBINR" 
                           value="{{ old('promo_code', $app->promo_code) }}"
                           style="text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">
                    <span style="font-size: 11px; color: var(--text-muted); margin-top: 4px;"><i class="fas fa-info-circle"></i> Users will see a "Copy Code" button on the homepage & game detail page.</span>
                </div>
            </div>
        </div>

        <!-- Submit & Control Bar -->
        <div class="form-action-bar">
            <button type="submit" class="submit-btn"><i class="fas fa-save"></i> Save Game Details</button>
            <a href="{{ route('admin.apps.index') }}" class="btn-cancel">Discard Changes</a>
        </div>
    </form>
</div>

<style>
    /* Headers */
    .form-header-strip {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        border-bottom: 1px solid rgba(255,255,255,0.05);
        padding-bottom: 16px;
    }
    
    .form-title {
        font-size: 16px;
        font-weight: 800;
        color: var(--text-main);
    }
    
    .btn-back {
        background: rgba(255,255,255,0.05);
        color: var(--text-muted);
        border: 1px solid var(--glass-border);
        border-radius: 8px;
        padding: 8px 14px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .btn-back:hover {
        color: var(--text-main);
        background: rgba(255,255,255,0.1);
    }
    
    /* Layout fields grid */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    
    .grid-section {
        background: rgba(255,255,255,0.01);
        border: 1px solid var(--glass-border);
        border-radius: 12px;
        padding: 20px;
    }
    
    .span-1 { grid-column: span 1; }
    .span-2 { grid-column: span 2; }
    .span-3 { grid-column: span 3; }
    
    .section-title {
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        color: var(--accent-color);
        letter-spacing: 0.5px;
        margin-bottom: 16px;
        border-bottom: 1px solid rgba(59, 130, 246, 0.1);
        padding-bottom: 6px;
    }
    
    .form-row {
        display: flex;
        gap: 16px;
    }
    
    .flex-1 { flex: 1; }
    .flex-2 { flex: 2; }
    
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    
    .form-group label {
        font-size: 12px;
        font-weight: 700;
        color: var(--text-main);
    }
    
    .required {
        color: var(--danger-color);
    }
    
    .form-control {
        background: rgba(255,255,255,0.03);
        border: 1px solid var(--glass-border);
        border-radius: 10px;
        padding: 10px 14px;
        color: white;
        font-size: 13px;
        font-family: inherit;
        outline: none;
        width: 100%;
        transition: all 0.2s;
    }
    
    .form-control:focus {
        border-color: var(--accent-color);
        background: rgba(255,255,255,0.06);
        box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
    }
    
    .text-area {
        resize: vertical;
        line-height: 1.5;
    }
    
    /* Custom checkbox custom layout */
    .checkbox-container {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        user-select: none;
    }
    
    .checkbox-lbl {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--text-main);
    }
    
    /* Form Actions toolbar at the bottom */
    .form-action-bar {
        display: flex;
        gap: 12px;
        margin-top: 30px;
        border-top: 1px solid rgba(255,255,255,0.05);
        padding-top: 20px;
    }
    
    .submit-btn {
        background: var(--accent-gradient);
        color: white;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px;
        padding: 12px 24px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(59,130,246,0.2);
    }
    
    .submit-btn:hover {
        opacity: 0.95;
    }
    
    .btn-cancel {
        background: transparent;
        color: var(--text-muted);
        border: 1px solid var(--glass-border);
        border-radius: 10px;
        padding: 12px 20px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    
    .btn-cancel:hover {
        background: rgba(255,255,255,0.05);
        color: var(--text-main);
    }
    
    @media (max-width: 900px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        .span-1, .span-2, .span-3 {
            grid-column: span 1;
        }
        .form-row {
            flex-direction: column;
        }
    }
</style>

<script>
    function updateLogoPreview(url) {
        const previewImg = document.getElementById('logoPreview');
        const fallbackDiv = document.getElementById('logoFallback');
        
        if (url.trim() !== '') {
            previewImg.src = url;
            previewImg.style.display = 'block';
            fallbackDiv.style.display = 'none';
        } else {
            previewImg.src = '';
            previewImg.style.display = 'none';
            fallbackDiv.style.display = 'flex';
        }
    }
</script>
@endsection
