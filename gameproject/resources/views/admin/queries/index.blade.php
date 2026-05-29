@extends('layouts.admin')

@section('title', 'User Queries – Yono Apps Portal')
@section('page_title', 'User Support Inquiries')

@section('admin_content')
<div class="glass-card">
    <div class="toolbar-strip">
        <h3 class="panel-header"><i class="fas fa-envelope text-accent"></i> Received Contact Queries</h3>
    </div>

    <!-- Queries Table -->
    <div class="table-container">
        <table class="apps-table">
            <thead>
                <tr>
                    <th style="width: 80px">ID</th>
                    <th style="width: 150px">Sender Name</th>
                    <th style="width: 180px">Email Address</th>
                    <th style="width: 180px">Subject</th>
                    <th>Message</th>
                    <th style="width: 130px">Attachment</th>
                    <th style="width: 150px">Received Date</th>
                    <th style="text-align: center; width: 100px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($queries as $query)
                    <tr class="main-row" id="row-{{ $query->id }}">
                        <td><code>#{{ $query->id }}</code></td>
                        <td class="font-bold">{{ $query->name }}</td>
                        <td><a href="mailto:{{ $query->email }}" class="text-email">{{ $query->email }}</a></td>
                        <td class="text-subject">{{ $query->subject }}</td>
                        <td class="msg-cell">
                            <div class="msg-preview">{{ Str::limit($query->message, 45) }}</div>
                        </td>
                        <td>
                            @if(!empty($query->attachment_path))
                                <a href="{{ asset('storage/' . $query->attachment_path) }}" target="_blank" class="action-btn file-btn" title="View Uploaded File">
                                    <i class="fas fa-paperclip"></i> View File
                                </a>
                            @else
                                <span class="text-muted" style="font-size: 11.5px;">No File</span>
                            @endif
                        </td>
                        <td class="text-muted">{{ $query->created_at->format('M d, Y h:i A') }}</td>
                        <td style="text-align: center; white-space: nowrap;">
                            <button type="button" class="action-btn view-btn" onclick="toggleDetails({{ $query->id }})" title="View Full Details">
                                <i class="fas fa-eye"></i> View
                            </button>
                            <a href="{{ route('admin.queries.delete', $query->id) }}" class="action-btn delete-btn" title="Delete Inquiry" onclick="return confirm('Are you sure you want to delete this contact inquiry?');">
                                <i class="fas fa-trash-alt"></i> Del
                            </a>
                        </td>
                    </tr>
                    <!-- Collapsible Details Row -->
                    <tr id="details-{{ $query->id }}" class="details-row hidden">
                        <td colspan="8">
                            <div class="details-expanded-card">
                                <div class="details-card-header">
                                    <span class="details-header-title"><i class="fas fa-info-circle text-accent"></i> Inquiry Details #{{ $query->id }}</span>
                                    <button type="button" class="close-details-btn" onclick="toggleDetails({{ $query->id }})">&times;</button>
                                </div>
                                <div class="details-card-body">
                                    <div class="details-meta-grid">
                                        <div class="meta-item">
                                            <strong>Sender Name:</strong>
                                            <span>{{ $query->name }}</span>
                                        </div>
                                        <div class="meta-item">
                                            <strong>Email Address:</strong>
                                            <span><a href="mailto:{{ $query->email }}" class="text-email">{{ $query->email }}</a></span>
                                        </div>
                                        <div class="meta-item">
                                            <strong>Subject:</strong>
                                            <span>{{ $query->subject }}</span>
                                        </div>
                                        <div class="meta-item">
                                            <strong>Received Date:</strong>
                                            <span>{{ $query->created_at->format('l, F d, Y @ h:i:s A') }}</span>
                                        </div>
                                        @if(!empty($query->attachment_path))
                                        <div class="meta-item">
                                            <strong>Attachment:</strong>
                                            <span>
                                                <a href="{{ asset('storage/' . $query->attachment_path) }}" target="_blank" class="action-btn file-btn">
                                                    <i class="fas fa-paperclip"></i> Open Uploaded File
                                                </a>
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="details-message-section">
                                        <strong>Full Message:</strong>
                                        <div class="full-message-text">{!! nl2br(e($query->message)) !!}</div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-8">
                            <i class="fas fa-envelope-open" style="font-size: 32px; display: block; margin: 12px auto; opacity: 0.3"></i>
                            No contact inquiries or player queries have been received yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination controls -->
    @if($queries->hasPages())
        <div class="pagination-wrapper">
            {{ $queries->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>

<style>
    /* Table responsive container wrapper */
    .table-container {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.05);
        margin-top: 10px;
    }

    /* Table styles */
    .apps-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 13px;
        color: var(--text-main);
    }
    
    .apps-table th {
        background: rgba(255, 255, 255, 0.03);
        border-bottom: 1px solid var(--glass-border);
        color: var(--text-muted);
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        padding: 14px 16px;
    }
    
    .apps-table td {
        padding: 14px 16px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        vertical-align: middle;
        word-break: break-word;
    }
    
    .apps-table tr:last-child td {
        border-bottom: none;
    }
    
    .apps-table tr:hover td {
        background: rgba(255, 255, 255, 0.01);
    }

    .font-bold {
        font-weight: 700;
    }

    .text-email {
        color: var(--accent-color);
        text-decoration: none;
        font-weight: 600;
    }

    .text-email:hover {
        text-decoration: underline;
    }

    .text-subject {
        font-weight: 600;
        color: #e2e8f0;
    }

    .msg-cell {
        max-width: 300px;
    }

    .msg-content {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        color: var(--text-muted);
        line-height: 1.5;
        font-size: 12.5px;
    }

    .msg-cell:hover .msg-content {
        -webkit-line-clamp: unset;
        display: block;
        overflow: visible;
        color: var(--text-main);
    }

    /* Actions buttons */
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 11.5px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 1px solid transparent;
    }

    .delete-btn {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger-color);
        border-color: rgba(239, 68, 68, 0.2);
    }
    
    .delete-btn:hover {
        background: var(--danger-color);
        color: white;
        box-shadow: 0 4px 10px rgba(239, 68, 68, 0.2);
    }

    .file-btn {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success-color);
        border-color: rgba(16, 185, 129, 0.2);
    }
    
    .file-btn:hover {
        background: var(--success-color);
        color: white;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
    }

    .py-8 { padding-top: 32px !important; padding-bottom: 32px !important; }

    /* Pagination controls */
    .pagination-wrapper {
        margin-top: 24px;
        display: flex;
        justify-content: center;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        padding-top: 16px;
    }

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

    /* ====== View Button ====== */
    .view-btn {
        background: rgba(99, 102, 241, 0.12);
        color: #a5b4fc;
        border-color: rgba(99, 102, 241, 0.25);
        margin-right: 6px;
    }
    .view-btn:hover {
        background: #6366f1;
        color: white;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }
    .view-btn.active {
        background: #6366f1;
        color: white;
        border-color: #6366f1;
    }

    /* ====== Collapsible Details Row ====== */
    .details-row {
        background: rgba(15, 20, 40, 0.6);
    }
    .details-row.hidden {
        display: none;
    }
    .details-row td {
        padding: 0 !important;
        border-bottom: 2px solid rgba(99, 102, 241, 0.3) !important;
    }

    /* ====== Expanded Card ====== */
    .details-expanded-card {
        border-radius: 12px;
        margin: 12px 16px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(99, 102, 241, 0.2);
        overflow: hidden;
        animation: slideDown 0.25s ease;
    }
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .details-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 18px;
        background: rgba(99, 102, 241, 0.1);
        border-bottom: 1px solid rgba(99, 102, 241, 0.15);
    }
    .details-header-title {
        font-weight: 700;
        font-size: 13.5px;
        color: #c7d2fe;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .close-details-btn {
        background: rgba(239, 68, 68, 0.12);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.2);
        border-radius: 6px;
        width: 28px;
        height: 28px;
        cursor: pointer;
        font-size: 16px;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .close-details-btn:hover {
        background: #ef4444;
        color: white;
    }

    .details-card-body {
        padding: 18px;
    }

    /* Meta grid: 2 columns */
    .details-meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px 24px;
        margin-bottom: 18px;
    }
    @media (max-width: 680px) {
        .details-meta-grid { grid-template-columns: 1fr; }
    }
    .meta-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .meta-item strong {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-muted);
    }
    .meta-item span {
        font-size: 13.5px;
        color: #e2e8f0;
        font-weight: 500;
    }

    /* Full message block */
    .details-message-section {
        border-top: 1px solid rgba(255,255,255,0.06);
        padding-top: 14px;
    }
    .details-message-section strong {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-muted);
        display: block;
        margin-bottom: 8px;
    }
    .full-message-text {
        background: rgba(0,0,0,0.2);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 8px;
        padding: 14px 16px;
        font-size: 13.5px;
        color: #cbd5e1;
        line-height: 1.7;
        white-space: pre-wrap;
        word-break: break-word;
    }
</style>

<script>
function toggleDetails(id) {
    const detailRow = document.getElementById('details-' + id);
    const viewBtn   = document.querySelector('#row-' + id + ' .view-btn');

    if (!detailRow) return;

    const isHidden = detailRow.classList.contains('hidden');

    // Close any OTHER open detail rows first
    document.querySelectorAll('.details-row').forEach(function(row) {
        if (row.id !== 'details-' + id) {
            row.classList.add('hidden');
        }
    });
    document.querySelectorAll('.view-btn').forEach(function(btn) {
        btn.classList.remove('active');
        btn.innerHTML = '<i class="fas fa-eye"></i> View';
    });

    // Toggle target row
    if (isHidden) {
        detailRow.classList.remove('hidden');
        if (viewBtn) {
            viewBtn.classList.add('active');
            viewBtn.innerHTML = '<i class="fas fa-eye-slash"></i> Hide';
        }
        // Smooth scroll to the row
        setTimeout(function() {
            detailRow.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 50);
    } else {
        detailRow.classList.add('hidden');
        if (viewBtn) {
            viewBtn.classList.remove('active');
            viewBtn.innerHTML = '<i class="fas fa-eye"></i> View';
        }
    }
}
</script>
@endsection
