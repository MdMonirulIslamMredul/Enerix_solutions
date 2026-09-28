@extends('frontend.layouts.app')

@section('title', $industry->title . ' - Industries We Serve')

@section('content')
    <!-- Banner -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, #07132b 0%, #004b87 100%);">
        <div class="container-fluid px-lg-5 py-3" data-aos="fade-up">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('industries.index') }}" class="text-white-50 text-decoration-none">Industries</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ $industry->title }}</li>
                </ol>
            </nav>
            <div class="d-flex align-items-center gap-3 mt-2">
                <div class="p-3 bg-white text-primary rounded-circle shadow d-inline-flex">
                    <i class="bi {{ $industry->icon ?? 'bi-building' }} fs-3"></i>
                </div>
                <div>
                    <h1 class="display-6 fw-bold mb-1">{{ $industry->title }}</h1>
                    <p class="lead text-white-50 mb-0" style="font-size: 1.05rem;">{{ $industry->subtitle ?? 'Engineering Solutions for ' . $industry->title }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5 bg-white">
        <div class="container-fluid px-lg-5">
            <div class="row g-5">
                <!-- Left Details -->
                <div class="col-lg-8" data-aos="fade-right">
                    @if ($industry->image)
                        <div class="rounded-4 overflow-hidden shadow-sm mb-4" style="max-height: 420px;">
                            <img src="{{ asset('storage/' . $industry->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $industry->title }}">
                        </div>
                    @endif

                    <h2 class="fw-bold mb-3">Industry Overview & Specialized Demands</h2>
                    <p class="lead text-dark mb-4">{{ $industry->short_description ?? 'Specialized engineering infrastructure tailored to the unique operational standards of this sector.' }}</p>

                    <div class="text-secondary lh-lg mb-4" style="font-size: 1.05rem;">
                        {!! $industry->description ?? '<p>Enerix Solutions engineers high-capacity electrical grids, rooftop solar power installations, structural architectural designs, and IT systems customized for operational efficiency in this domain.</p>' !!}
                    </div>

                    <!-- Recommended Solutions Grid -->
                    @if(isset($solutions) && count($solutions) > 0)
                        <h4 class="fw-bold fs-5 mb-3">Recommended Solutions for {{ $industry->title }}</h4>
                        <div class="row g-3 mb-4">
                            @foreach($solutions as $sol)
                                <div class="col-md-6">
                                    <div class="p-3 rounded-3 border bg-light d-flex align-items-center gap-3">
                                        <div class="p-2 rounded-circle bg-primary text-white">
                                            <i class="bi {{ $sol->icon ?? 'bi-check2' }} fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0 text-dark">{{ $sol->title }}</h6>
                                            <a href="{{ route('solutions.show', $sol->slug) }}" class="small text-primary text-decoration-none">Learn More &rarr;</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="p-4 rounded-4 text-white" style="background: linear-gradient(135deg, #07132b 0%, #0072ce 100%);">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="fw-bold text-white mb-1">Empower Your Sector Operations Today</h4>
                                <p class="text-white-50 small mb-md-0">Get in touch with an Enerix sector specialist to explore custom solutions.</p>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <a href="{{ route('quote') }}?industry={{ urlencode($industry->title) }}" class="btn btn-light rounded-pill px-4 fw-bold text-primary">
                                    Get Quote
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="col-lg-4" data-aos="fade-left">
                    <!-- Other Industries List -->
                    <div class="card p-4 rounded-4 border bg-light mb-4">
                        <h4 class="fw-bold fs-5 mb-3 border-bottom pb-2">Other Sectors We Serve</h4>
                        <div class="d-flex flex-column gap-2">
                            @foreach($otherIndustries as $other)
                                <a href="{{ route('industries.show', $other->slug) }}" class="d-flex align-items-center justify-content-between p-2 rounded bg-white border text-decoration-none text-dark">
                                    <span class="small fw-semibold"><i class="bi {{ $other->icon ?? 'bi-building' }} text-primary me-2"></i>{{ $other->title }}</span>
                                    <i class="bi bi-chevron-right text-muted small"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Consultation Box -->
                    <div class="card p-4 rounded-4 border shadow-sm">
                        <h5 class="fw-bold mb-2">Request Sector Analysis</h5>
                        <p class="small text-muted mb-3">Speak with our senior industry consultants.</p>
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="subject" value="Inquiry for Industry: {{ $industry->title }}">
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control form-control-sm rounded-3" placeholder="Full Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control form-control-sm rounded-3" placeholder="Work Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="phone" class="form-control form-control-sm rounded-3" placeholder="Phone Number">
                            </div>
                            <div class="mb-3">
                                <textarea name="message" class="form-control form-control-sm rounded-3" rows="3" placeholder="Details of requirements..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold">Submit Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
