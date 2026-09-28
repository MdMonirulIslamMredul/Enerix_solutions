@extends('frontend.layouts.app')

@section('title', 'Industries We Serve - Enerix Solutions')

@section('content')
    <!-- Banner -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, #07132b 0%, #004b87 100%);">
        <div class="container-fluid px-lg-5 py-3" data-aos="fade-up">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Industries</li>
                </ol>
            </nav>
            <h1 class="display-5 fw-bold mb-2">Industries We Serve</h1>
            <p class="lead text-white-50 mb-0" style="max-width: 760px;">
                Tailored engineering, high-performance solar installations, and enterprise technology for specialized industry sectors.
            </p>
        </div>
    </section>

    <!-- Industries Grid -->
    <section class="py-5 bg-light">
        <div class="container-fluid px-lg-5">
            <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4">
                @forelse($industries as $industry)
                    <div class="col" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 60 }}">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="position-relative" style="height: 200px;">
                                @if($industry->image)
                                    <img src="{{ asset('storage/' . $industry->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $industry->title }}">
                                @else
                                    <img src="{{ asset('images/enerix/industry_residential.jpg') }}" class="w-100 h-100 object-fit-cover" alt="{{ $industry->title }}">
                                @endif
                                <div class="position-absolute bottom-0 start-0 m-3 px-3 py-1 rounded-pill bg-dark bg-opacity-75 text-white small fw-bold">
                                    <i class="bi {{ $industry->icon ?? 'bi-building' }} me-1"></i>{{ $industry->title }}
                                </div>
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <h3 class="fw-bold fs-5 mb-1">{{ $industry->title }}</h3>
                                <p class="text-primary small fw-semibold mb-2">{{ $industry->subtitle ?? 'Sector Solutions' }}</p>
                                <p class="text-muted small mb-4">{{ $industry->short_description ?? 'Customized engineering, solar power, and infrastructure support.' }}</p>
                                <div class="mt-auto">
                                    <a href="{{ route('industries.show', $industry->slug) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-semibold">
                                        Explore Sector <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-muted">
                        No industries configured yet.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Bottom CTA -->
    <section class="enerix-cta-banner">
        <div class="container-fluid px-lg-5 text-center" data-aos="zoom-in">
            <h3 class="fw-bold text-white mb-2">Need an Industry-Specific Solution?</h3>
            <p class="text-white-50 mb-4 max-w-lg mx-auto">From medical facilities to industrial manufacturing, our engineers tailor systems to exact industry standards.</p>
            <a href="{{ route('quote') }}" class="btn-enerix-white">Get a Free Consultation <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
    </section>
@endsection
