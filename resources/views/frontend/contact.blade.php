@extends('frontend.layouts.app')

@section('title', ($isQuote ?? false) ? 'Get a Free Quote & Consultation - Enerix Solutions' : 'Contact Us - Enerix Solutions')

@section('content')
    <!-- Banner -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, #07132b 0%, #004b87 100%);">
        <div class="container-fluid px-lg-5 py-3" data-aos="fade-up">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ ($isQuote ?? false) ? 'Get a Quote' : 'Contact Us' }}</li>
                </ol>
            </nav>
            <h1 class="display-5 fw-bold mb-2">{{ ($isQuote ?? false) ? 'Get a Free Consultation & Quote' : 'Contact Our Engineering Team' }}</h1>
            <p class="lead text-white-50 mb-0" style="max-width: 760px;">
                Have questions or need an engineered solution for your business or residence? Talk to our specialists today.
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5 bg-light">
        <div class="container-fluid px-lg-5">
            <div class="row g-5">
                <!-- Form Column -->
                <div class="col-lg-7" data-aos="fade-right">
                    <div class="card p-4 p-md-5 border-0 shadow-sm rounded-4 bg-white">
                        <div class="mb-4">
                            <span class="badge bg-primary-subtle text-primary fw-bold text-uppercase px-3 py-2 rounded-pill mb-2">
                                {{ ($isQuote ?? false) ? 'Request Proposal' : 'Send Message' }}
                            </span>
                            <h2 class="fw-bold mb-2">{{ ($isQuote ?? false) ? 'Request an Engineering Consultation' : 'Get in Touch With Us' }}</h2>
                            <p class="text-secondary small mb-0">Fill out your details below and our team will get back to you within 24 hours.</p>
                        </div>

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control rounded-3 py-2" placeholder="e.g. John Doe" value="{{ old('name') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control rounded-3 py-2" placeholder="e.g. john@example.com" value="{{ old('email') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Phone / WhatsApp Number</label>
                                    <input type="text" name="phone" class="form-control rounded-3 py-2" placeholder="+880 1..." value="{{ old('phone') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Required Solution / Discipline</label>
                                    <select name="subject" class="form-select rounded-3 py-2">
                                        <option value="General Inquiry">General Inquiry</option>
                                        <option value="Solar Energy Solutions" {{ request('solution') == 'Solar Energy Solutions' ? 'selected' : '' }}>Solar Energy Solutions</option>
                                        <option value="Civil & Architectural Engineering" {{ request('solution') == 'Civil & Architectural Engineering' ? 'selected' : '' }}>Civil & Architectural Engineering</option>
                                        <option value="Electrical Engineering" {{ request('solution') == 'Electrical Engineering' ? 'selected' : '' }}>Electrical Engineering</option>
                                        <option value="IT & Technology Solutions" {{ request('solution') == 'IT & Technology Solutions' ? 'selected' : '' }}>IT & Technology Solutions</option>
                                        <option value="Security & Surveillance" {{ request('solution') == 'Security & Surveillance' ? 'selected' : '' }}>Security & Surveillance</option>
                                        <option value="Engineering Consultancy" {{ request('solution') == 'Engineering Consultancy' ? 'selected' : '' }}>Engineering Consultancy</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold small">Project Scope & Location <span class="text-danger">*</span></label>
                                    <textarea name="message" class="form-control rounded-3" rows="5" placeholder="Tell us about your project requirements, location, estimated capacity, or timeline..." required>{{ old('message') }}</textarea>
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow-sm">
                                        {{ ($isQuote ?? false) ? 'Submit Quote Request' : 'Send Message' }} <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Column -->
                <div class="col-lg-5" data-aos="fade-left">
                    <!-- Contact Cards -->
                    <div class="card p-4 border-0 shadow-sm rounded-4 bg-white mb-4">
                        <h4 class="fw-bold fs-5 mb-3 border-bottom pb-2">Direct Contact Information</h4>
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-start gap-3">
                                <div class="p-3 rounded-circle bg-primary-subtle text-primary">
                                    <i class="bi bi-geo-alt-fill fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark">Office Headquarters</h6>
                                    <p class="text-secondary small mb-0">{{ $setting->contact_address ?? 'Dhaka, Bangladesh' }}</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start gap-3">
                                <div class="p-3 rounded-circle bg-primary-subtle text-primary">
                                    <i class="bi bi-telephone-fill fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark">Telephone</h6>
                                    <p class="text-secondary small mb-0">
                                        <a href="tel:{{ $setting->contact_phone ?? '+880 1234 567890' }}" class="text-decoration-none text-dark fw-semibold">
                                            {{ $setting->contact_phone ?? '+880 1234 567890' }}
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start gap-3">
                                <div class="p-3 rounded-circle bg-success-subtle text-success">
                                    <i class="bi bi-whatsapp fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark">WhatsApp Technical Line</h6>
                                    <p class="text-secondary small mb-0">
                                        @php
                                            $waNum = preg_replace('/\D+/', '', $setting->whatsapp_number ?? ($setting->contact_phone ?? '8801234567890'));
                                        @endphp
                                        <a href="https://wa.me/{{ $waNum }}" target="_blank" class="text-decoration-none text-success fw-semibold">
                                            {{ $setting->whatsapp_number ?? '+880 1234 567890' }}
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start gap-3">
                                <div class="p-3 rounded-circle bg-primary-subtle text-primary">
                                    <i class="bi bi-envelope-fill fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark">Official Email</h6>
                                    <p class="text-secondary small mb-0">
                                        <a href="mailto:{{ $setting->contact_email ?? 'info@enerixbd.com' }}" class="text-decoration-none text-dark">
                                            {{ $setting->contact_email ?? 'info@enerixbd.com' }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map Card -->
                    @if ($setting?->google_map_embed)
                        <div class="card p-2 border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                            <iframe src="{{ $setting->google_map_embed }}" width="100%" height="260"
                                style="border:0; border-radius: 12px;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
