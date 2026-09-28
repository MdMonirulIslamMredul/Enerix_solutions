@extends('frontend.layouts.app')

@section('title', $about?->title ?? 'About Us - Enerix Solutions')

@section('content')
    @php
        $bannerImage = !empty($about?->banner_image)
            ? asset('storage/' . $about->banner_image)
            : asset('images/enerix/hero_main.jpg');
        $image1 = !empty($about?->image1)
            ? asset('storage/' . $about->image1)
            : asset('images/enerix/solution_civil.jpg');
        $image2 = !empty($about?->image2)
            ? asset('storage/' . $about->image2)
            : asset('images/enerix/solution_solar.jpg');
        $keyValues = collect($about?->key_values ?? [
            'Engineering Excellence',
            'Sustainable Energy',
            'Uncompromising Safety',
            'Customer Partnership',
        ])->filter()->values();
    @endphp

    <!-- Page Header Banner -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, #07132b 0%, #004b87 100%);">
        <div class="container-fluid px-lg-5 py-4" data-aos="fade-up">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">About Us</li>
                </ol>
            </nav>
            <h1 class="display-5 fw-bold mb-2">{{ $about?->title ?? 'About Enerix Solutions' }}</h1>
            <p class="lead text-white-50 mb-0" style="max-width: 760px;">
                Delivering reliable Solar, Electrical, Civil, Architectural and IT engineering solutions across residential, commercial and industrial domains.
            </p>
        </div>
    </section>

    <!-- Company Story & Overview -->
    <section class="py-5 bg-white">
        <div class="container-fluid px-lg-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="position-relative">
                        <img src="{{ $image1 }}" alt="Enerix Engineering" class="img-fluid rounded-4 shadow">
                        <div class="position-absolute bottom-0 end-0 bg-primary text-white p-3 p-md-4 rounded-4 shadow-lg m-3" style="max-width: 220px;">
                            <div class="display-6 fw-bold mb-0">{{ $about?->years_experience ?? 15 }}+</div>
                            <div class="small fw-semibold text-uppercase">Years of Engineering Excellence</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <span class="badge bg-primary-subtle text-primary fw-bold text-uppercase px-3 py-2 rounded-pill mb-3">Our Identity</span>
                    <h2 class="fw-bold mb-3" style="font-size: 2.2rem;">Engineering Tomorrow, Powering Real-World Possibilities</h2>
                    <div class="text-secondary lh-lg mb-4">
                        {!! $about?->page_details ?? '<p>Enerix Solutions is an integrated engineering and technology solutions provider delivering reliable Solar, Electrical, Civil, Architectural and IT solutions for residential, commercial and industrial clients.</p>' !!}
                    </div>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="border rounded-3 p-3 h-100 bg-light">
                                <i class="bi bi-bullseye fs-3 text-primary mb-2 d-block"></i>
                                <h5 class="fw-bold fs-6 mb-1">Our Mission</h5>
                                <p class="small text-muted mb-0">{{ $setting->mission ?? 'To deliver robust, sustainable engineering and clean energy infrastructure with uncompromising quality and client trust.' }}</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="border rounded-3 p-3 h-100 bg-light">
                                <i class="bi bi-eye fs-3 text-primary mb-2 d-block"></i>
                                <h5 class="fw-bold fs-6 mb-1">Our Vision</h5>
                                <p class="small text-muted mb-0">{{ $setting->vision ?? 'To be the most trusted integrated engineering and renewable energy partner driving industrial modernization.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Engineering Disciplines -->
    <section class="py-5" style="background-color: #f8fafc;">
        <div class="container-fluid px-lg-5">
            <div class="text-center max-w-xl mx-auto mb-5" data-aos="fade-up">
                <span class="badge bg-primary-subtle text-primary fw-bold text-uppercase px-3 py-2 rounded-pill mb-2">Capabilities</span>
                <h2 class="fw-bold">Multi-Disciplinary Engineering Expertise</h2>
                <p class="text-secondary small">Comprehensive end-to-end technical execution from initial site analysis to full commissioning.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 p-4 border-0 shadow-sm rounded-4 text-center">
                        <div class="mx-auto mb-3 p-3 rounded-circle bg-primary-subtle text-primary d-inline-flex">
                            <i class="bi bi-sun-fill fs-2"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Solar Energy</h5>
                        <p class="small text-muted mb-0">On-grid, off-grid and hybrid industrial rooftop arrays engineered for maximum return on investment.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100 p-4 border-0 shadow-sm rounded-4 text-center">
                        <div class="mx-auto mb-3 p-3 rounded-circle bg-primary-subtle text-primary d-inline-flex">
                            <i class="bi bi-buildings fs-2"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Civil & Architecture</h5>
                        <p class="small text-muted mb-0">Structural blueprints, high-rise real estate, master planning, and reinforced concrete construction.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 p-4 border-0 shadow-sm rounded-4 text-center">
                        <div class="mx-auto mb-3 p-3 rounded-circle bg-primary-subtle text-primary d-inline-flex">
                            <i class="bi bi-lightning-charge-fill fs-2"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Electrical Systems</h5>
                        <p class="small text-muted mb-0">Substation design, medium-voltage distribution, transformers, and electrical safety certification.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="card h-100 p-4 border-0 shadow-sm rounded-4 text-center">
                        <div class="mx-auto mb-3 p-3 rounded-circle bg-primary-subtle text-primary d-inline-flex">
                            <i class="bi bi-hdd-network-fill fs-2"></i>
                        </div>
                        <h5 class="fw-bold mb-2">IT & Surveillance</h5>
                        <p class="small text-muted mb-0">Enterprise datacenter setups, structured fiber cabling, and AI biometric CCTV surveillance ecosystems.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Detailed Narratives & Values -->
    <section class="py-5 bg-white">
        <div class="container-fluid px-lg-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                    <img src="{{ $image2 }}" alt="Enerix Quality Commitment" class="img-fluid rounded-4 shadow">
                </div>
                <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                    <h3 class="fw-bold mb-3">Our Core Values & Quality Assurance</h3>
                    <div class="text-secondary mb-4">
                        {!! $about?->details1 ?? '<p>Our team handles complete project execution from site survey and design to installation and maintenance with full technical rigor.</p>' !!}
                        {!! $about?->details2 ?? '<p>We use quality components and engineering-backed planning to maximize energy yield and system life.</p>' !!}
                    </div>

                    <h5 class="fw-bold fs-6 mb-3 text-uppercase text-muted">What We Stand For:</h5>
                    <div class="row g-2">
                        @foreach ($keyValues as $value)
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-2 p-2 rounded bg-light">
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                    <span class="fw-semibold small text-dark">{{ $value }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA Ribbon -->
    <section class="enerix-cta-banner">
        <div class="container-fluid px-lg-5 text-center" data-aos="zoom-in">
            <h3 class="fw-bold text-white mb-2">Ready to Engineer Your Next Project?</h3>
            <p class="text-white-50 mb-4 max-w-lg mx-auto">Get in touch with our certified engineers for an in-depth consultation and custom proposal.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('quote') }}" class="btn-enerix-white">Get a Free Consultation <i class="bi bi-arrow-right ms-1"></i></a>
                <a href="{{ route('contact.index') }}" class="btn-enerix-glass">Contact Our Team</a>
            </div>
        </div>
    </section>
@endsection
