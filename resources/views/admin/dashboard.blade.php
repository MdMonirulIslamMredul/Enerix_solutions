@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@push('styles')
<style>
    /* Stat Cards */
    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 1.35rem 1.5rem;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        cursor: pointer;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(0,0,0,0.08);
        border-color: #cbd5e1;
    }
    .stat-card .stat-arrow {
        position: absolute;
        top: 10px;
        right: 12px;
        font-size: 0.72rem;
        color: #94a3b8;
        opacity: 0;
        transform: translate(-3px, 3px);
        transition: opacity 0.2s ease, transform 0.2s ease, color 0.2s ease;
    }
    .stat-card:hover .stat-arrow {
        opacity: 0.85;
        transform: translate(0, 0);
    }
    a.stat-card-link {
        text-decoration: none !important;
        display: block;
        color: inherit;
    }
    a.stat-card-link .stat-label {
        color: #64748b;
        transition: color 0.15s ease;
    }
    a.stat-card-link:hover .stat-label {
        color: #0072ce;
    }
    a.stat-card-link .stat-value {
        color: #0f172a;
    }
    .stat-icon {
        width: 52px; height: 52px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem; flex-shrink: 0;
        transition: transform 0.2s ease;
    }
    .stat-card:hover .stat-icon {
        transform: scale(1.05);
    }
    .stat-label { font-size: 0.78rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 3px; }
    .stat-value { font-size: 1.85rem; font-weight: 800; line-height: 1; color: #0f172a; }

    /* Table card */
    .adm-card {
        background: #fff; border-radius: 16px;
        border: 1px solid #e2e8f0; overflow: hidden;
    }
    .adm-card-header {
        padding: 1.1rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex; align-items: center; justify-content: space-between;
    }
    .adm-card-title { font-size: 0.95rem; font-weight: 700; color: #0f172a; margin: 0; }

    .adm-table { margin: 0; }
    .adm-table thead th {
        background: #f8fafc;
        font-size: 0.73rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.6px; color: #64748b;
        padding: 10px 16px; border-bottom: 1px solid #e2e8f0; border-top: none;
    }
    .adm-table tbody td {
        padding: 12px 16px; vertical-align: middle;
        font-size: 0.875rem; border-color: #f1f5f9; color: #374151;
    }
    .adm-table tbody tr:hover td { background: #f8fafc; }
    .adm-table tbody tr:last-child td { border-bottom: none; }

    .contact-avatar {
        width: 32px; height: 32px; border-radius: 50%;
        background: linear-gradient(135deg, #0072ce 0%, #38bdf8 100%);
        color: #fff; font-weight: 700; font-size: 0.8rem;
        display: inline-flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .badge-pill {
        padding: 3px 10px; border-radius: 50px; font-size: 0.72rem; font-weight: 700;
    }
</style>
@endpush

@section('content')

{{-- Stat Cards --}}
<div class="row g-3 mb-4">

    {{-- Products --}}
    <div class="col-6 col-md-4 col-xl-2">
        <a href="{{ route('admin.products.index') }}" class="stat-card-link">
            <div class="stat-card">
                <i class="bi bi-arrow-up-right stat-arrow"></i>
                <div class="stat-icon" style="background:#eff6ff; color:#0072ce;">
                    <i class="bi bi-box-seam-fill"></i>
                </div>
                <div>
                    <div class="stat-label">Products</div>
                    <div class="stat-value">{{ $stats['products'] }}</div>
                </div>
            </div>
        </a>
    </div>

    {{-- Services / Solutions --}}
    <div class="col-6 col-md-4 col-xl-2">
        <a href="{{ route('admin.services.index') }}" class="stat-card-link">
            <div class="stat-card">
                <i class="bi bi-arrow-up-right stat-arrow"></i>
                <div class="stat-icon" style="background:#f0fdf4; color:#16a34a;">
                    <i class="bi bi-lightbulb-fill"></i>
                </div>
                <div>
                    <div class="stat-label">Solutions</div>
                    <div class="stat-value">{{ $stats['services'] }}</div>
                </div>
            </div>
        </a>
    </div>

    {{-- Blogs --}}
    <div class="col-6 col-md-4 col-xl-2">
        <a href="{{ route('admin.blogs.index') }}" class="stat-card-link">
            <div class="stat-card">
                <i class="bi bi-arrow-up-right stat-arrow"></i>
                <div class="stat-icon" style="background:#fef9c3; color:#ca8a04;">
                    <i class="bi bi-file-earmark-text-fill"></i>
                </div>
                <div>
                    <div class="stat-label">Blogs</div>
                    <div class="stat-value">{{ $stats['blogs'] }}</div>
                </div>
            </div>
        </a>
    </div>

    {{-- Team --}}
    <div class="col-6 col-md-4 col-xl-2">
        <a href="{{ route('admin.team-members.index') }}" class="stat-card-link">
            <div class="stat-card">
                <i class="bi bi-arrow-up-right stat-arrow"></i>
                <div class="stat-icon" style="background:#fdf2f8; color:#9333ea;">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <div class="stat-label">Team</div>
                    <div class="stat-value">{{ $stats['team_members'] }}</div>
                </div>
            </div>
        </a>
    </div>

    {{-- Gallery --}}
    <div class="col-6 col-md-4 col-xl-2">
        <a href="{{ route('admin.galleries.index') }}" class="stat-card-link">
            <div class="stat-card">
                <i class="bi bi-arrow-up-right stat-arrow"></i>
                <div class="stat-icon" style="background:#fff7ed; color:#ea580c;">
                    <i class="bi bi-images"></i>
                </div>
                <div>
                    <div class="stat-label">Gallery</div>
                    <div class="stat-value">{{ $stats['galleries'] }}</div>
                </div>
            </div>
        </a>
    </div>

    {{-- Contacts --}}
    <div class="col-6 col-md-4 col-xl-2">
        <a href="{{ route('admin.contacts.index') }}" class="stat-card-link">
            <div class="stat-card">
                <i class="bi bi-arrow-up-right stat-arrow"></i>
                <div class="stat-icon" style="background:#fef2f2; color:#dc2626;">
                    <i class="bi bi-envelope-fill"></i>
                </div>
                <div>
                    <div class="stat-label">Contacts</div>
                    <div class="stat-value">{{ $stats['contacts'] }}</div>
                </div>
            </div>
        </a>
    </div>

</div>

{{-- Recent Contacts Table --}}
<div class="adm-card">
    <div class="adm-card-header">
        <div class="d-flex align-items-center gap-2">
            <h5 class="adm-card-title"><i class="bi bi-envelope me-2 text-primary"></i>Recent Inquiries &amp; Quotes</h5>
            <span class="badge bg-primary bg-opacity-10 text-primary badge-pill">Latest {{ $recentContacts->count() }}</span>
        </div>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold">
            View All Messages <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
    <div class="table-responsive">
        <table class="table adm-table">
            <thead>
                <tr>
                    <th>Sender</th>
                    <th>Source</th>
                    <th>Subject / Discipline</th>
                    <th>Status</th>
                    <th>Read Status</th>
                    <th>Received</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentContacts as $contact)
                    <tr class="{{ $contact->isUnread() ? 'fw-semibold bg-light-subtle' : '' }}">
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="contact-avatar position-relative">
                                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                                    @if($contact->isUnread())
                                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                                    @endif
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $contact->name }}</div>
                                    <a href="mailto:{{ $contact->email }}" class="text-secondary small text-decoration-none">{{ $contact->email }}</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($contact->source === 'quote')
                                <span class="badge bg-warning bg-opacity-10 text-warning-emphasis border border-warning-subtle rounded-pill px-2 py-1 small">
                                    <i class="bi bi-calculator me-1"></i>Quote
                                </span>
                            @else
                                <span class="badge bg-info bg-opacity-10 text-info-emphasis border border-info-subtle rounded-pill px-2 py-1 small">
                                    <i class="bi bi-chat-left-text me-1"></i>Contact
                                </span>
                            @endif
                        </td>
                        <td>
                            <span class="text-dark">{{ $contact->subject ?? 'General Inquiry' }}</span>
                        </td>
                        <td>
                            @if($contact->status === 'connected')
                                <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle rounded-pill px-2 py-1">
                                    <i class="bi bi-check-circle-fill me-1"></i>Connected
                                </span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary-subtle rounded-pill px-2 py-1">
                                    <i class="bi bi-clock me-1"></i>Not Connected
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($contact->isUnread())
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle rounded-pill px-2 py-1">
                                    <i class="bi bi-envelope-fill me-1"></i>Unread
                                </span>
                            @else
                                <span class="badge bg-light text-muted border rounded-pill px-2 py-1">
                                    <i class="bi bi-envelope-open me-1"></i>Read
                                </span>
                            @endif
                        </td>
                        <td class="text-muted small">
                            {{ $contact->created_at->diffForHumans() }}
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-light border rounded-pill px-3 fw-semibold">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-2 d-block mb-2 opacity-25"></i>
                            No contact submissions yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

