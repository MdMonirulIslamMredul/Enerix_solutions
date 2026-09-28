@extends('frontend.layouts.app')

@section('title', $service->title . ' - Enerix Solutions')

@section('content')
    @php
        $bulletItems = $service->features ?? [];
        if (is_string($bulletItems)) {
            $bulletItems = array_filter(array_map('trim', explode("\n", $bulletItems)));
        }
    @endphp

    <!-- Page Banner -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, #07132b 0%, #004b87 100%);">
        <div class="container-fluid px-lg-5 py-3" data-aos="fade-up">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('solutions.index') }}" class="text-white-50 text-decoration-none">Solutions</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ $service->title }}</li>
                </ol>
            </nav>
            <div class="d-flex align-items-center gap-3 mt-2">
                <div class="p-3 bg-white text-primary rounded-circle shadow d-inline-flex">
                    <i class="bi {{ $service->icon ?? 'bi-sun-fill' }} fs-3"></i>
                </div>
                <div>
                    <h1 class="display-6 fw-bold mb-1">{{ $service->title }}</h1>
                    <p class="lead text-white-50 mb-0" style="font-size: 1.05rem;">{{ $service->short_description }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content & Sidebar -->
    <section class="py-5 bg-white">
        <div class="container-fluid px-lg-5">
            <div class="row g-5">
                <!-- Left Details -->
                <div class="col-lg-8" data-aos="fade-right">
                    @if ($service->image)
                        <div class="rounded-4 overflow-hidden shadow-sm mb-4" style="max-height: 420px;">
                            <img src="{{ asset('storage/' . $service->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $service->title }}">
                        </div>
                    @endif

                    <h2 class="fw-bold mb-3">Overview & Technical Scope</h2>
                    <div class="text-secondary lh-lg mb-4" style="font-size: 1.05rem;">
                        {!! $service->description !!}
                    </div>

                    @if(!empty($bulletItems) && count($bulletItems) > 0)
                        <div class="card border-0 bg-light p-4 rounded-4 mb-4">
                            <h4 class="fw-bold fs-5 mb-3 text-dark"><i class="bi bi-check2-all text-primary me-2"></i>Key Engineering Capabilities</h4>
                            <div class="row g-3">
                                @foreach($bulletItems as $feat)
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center gap-2 p-2 bg-white rounded-3 border">
                                            <i class="bi bi-patch-check-fill text-primary"></i>
                                            <span class="fw-semibold text-dark">{{ $feat }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="p-4 rounded-4 text-white" style="background: linear-gradient(135deg, #07132b 0%, #0072ce 100%);">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="fw-bold text-white mb-1">Require a customized proposal for this solution?</h4>
                                <p class="text-white-50 small mb-md-0">Our engineers evaluate your site drawings, load profile, and specifications with fast turnaround.</p>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <a href="{{ route('quote') }}?solution={{ urlencode($service->title) }}" class="btn btn-light rounded-pill px-4 fw-bold text-primary">
                                    Request Quote
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="col-lg-4" data-aos="fade-left">
                    <!-- Quick Consultation Card -->
                    <div class="card p-4 rounded-4 border shadow-sm mb-4">
                        <h4 class="fw-bold fs-5 mb-2">Request Technical Assessment</h4>
                        <p class="small text-muted mb-3">Fill out our quick form and our lead engineer will get in touch.</p>
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="subject" value="Inquiry regarding {{ $service->title }}">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Your Name</label>
                                <input type="text" name="name" class="form-control form-control-sm rounded-3" placeholder="Full Name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control form-control-sm rounded-3" placeholder="name@company.com" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Phone / WhatsApp</label>
                                <input type="text" name="phone" class="form-control form-control-sm rounded-3" placeholder="+880 ...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Project Scope</label>
                                <textarea name="message" class="form-control form-control-sm rounded-3" rows="3" placeholder="Location, estimated capacity, requirements..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold">Submit Inquiry</button>
                        </form>
                    </div>

                    <!-- Direct Contact Card -->
                    <div class="card p-4 rounded-4 border-0 text-white" style="background-color: #07132b;">
                        <h5 class="fw-bold mb-3"><i class="bi bi-headset text-primary me-2"></i>Engineering Support</h5>
                        <p class="small text-secondary mb-3">Have questions? Speak directly to our technical desk.</p>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-telephone-fill text-primary"></i>
                            <a href="tel:{{ $settings?->contact_phone ?? '+880 1234 567890' }}" class="text-white text-decoration-none fw-semibold">
                                {{ $settings?->contact_phone ?? '+880 1234 567890' }}
                            </a>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-envelope-fill text-primary"></i>
                            <a href="mailto:{{ $settings?->contact_email ?? 'info@enerixbd.com' }}" class="text-white text-decoration-none small">
                                {{ $settings?->contact_email ?? 'info@enerixbd.com' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
