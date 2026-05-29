@extends('layouts.frontend')

@section('title', 'Contact Us – ' . $settings['site_title'])

@section('content')
<div class="content-page">
    <h2 class="page-title">Contact Us</h2>
    
    <div class="page-card">
        <h3>Get in Touch</h3>
        <p>
            Have a question, feedback, or business inquiry? We are always happy to connect with our players and partners! Feel free to fill out the form below or contact us directly via our customer channels.
        </p>
        
        <div class="contact-methods">
            <a href="{{ $settings['telegram_url'] }}" target="_blank" class="contact-pill telegram-pill">
                <i class="fab fa-telegram-plane"></i>
                <div>
                    <strong>Telegram Channel</strong>
                    <span>{{ $settings['site_title'] }}</span>
                </div>
            </a>
            <div class="contact-pill email-pill">
                <i class="fas fa-envelope"></i>
                <div>
                    <strong>Support Email</strong>
                    <span>support@allnewyonoapps.com</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form Card -->
    <div class="page-card">
        <h3>Send us a Message</h3>
        
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST" class="contact-form" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" name="name" id="name" required placeholder="Enter your full name" value="{{ old('name') }}">
            </div>
            
            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" name="email" id="email" required placeholder="Enter your email address" value="{{ old('email') }}">
            </div>
            
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" name="subject" id="subject" required placeholder="Select or enter subject" value="{{ old('subject') }}">
            </div>

            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea name="message" id="message" rows="5" required placeholder="Write your comments or inquiries...">{{ old('message') }}</textarea>
            </div>

            <div class="form-group">
                <label for="attachment">Attachment (Screenshot / Image / PDF - max 5MB)</label>
                <input type="file" name="attachment" id="attachment" accept="image/*,application/pdf" style="padding: 6px 10px;">
            </div>

            <button type="submit" class="submit-btn">Send Message</button>
        </form>
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
        margin-bottom: 16px;
    }
    
    /* Contact Pills Layout */
    .contact-methods {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .contact-pill {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 12px 16px;
        border-radius: 12px;
        text-decoration: none;
        color: var(--text-main);
        border: 1px solid var(--border-color);
        background: #f8fafc;
        transition: all 0.2s ease;
    }
    
    .contact-pill i {
        font-size: 20px;
    }
    
    .telegram-pill i {
        color: #0088cc;
    }
    
    .email-pill i {
        color: var(--theme-color);
    }
    
    .contact-pill div {
        display: flex;
        flex-direction: column;
    }
    
    .contact-pill strong {
        font-size: 13px;
        font-weight: 700;
    }
    
    .contact-pill span {
        font-size: 11.5px;
        color: var(--text-muted);
    }
    
    .contact-pill:hover {
        transform: translateY(-1px);
        border-color: #cbd5e1;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    }
    
    /* Contact form styling */
    .contact-form {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    
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
    
    .form-group input, 
    .form-group textarea {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        font-size: 13px;
        font-family: inherit;
        outline: none;
        transition: border-color 0.2s;
    }
    
    .form-group input:focus, 
    .form-group textarea:focus {
        border-color: var(--theme-color);
    }
    
    .submit-btn {
        background: var(--text-main);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
        transition: background 0.2s;
    }
    
    .submit-btn:hover {
        background: var(--theme-color);
    }
    
    .alert-success {
        background: #ecfdf5;
        border: 1px solid #10b981;
        color: #065f46;
        padding: 10px;
        border-radius: 8px;
        font-size: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
    }
</style>
@endsection
