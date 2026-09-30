@extends('admin.layouts.app')
@section('title', 'View Message - ' . $contact->name)
@section('page_title', 'Inquiry Details')

@push('styles')
<style>
    .detail-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    .detail-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, #07132b 0%, #0072ce 100%);
        color: #fff;
        font-weight: 800;
        font-size: 1.35rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .message-box {
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        padding: 1.5rem;
        font-size: 0.95rem;
        line-height: 1.7;
        color: #1e293b;
        white-space: pre-wrap;
        word-break: break-word;
    }

    .status-radio-card {
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 16px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .status-radio-card:hover {
        border-color: #cbd5e1;
        background: #f8fafc;
    }

    .form-check-input:checked ~ .status-radio-label {
        font-weight: 700;
    }

    .status-radio-card.active-connected {
        border-color: #16a34a;
        background: #f0fdf4;
    }

    .status-radio-card.active-not-connected {
        border-color: #64748b;
        background: #f8fafc;
    }
</style>
@endpush

@section('content')

{{-- Top navigation bar --}}
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary rounded-pill btn-sm px-3 fw-semibold">
            <i class="bi bi-arrow-left me-1"></i> Back to All Messages
        </a>
        <span class="text-muted">|</span>
        <span class="text-secondary small">Message #{{ $contact->id }}</span>
    </div>

    <div class="d-flex align-items-center gap-2">
        {{-- Toggle Read/Unread Form --}}
        <form action="{{ route('admin.contacts.toggle-read', $contact) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-light border rounded-pill px-3 fw-semibold">
                <i class="bi {{ $contact->isRead() ? 'bi-envelope' : 'bi-envelope-open' }} me-1"></i>
                Mark as {{ $contact->isRead() ? 'Unread' : 'Read' }}
            </button>
        </form>

        {{-- Delete Form --}}
        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this inquiry?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold">
                <i class="bi bi-trash me-1"></i> Delete
            </button>
        </form>
    </div>
</div>

<div class="row g-4">
    
    {{-- Left: Message & Inquiry Info --}}
    <div class="col-lg-8">
        <div class="detail-card shadow-sm p-4 mb-4">
            
            {{-- Sender Info Block --}}
            <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between pb-4 mb-4 border-bottom gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="detail-avatar">
                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-1">{{ $contact->name }}</h4>
                        <div class="d-flex flex-wrap align-items-center gap-2 small">
                            <a href="mailto:{{ $contact->email }}" class="text-primary text-decoration-none fw-semibold">
                                <i class="bi bi-envelope me-1"></i>{{ $contact->email }}
                            </a>
                            @if($contact->phone)
                                <span class="text-muted">•</span>
                                <a href="tel:{{ $contact->phone }}" class="text-secondary text-decoration-none">
                                    <i class="bi bi-telephone me-1"></i>{{ $contact->phone }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Badges --}}
                <div class="d-flex flex-wrap align-items-center gap-2">
                    @if($contact->source === 'quote')
                        <span class="badge bg-warning bg-opacity-10 text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-2 fw-bold">
                            <i class="bi bi-calculator me-1"></i>Quote Request
                        </span>
                    @else
                        <span class="badge bg-info bg-opacity-10 text-info-emphasis border border-info-subtle rounded-pill px-3 py-2 fw-bold">
                            <i class="bi bi-chat-left-text me-1"></i>Contact Inquiry
                        </span>
                    @endif

                    @if($contact->status === 'connected')
                        <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle rounded-pill px-3 py-2 fw-bold">
                            <i class="bi bi-check-circle-fill me-1"></i>Connected
                        </span>
                    @else
                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary-subtle rounded-pill px-3 py-2 fw-bold">
                            <i class="bi bi-clock me-1"></i>Not Connected
                        </span>
                    @endif
                </div>
            </div>

            {{-- Subject / Discipline --}}
            <div class="mb-4">
                <div class="text-secondary small fw-bold text-uppercase mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">Subject / Required Solution</div>
                <h5 class="fw-bold text-dark mb-0">{{ $contact->subject ?? 'General Inquiry' }}</h5>
            </div>

            {{-- Message Content --}}
            <div class="mb-4">
                <div class="text-secondary small fw-bold text-uppercase mb-2" style="font-size: 0.72rem; letter-spacing: 0.5px;">Message / Project Scope</div>
                <div class="message-box">
{{ $contact->message }}
                </div>
            </div>

            {{-- Meta timestamps --}}
            <div class="row g-3 pt-3 border-top text-secondary small">
                <div class="col-sm-6">
                    <span class="fw-semibold text-dark"><i class="bi bi-calendar-event me-1"></i>Submitted:</span>
                    {{ $contact->created_at->format('F d, Y - h:i A') }} ({{ $contact->created_at->diffForHumans() }})
                </div>
                <div class="col-sm-6">
                    <span class="fw-semibold text-dark"><i class="bi bi-eye me-1"></i>Opened &amp; Read:</span>
                    @if($contact->read_at)
                        {{ $contact->read_at->format('F d, Y - h:i A') }}
                    @else
                        <span class="text-danger fw-bold">Unread</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Direct Contact Action Panel --}}
        <div class="detail-card shadow-sm p-4">
            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-lightning-charge text-primary me-2"></i>Quick Actions</h6>
            <div class="d-flex flex-wrap gap-2">
                <a href="mailto:{{ $contact->email }}?subject=Re: {{ urlencode($contact->subject ?? 'Enerix Solutions Inquiry') }}" 
                   class="btn btn-primary rounded-pill px-4 fw-bold">
                    <i class="bi bi-reply-fill me-1"></i> Reply via Email
                </a>

                @if($contact->phone)
                    @php
                        $cleanPhone = preg_replace('/\D+/', '', $contact->phone);
                    @endphp
                    <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" class="btn btn-success rounded-pill px-4 fw-bold">
                        <i class="bi bi-whatsapp me-1"></i> Open in WhatsApp
                    </a>
                    <a href="tel:{{ $contact->phone }}" class="btn btn-light border rounded-pill px-4 fw-bold text-dark">
                        <i class="bi bi-telephone-outbound me-1"></i> Call Phone
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Right: Status & Notes Management Form --}}
    <div class="col-lg-4">
        <div class="detail-card shadow-sm p-4 sticky-top" style="top: 85px;">
            <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-sliders text-primary"></i> Follow-up Status
            </h5>
            <p class="text-secondary small mb-4">Update whether your team has successfully connected with this client.</p>

            <form action="{{ route('admin.contacts.update-status', $contact) }}" method="POST">
                @csrf
                @method('PATCH')

                {{-- Status Choice --}}
                <div class="mb-4">
                    <label class="form-label fw-bold small text-secondary text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">
                        Connection Status <span class="text-danger">*</span>
                    </label>

                    <div class="d-flex flex-column gap-2">
                        {{-- Connected --}}
                        <label class="status-radio-card d-flex align-items-center gap-3 {{ $contact->status === 'connected' ? 'active-connected' : '' }}">
                            <input class="form-check-input mt-0" type="radio" name="status" value="connected" {{ $contact->status === 'connected' ? 'checked' : '' }} required>
                            <div>
                                <span class="d-block fw-bold text-success status-radio-label">
                                    <i class="bi bi-check-circle-fill me-1"></i> Connected
                                </span>
                                <span class="text-secondary small d-block" style="font-size: 0.75rem;">Client has been contacted &amp; communicated with</span>
                            </div>
                        </label>

                        {{-- Not Connected --}}
                        <label class="status-radio-card d-flex align-items-center gap-3 {{ $contact->status === 'not_connected' ? 'active-not-connected' : '' }}">
                            <input class="form-check-input mt-0" type="radio" name="status" value="not_connected" {{ $contact->status === 'not_connected' ? 'checked' : '' }} required>
                            <div>
                                <span class="d-block fw-bold text-secondary status-radio-label">
                                    <i class="bi bi-clock me-1"></i> Not Connected
                                </span>
                                <span class="text-secondary small d-block" style="font-size: 0.75rem;">Follow up pending or yet to reach client</span>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Admin Internal Notes --}}
                <div class="mb-4">
                    <label class="form-label fw-bold small text-secondary text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">
                        Internal Admin Notes (Optional)
                    </label>
                    <textarea name="admin_notes" class="form-control rounded-3" rows="4" placeholder="Add follow-up notes, phone call summaries, client requirements...">{{ old('admin_notes', $contact->admin_notes) }}</textarea>
                    <div class="form-text small text-muted">Notes are visible only to administrators.</div>
                </div>

                <button type="submit" class="btn btn-primary rounded-pill w-100 py-2 fw-bold shadow-sm">
                    <i class="bi bi-save me-1"></i> Save Status &amp; Notes
                </button>
            </form>
        </div>
    </div>

</div>

@endsection
