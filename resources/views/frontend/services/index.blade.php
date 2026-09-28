@extends('frontend.layouts.app')

@section('title', 'Engineering Solutions - Enerix Solutions')

@section('content')
    <!-- Banner -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, #07132b 0%, #004b87 100%);">
        <div class="container-fluid px-lg-5 py-3" data-aos="fade-up">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Solutions</li>
                </ol>
            </nav>
            <h1 class="display-5 fw-bold mb-2">Our Engineering Solutions</h1>
            <p class="lead text-white-50 mb-0" style="max-width: 760px;">
                Comprehensive, robust and future-ready engineering solutions designed for residential, commercial and heavy industrial demands.
            </p>
        </div>
    </section>

    <!-- Solutions Listing -->
    <section class="py-5 bg-light">
        <div class="container-fluid px-lg-5">
            <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
                @forelse($services as $service)
                    @php
                        $bulletItems = $service->features ?? [];
                        if (is_string($bulletItems)) {
                            $bulletItems = array_filter(array_map('trim', explode("\n", $bulletItems)));
                        }
                    @endphp
                    <div class="col" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 80 }}">
                        <div class="solution-card h-100 shadow-sm border-0">
                            <!-- Image + Icon Badge -->
                            <div class="solution-card-img-wrapper" style="height: 200px;">
                                @if($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                                @else
                                    <img src="{{ asset('images/enerix/solution_solar.jpg') }}" alt="{{ $service->title }}">
                                @endif
                                <div class="solution-icon-badge" style="width: 48px; height: 48px; font-size: 1.35rem; bottom: -18px;">
                                    <i class="bi {{ $service->icon ?? 'bi-sun-fill' }}"></i>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="solution-card-body pt-4 p-4">
                                <h3 class="solution-title fs-5 mb-2">
                                    <a href="{{ route('solutions.show', $service->slug) }}" class="text-decoration-none text-dark">
                                        {{ $service->title }}
                                    </a>
                                </h3>

                                <p class="small text-muted mb-3">{{ $service->short_description }}</p>

                                @if(!empty($bulletItems) && count($bulletItems) > 0)
                                    <ul class="solution-bullet-list mb-4">
                                        @foreach($bulletItems as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                                    <a href="{{ route('solutions.show', $service->slug) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-semibold">
                                        Explore Solution <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                    <a href="{{ route('quote') }}?solution={{ urlencode($service->title) }}" class="small text-decoration-none fw-bold text-dark">
                                        Get Quote
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-muted">
                        No solutions currently available.
                    </div>
                @endforelse
            </div>

            @if(method_exists($services, 'hasPages') && $services->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {{ $services->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- Bottom CTA -->
    <section class="enerix-cta-banner">
        <div class="container-fluid px-lg-5 text-center" data-aos="zoom-in">
            <h3 class="fw-bold text-white mb-2">Have a Custom Technical Requirement?</h3>
            <p class="text-white-50 mb-4 max-w-lg mx-auto">Our engineering consultancy division provides feasibility studies, architectural review, and custom turnkey systems.</p>
            <a href="{{ route('quote') }}" class="btn-enerix-white">Request a Consultation <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
    </section>
@endsection
