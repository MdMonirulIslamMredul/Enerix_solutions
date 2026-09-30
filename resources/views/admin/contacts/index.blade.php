@extends('admin.layouts.app')
@section('title', 'Contact Messages & Inquiries')
@section('page_title', 'Contact Inquiries')

@push('styles')
<style>
    .contact-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    .filter-tab-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid #e2e8f0;
        color: #64748b;
        background: #fff;
        transition: all 0.15s ease;
    }

    .filter-tab-btn:hover {
        background: #f8fafc;
        color: #0f172a;
        border-color: #cbd5e1;
    }

    .filter-tab-btn.active {
        background: #0072ce;
        color: #fff;
        border-color: #0072ce;
    }

    .filter-tab-btn.active .badge {
        background: #fff !important;
        color: #0072ce !important;
    }

    .contact-row-unread {
        background: rgba(0, 114, 206, 0.025);
        border-left: 3px solid #0072ce;
    }

    .contact-row-read {
        border-left: 3px solid transparent;
    }

    .contact-row-unread td {
        font-weight: 600;
        color: #0f172a;
    }

    .contact-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, #07132b 0%, #0072ce 100%);
        color: #fff;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-mini-card {
        background: #fff;
        border-radius: 14px;
        padding: 1rem 1.25rem;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .stat-mini-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
</style>
@endpush

@section('content')

