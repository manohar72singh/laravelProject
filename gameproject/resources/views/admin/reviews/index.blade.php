@extends('layouts.admin')

@section('title', 'Reviews Moderation')

@section('admin_content')
<style>
    .reviews-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 16px;
    }
    .page-title {
        font-size: 24px;
        font-weight: 800;
        color: #f8fafc;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .page-title i { color: #fbbf24; }

    .section-label {
        font-size: 16px;
        font-weight: 700;
        color: #f8fafc;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .section-label .badge {
        background: rgba(251,191,36,0.2);
        color: #fbbf24;
        border: 1px solid rgba(251,191,36,0.3);
        padding: 3px 10px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }
    .section-label .badge-green {
        background: rgba(52,211,153,0.2);
        color: #34d399;
        border: 1px solid rgba(52,211,153,0.3);
    }

    .alert-success {
        background: rgba(52,211,153,0.15);
        border: 1px solid rgba(52,211,153,0.3);
        color: #34d399;
        border-radius: 12px;
        padding: 14px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
    }

    .review-card {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 14px;
        padding: 18px 20px;
        margin-bottom: 14px;
        transition: all 0.2s;
    }
    .review-card:hover {
        background: rgba(255,255,255,0.08);
        border-color: rgba(255,255,255,0.15);
    }
    .review-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 10px;
    }
    .reviewer-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 15px;
        color: white;
        flex-shrink: 0;
    }
    .reviewer-name {
        font-weight: 600;
        color: #f8fafc;
        font-size: 14px;
    }
    .reviewer-app {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 2px;
    }
    .stars {
        color: #fbbf24;
        font-size: 13px;
        letter-spacing: 1px;
    }
    .review-comment {
        font-size: 14px;
        color: #cbd5e1;
        line-height: 1.6;
        padding: 12px 14px;
        background: rgba(255,255,255,0.04);
        border-radius: 10px;
        margin-bottom: 14px;
        font-style: italic;
    }
    .review-date {
        font-size: 12px;
        color: #64748b;
    }
    .review-actions {
        display: flex;
        gap: 8px;
    }
    .btn-approve {
        background: rgba(52,211,153,0.15);
        color: #34d399;
        border: 1px solid rgba(52,211,153,0.3);
        padding: 6px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .btn-approve:hover {
        background: rgba(52,211,153,0.25);
        color: #34d399;
    }
    .btn-delete-review {
        background: rgba(239,68,68,0.15);
        color: #f87171;
        border: 1px solid rgba(239,68,68,0.3);
        padding: 6px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .btn-delete-review:hover {
        background: rgba(239,68,68,0.25);
        color: #f87171;
    }
    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #64748b;
    }
    .empty-state i {
        font-size: 42px;
        margin-bottom: 14px;
        display: block;
        opacity: 0.4;
    }
    .section-divider {
        margin: 36px 0 28px;
        border: none;
        border-top: 1px solid rgba(255,255,255,0.08);
    }
    .pagination-wrap { margin-top: 16px; }
    .pagination-wrap nav span, .pagination-wrap nav a {
        background: rgba(255,255,255,0.06) !important;
        color: #94a3b8 !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
        padding: 6px 12px !important;
        border-radius: 8px !important;
        margin: 0 2px !important;
        font-size: 13px !important;
        text-decoration: none !important;
        display: inline-block !important;
        transition: all 0.2s !important;
    }
    .pagination-wrap nav a:hover {
        background: rgba(255,255,255,0.12) !important;
        color: white !important;
    }
    .pagination-wrap nav span[aria-current] {
        background: rgba(99,102,241,0.3) !important;
        color: #a5b4fc !important;
        border-color: rgba(99,102,241,0.4) !important;
    }
</style>

<div class="reviews-header">
    <div class="page-title">
        <i class="fas fa-star-half-alt"></i>
        Reviews Moderation
    </div>
</div>

@if(session('success'))
    <div class="alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

{{-- PENDING REVIEWS --}}
<div class="section-label">
    <i class="fas fa-clock"></i>
    Pending Approval
    <span class="badge">{{ $pending->total() }}</span>
</div>

@if($pending->count() > 0)
    @foreach($pending as $review)
        <div class="review-card">
            <div class="review-meta">
                <div class="reviewer-info">
                    <div class="avatar">{{ strtoupper(substr($review->name, 0, 1)) }}</div>
                    <div>
                        <div class="reviewer-name">{{ $review->name }}</div>
                        <div class="reviewer-app">
                            <i class="fas fa-gamepad" style="font-size:11px;"></i>
                            {{ $review->app->name ?? 'Unknown App' }}
                        </div>
                    </div>
                </div>
                <div>
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating) ★ @else ☆ @endif
                        @endfor
                    </div>
                    <div class="review-date">{{ $review->created_at->diffForHumans() }}</div>
                </div>
            </div>
            <div class="review-comment">"{{ $review->comment }}"</div>
            <div class="review-actions">
                <a href="{{ route('admin.reviews.approve', $review->id) }}" class="btn-approve">
                    <i class="fas fa-check"></i> Approve
                </a>
                <a href="{{ route('admin.reviews.delete', $review->id) }}" class="btn-delete-review"
                   onclick="return confirm('Delete this review permanently?')">
                    <i class="fas fa-trash"></i> Delete
                </a>
            </div>
        </div>
    @endforeach
    <div class="pagination-wrap">{{ $pending->links() }}</div>
@else
    <div class="empty-state">
        <i class="fas fa-inbox"></i>
        <p>No pending reviews. All caught up! ✅</p>
    </div>
@endif

<hr class="section-divider">

{{-- APPROVED REVIEWS --}}
<div class="section-label">
    <i class="fas fa-check-double"></i>
    Approved Reviews
    <span class="badge badge-green">{{ $approved->total() }}</span>
</div>

@if($approved->count() > 0)
    @foreach($approved as $review)
        <div class="review-card">
            <div class="review-meta">
                <div class="reviewer-info">
                    <div class="avatar" style="background: linear-gradient(135deg, #059669, #34d399);">
                        {{ strtoupper(substr($review->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="reviewer-name">{{ $review->name }}</div>
                        <div class="reviewer-app">
                            <i class="fas fa-gamepad" style="font-size:11px;"></i>
                            {{ $review->app->name ?? 'Unknown App' }}
                        </div>
                    </div>
                </div>
                <div>
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating) ★ @else ☆ @endif
                        @endfor
                    </div>
                    <div class="review-date">{{ $review->created_at->diffForHumans() }}</div>
                </div>
            </div>
            <div class="review-comment">"{{ $review->comment }}"</div>
            <div class="review-actions">
                <a href="{{ route('admin.reviews.delete', $review->id) }}" class="btn-delete-review"
                   onclick="return confirm('Delete this approved review?')">
                    <i class="fas fa-trash"></i> Delete
                </a>
            </div>
        </div>
    @endforeach
    <div class="pagination-wrap">{{ $approved->links() }}</div>
@else
    <div class="empty-state">
        <i class="fas fa-comment-slash"></i>
        <p>No approved reviews yet.</p>
    </div>
@endif
@endsection
