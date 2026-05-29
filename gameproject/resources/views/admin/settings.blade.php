@extends('layouts.admin')

@section('title', 'Portal General Settings – Yono Apps Portal')
@section('page_title', 'Portal Settings')

@section('admin_content')
<div class="glass-card">
    <div class="form-header-strip">
        <h3 class="form-title"><i class="fas fa-sliders-h text-accent"></i> Configure Web Portal</h3>
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

    <form action="{{ route('admin.settings') }}" method="POST" class="admin-form">
        @csrf
        
        <div class="form-grid">
            <!-- 1. General Brand Information -->
            <div class="grid-section span-2">
                <h4 class="section-title">1. Branding & Identity</h4>
                
                <div class="form-row">
                    <div class="form-group flex-1">
                        <label for="site_title">Portal Title <span class="required">*</span></label>
                        <input type="text" name="site_title" id="site_title" class="form-control" required placeholder="All New Yono Apps" value="{{ old('site_title', $settings['site_title']) }}">
                    </div>
                    
                    <div class="form-group flex-1">
                        <label for="site_tagline">Portal Tagline <span class="required">*</span></label>
                        <input type="text" name="site_tagline" id="site_tagline" class="form-control" required placeholder="All Yono Games, Rummy Apps & Slots in One" value="{{ old('site_tagline', $settings['site_tagline']) }}">
                    </div>
                </div>

                <div class="form-row" style="margin-top: 14px;">
                    <div class="form-group flex-1">
                        <label for="telegram_url">Telegram Join URL <span class="required">*</span></label>
                        <input type="url" name="telegram_url" id="telegram_url" class="form-control" required placeholder="https://t.me/your_channel" value="{{ old('telegram_url', $settings['telegram_url']) }}">
                    </div>
                    
                    <div class="form-group flex-1">
                        <label for="whatsapp_number">WhatsApp Support Number</label>
                        <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control" placeholder="e.g. +919876543210 (with country code)" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '') }}">
                    </div>
                    
                    <div class="form-group flex-1">
                        <label for="logo_url">Brand Logo URL</label>
                        <input type="url" name="logo_url" id="logo_url" class="form-control" placeholder="https://example.com/logo.jpg" value="{{ old('logo_url', $settings['logo_url']) }}">
                    </div>
                </div>
            </div>

            <!-- 2. Dynamic Colors Customizer -->
            <div class="grid-section span-1">
                <h4 class="section-title">2. Portal Color Customizer</h4>
                
                <div class="color-row">
                    <div class="form-group">
                        <label for="header_gradient_start">Header Gradient Start</label>
                        <div class="color-picker-wrapper">
                            <input type="color" name="header_gradient_start" id="header_gradient_start" class="picker-input" value="{{ old('header_gradient_start', $settings['header_gradient_start']) }}">
                            <input type="text" class="form-control text-picker" readonly value="{{ $settings['header_gradient_start'] }}">
                        </div>
                    </div>
                    
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="header_gradient_end">Header Gradient End</label>
                        <div class="color-picker-wrapper">
                            <input type="color" name="header_gradient_end" id="header_gradient_end" class="picker-input" value="{{ old('header_gradient_end', $settings['header_gradient_end']) }}">
                            <input type="text" class="form-control text-picker" readonly value="{{ $settings['header_gradient_end'] }}">
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="theme_color">Global Theme Accent Color</label>
                        <div class="color-picker-wrapper">
                            <input type="color" name="theme_color" id="theme_color" class="picker-input" value="{{ old('theme_color', $settings['theme_color']) }}">
                            <input type="text" class="form-control text-picker" readonly value="{{ $settings['theme_color'] }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Legal Disclaimers & Alert Banners -->
            <div class="grid-section span-3" style="margin-top: 20px;">
                <h4 class="section-title">3. Legal Warnings & Alert Statements</h4>
                
                <div class="form-group">
                    <label for="disclaimer_text">General Site Disclaimer (appears in red alert card)</label>
                    <textarea name="disclaimer_text" id="disclaimer_text" rows="4" class="form-control text-area" placeholder="Write independent platform warnings, addictive properties, financial risks...">{{ old('disclaimer_text', $settings['disclaimer_text']) }}</textarea>
                </div>

                <div class="form-group" style="margin-top: 14px;">
                    <label for="states_ban_alert">Banned States Notification Alert (appears in amber shield card)</label>
                    <textarea name="states_ban_alert" id="states_ban_alert" rows="3" class="form-control text-area" placeholder="Write states where real money gaming is legally banned by the government...">{{ old('states_ban_alert', $settings['states_ban_alert']) }}</textarea>
                </div>
            </div>

            <!-- 4. Portal SEO Meta parameters -->
            <div class="grid-section span-3" style="margin-top: 20px;">
                <h4 class="section-title">4. Search Engine Optimization (SEO) Configurations</h4>
                
                <div class="form-group">
                    <label for="site_keywords">Global Meta SEO Keywords (Comma Separated)</label>
                    <input type="text" name="site_keywords" id="site_keywords" class="form-control" placeholder="All Yono Apps, Yono Rummy, Slots" value="{{ old('site_keywords', $settings['site_keywords']) }}">
                </div>

                <div class="form-group" style="margin-top: 14px;">
                    <label for="site_description">Global Meta SEO Description</label>
                    <textarea name="site_description" id="site_description" rows="3" class="form-control text-area" placeholder="Enter keyword-rich, appealing portal summary for search listings...">{{ old('site_description', $settings['site_description']) }}</textarea>
                </div>
            </div>

            <!-- 5. Telegram Bot Auto-Notifications -->
            <div class="grid-section span-3" style="margin-top: 20px;">
                <h4 class="section-title">5. Telegram Bot Auto-Notifications</h4>
                <p style="font-size: 11.5px; color: var(--text-muted); margin-top: -10px; margin-bottom: 15px;">
                    When configured, a message is automatically sent to your Telegram channel/group whenever a new app is added. Leave blank to disable.
                </p>

                <div class="form-row">
                    <div class="form-group flex-2">
                        <label for="telegram_bot_token">Telegram Bot Token</label>
                        <input type="text" name="telegram_bot_token" id="telegram_bot_token" class="form-control"
                               placeholder="e.g. 1234567890:ABCDefgh..." 
                               value="{{ old('telegram_bot_token', $settings['telegram_bot_token'] ?? '') }}">
                    </div>
                    <div class="form-group flex-1">
                        <label for="telegram_chat_id">Channel / Group Chat ID</label>
                        <input type="text" name="telegram_chat_id" id="telegram_chat_id" class="form-control"
                               placeholder="e.g. -1001234567890"
                               value="{{ old('telegram_chat_id', $settings['telegram_chat_id'] ?? '') }}">
                    </div>
                </div>
                <p style="font-size: 11px; color: var(--text-muted); margin-top: 8px;">
                    <i class="fas fa-info-circle"></i>
                    Create a bot via <strong>@BotFather</strong> on Telegram → get your bot token → add it to your channel as Admin → get Chat ID from <strong>@userinfobot</strong>.
                </p>
            </div>

            <!-- 6. Admin Credentials Security Lock -->
            <div class="grid-section span-3" style="margin-top: 20px;">
                <h4 class="section-title">6. Admin Credentials Security lock</h4>
                <p style="font-size: 11.5px; color: var(--text-muted); margin-top: -10px; margin-bottom: 15px;">
                    Fill out the fields below ONLY if you explicitly want to change the administrator password. Leave blank to keep current password.
                </p>
                
                <div class="form-row">
                    <div class="form-group flex-1">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Minimum 6 characters">
                    </div>
                    
                    <div class="form-group flex-1">
                        <label for="new_password_confirmation">Confirm Password</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Confirm password matching">
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit actions -->
        <div class="form-action-bar">
            <button type="submit" class="submit-btn"><i class="fas fa-save"></i> Save Site Configurations</button>
        </div>
    </form>
</div>

<style>
    /* Headers */
    .form-header-strip {
        border-bottom: 1px solid rgba(255,255,255,0.05);
        padding-bottom: 16px;
        margin-bottom: 24px;
    }
    
    .form-title {
        font-size: 16px;
        font-weight: 800;
        color: var(--text-main);
    }
    
    /* Grid sections layouts */
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
    
    /* Dynamic Color picker grids */
    .color-picker-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .picker-input {
        width: 44px;
        height: 38px;
        border: 1px solid var(--glass-border);
        border-radius: 10px;
        background: transparent;
        cursor: pointer;
        padding: 0;
    }
    
    .text-picker {
        width: 120px;
        text-align: center;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    
    /* Submit bar footer */
    .form-action-bar {
        display: flex;
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

<!-- Custom JS to bind Pickers and Text boxes -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const pickers = document.querySelectorAll('.picker-input');
        
        pickers.forEach(picker => {
            const textBox = picker.nextElementSibling;
            
            // On picker input change, update textbox text
            picker.addEventListener('input', (e) => {
                textBox.value = e.target.value.toUpperCase();
            });
        });
    });
</script>
@endsection