{{-- Mini Stats Bar --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3 col-xl">
        <div class="stat-mini-card">
            <div class="stat-mini-icon" style="background: #eff6ff; color: #0072ce;">
                <i class="bi bi-inbox-fill"></i>
            </div>
            <div>
                <div class="text-secondary small fw-semibold text-uppercase" style="font-size: 0.7rem;">Total Messages</div>
                <div class="fs-5 fw-bold text-dark">{{ $counts['all'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 col-xl">
        <div class="stat-mini-card">
            <div class="stat-mini-icon" style="background: #fef2f2; color: #dc2626;">
                <i class="bi bi-envelope-fill"></i>
            </div>
            <div>
                <div class="text-secondary small fw-semibold text-uppercase" style="font-size: 0.7rem;">Unread</div>
                <div class="fs-5 fw-bold text-danger">{{ $counts['unread'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 col-xl">
        <div class="stat-mini-card">
            <div class="stat-mini-icon" style="background: #f0fdf4; color: #16a34a;">
                <i class="bi bi-person-check-fill"></i>
            </div>
            <div>
                <div class="text-secondary small fw-semibold text-uppercase" style="font-size: 0.7rem;">Connected</div>
                <div class="fs-5 fw-bold text-success">{{ $counts['connected'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 col-xl">
        <div class="stat-mini-card">
            <div class="stat-mini-icon" style="background: #fff7ed; color: #ea580c;">
                <i class="bi bi-person-x-fill"></i>
            </div>
            <div>
                <div class="text-secondary small fw-semibold text-uppercase" style="font-size: 0.7rem;">Not Connected</div>
                <div class="fs-5 fw-bold text-warning-emphasis">{{ $counts['not_connected'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 col-xl">
        <div class="stat-mini-card">
            <div class="stat-mini-icon" style="background: #fef9c3; color: #ca8a04;">
                <i class="bi bi-calculator-fill"></i>
            </div>
            <div>
                <div class="text-secondary small fw-semibold text-uppercase" style="font-size: 0.7rem;">Quote Requests</div>
                <div class="fs-5 fw-bold text-dark">{{ $counts['quote'] }}</div>
            </div>
        </div>
    </div>
</div>

{{-- Main Container Card --}}
<div class="contact-card shadow-sm mb-4">
    
    {{-- Header & Filters --}}
    <div class="p-3 p-md-4 border-bottom bg-white">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-3">
            <div>
                <h5 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">
                    <i class="bi bi-chat-left-dots text-primary"></i> Inquiries &amp; Quote Submissions
                </h5>
                <p class="text-secondary small mb-0">Manage incoming inquiries submitted via Contact Us and Quote forms.</p>
            </div>

            {{-- Search Bar --}}
            <form action="{{ route('admin.contacts.index') }}" method="GET" class="d-flex align-items-center gap-2" style="min-width: 280px;">
                @if(request('read_status')) <input type="hidden" name="read_status" value="{{ request('read_status') }}"> @endif
                @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
                @if(request('source')) <input type="hidden" name="source" value="{{ request('source') }}"> @endif
                
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control bg-light border-start-0" placeholder="Search sender, email, subject..." value="{{ request('search') }}">
                    @if(request('search'))
                        <a href="{{ route('admin.contacts.index', request()->except('search')) }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x"></i>
                        </a>
                    @endif
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>

        {{-- Filter Pills Bar --}}
        <div class="d-flex flex-wrap align-items-center gap-2 pt-2 border-top">
            <span class="text-secondary small fw-bold me-1" style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.5px;">Filter:</span>
            
            {{-- All --}}
            <a href="{{ route('admin.contacts.index', array_filter(['search' => request('search')])) }}" 
               class="filter-tab-btn {{ !request('read_status') && !request('status') && !request('source') ? 'active' : '' }}">
                All <span class="badge bg-secondary rounded-pill">{{ $counts['all'] }}</span>
            </a>

            {{-- Unread --}}
            <a href="{{ route('admin.contacts.index', array_filter(['read_status' => 'unread', 'status' => request('status'), 'source' => request('source'), 'search' => request('search')])) }}" 
               class="filter-tab-btn {{ request('read_status') === 'unread' ? 'active' : '' }}">
                <i class="bi bi-envelope-fill text-danger"></i> Unread 
                <span class="badge bg-danger rounded-pill">{{ $counts['unread'] }}</span>
            </a>

            {{-- Read --}}
            <a href="{{ route('admin.contacts.index', array_filter(['read_status' => 'read', 'status' => request('status'), 'source' => request('source'), 'search' => request('search')])) }}" 
               class="filter-tab-btn {{ request('read_status') === 'read' ? 'active' : '' }}">
                <i class="bi bi-envelope-open text-secondary"></i> Read
                <span class="badge bg-light text-dark border rounded-pill">{{ $counts['read'] }}</span>
            </a>

            <div class="vr my-1 mx-1 text-secondary opacity-25"></div>

            {{-- Connected --}}
            <a href="{{ route('admin.contacts.index', array_filter(['status' => 'connected', 'read_status' => request('read_status'), 'source' => request('source'), 'search' => request('search')])) }}" 
               class="filter-tab-btn {{ request('status') === 'connected' ? 'active' : '' }}">
                <i class="bi bi-check-circle-fill text-success"></i> Connected
                <span class="badge bg-success rounded-pill">{{ $counts['connected'] }}</span>
            </a>

            {{-- Not Connected --}}
            <a href="{{ route('admin.contacts.index', array_filter(['status' => 'not_connected', 'read_status' => request('read_status'), 'source' => request('source'), 'search' => request('search')])) }}" 
               class="filter-tab-btn {{ request('status') === 'not_connected' ? 'active' : '' }}">
                <i class="bi bi-clock text-warning"></i> Not Connected
                <span class="badge bg-secondary rounded-pill">{{ $counts['not_connected'] }}</span>
            </a>

            <div class="vr my-1 mx-1 text-secondary opacity-25"></div>

            {{-- Quote Source --}}
            <a href="{{ route('admin.contacts.index', array_filter(['source' => 'quote', 'read_status' => request('read_status'), 'status' => request('status'), 'search' => request('search')])) }}" 
               class="filter-tab-btn {{ request('source') === 'quote' ? 'active' : '' }}">
                <i class="bi bi-calculator"></i> Quote Form
                <span class="badge bg-warning text-dark rounded-pill">{{ $counts['quote'] }}</span>
            </a>

            {{-- Contact Source --}}
            <a href="{{ route('admin.contacts.index', array_filter(['source' => 'contact', 'read_status' => request('read_status'), 'status' => request('status'), 'search' => request('search')])) }}" 
               class="filter-tab-btn {{ request('source') === 'contact' ? 'active' : '' }}">
                <i class="bi bi-chat-text"></i> Contact Form
                <span class="badge bg-info text-dark rounded-pill">{{ $counts['contact'] }}</span>
            </a>

            @if(request('read_status') || request('status') || request('source') || request('search'))
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-link text-danger text-decoration-none ms-auto small p-0">
                    <i class="bi bi-x-circle me-1"></i>Reset Filters
                </a>
            @endif
        </div>
    </div>

    {{-- Messages Table --}}
    <div class="table-responsive">
        <table class="table adm-table align-middle mb-0">
            <thead>
                <tr>
                    <th style="width: 250px;">Sender</th>
                    <th style="width: 120px;">Source</th>
                    <th style="width: 180px;">Subject / Discipline</th>
                    <th>Message Snippet</th>
                    <th style="width: 140px;">Connection Status</th>
                    <th style="width: 110px;">Read Status</th>
                    <th style="width: 130px;">Received</th>
                    <th style="width: 120px;" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr class="{{ $contact->isUnread() ? 'contact-row-unread' : 'contact-row-read' }}">
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="contact-avatar position-relative">
                                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                                    @if($contact->isUnread())
                                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle" title="Unread"></span>
                                    @endif
                                </div>
                                <div class="overflow-hidden">
                                    <div class="fw-bold text-dark text-truncate" style="max-width: 180px;">
                                        <a href="{{ route('admin.contacts.show', $contact) }}" class="text-decoration-none text-dark">
                                            {{ $contact->name }}
                                        </a>
                                    </div>
                                    <div class="small text-muted text-truncate" style="max-width: 180px;">
                                        <a href="mailto:{{ $contact->email }}" class="text-secondary text-decoration-none">{{ $contact->email }}</a>
                                    </div>
                                    @if($contact->phone)
                                        <div class="small text-muted" style="font-size: 0.75rem;">
                                            <a href="tel:{{ $contact->phone }}" class="text-secondary text-decoration-none">
                                                <i class="bi bi-telephone text-primary me-1"></i>{{ $contact->phone }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>

                        {{-- Source --}}
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

                        {{-- Subject --}}
                        <td>
                            <span class="fw-semibold text-dark small d-block text-truncate" style="max-width: 170px;" title="{{ $contact->subject ?? 'General Inquiry' }}">
                                {{ $contact->subject ?? 'General Inquiry' }}
                            </span>
                        </td>

                        {{-- Message preview --}}
                        <td>
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="text-decoration-none text-secondary small d-block">
                                {{ \Illuminate\Support\Str::limit($contact->message, 85) }}
                            </a>
                        </td>

                        {{-- Connection Status --}}
                        <td>
                            @if($contact->status === 'connected')
                                <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle rounded-pill px-2 py-1 small d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-check-circle-fill"></i> Connected
                                </span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary-subtle rounded-pill px-2 py-1 small d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-clock"></i> Not Connected
                                </span>
                            @endif
                        </td>

                        {{-- Read Status --}}
                        <td>
                            @if($contact->isUnread())
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle rounded-pill px-2 py-1 small d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-envelope-fill"></i> Unread
                                </span>
                            @else
                                <span class="badge bg-light text-muted border rounded-pill px-2 py-1 small d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-envelope-open"></i> Read
                                </span>
                            @endif
                        </td>

                        {{-- Date --}}
                        <td class="small text-muted">
                            <span class="d-block text-dark fw-semibold">{{ $contact->created_at->format('M d, Y') }}</span>
                            <span style="font-size: 0.72rem;">{{ $contact->created_at->diffForHumans() }}</span>
                        </td>

                        {{-- Actions --}}
                        <td class="text-end">
                            <div class="d-flex align-items-center justify-content-end gap-1">
                                <a href="{{ route('admin.contacts.show', $contact) }}" 
                                   class="btn btn-sm btn-outline-primary rounded-pill px-2 py-1" 
                                   title="View Details">
                                    <i class="bi bi-eye"></i> View
                                </a>

                                <form action="{{ route('admin.contacts.toggle-read', $contact) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-light border rounded-circle p-1" style="width: 28px; height: 28px;" title="{{ $contact->isRead() ? 'Mark as Unread' : 'Mark as Read' }}">
                                        <i class="bi {{ $contact->isRead() ? 'bi-envelope' : 'bi-envelope-open' }} small text-secondary"></i>
                                    </button>
                                </form>

                                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border rounded-circle p-1 text-danger" style="width: 28px; height: 28px;" title="Delete">
                                        <i class="bi bi-trash small"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <div class="my-3">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary opacity-25"></i>
                                <h6 class="fw-bold text-dark">No inquiries found</h6>
                                <p class="small text-secondary mb-0">There are no contact or quote messages matching your current filter criteria.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination Footer --}}
    @if($contacts->hasPages())
        <div class="p-3 border-top bg-light d-flex justify-content-between align-items-center">
            <span class="small text-secondary">
                Showing {{ $contacts->firstItem() }} to {{ $contacts->lastItem() }} of {{ $contacts->total() }} results
            </span>
            <div>
                {{ $contacts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>

@endsection
