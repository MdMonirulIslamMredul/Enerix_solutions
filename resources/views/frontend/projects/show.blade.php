@extends('frontend.layouts.app')

@section('title', $project->title . ' - Case Study')

@section('content')
    <!-- Banner -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, #07132b 0%, #004b87 100%);">
        <div class="container-fluid px-lg-5 py-3" data-aos="fade-up">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('projects.index') }}" class="text-white-50 text-decoration-none">Projects</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ $project->title }}</li>
                </ol>
            </nav>
            <div class="mt-2">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-2">{{ $project->category ?? 'Engineering Project' }}</span>
                <h1 class="display-6 fw-bold mb-2">{{ $project->title }}</h1>
                <p class="lead text-white-50 mb-0" style="font-size: 1.05rem;">
                    <i class="bi bi-geo-alt-fill text-info me-1"></i> {{ $project->location ?? 'Bangladesh' }} 
                    @if($project->spec_subtitle) | <span class="text-white">{{ $project->spec_subtitle }}</span>@endif
                </p>
            </div>
        </div>
    </section>

    <!-- Main Case Study Content -->
    <section class="py-5 bg-white">
        <div class="container-fluid px-lg-5">
            <div class="row g-5">
                <div class="col-lg-8" data-aos="fade-right">
                    @if ($project->image)
                        <div class="rounded-4 overflow-hidden shadow-sm mb-4" style="max-height: 480px;">
                            <img src="{{ asset('storage/' . $project->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $project->title }}">
                        </div>
                    @endif

                    <h2 class="fw-bold mb-3">Project Summary & Technical Execution</h2>
                    <p class="lead text-dark mb-4">{{ $project->short_description }}</p>

                    <div class="text-secondary lh-lg mb-4" style="font-size: 1.05rem;">
                        {!! $project->description !!}
                    </div>

                    <div class="p-4 rounded-4 text-white mt-4" style="background: linear-gradient(135deg, #07132b 0%, #0072ce 100%);">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="fw-bold text-white mb-1">Looking for a similar engineering solution?</h4>
                                <p class="text-white-50 small mb-md-0">Enerix Solutions engineers turnkey systems with full warranty and lifecycle support.</p>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <a href="{{ route('quote') }}?project={{ urlencode($project->title) }}" class="btn btn-light rounded-pill px-4 fw-bold text-primary">
                                    Get a Quote
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar Details -->
                <div class="col-lg-4" data-aos="fade-left">
                    <div class="card p-4 rounded-4 border bg-light mb-4">
                        <h4 class="fw-bold fs-5 mb-3 border-bottom pb-2">Project Metadata</h4>
                        <div class="d-flex flex-column gap-3 small">
                            <div>
                                <span class="text-muted d-block">Project Name</span>
                                <strong class="text-dark">{{ $project->title }}</strong>
                            </div>
                            @if($project->spec_subtitle)
                                <div>
                                    <span class="text-muted d-block">Specification / System Capacity</span>
                                    <strong class="text-dark">{{ $project->spec_subtitle }}</strong>
                                </div>
                            @endif
                            <div>
                                <span class="text-muted d-block">Location</span>
                                <strong class="text-dark"><i class="bi bi-geo-alt-fill text-primary me-1"></i>{{ $project->location ?? 'Bangladesh' }}</strong>
                            </div>
                            @if($project->category)
                                <div>
                                    <span class="text-muted d-block">Category</span>
                                    <strong class="text-dark">{{ $project->category }}</strong>
                                </div>
                            @endif
                            <div>
                                <span class="text-muted d-block">Execution Partner</span>
                                <strong class="text-dark">Enerix Solutions Engineering Division</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Consultation Form -->
                    <div class="card p-4 rounded-4 border shadow-sm">
                        <h5 class="fw-bold mb-2">Request Consultation</h5>
                        <p class="small text-muted mb-3">Speak with our engineering specialists.</p>
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="subject" value="Inquiry on Project: {{ $project->title }}">
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control form-control-sm rounded-3" placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control form-control-sm rounded-3" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="phone" class="form-control form-control-sm rounded-3" placeholder="Phone Number">
                            </div>
                            <div class="mb-3">
                                <textarea name="message" class="form-control form-control-sm rounded-3" rows="3" placeholder="Describe your project requirement..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold">Submit Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
