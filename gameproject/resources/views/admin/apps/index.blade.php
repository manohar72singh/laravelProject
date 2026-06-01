@extends('layouts.admin')

@section('title', 'Manage Game Apps – Yono Apps Portal')
@section('page_title', 'Manage Applications')

@section('admin_content')
<div class="glass-card">
    <!-- Top toolbar with search and filter inputs -->
    <div class="toolbar-strip">
        <form action="{{ route('admin.apps.index') }}" method="GET" class="filter-form">
            <div class="form-row">
                <div class="input-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" name="search" class="form-control" placeholder="Search app name or slug..." value="{{ $search }}">
                </div>
                
                <select name="category" class="form-control select-control" onchange="this.form.submit()">
                    <option value="" {{ empty($category) ? 'selected' : '' }}>All Categories</option>
                    <option value="new" {{ $category === 'new' ? 'selected' : '' }}>New Games Tab Only</option>
                    <option value="other" {{ $category === 'other' ? 'selected' : '' }}>Other Games Tab Only</option>
                </select>
                
                @if(!empty($search) || !empty($category))
                    <a href="{{ route('admin.apps.index') }}" class="btn-reset" title="Clear Filters">
                        <i class="fas fa-sync-alt"></i> Reset
                    </a>
                @endif
            </div>
        </form>

        <a href="{{ route('admin.apps.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Add New App
        </a>
    </div>

    <!-- Apps Table -->
    <div class="table-container">
        <table class="apps-table">
            <thead>
                <tr>
                    <th style="width: 80px">ID</th>
                    <th>App Name</th>
                    <th>Slug</th>
                    <th>Category</th>
                    <th>Bonus</th>
                    <th>Withdraw</th>
                    <th>Rating</th>
                    <th>Votes</th>
                    <th style="text-align: center; width: 220px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($apps as $app)
                    <tr>
                        <td><code>#{{ $app->id }}</code></td>
                        <td class="font-bold flex-cell">
                            @if(!empty($app->icon_url))
                                <img src="{{ $app->icon_url }}" alt="{{ $app->name }}" class="app-icon" referrerpolicy="no-referrer" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            @endif
                            <div class="app-fallback" style="background: {{ $app->fallback_bg }}; display: {{ empty($app->icon_url) ? 'flex' : 'none' }};">
                                {{ $app->initials }}
                            </div>
                            <span>{{ $app->name }}</span>
                        </td>
                        <td><code>/{{ $app->slug }}</code></td>
                        <td>
                            @if($app->is_new)
                                <span class="badge-status success-bg">New Release</span>
                            @else
                                <span class="badge-status warning-bg">Other Game</span>
                            @endif
                        </td>
                        <td class="text-bonus">{{ $app->bonus_amount }}</td>
                        <td>{{ $app->min_withdrawal }}</td>
                        <td><i class="fas fa-star text-gold"></i> {{ $app->rating }}</td>
                        <td class="text-muted">{{ $app->votes }}</td>
                        <td style="text-align: center">
                            <div class="action-btn-group">
                                <a href="{{ route('game.detail', $app->slug) }}" target="_blank" class="action-btn view-btn" title="View Public Page">
                                    <i class="fas fa-external-link-alt"></i> View
                                </a>
                                
                                <a href="{{ route('admin.apps.edit', $app->id) }}" class="action-btn edit-btn" title="Edit App">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                
                                <a href="{{ route('admin.apps.delete', $app->id) }}" class="action-btn delete-btn" title="Delete App" onclick="return confirm('Are you absolutely sure you want to delete {{ $app->name }}? This action is irreversible!');">
                                    <i class="fas fa-trash-alt"></i> Del
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-8">
                            <i class="fas fa-folder-open" style="font-size: 32px; display: block; margin: 12px auto; opacity: 0.3"></i>
                            No gaming applications match the filters or are stored in database.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination controls -->
    @if($apps->hasPages())
        <div class="pagination-wrapper">
            {{ $apps->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>

<style>
    /* Table responsive container wrapper */
    .table-container {
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.05);
        margin-top: 10px;
    }

    /* Toolbar filters */
    .toolbar-strip {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        gap: 16px;
        flex-wrap: wrap;
    }
    
    .filter-form {
        flex: 1;
        min-width: 300px;
    }
    
    .form-row {
        display: flex;
        gap: 12px;
        align-items: center;
    }
    
    .input-wrapper {
        position: relative;
        flex: 2;
    }
    
    .search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 14px;
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
        box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
    }
    
    .input-wrapper .form-control {
        padding-left: 38px;
    }
    
    .select-control {
        flex: 1;
        cursor: pointer;
        height: 38px;
    }
    
    .select-control option {
        background: var(--admin-bg);
        color: white;
    }
    
    .btn-reset {
        background: rgba(255,255,255,0.05);
        color: var(--text-main);
        border: 1px solid var(--glass-border);
        border-radius: 10px;
        padding: 10px 16px;
        font-size: 12.5px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }
    
    .btn-reset:hover {
        background: rgba(255,255,255,0.1);
    }
    
    .btn-add {
        background: var(--accent-gradient);
        color: white;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px;
        padding: 10px 18px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(59,130,246,0.2);
        transition: all 0.2s;
    }
    
    .btn-add:hover {
        opacity: 0.95;
        transform: translateY(-1px);
    }
    
    /* Table design details */
    .apps-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 13.5px;
        white-space: nowrap;
    }
    
    .apps-table th {
        color: var(--text-muted);
        font-weight: 700;
        padding: 14px 16px;
        border-bottom: 2px solid rgba(255,255,255,0.08);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .apps-table td {
        padding: 14px 16px;
        border-bottom: 1px solid rgba(255,255,255,0.05);
        color: #cbd5e1;
    }
    
    .apps-table tr:hover td {
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
    
    .app-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        object-fit: cover;
    }
    
    .app-fallback {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 800;
        font-size: 9px;
        line-height: 1;
    }
    
    /* Category Status badges */
    .badge-status {
        font-size: 10px;
        font-weight: 700;
        padding: 4px 8px;
        border-radius: 20px;
        text-transform: uppercase;
        display: inline-block;
    }
    
    .success-bg {
        background: rgba(16, 185, 129, 0.15);
        color: var(--success-color);
        border: 1px solid rgba(16, 185, 129, 0.25);
    }
    
    .warning-bg {
        background: rgba(249, 115, 22, 0.15);
        color: #f97316;
        border: 1px solid rgba(249, 115, 22, 0.25);
    }
    
    .text-bonus {
        color: var(--danger-color);
        font-weight: 700;
    }
    
    .text-gold { color: #eab308; }
    
    /* Actions buttons */
    .action-btn-group {
        display: flex;
        gap: 6px;
        justify-content: center;
    }
    
    .action-btn {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 11.5px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        border: 1px solid transparent;
        transition: all 0.2s;
    }
    
    .view-btn {
        background: rgba(255,255,255,0.05);
        color: var(--text-main);
        border-color: var(--glass-border);
    }
    
    .view-btn:hover {
        background: rgba(255,255,255,0.1);
    }
    
    .edit-btn {
        background: rgba(59, 130, 246, 0.1);
        color: var(--accent-color);
        border-color: rgba(59, 130, 246, 0.2);
    }
    
    .edit-btn:hover {
        background: var(--accent-color);
        color: white;
    }
    
    .delete-btn {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger-color);
        border-color: rgba(239, 68, 68, 0.2);
    }
    
    .delete-btn:hover {
        background: var(--danger-color);
        color: white;
    }
    
    .py-8 { padding-top: 32px !important; padding-bottom: 32px !important; }
    
    /* Pagination styles overrides */
    .pagination-wrapper {
        margin-top: 24px;
        display: flex;
        justify-content: center;
        border-top: 1px solid rgba(255,255,255,0.05);
        padding-top: 16px;
    }

    /* Premium Glassmorphic Numbered Pagination */
    .pagination-wrapper .pagination {
        display: flex;
        list-style: none;
        gap: 6px;
        align-items: center;
        padding: 0;
        margin: 0;
    }
    
    .pagination-wrapper .page-item {
        display: inline-block;
    }
    
    .pagination-wrapper .page-link,
    .pagination-wrapper .page-item span {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--glass-border);
        color: #cbd5e1;
        padding: 8px 14px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 12.5px;
        font-weight: 700;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        cursor: pointer;
    }
    
    .pagination-wrapper .page-item.active span {
        background: var(--accent-gradient);
        border-color: rgba(255, 255, 255, 0.1);
        color: white;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
    }
    
    .pagination-wrapper .page-item.disabled span,
    .pagination-wrapper .page-item.disabled a {
        opacity: 0.35;
        cursor: not-allowed;
        background: rgba(255, 255, 255, 0.01);
        color: var(--text-muted);
        border-color: rgba(255, 255, 255, 0.03);
    }
    
    .pagination-wrapper .page-link:hover:not(.disabled) {
        background: rgba(255, 255, 255, 0.08);
        border-color: var(--accent-color);
        color: white;
        transform: translateY(-1px);
    }
</style>
@endsection
