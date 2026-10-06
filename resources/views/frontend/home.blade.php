@extends('frontend.layouts.app')

@section('title', $setting->meta_title ?? 'Enerix Solutions - Integrated Engineering & Renewable Energy')

@push('styles')
    <style>
        /* ================= 1. ENERIX PANORAMIC HERO BANNER ================= */
        .enerix-hero-section {
            background-color: #07132b;
            position: relative;
            padding: 0;
            overflow: hidden;
        }

        .enerix-hero-banner {
            position: relative;
            min-height: 490px;
            border-radius: 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            background-color: #07132b;
        }

        /* Dual-layer background images for smooth cinematic crossfade */
        .hero-bg-container {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .hero-bg-layer {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: 74% center;
            opacity: 0;
            transform: scale(1.04);
            transition: opacity 0.65s cubic-bezier(0.25, 1, 0.5, 1), transform 0.85s cubic-bezier(0.25, 1, 0.5, 1);
            pointer-events: none;
            z-index: 1;
        }

        .hero-bg-layer.is-active {
            opacity: 1;
            transform: scale(1);
            z-index: 2;
        }

        .hero-bg-gradient {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, #07132b 0%, rgba(7, 19, 43, 0.96) 28%, rgba(7, 19, 43, 0.72) 46%, rgba(7, 19, 43, 0.15) 68%, transparent 84%);
            z-index: 3;
            pointer-events: none;
        }

        /* Left Hero Content */
        .hero-content-col {
            position: relative;
            z-index: 4;
            padding: 3.5rem 3rem;
            max-width: 680px;
        }

        .hero-tagline {
            display: inline-block;
            color: #38bdf8;
            font-size: 0.85rem;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 0.85rem;
        }

        .hero-title {
            font-size: clamp(2.2rem, 3.8vw, 3.4rem);
            font-weight: 900;
            line-height: 1.15;
            letter-spacing: -0.5px;
            color: #ffffff;
            margin-bottom: 1.15rem;
        }

        .hero-title .highlight {
            color: #0284c7;
            display: block;
        }

        .hero-desc {
            color: #cbd5e1;
            font-size: 1.1rem;
            line-height: 1.6;
            max-width: 520px;
            margin-bottom: 2rem;
        }

        .hero-action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        /* Right 3-Panel Slanted Collage */
        .hero-side-collage {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 38%;
            min-width: 340px;
            max-width: 560px;
            z-index: 5;
            pointer-events: none;
        }

        /* Non-scaling SVG Razor-Sharp White Dividers */
        .hero-collage-borders {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            z-index: 9;
            pointer-events: none;
        }

        .hero-collage-borders .border-line {
            stroke: #ffffff;
            stroke-width: 4px;
            vector-effect: non-scaling-stroke;
        }

        /* Individual Panel Items */
        .hero-panel-item {
            position: absolute;
            inset: 0;
            pointer-events: auto;
            cursor: pointer;
            overflow: hidden;
            background-color: #07132b;
            outline: none;
            transition: filter 0.3s ease;
        }

        .hero-panel-item:focus-visible {
            box-shadow: inset 0 0 0 3px #38bdf8;
        }

        /* Slanted Polygons Matching Image */
        .hero-panel-item.panel-top {
            clip-path: polygon(22% 0, 100% 0, 100% 27.5%, 14.7% 33%);
        }

        .hero-panel-item.panel-mid {
            clip-path: polygon(14.7% 33%, 100% 27.5%, 100% 61.5%, 7.3% 67%);
        }

        .hero-panel-item.panel-bot {
            clip-path: polygon(7.3% 67%, 100% 61.5%, 100% 100%, 0% 100%);
        }

        .panel-img-holder {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .panel-img-holder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform 0.45s cubic-bezier(0.2, 0.8, 0.25, 1), opacity 0.25s ease;
        }

        .hero-panel-item:hover .panel-img-holder img {
            transform: scale(1.08);
        }

        /* Hover Overlay & Badge */
        .panel-hover-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 114, 206, 0.35) 0%, rgba(7, 19, 43, 0.45) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 6;
            pointer-events: none;
        }

        .hero-panel-item:hover .panel-hover-overlay {
            opacity: 1;
        }

        .panel-badge {
            background: rgba(255, 255, 255, 0.95);
            color: #07132b;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.35);
            transform: translateY(6px);
            transition: transform 0.3s cubic-bezier(0.2, 0.8, 0.25, 1);
        }

        .hero-panel-item:hover .panel-badge {
            transform: translateY(0);
        }

        /* Caption Pills on Panels */
        .panel-caption-pill {
            position: absolute;
            z-index: 7;
            background: rgba(7, 19, 43, 0.75);
            backdrop-filter: blur(8px);
            color: #ffffff;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.4px;
            padding: 3px 10px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            pointer-events: none;
            opacity: 0.9;
            transition: all 0.25s ease;
        }

        .hero-panel-item.panel-top .panel-caption-pill {
            top: 14px;
            right: 18px;
        }

        .hero-panel-item.panel-mid .panel-caption-pill {
            top: 48%;
            right: 18px;
            transform: translateY(-50%);
        }

        .hero-panel-item.panel-bot .panel-caption-pill {
            bottom: 14px;
            right: 18px;
        }

        .hero-panel-item:hover .panel-caption-pill {
            background: var(--primary-color, #0072ce);
            opacity: 1;
            border-color: rgba(255, 255, 255, 0.5);
        }

        /* Pulse / Flash Swap Animation */
        @keyframes panelSwapPulse {
            0% {
                filter: brightness(1);
            }
            35% {
                filter: brightness(1.4) drop-shadow(0 0 10px #38bdf8);
            }
            100% {
                filter: brightness(1);
            }
        }

        .hero-panel-item.is-swapping {
            animation: panelSwapPulse 0.5s cubic-bezier(0.2, 0.8, 0.25, 1);
        }

        /* Responsive Breakpoints */
        @media (max-width: 1199px) {
            .hero-side-collage {
                width: 40%;
                min-width: 300px;
            }
            .hero-content-col {
                padding: 3rem 2.25rem;
                max-width: 580px;
            }
        }

        @media (max-width: 991px) {
            .enerix-hero-banner {
                min-height: auto;
                flex-direction: column;
                align-items: stretch;
            }

            .hero-content-col {
                padding: 2.75rem 1.75rem 1.75rem 1.75rem;
                max-width: 100%;
            }

            .hero-bg-layer {
                object-position: center;
            }

            .hero-bg-gradient {
                background: linear-gradient(180deg, rgba(7, 19, 43, 0.95) 0%, rgba(7, 19, 43, 0.8) 55%, rgba(7, 19, 43, 0.95) 100%);
            }

            .hero-side-collage {
                position: relative;
                width: 100%;
                max-width: 100%;
                min-width: 0;
                height: auto;
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
                padding: 0 1.5rem 1.75rem 1.5rem;
                pointer-events: auto;
            }

            .hero-panel-item {
                position: relative;
                inset: auto;
                height: 125px;
                border-radius: 12px;
                clip-path: none !important;
                border: 2.5px solid #ffffff;
                box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35);
            }

            .hero-panel-item.panel-top .panel-caption-pill,
            .hero-panel-item.panel-mid .panel-caption-pill,
            .hero-panel-item.panel-bot .panel-caption-pill {
                top: auto;
                bottom: 8px;
                right: 8px;
                transform: none;
                font-size: 0.65rem;
                padding: 2px 7px;
            }
        }

        @media (max-width: 575px) {
            .hero-side-collage {
                gap: 6px;
                padding: 0 1rem 1.25rem 1rem;
            }

            .hero-panel-item {
                height: 90px;
                border-radius: 8px;
                border-width: 2px;
            }

            .panel-caption-pill {
                display: none;
            }

            .hero-content-col {
                padding: 2.25rem 1.25rem 1.25rem 1.25rem;
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
    @php
        $imgMain = !empty($setting->hero_image_main) ? asset('storage/' . $setting->hero_image_main) : asset('images/enerix/hero_main.jpg');
        $imgTop  = !empty($setting->hero_image_top)  ? asset('storage/' . $setting->hero_image_top)  : asset('images/enerix/hero_top.jpg');
        $imgMid  = !empty($setting->hero_image_mid)  ? asset('storage/' . $setting->hero_image_mid)  : asset('images/enerix/hero_mid.jpg');
        $imgBot  = !empty($setting->hero_image_bot)  ? asset('storage/' . $setting->hero_image_bot)  : asset('images/enerix/hero_bot.jpg');
    @endphp

    <section class="enerix-hero-section">
        <div class="container-fluid px-0">
            <div class="enerix-hero-banner" id="heroBanner">
                <!-- Dual-layer background images for smooth cinematic crossfade -->
                <div class="hero-bg-container">
                    <img id="heroBgActive" class="hero-bg-layer is-active" src="{{ $imgMain }}" alt="Enerix Engineer Solar Solutions">
                    <img id="heroBgNext" class="hero-bg-layer" src="{{ $imgMain }}" alt="Enerix Solutions Banner Preview">
                    <div class="hero-bg-gradient"></div>
                </div>

                <!-- Left Content Overlay (Tagline, Title, Desc, Buttons) -->
                <div class="hero-content-col" data-aos="fade-right">
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

                    <div class="hero-action-buttons">
                        <a href="{{ route('solutions.index') }}" class="btn-enerix-primary">
                            Explore Our Solutions <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        <a href="{{ route('quote') }}" class="btn-enerix-glass">
                            Request a Consultation
                        </a>
                    </div>
                </div>

                <!-- Right 3-Panel Slanted Collage -->
                <div class="hero-side-collage" id="heroSideCollage" data-aos="fade-left">
                    <!-- SVG Razor-Sharp Non-scaling White Dividers -->
                    <svg class="hero-collage-borders d-none d-lg-block" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                        <!-- Diagonal Seam line -->
                        <line class="border-line border-slant" x1="22" y1="0" x2="0" y2="100" />
                        <!-- Divider between Panel 1 & 2 -->
                        <line class="border-line border-div1" x1="14.7" y1="33" x2="100" y2="27.5" />
                        <!-- Divider between Panel 2 & 3 -->
                        <line class="border-line border-div2" x1="7.3" y1="67" x2="100" y2="61.5" />
                    </svg>

                    <!-- Panel 1 (Top: Civil Construction) -->
                    <div class="hero-panel-item panel-top" data-slot="top" role="button" tabindex="0" title="Click to view Civil Construction">
                        <div class="panel-img-holder">
                            <img src="{{ $imgTop }}" alt="Civil & Structural Construction">
                        </div>
                        <div class="panel-hover-overlay">
                            <span class="panel-badge"><i class="bi bi-arrow-left-right"></i> Swap Preview</span>
                        </div>
                        <span class="panel-caption-pill">Civil Construction</span>
                    </div>

                    <!-- Panel 2 (Mid: Datacenter IT) -->
                    <div class="hero-panel-item panel-mid" data-slot="mid" role="button" tabindex="0" title="Click to view IT Datacenter">
                        <div class="panel-img-holder">
                            <img src="{{ $imgMid }}" alt="IT Datacenter & Technology">
                        </div>
                        <div class="panel-hover-overlay">
                            <span class="panel-badge"><i class="bi bi-arrow-left-right"></i> Swap Preview</span>
                        </div>
                        <span class="panel-caption-pill">IT Datacenter</span>
                    </div>

                    <!-- Panel 3 (Bot: CCTV Security) -->
                    <div class="hero-panel-item panel-bot" data-slot="bot" role="button" tabindex="0" title="Click to view AI Surveillance">
                        <div class="panel-img-holder">
                            <img src="{{ $imgBot }}" alt="Security & AI Surveillance">
                        </div>
                        <div class="panel-hover-overlay">
                            <span class="panel-badge"><i class="bi bi-arrow-left-right"></i> Swap Preview</span>
                        </div>
                        <span class="panel-caption-pill">AI Surveillance</span>
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
                            <!-- Image -->
                            <div class="solution-card-img-wrapper">
                                @if($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                                @else
                                    <img src="{{ asset('images/enerix/solution_solar.jpg') }}" alt="{{ $service->title }}">
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="solution-card-body">
                                <!-- Header Row: Full Size Icon Badge + Title -->
                                <div class="solution-header-row">
                                    <div class="solution-icon-badge">
                                        @php
                                            $t = strtolower($service->title ?? '');
                                            $s = strtolower($service->slug ?? '');
                                        @endphp
                                        @if(str_contains($t, 'solar') || str_contains($s, 'solar'))
                                            <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="8" cy="7" r="2.8" fill="currentColor" />
                                                <line x1="8" y1="1.2" x2="8" y2="2.5" />
                                                <line x1="8" y1="11.5" x2="8" y2="12.8" />
                                                <line x1="2.2" y1="7" x2="3.5" y2="7" />
                                                <line x1="12.5" y1="7" x2="13.8" y2="7" />
                                                <line x1="3.9" y1="2.9" x2="4.8" y2="3.8" />
                                                <line x1="11.2" y1="10.2" x2="12.1" y2="11.1" />
                                                <line x1="3.9" y1="11.1" x2="4.8" y2="10.2" />
                                                <line x1="11.2" y1="3.8" x2="12.1" y2="2.9" />
                                                <path d="M6 13.5L9 22H22L19 13.5H6Z" fill="rgba(255,255,255,0.18)" stroke="currentColor" stroke-width="1.6" />
                                                <line x1="12.5" y1="13.5" x2="15.5" y2="22" stroke-width="1.4" />
                                                <line x1="7.6" y1="17.7" x2="20.5" y2="17.7" stroke-width="1.4" />
                                            </svg>
                                        @elseif(str_contains($t, 'civil') || str_contains($s, 'civil') || str_contains($t, 'architect'))
                                            <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M2 21.5H22" stroke-width="2" />
                                                <rect x="3" y="11" width="5" height="10.5" rx="0.5" fill="rgba(255,255,255,0.18)" />
                                                <rect x="8.5" y="3.5" width="7" height="18" rx="0.5" fill="rgba(255,255,255,0.18)" />
                                                <rect x="16" y="7.5" width="5" height="14" rx="0.5" fill="rgba(255,255,255,0.18)" />
                                                <circle cx="5.5" cy="14" r="0.75" fill="currentColor" stroke="none" />
                                                <circle cx="5.5" cy="17.5" r="0.75" fill="currentColor" stroke="none" />
                                                <circle cx="12" cy="7" r="0.75" fill="currentColor" stroke="none" />
                                                <circle cx="12" cy="10.5" r="0.75" fill="currentColor" stroke="none" />
                                                <circle cx="12" cy="14" r="0.75" fill="currentColor" stroke="none" />
                                                <circle cx="12" cy="17.5" r="0.75" fill="currentColor" stroke="none" />
                                                <circle cx="18.5" cy="11" r="0.75" fill="currentColor" stroke="none" />
                                                <circle cx="18.5" cy="14.5" r="0.75" fill="currentColor" stroke="none" />
                                                <circle cx="18.5" cy="18" r="0.75" fill="currentColor" stroke="none" />
                                            </svg>
                                        @elseif(str_contains($t, 'electric') || str_contains($s, 'electric'))
                                            <svg viewBox="0 0 24 24" width="32" height="32" fill="currentColor">
                                                <path d="M13.5 1.5L4 13.5H12L10.5 22.5L20 10.5H12L13.5 1.5Z" />
                                            </svg>
                                        @elseif(str_contains($t, 'it') || str_contains($s, 'it') || str_contains($t, 'tech'))
                                            <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="2" y="3.5" width="20" height="13.5" rx="2" fill="rgba(255,255,255,0.18)" />
                                                <line x1="7" y1="21" x2="17" y2="21" stroke-width="2" />
                                                <line x1="12" y1="17" x2="12" y2="21" stroke-width="2" />
                                                <line x1="5.5" y1="13.5" x2="9.5" y2="13.5" />
                                            </svg>
                                        @elseif(str_contains($t, 'security') || str_contains($s, 'security') || str_contains($t, 'surveillance'))
                                            <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 2L4 5.5V11.5C4 16.5 7.5 21 12 22C16.5 21 20 16.5 20 11.5V5.5L12 2Z" fill="rgba(255,255,255,0.18)" />
                                                <path d="M8.5 11.5L11 14L15.5 9" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        @elseif(str_contains($t, 'consult') || str_contains($s, 'consult'))
                                            <svg viewBox="0 0 24 24" width="32" height="32" fill="currentColor">
                                                <path d="M16 13C17.66 13 21 13.84 21 15.5V17.5H11V15.5C11 13.84 14.34 13 16 13ZM8 13C9.66 13 13 13.84 13 15.5V17.5H3V15.5C3 13.84 6.34 13 8 13ZM8 11C6.34 11 5 9.66 5 8C5 6.34 6.34 5 8 5C9.66 5 11 6.34 11 8C11 9.66 9.66 11 8 11ZM16 11C14.34 11 13 9.66 13 8C13 6.34 14.34 5 16 5C17.66 5 19 6.34 19 8C19 9.66 17.66 11 16 11Z" />
                                            </svg>
                                        @else
                                            <i class="bi {{ $service->icon ?? 'bi-gear-fill' }}"></i>
                                        @endif
                                    </div>

                                    <h3 class="solution-title">
                                        <a href="{{ route('solutions.show', $service->slug) }}">
                                            {{ $service->title }}
                                        </a>
                                    </h3>
                                </div>

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

    <!-- ================= 6. FREQUENTLY ASKED QUESTIONS ================= -->
    {{-- @if(isset($faqs) && $faqs->count() > 0)
        <section class="py-5" style="background-color: #f8fafc;" id="faqs">
            <div class="container-fluid px-lg-5">
                <div class="text-center max-w-xl mx-auto mb-4" data-aos="fade-up">
                    <span class="badge bg-primary-subtle text-primary fw-bold text-uppercase px-3 py-2 rounded-pill mb-2">Got Questions?</span>
                    <h2 class="fw-bold mb-1" style="font-size: 1.85rem;">
                        Frequently Asked <span style="color: var(--primary-color);">Questions</span>
                    </h2>
                    <p class="text-secondary small mb-0">Find answers to common questions about our engineering, solar, and technology solutions.</p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8" data-aos="fade-up">
                        <div class="accordion accordion-flush" id="enerixHomeFaq">
                            @foreach($faqs as $faq)
                                <div class="accordion-item mb-3 border rounded-3 overflow-hidden shadow-sm bg-white">
                                    <h2 class="accordion-header" id="faqHeading{{ $faq->id }}">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }} fw-bold text-dark py-3" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse{{ $faq->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="faqCollapse{{ $faq->id }}" style="font-size: 0.95rem;">
                                            <i class="bi bi-question-circle text-primary me-2"></i> {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="faqCollapse{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="faqHeading{{ $faq->id }}" data-bs-parent="#enerixHomeFaq">
                                        <div class="accordion-body text-secondary small lh-lg pt-0 pb-3">
                                            {!! nl2br(e($faq->answer)) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif --}}

    <!-- ================= 7. HAVE A PROJECT IN MIND? CTA BANNER ================= -->
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const heroBgActive = document.getElementById('heroBgActive');
        const heroBgNext = document.getElementById('heroBgNext');
        if (!heroBgActive || !heroBgNext) return;

        let currentHeroLayer = 1; // 1 = heroBgActive is visible, 2 = heroBgNext is visible
        let isSwapping = false;

        // 4-Photo State Model (1 Big Spotlight + 3 Side Previews)
        const photoState = {
            hero: {
                id: 'hero',
                src: @json($imgMain),
                alt: 'Enerix Engineer Solar Solutions',
                title: 'Solar & Renewable Energy'
            },
            top: {
                id: 'top',
                src: @json($imgTop),
                alt: 'Civil & Structural Construction',
                title: 'Civil Construction'
            },
            mid: {
                id: 'mid',
                src: @json($imgMid),
                alt: 'IT Datacenter & Technology',
                title: 'IT Datacenter'
            },
            bot: {
                id: 'bot',
                src: @json($imgBot),
                alt: 'Security & AI Surveillance',
                title: 'AI Surveillance'
            }
        };

        // Preload all 4 images into browser memory to eliminate any loading flicker
        Object.values(photoState).forEach(photo => {
            const preloader = new Image();
            preloader.src = photo.src;
        });

        // Setup click & keyboard interactions for the 3 side panels
        const panelItems = document.querySelectorAll('.hero-panel-item');

        panelItems.forEach(panel => {
            const slotKey = panel.getAttribute('data-slot');

            function performSwap() {
                if (isSwapping || !photoState[slotKey]) return;
                isSwapping = true;

                // 1. Snapshot the photo data for swap
                const clickedPhoto = Object.assign({}, photoState[slotKey]);
                const oldHeroPhoto = Object.assign({}, photoState.hero);

                // 2. Swap state data
                photoState.hero = clickedPhoto;
                photoState[slotKey] = oldHeroPhoto;

                // 3. Dual-layer Crossfade on Big Hero Canvas
                const outgoingLayer = (currentHeroLayer === 1) ? heroBgActive : heroBgNext;
                const incomingLayer = (currentHeroLayer === 1) ? heroBgNext : heroBgActive;

                incomingLayer.src = clickedPhoto.src;
                incomingLayer.alt = clickedPhoto.alt;

                // Trigger smooth layer transition
                incomingLayer.classList.add('is-active');
                outgoingLayer.classList.remove('is-active');
                currentHeroLayer = (currentHeroLayer === 1) ? 2 : 1;

                // 4. Panel Click Feedback & Image Swap
                panel.classList.add('is-swapping');
                const panelImg = panel.querySelector('.panel-img-holder img');
                const panelPill = panel.querySelector('.panel-caption-pill');

                if (panelImg) {
                    panelImg.style.opacity = '0.35';
                    panelImg.style.transform = 'scale(0.92)';

                    setTimeout(() => {
                        panelImg.src = oldHeroPhoto.src;
                        panelImg.alt = oldHeroPhoto.alt;
                        if (panelPill) {
                            panelPill.textContent = oldHeroPhoto.title;
                        }
                        panel.setAttribute('title', 'Click to view ' + oldHeroPhoto.title);
                        panelImg.style.opacity = '1';
                        panelImg.style.transform = '';
                    }, 180);
                }

                setTimeout(() => {
                    panel.classList.remove('is-swapping');
                    isSwapping = false;
                }, 520);
            }

            panel.addEventListener('click', performSwap);

            panel.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    performSwap();
                }
            });
        });
    });
</script>
@endpush

