@extends('layouts.admin')

@section('title', 'Admin Dashboard – Yono Apps Portal')
@section('page_title', 'Dashboard Overview')

@section('admin_content')
<!-- Stats Widget Grid -->
<section class="stats-grid">
    <div class="stat-widget-card blue-grad">
        <div class="widget-icon">
            <i class="fas fa-gamepad"></i>
        </div>
        <div class="widget-info">
            <h3 class="widget-value">{{ $totalApps }}</h3>
            <span class="widget-label">Total Applications</span>
        </div>
    </div>
    
    <div class="stat-widget-card emerald-grad">
        <div class="widget-icon">
            <i class="fas fa-star"></i>
        </div>
        <div class="widget-info">
            <h3 class="widget-value">{{ $newApps }}</h3>
            <span class="widget-label">New Releases</span>
        </div>
    </div>
    
    <div class="stat-widget-card orange-grad">
        <div class="widget-icon">
            <i class="fas fa-layer-group"></i>
        </div>
        <div class="widget-info">
            <h3 class="widget-value">{{ $otherApps }}</h3>
            <span class="widget-label">Other Category Apps</span>
        </div>
    </div>
</section>

<!-- Action panel grid -->
<div class="dashboard-row">
    <!-- Quick Actions Panel -->
    <div class="glass-card flex-2">
        <h3 class="panel-header"><i class="fas fa-bolt text-accent"></i> Quick Operations</h3>
        <div class="quick-actions">
            <a href="{{ route('admin.apps.create') }}" class="action-btn-main">
                <i class="fas fa-plus-circle"></i>
                <div>
                    <strong>Add New Gaming App</strong>
                    <span>Input detailed specifications and SEO tags</span>
                </div>
            </a>
            
            <a href="{{ route('admin.settings') }}" class="action-btn-main">
                <i class="fas fa-sliders-h"></i>
                <div>
                    <strong>Portal Settings</strong>
                    <span>Manage Telegram join link, logos, and disclaimer text</span>
                </div>
            </a>
            
            <a href="{{ route('home') }}" target="_blank" class="action-btn-main">
                <i class="fas fa-eye"></i>
                <div>
                    <strong>View Public Portal</strong>
                    <span>Check styling, search functionality, and tabs</span>
                </div>
            </a>
        </div>
    </div>

    <!-- System Info Panel -->
    <div class="glass-card flex-1">
        <h3 class="panel-header"><i class="fas fa-server text-accent"></i> Platform Stats</h3>
        <div class="system-stats">
            <div class="sys-item">
                <span class="sys-lbl">Laravel Version</span>
                <span class="sys-val">v13.12.0</span>
            </div>
            <div class="sys-item">
                <span class="sys-lbl">Database Engine</span>
                <span class="sys-val">MySQL (workbench)</span>
            </div>
            <div class="sys-item">
                <span class="sys-lbl">Active Environment</span>
                <span class="sys-val">Local (debug=true)</span>
            </div>
            <div class="sys-item" style="border-bottom: none;">
                <span class="sys-lbl">Admin User</span>
                <span class="sys-val">{{ Auth::user()->email }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Recent Apps Table -->
<div class="glass-card">
    <div class="panel-title-strip">
        <h3 class="panel-header"><i class="fas fa-clock text-accent"></i> Recently Modified Apps</h3>
        <a href="{{ route('admin.apps.index') }}" class="panel-link">View All Apps</a>
    </div>
    
    <div class="table-container">
        <table class="recent-table">
            <thead>
                <tr>
                    <th>App Name</th>
                    <th>Slug</th>
                    <th>Bonus</th>
                    <th>Min. Withdraw</th>
                    <th>Rating</th>
                    <th>Last Updated</th>
                    <th style="text-align: center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentApps as $app)
                    <tr>
                        <td class="font-bold flex-cell">
                            @if(!empty($app->icon_url))
                                <img src="{{ $app->icon_url }}" alt="{{ $app->name }}" class="small-icon" referrerpolicy="no-referrer">
                            @else
                                <div class="small-fallback" style="background: {{ $app->fallback_bg }}">
                                    {{ $app->initials }}
                                </div>
                            @endif
                            <span>{{ $app->name }}</span>
                            @if($app->is_new)
                                <span class="badge-new">New</span>
                            @endif
                        </td>
                        <td><code>/{{ $app->slug }}</code></td>
                        <td class="text-bonus">{{ $app->bonus_amount }}</td>
                        <td>{{ $app->min_withdrawal }}</td>
                        <td><i class="fas fa-star text-gold"></i> {{ $app->rating }}</td>
                        <td class="text-muted">{{ $app->updated_at->diffForHumans() }}</td>
                        <td style="text-align: center">
                            <a href="{{ route('admin.apps.edit', $app->id) }}" class="table-action-btn edit-btn" title="Edit App">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No gaming applications stored yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    /* Stats grid and gradients */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    
    .stat-widget-card {
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        backdrop-filter: blur(12px);
        padding: 24px;
        border-radius: var(--card-radius);
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }
    
    .widget-icon {
        width: 54px;
        height: 54px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }
    
    .blue-grad .widget-icon { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
    .emerald-grad .widget-icon { background: linear-gradient(135deg, #10b981, #047857); }
    .orange-grad .widget-icon { background: linear-gradient(135deg, #f97316, #c2410c); }
    
    .widget-value {
        font-size: 28px;
        font-weight: 800;
        line-height: 1.1;
    }
    
    .widget-label {
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 600;
    }
    
    /* Layout rows */
    .dashboard-row {
        display: flex;
        gap: 20px;
    }
    
    .flex-1 { flex: 1; }
    .flex-2 { flex: 2; }
    
    .panel-header {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .text-accent { color: var(--accent-color); }
    
    /* Quick action buttons */
    .quick-actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    .action-btn-main {
        display: flex;
        align-items: center;
        gap: 16px;
        text-decoration: none;
        color: var(--text-main);
        background: rgba(255,255,255,0.02);
        border: 1px solid var(--glass-border);
        padding: 14px 20px;
        border-radius: 12px;
        transition: all 0.2s ease;
    }
    
    .action-btn-main i {
        font-size: 20px;
        color: var(--accent-color);
        background: rgba(59, 130, 246, 0.1);
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .action-btn-main div {
        display: flex;
        flex-direction: column;
    }
    
    .action-btn-main strong {
        font-size: 13.5px;
        font-weight: 700;
    }
    
    .action-btn-main span {
        font-size: 11.5px;
        color: var(--text-muted);
    }
    
    .action-btn-main:hover {
        background: rgba(255,255,255,0.05);
        border-color: rgba(255,255,255,0.12);
        transform: translateX(4px);
    }
    
    /* Platform stats list */
    .system-stats {
        display: flex;
        flex-direction: column;
    }
    
    .sys-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px dashed rgba(255,255,255,0.05);
        font-size: 13px;
    }
    
    .sys-lbl {
        color: var(--text-muted);
        font-weight: 500;
    }
    
    .sys-val {
        font-weight: 700;
    }
    
    /* Recent Apps Table Styles */
    .panel-title-strip {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .panel-title-strip .panel-header {
        margin-bottom: 0;
    }
    
    .panel-link {
        font-size: 12px;
        font-weight: 700;
        color: var(--accent-color);
        text-decoration: none;
        transition: opacity 0.2s;
    }
    
    .panel-link:hover {
        opacity: 0.8;
    }
    
    .table-container {
        width: 100%;
        overflow-x: auto;
    }
    
    .recent-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 13px;
    }
    
    .recent-table th {
        color: var(--text-muted);
        font-weight: 700;
        padding: 12px 16px;
        border-bottom: 1px solid rgba(255,255,255,0.08);
        font-size: 11.5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .recent-table td {
        padding: 14px 16px;
        border-bottom: 1px solid rgba(255,255,255,0.05);
        color: #e2e8f0;
    }
    
    .recent-table tr:hover td {
        background: rgba(255,255,255,0.01);
    }
    
    .font-bold {
        font-weight: 700;
    }
    
    .flex-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .small-icon {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        object-fit: cover;
    }
    
    .small-fallback {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 800;
        font-size: 8px;
        line-height: 1;
    }
    
    .badge-new {
        background: var(--success-color);
        color: white;
        font-size: 9px;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 20px;
        text-transform: uppercase;
    }
    
    .text-bonus {
        color: var(--danger-color);
        font-weight: 700;
    }
    
    .text-center { text-align: center; }
    
    .text-gold { color: #eab308; }
    
    /* Table action edit button */
    .table-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .edit-btn {
        background: rgba(59, 130, 246, 0.1);
        color: var(--accent-color);
        border: 1px solid rgba(59, 130, 246, 0.2);
    }
    
    .edit-btn:hover {
        background: var(--accent-color);
        color: white;
        box-shadow: 0 4px 10px rgba(59, 130, 246, 0.2);
    }
    
    @media (max-width: 1000px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        .dashboard-row {
            flex-direction: column;
        }
    }
</style>
@endsection
