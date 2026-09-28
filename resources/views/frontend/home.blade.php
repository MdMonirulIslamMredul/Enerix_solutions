@extends('frontend.layouts.app')

@section('title', $setting->meta_title ?? 'Enerix Solutions - Integrated Engineering & Renewable Energy')

@push('styles')
    <style>
        /* Hero Section Styling */
        .enerix-hero-section {
            background-color: #07132b;
            background-image: radial-gradient(circle at 85% 30%, rgba(0, 114, 206, 0.25) 0%, transparent 60%),
                              radial-gradient(circle at 10% 80%, rgba(0, 198, 255, 0.12) 0%, transparent 50%);
            color: #ffffff;
            position: relative;
            padding: 3.5rem 0 4rem 0;
            overflow: hidden;
        }

        .hero-tagline {
            display: inline-block;
            color: #38bdf8;
            font-size: 0.88rem;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .hero-title {
            font-size: clamp(2.4rem, 4.5vw, 3.6rem);
            font-weight: 900;
            line-height: 1.12;
            letter-spacing: -0.5px;
            margin-bottom: 1.25rem;
        }

        .hero-title .highlight {
            color: #0284c7;
            display: block;
        }

        .hero-desc {
            color: #94a3b8;
            font-size: 1.15rem;
            line-height: 1.6;
            max-width: 520px;
            margin-bottom: 2rem;
        }

        /* Hero 4-Panel Dynamic Collage */
        .hero-collage-container {
            position: relative;
            display: flex;
            gap: 12px;
            height: 480px;
        }

        .hero-collage-main {
            flex: 1.5;
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .hero-collage-main img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .hero-collage-sidebar {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .hero-collage-sub {
            flex: 1;
            position: relative;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(0,0,0,0.25);
        }

        .hero-collage-sub img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform 0.4s ease;
        }

        .hero-collage-sub:hover img {
            transform: scale(1.08);
        }

        @media (max-width: 991px) {
            .hero-collage-container {
                height: 380px;
                margin-top: 2rem;
            }
        }

        @media (max-width: 575px) {
            .hero-collage-container {
                height: auto;
                flex-direction: column;
            }
            .hero-collage-main {
                height: 240px;
            }
            .hero-collage-sidebar {
                flex-direction: row;
                height: 120px;
            }
        }

        /* Why Enerix Dark Banner */
        .why-enerix-section {
            background-color: #07132b;
            background-image: radial-gradient(circle at 50% 50%, rgba(0, 114, 206, 0.15) 0%, transparent 80%);
            color: #ffffff;
            padding: 3rem 0;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .counter-stat-box {
            text-align: center;
            padding: 0 1rem;
        }

        .counter-stat-val {
            font-size: 2.3rem;
            font-weight: 900;
            color: #38bdf8;
            line-height: 1;
            margin-bottom: 4px;
        }

        .counter-stat-lbl {
            font-size: 0.85rem;
            color: #94a3b8;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* CTA Contact Banner */
        .cta-contact-pill {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(6px);
            padding: 8px 18px;
            border-radius: 50px;
            color: #ffffff;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 600;
            transition: all 0.2s ease;
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .cta-contact-pill:hover {
            background: #ffffff;
            color: #0072ce;
            border-color: #ffffff;
            transform: translateY(-2px);
        }

        .cta-contact-pill .icon-circle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #ffffff;
            color: #0072ce;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .cta-contact-pill:hover .icon-circle {
            background: #0072ce;
            color: #ffffff;
        }
    </style>
@endpush

@section('content')

    <!-- ================= 1. HERO SECTION ================= -->
    <section class="enerix-hero-section">
        <div class="container-fluid px-lg-5">
            <div class="row align-items-center">
                <!-- Left Hero Text -->
                <div class="col-lg-6 pe-lg-4" data-aos="fade-right">
                    <span class="hero-tagline">
                        {{ $setting->hero_tagline ?? 'ENGINEERING | SOLAR | IT | REAL ESTATE' }}
                    </span>

                    <h1 class="hero-title">
                        {{ $setting->hero_title ?? 'Engineering Tomorrow.' }}
                        <span class="highlight">{{ $setting->hero_highlight ?? 'Powering Possibilities.' }}</span>
                    </h1>

                    <p class="hero-desc">
                        {{ $setting->hero_description ?? 'Integrated Engineering, Solar Energy & IT Solutions for Homes, Businesses and Industries.' }}
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('solutions.index') }}" class="btn-enerix-primary">
                            Explore Our Solutions <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        <a href="{{ route('quote') }}" class="btn-enerix-glass">
                            Request a Consultation
                        </a>
                    </div>
                </div>

                <!-- Right Hero 4-Panel Dynamic Visual Collage -->
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="hero-collage-container">
                        <!-- Main Left Panel: Engineer + Solar Site -->
                        <div class="hero-collage-main">
                            @if(!empty($setting->hero_image_main))
                                <img src="{{ asset('storage/' . $setting->hero_image_main) }}" alt="Enerix Engineer Solar Solutions">
                            @else
                                <img src="{{ asset('images/enerix/hero_main.jpg') }}" alt="Enerix Engineer Solar Solutions">
                            @endif
                        </div>

                        <!-- 3 Right Stacked Panels: Civil, IT, Security -->
                        <div class="hero-collage-sidebar">
                            <!-- Top: Civil Construction -->
                            <div class="hero-collage-sub">
                                @if(!empty($setting->hero_image_top))
                                    <img src="{{ asset('storage/' . $setting->hero_image_top) }}" alt="Civil & Structural Construction">
                                @else
                                    <img src="{{ asset('images/enerix/hero_top.jpg') }}" alt="Civil & Structural Construction">
                                @endif
                            </div>

                            <!-- Mid: Datacenter IT -->
                            <div class="hero-collage-sub">
                                @if(!empty($setting->hero_image_mid))
                                    <img src="{{ asset('storage/' . $setting->hero_image_mid) }}" alt="IT Datacenter & Technology">
                                @else
                                    <img src="{{ asset('images/enerix/hero_mid.jpg') }}" alt="IT Datacenter & Technology">
                                @endif
                            </div>

                            <!-- Bot: CCTV Security -->
                            <div class="hero-collage-sub">
                                @if(!empty($setting->hero_image_bot))
                                    <img src="{{ asset('storage/' . $setting->hero_image_bot) }}" alt="Security & AI Surveillance">
                                @else
                                    <img src="{{ asset('images/enerix/hero_bot.jpg') }}" alt="Security & AI Surveillance">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= 2. OUR SOLUTIONS SECTION ================= -->
    <section class="py-5 bg-white" id="solutions">
        <div class="container-fluid px-lg-5">
            <!-- Header Row -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <h2 class="fw-bold mb-1" style="font-size: 2rem;">
                        Our <span style="color: var(--primary-color);">Solutions</span>
                    </h2>
                </div>
                <div class="text-md-center">
                    <p class="text-secondary mb-0 small" style="max-width: 600px;">
                        We provide reliable, modern and professional solutions for residential, commercial and industrial clients.
                    </p>
                </div>
                <div>
                    <a href="{{ route('solutions.index') }}" class="fw-bold text-decoration-none d-inline-flex align-items-center" style="color: var(--primary-color);">
                        View All Solutions <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <!-- 6 Solutions Cards Grid -->
            <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-6">
                @forelse($services as $service)
                    @php
                        $bulletItems = $service->features ?? [];
                        if (is_string($bulletItems)) {
                            $bulletItems = array_filter(array_map('trim', explode("\n", $bulletItems)));
                        }
                    @endphp
                    <div class="col" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 70 }}">
                        <div class="solution-card">
                            <!-- Image + Icon Badge -->
                            <div class="solution-card-img-wrapper">
                                @if($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                                @else
                                    <img src="{{ asset('images/enerix/solution_solar.jpg') }}" alt="{{ $service->title }}">
                                @endif
                                <div class="solution-icon-badge">
                                    <i class="bi {{ $service->icon ?? 'bi-sun-fill' }}"></i>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="solution-card-body">
                                <h3 class="solution-title">
                                    <a href="{{ route('solutions.show', $service->slug) }}" class="text-decoration-none text-dark">
                                        {{ $service->title }}
                                    </a>
                                </h3>

                                <ul class="solution-bullet-list mt-auto">
                                    @if(!empty($bulletItems) && count($bulletItems) > 0)
                                        @foreach(array_slice($bulletItems, 0, 4) as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    @else
                                        <li>Design & Planning</li>
                                        <li>Supply & Installation</li>
                                        <li>Testing & Commissioning</li>
                                        <li>Maintenance Support</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4 text-muted">
                        No solutions configured. Seed data or add solutions from Admin Panel.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ================= 3. WHY ENERIX SOLUTIONS? ================= -->
    <section class="why-enerix-section">
        <div class="container-fluid px-lg-5">
            <div class="row align-items-center g-4">
                <!-- Left Title & Subtitle -->
                <div class="col-xl-3 col-lg-4 text-center text-lg-start" data-aos="fade-right">
                    <h3 class="fw-bold text-white mb-2" style="font-size: 1.65rem;">
                        {{ $setting->why_title ?? 'Why Enerix Solutions?' }}
                    </h3>
                    <p class="text-secondary-subtle mb-0 small" style="color: #94a3b8; max-width: 320px;">
                        {{ $setting->why_subtitle ?? 'Your trusted partner for sustainable, efficient and future-ready solutions.' }}
                    </p>
                </div>

                <!-- Middle 5 Feature Badges -->
                <div class="col-xl-6 col-lg-5" data-aos="fade-up">
                    <div class="d-flex justify-content-around align-items-start flex-wrap gap-3">
                        <div class="why-badge">
                            <div class="why-badge-icon"><i class="bi bi-gem"></i></div>
                            <span class="why-badge-text">Integrated Solutions</span>
                        </div>

                        <div class="why-badge">
                            <div class="why-badge-icon"><i class="bi bi-award"></i></div>
                            <span class="why-badge-text">Professional Engineering</span>
                        </div>

                        <div class="why-badge">
                            <div class="why-badge-icon"><i class="bi bi-shield-check"></i></div>
                            <span class="why-badge-text">Quality Equipment</span>
                        </div>

                        <div class="why-badge">
                            <div class="why-badge-icon"><i class="bi bi-headset"></i></div>
                            <span class="why-badge-text">Technical Support</span>
                        </div>

                        <div class="why-badge">
                            <div class="why-badge-icon"><i class="bi bi-diagram-3"></i></div>
                            <span class="why-badge-text">End-to-End Management</span>
                        </div>
                    </div>
                </div>

                <!-- Right 3 Stats / Counters -->
                <div class="col-xl-3 col-lg-3 border-start border-secondary ps-xl-4 text-center" data-aos="fade-left">
                    <div class="d-flex justify-content-around align-items-center">
                        @forelse($counters as $counter)
                            <div class="counter-stat-box">
                                <div class="counter-stat-val">{{ $counter->value }}</div>
                                <div class="counter-stat-lbl">{{ $counter->title }}</div>
                            </div>
                        @empty
                            <div class="counter-stat-box">
                                <div class="counter-stat-val">50+</div>
                                <div class="counter-stat-lbl">Projects</div>
                            </div>
                            <div class="counter-stat-box">
                                <div class="counter-stat-val">20+</div>
                                <div class="counter-stat-lbl">Partners</div>
                            </div>
                            <div class="counter-stat-box">
                                <div class="counter-stat-val">24/7</div>
                                <div class="counter-stat-lbl">Support</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= 4. INDUSTRIES WE SERVE ================= -->
    <section class="py-5" style="background-color: #f8fafc;">
        <div class="container-fluid px-lg-5">
            <!-- Header Row -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0" style="font-size: 1.85rem;">
                    Industries <span style="color: var(--primary-color);">We Serve</span>
                </h2>
                <a href="{{ route('industries.index') }}" class="fw-bold text-decoration-none d-inline-flex align-items-center" style="color: var(--primary-color);">
                    View All Industries <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

            <!-- 7 Horizontal Industry Cards -->
            <div class="row g-3 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-7">
                @forelse($industries as $industry)
                    <div class="col" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 50 }}">
                        <a href="{{ route('industries.show', $industry->slug) }}" class="industry-card">
                            @if($industry->image)
                                <img src="{{ asset('storage/' . $industry->image) }}" alt="{{ $industry->title }}">
                            @else
                                <img src="{{ asset('images/enerix/industry_residential.jpg') }}" alt="{{ $industry->title }}">
                            @endif
                            <div class="industry-badge-pill">
                                {{ $industry->title }}
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-4 text-muted">
                        No industries configured. Seed data or add industries from Admin Panel.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ================= 5. FEATURED PROJECTS ================= -->
    <section class="py-5 bg-white">
        <div class="container-fluid px-lg-5">
            <!-- Header Row -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0" style="font-size: 1.85rem;">
                    Featured <span style="color: var(--primary-color);">Projects</span>
                </h2>
                <a href="{{ route('projects.index') }}" class="fw-bold text-decoration-none d-inline-flex align-items-center" style="color: var(--primary-color);">
                    View All Projects <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

            <!-- 4 Featured Projects Cards Grid -->
            <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-xl-4">
                @forelse($projects as $project)
                    <div class="col" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 70 }}">
                        <a href="{{ route('projects.show', $project->slug) }}" class="project-card">
                            <div class="project-img-wrapper">
                                @if($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                                @else
                                    <img src="{{ asset('images/enerix/project_commercial_solar.jpg') }}" alt="{{ $project->title }}">
                                @endif
                            </div>
                            <div class="project-card-body">
                                <h4 class="fw-bold text-dark fs-6 mb-1">{{ $project->title }}</h4>
                                <div class="text-secondary small mb-2">{{ $project->spec_subtitle ?? ($project->category ?? 'Engineering Solution') }}</div>
                                <div class="mt-auto d-flex align-items-center small text-muted">
                                    <i class="bi bi-geo-alt-fill text-primary me-1"></i>
                                    <span>{{ $project->location ?? 'Bangladesh' }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-4 text-muted">
                        No projects found. Seed data or add projects from Admin Panel.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ================= 6. HAVE A PROJECT IN MIND? CTA BANNER ================= -->
    <section class="enerix-cta-banner">
        <div class="container-fluid px-lg-5">
            <div class="row align-items-center g-4">
                <!-- Left Title & Subtitle -->
                <div class="col-xl-4 col-lg-5 text-center text-lg-start" data-aos="fade-right">
                    <h3 class="fw-bold text-white mb-1" style="font-size: 1.85rem;">
                        {{ $setting->cta_title ?? 'Have a Project in Mind?' }}
                    </h3>
                    <p class="text-white-50 mb-0 small">
                        {{ $setting->cta_text ?? 'Talk to our engineering team and discover the right solution for your project.' }}
                    </p>
                </div>

                <!-- Middle CTA Button -->
                <div class="col-xl-3 col-lg-3 text-center" data-aos="zoom-in">
                    <a href="{{ route('quote') }}" class="btn-enerix-white">
                        Get a Free Consultation <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>

                <!-- Right Quick Contact Badges -->
                <div class="col-xl-5 col-lg-4 text-center text-lg-end" data-aos="fade-left">
                    <div class="d-flex flex-wrap justify-content-center justify-content-lg-end gap-2">
                        <!-- Phone -->
                        <a href="tel:{{ $setting->contact_phone ?? '+880 1234 567890' }}" class="cta-contact-pill">
                            <span class="icon-circle"><i class="bi bi-telephone-fill"></i></span>
                            <span>Call Us: {{ $setting->contact_phone ?? '+880 1234 567890' }}</span>
                        </a>

                        <!-- WhatsApp -->
                        @php
                            $wa = preg_replace('/\D+/', '', $setting->whatsapp_number ?? ($setting->contact_phone ?? '8801234567890'));
                        @endphp
                        <a href="https://wa.me/{{ $wa }}" target="_blank" class="cta-contact-pill">
                            <span class="icon-circle"><i class="bi bi-whatsapp"></i></span>
                            <span>WhatsApp: {{ $setting->whatsapp_number ?? '+880 1234 567890' }}</span>
                        </a>

                        <!-- Email -->
                        <a href="mailto:{{ $setting->contact_email ?? 'info@enerixbd.com' }}" class="cta-contact-pill">
                            <span class="icon-circle"><i class="bi bi-envelope-fill"></i></span>
                            <span>Email Us: {{ $setting->contact_email ?? 'info@enerixbd.com' }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
