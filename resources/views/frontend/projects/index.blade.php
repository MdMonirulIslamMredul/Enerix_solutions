@extends('frontend.layouts.app')

@section('title', 'Featured Projects - Enerix Solutions')

@section('content')
    <!-- Banner -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, #07132b 0%, #004b87 100%);">
        <div class="container-fluid px-lg-5 py-3" data-aos="fade-up">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Projects</li>
                </ol>
            </nav>
            <h1 class="display-5 fw-bold mb-2">Our Engineering Portfolio</h1>
            <p class="lead text-white-50 mb-0" style="max-width: 760px;">
                Proven turnkey execution across commercial rooftop solar, heavy industrial plants, data center networks, and hospital electrical installations.
            </p>
        </div>
    </section>

    <!-- Projects Listing -->
    <section class="py-5 bg-light">
        <div class="container-fluid px-lg-5">
            <!-- Category Filter Pills -->
            @if(isset($categories) && count($categories) > 0)
                <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center" data-aos="fade-up">
                    <a href="{{ route('projects.index') }}" class="btn btn-sm rounded-pill px-3 {{ empty($currentCategory) ? 'btn-primary' : 'btn-outline-secondary bg-white' }}">
                        All Projects
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('projects.index', ['category' => $cat]) }}" class="btn btn-sm rounded-pill px-3 {{ $currentCategory === $cat ? 'btn-primary' : 'btn-outline-secondary bg-white' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            @endif

            <!-- Projects Grid -->
            <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-xl-4">
                @forelse($projects as $project)
                    <div class="col" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 70 }}">
                        <a href="{{ route('projects.show', $project->slug) }}" class="project-card shadow-sm border-0">
                            <div class="project-img-wrapper" style="height: 190px;">
                                @if($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                                @else
                                    <img src="{{ asset('images/enerix/project_commercial_solar.jpg') }}" alt="{{ $project->title }}">
                                @endif
                                @if($project->category)
                                    <span class="badge bg-primary position-absolute top-0 end-0 m-3 shadow-sm rounded-pill px-3 py-1">
                                        {{ $project->category }}
                                    </span>
                                @endif
                            </div>
                            <div class="project-card-body p-4">
                                <h4 class="fw-bold text-dark fs-6 mb-1">{{ $project->title }}</h4>
                                <div class="text-secondary small mb-3 fw-semibold">{{ $project->spec_subtitle ?? '-' }}</div>
                                <p class="small text-muted mb-3" style="line-height: 1.4;">{{ Str::limit($project->short_description, 95) }}</p>
                                <div class="mt-auto pt-2 border-top d-flex align-items-center justify-content-between text-muted small">
                                    <span><i class="bi bi-geo-alt-fill text-primary me-1"></i>{{ $project->location ?? 'Bangladesh' }}</span>
                                    <span class="text-primary fw-semibold">View Case Study <i class="bi bi-arrow-right"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-muted">
                        No projects found in this category.
                    </div>
                @endforelse
            </div>

            @if(method_exists($projects, 'hasPages') && $projects->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {{ $projects->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- Bottom CTA -->
    <section class="enerix-cta-banner">
        <div class="container-fluid px-lg-5 text-center" data-aos="zoom-in">
            <h3 class="fw-bold text-white mb-2">Have a Similar Project You Want to Undertake?</h3>
            <p class="text-white-50 mb-4 max-w-lg mx-auto">Our engineering teams bring unmatched precision, safety standards, and commercial feasibility.</p>
            <a href="{{ route('quote') }}" class="btn-enerix-white">Get a Free Consultation <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
    </section>
@endsection
