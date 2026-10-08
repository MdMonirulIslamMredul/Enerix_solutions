<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $settings?->meta_title ?? 'Enerix Solutions - Integrated Engineering & Renewable Energy')</title>
    <meta name="description" content="@yield('meta_description', $settings?->meta_description ?? 'Enerix Solutions delivers integrated engineering, solar energy, electrical, civil, and IT solutions.')">
    <meta name="keywords" content="@yield('meta_keywords', $settings?->seo_keywords ?? 'engineering, solar, IT, civil, electrical, Enerix')">
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Icons & AOS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @if ($settings?->favicon_path)
        <link rel="icon" href="{{ asset('storage/' . $settings->favicon_path) }}">
    @else
        <link rel="icon" href="{{ asset('images/enerix/logo.svg') }}">
    @endif

    <style>
        :root {
            --primary-color: {{ $settings?->primary_color ?? '#0072ce' }};
            --secondary-color: {{ $settings?->secondary_color ?? '#07132b' }};
            --accent-color: {{ $settings?->accent_color ?? '#00c6ff' }};
            --text-color: {{ $settings?->text_color ?? '#1e293b' }};
            --bg-color: {{ $settings?->bg_color ?? '#ffffff' }};
            --brand: var(--primary-color);
            --brand-2: var(--accent-color);
            --ink: var(--text-color);
            --bg: var(--bg-color);
            --surface-color: #ffffff;
            --surface-alt-color: #f8fafc;
            --border-color: rgba(15, 23, 42, 0.08);
            --muted-color: #64748b;
            --navbar-bg: #ffffff;
            --footer-bg: #07132b;
            --footer-text: #cbd5e1;
            --page-gradient: linear-gradient(180deg, #f8fafc 0%, #eef2ff 100%);
        }

        html {
            overflow-x: hidden;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: var(--ink);
            background-color: var(--bg);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Enerix Header & Navigation */
        .enerix-nav-link {
            color: #1e293b !important;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 8px 14px !important;
            position: relative;
            transition: color 0.2s ease;
        }

        .enerix-nav-link:hover,
        .enerix-nav-link.active {
            color: var(--primary-color) !important;
        }

        .enerix-nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 14px;
            right: 14px;
            height: 2.5px;
            background: var(--primary-color);
            border-radius: 2px;
        }

        /* Enerix Navbar Dropdown */
        .enerix-dropdown-toggle::after {
            display: none; /* hide default Bootstrap caret — we use bi-chevron-down */
        }

        .enerix-dropdown-menu {
            border-radius: 12px;
            padding: 6px;
            min-width: 200px;
            margin-top: 8px;
            background: #ffffff;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1) !important;
            border: 1px solid rgba(0, 0, 0, 0.06) !important;
            animation: dropdownFadeIn 0.18s ease;
        }

        @keyframes dropdownFadeIn {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .enerix-dropdown-item {
            border-radius: 8px;
            padding: 9px 14px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #1e293b;
            display: flex;
            align-items: center;
            transition: background 0.15s ease, color 0.15s ease;
        }

        .enerix-dropdown-item i {
            color: var(--primary-color);
            font-size: 1rem;
        }

        .enerix-dropdown-item:hover,
        .enerix-dropdown-item:focus {
            background: #f0f7ff;
            color: var(--primary-color);
        }

        .enerix-dropdown-item.active {
            background: #e8f3ff;
            color: var(--primary-color);
        }


        .btn-quote-pill {
            background-color: var(--primary-color);
            color: #ffffff !important;
            border-radius: 50px;
            padding: 8px 22px;
            font-weight: 700;
            font-size: 0.92rem;
            border: none;
            transition: all 0.25s ease;
            box-shadow: 0 4px 14px rgba(0, 114, 206, 0.25);
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }

        .btn-quote-pill:hover {
            background-color: #005bb5;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 114, 206, 0.35);
        }

        .btn-search-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .btn-search-icon:hover {
            background: #f1f5f9;
            color: var(--primary-color);
            border-color: #cbd5e1;
        }

        /* Enerix Custom Buttons */
        .btn-enerix-primary {
            background-color: var(--primary-color);
            color: #ffffff !important;
            border-radius: 50px;
            padding: 12px 28px;
            font-weight: 700;
            font-size: 0.98rem;
            border: none;
            transition: all 0.25s ease;
            box-shadow: 0 8px 24px rgba(0, 114, 206, 0.3);
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }

        .btn-enerix-primary:hover {
            background-color: #005bb5;
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(0, 114, 206, 0.4);
        }

        .btn-enerix-glass {
            background-color: rgba(255, 255, 255, 0.08);
            color: #ffffff !important;
            border: 1.5px solid rgba(255, 255, 255, 0.6);
            border-radius: 50px;
            padding: 12px 28px;
            font-weight: 600;
            font-size: 0.98rem;
            backdrop-filter: blur(8px);
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }

        .btn-enerix-glass:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: #ffffff;
            transform: translateY(-2px);
        }

        .btn-enerix-white {
            background-color: #ffffff;
            color: var(--primary-color) !important;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 800;
            font-size: 0.98rem;
            border: none;
            transition: all 0.25s ease;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }

        .btn-enerix-white:hover {
            background-color: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        /* Optimize fluid container margins on laptops and medium desktops */
        @media (min-width: 992px) and (max-width: 1399.98px) {
            .container-fluid.px-lg-5 {
                padding-left: 1.5rem !important;
                padding-right: 1.5rem !important;
            }
        }

        /* Solutions Cards */
        .solution-card {
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.09);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03);
        }

        .solution-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 38px rgba(0, 114, 206, 0.14);
            border-color: rgba(0, 114, 206, 0.25);
        }

        .solution-card-img-wrapper {
            position: relative;
            height: 135px;
            overflow: hidden;
        }

        .solution-card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.45s cubic-bezier(0.2, 0.8, 0.25, 1);
        }

        .solution-card:hover .solution-card-img-wrapper img {
            transform: scale(1.08);
        }

        .solution-card-body {
            padding: 0 1.15rem 1.25rem 1.15rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        @media (min-width: 1200px) and (max-width: 1399.98px) {
            .solution-card-body {
                padding: 0 0.75rem 1.1rem 0.75rem;
            }
        }

        /* Header Row with Icon Badge & Title */
        .solution-header-row {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 12px;
            position: relative;
            z-index: 3;
            min-height: 66px; /* Aligns titles and bullet points evenly across cards */
        }

        @media (min-width: 1200px) and (max-width: 1399.98px) {
            .solution-header-row {
                gap: 8px;
                margin-bottom: 10px;
                min-height: 58px;
            }
        }

        /* Full Size Circular Icon Badge */
        .solution-icon-badge {
            width: 58px;
            height: 58px;
            min-width: 58px;
            margin-top: -29px; /* Floats ONLY the circular badge up over the image seam */
            background: linear-gradient(135deg, #0080e6 0%, #0060b8 100%);
            color: #ffffff;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 3.5px solid #ffffff;
            box-shadow: 0 6px 16px rgba(0, 114, 206, 0.32);
            transition: all 0.3s cubic-bezier(0.2, 0.8, 0.25, 1);
            flex-shrink: 0;
            position: relative;
            z-index: 5;
        }

        @media (min-width: 1200px) and (max-width: 1399.98px) {
            .solution-icon-badge {
                width: 44px;
                height: 44px;
                min-width: 44px;
                margin-top: -22px;
                border-width: 3px;
                box-shadow: 0 4px 12px rgba(0, 114, 206, 0.28);
            }
        }

        .solution-card:hover .solution-icon-badge {
            transform: scale(1.06);
            box-shadow: 0 8px 22px rgba(0, 114, 206, 0.45);
        }

        /* Full Size Icon Inside Badge */
        .solution-icon-badge i {
            font-size: 1.75rem;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .solution-icon-badge svg {
            width: 32px;
            height: 32px;
            display: block;
        }

        @media (min-width: 1200px) and (max-width: 1399.98px) {
            .solution-icon-badge i {
                font-size: 1.3rem;
            }
            .solution-icon-badge svg {
                width: 22px;
                height: 22px;
            }
        }

        .solution-title {
            font-size: 0.98rem;
            font-weight: 800;
            color: #07132b;
            line-height: 1.25;
            margin-top: 8px; /* Lowers down the title onto the clean white card background */
            margin-bottom: 0;
            flex: 1;
            min-width: 0; /* Prevents text overflow and allows proper word wrapping */
            word-break: normal;
            overflow-wrap: break-word;
            hyphens: manual;
        }

        @media (min-width: 1200px) and (max-width: 1399.98px) {
            .solution-title {
                font-size: 0.85rem;
                line-height: 1.22;
                margin-top: 3px;
                letter-spacing: -0.2px;
            }
        }

        .solution-title a {
            color: #07132b;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .solution-title a:hover {
            color: var(--primary-color, #0072ce);
        }

        .solution-bullet-list {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 0.82rem;
            color: #475569;
        }

        @media (min-width: 1200px) and (max-width: 1399.98px) {
            .solution-bullet-list {
                font-size: 0.77rem;
            }
            .solution-bullet-list li {
                padding-left: 12px;
                margin-bottom: 4px;
                line-height: 1.3;
            }
            .solution-bullet-list li::before {
                font-size: 0.95rem;
            }
        }

        .solution-bullet-list li {
            position: relative;
            padding-left: 14px;
            margin-bottom: 5px;
            line-height: 1.35;
        }

        .solution-bullet-list li::before {
            content: '•';
            color: var(--primary-color, #0072ce);
            font-weight: 900;
            position: absolute;
            left: 0;
            top: -1px;
            font-size: 1.05rem;
        }

        /* Why Enerix Badges Grid & Badges */
        .why-badges-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            align-items: start;
            justify-items: center;
            width: 100%;
        }

        .why-badge {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            color: #ffffff;
            width: 100%;
        }

        .why-badge-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.16);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: var(--accent-color, #38bdf8);
            margin-bottom: 8px;
            transition: all 0.25s ease;
        }

        @media (min-width: 1200px) and (max-width: 1399.98px) {
            .why-badge-icon {
                width: 42px;
                height: 42px;
                font-size: 1.25rem;
                margin-bottom: 6px;
            }
        }

        .why-badge:hover .why-badge-icon {
            background: rgba(0, 198, 255, 0.2);
            transform: scale(1.08);
            border-color: var(--accent-color, #38bdf8);
        }

        .why-badge-text {
            font-size: 0.8rem;
            font-weight: 600;
            line-height: 1.25;
            max-width: 105px;
            color: #e2e8f0;
            text-align: center;
            display: block;
        }

        @media (min-width: 1200px) and (max-width: 1399.98px) {
            .why-badge-text {
                font-size: 0.77rem;
                max-width: 96px;
                line-height: 1.22;
            }
        }

        .why-stats-col {
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            padding-top: 1.5rem;
        }

        @media (min-width: 1200px) {
            .why-stats-col {
                border-top: none;
                padding-top: 0;
                border-left: 1px solid rgba(255, 255, 255, 0.15);
                padding-left: 1.5rem;
            }
        }

        @media (max-width: 991.98px) {
            .why-badges-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 18px 12px;
            }
        }

        @media (max-width: 575.98px) {
            .why-badges-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px 10px;
            }
        }

        @media (min-width: 1200px) {
            .row-cols-xl-7 > * {
                flex: 0 0 auto;
                width: 14.285714%;
            }
        }

        /* Industry Card */
        .industry-card {
            position: relative;
            border-radius: 14px;
            overflow: hidden;
            height: 155px;
            display: block;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        }

        .industry-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .industry-card:hover img {
            transform: scale(1.08);
        }

        .industry-badge-pill {
            position: absolute;
            bottom: 8px;
            left: 8px;
            right: 8px;
            background: rgba(7, 19, 43, 0.88);
            backdrop-filter: blur(8px);
            color: #ffffff;
            padding: 5px 8px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 700;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.15);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: background 0.2s ease;
        }

        .industry-card:hover .industry-badge-pill {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Project Card */
        .project-card {
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            text-decoration: none;
            display: flex;
            flex-direction: column;
        }

        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 36px rgba(0, 114, 206, 0.1);
            border-color: rgba(0, 114, 206, 0.25);
        }

        .project-img-wrapper {
            height: 150px;
            overflow: hidden;
            position: relative;
        }

        .project-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .project-card:hover .project-img-wrapper img {
            transform: scale(1.06);
        }

        .project-card-body {
            padding: 1.1rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        /* CTA Banner */
        .enerix-cta-banner {
            background: linear-gradient(135deg, #0072ce 0%, #005bb5 100%);
            color: #ffffff;
            padding: 2.8rem 0;
            position: relative;
            overflow: hidden;
        }

        /* Floating WhatsApp Button - Circular FAB */
        .whatsapp-float {
            position: fixed;
            right: 1.5rem;
            bottom: 1.5rem;
            z-index: 1080;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #25D366;
            color: #ffffff !important;
            text-decoration: none;
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4), 0 4px 10px rgba(0, 0, 0, 0.12);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            animation: whatsapp-pulse 2.8s infinite;
        }

        .whatsapp-float:hover,
        .whatsapp-float:focus-visible {
            transform: scale(1.1) translateY(-2px);
            background-color: #20ba5a;
            color: #ffffff !important;
            box-shadow: 0 14px 30px rgba(37, 211, 102, 0.55), 0 6px 14px rgba(0, 0, 0, 0.18);
            animation: none;
        }

        .whatsapp-float .whatsapp-icon-svg {
            width: 34px;
            height: 34px;
            fill: #ffffff;
            transition: transform 0.25s ease;
        }

        .whatsapp-float:hover .whatsapp-icon-svg {
            transform: scale(1.08);
        }

        /* Tooltip that slides out smoothly on hover */
        .whatsapp-float .whatsapp-tooltip {
            position: absolute;
            right: calc(100% + 12px);
            top: 50%;
            transform: translateY(-50%) translateX(8px);
            background: #0f172a;
            color: #ffffff;
            font-size: 0.82rem;
            font-weight: 600;
            white-space: nowrap;
            padding: 6px 14px;
            border-radius: 50px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: all 0.25s ease;
        }

        .whatsapp-float .whatsapp-tooltip::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -6px;
            transform: translateY(-50%);
            border-width: 6px 0 6px 6px;
            border-style: solid;
            border-color: transparent transparent transparent #0f172a;
        }

        .whatsapp-float:hover .whatsapp-tooltip {
            opacity: 1;
            visibility: visible;
            transform: translateY(-50%) translateX(0);
        }

        @keyframes whatsapp-pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.65), 0 10px 25px rgba(37, 211, 102, 0.4);
            }
            70% {
                box-shadow: 0 0 0 14px rgba(37, 211, 102, 0), 0 10px 25px rgba(37, 211, 102, 0.4);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0), 0 10px 25px rgba(37, 211, 102, 0.4);
            }
        }

        @media (max-width: 575px) {
            .whatsapp-float {
                right: 1.1rem;
                bottom: 1.1rem;
                width: 54px;
                height: 54px;
            }

            .whatsapp-float .whatsapp-icon-svg {
                width: 30px;
                height: 30px;
            }

            .whatsapp-float .whatsapp-tooltip {
                display: none;
            }
        }
        }


        /* Flash alert floating */
        .flash-alert-floating {
            position: fixed;
            left: 0;
            right: 0;
            top: 76px;
            z-index: 1060;
            pointer-events: none;
            display: flex;
            justify-content: center;
            padding: 0.5rem;
        }

        .flash-alert-floating .alert {
            pointer-events: auto;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(2, 6, 23, 0.12);
        }

        /* Footer social icons */
        .footer-social-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .footer-social-btn:hover {
            background: var(--primary-color);
            color: #ffffff;
            transform: translateY(-2px);
        }

        .footer-link {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-link:hover {
            color: var(--accent-color);
        }
    </style>
    @stack('styles')
</head>

<body>
    @include('frontend.partials.navbar')

    @if (session('success') || session('error') || session('status') || $errors->any())
        <div class="flash-alert-floating" aria-live="polite">
            <div class="container">
                <div class="d-flex justify-content-center">
                    <div class="w-100" style="max-width:900px;">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    @include('frontend.partials.footer')

    @if ($settings?->whatsapp_number ?? $settings?->contact_phone)
        @php
            $waRaw = $settings->whatsapp_number ?? $settings->contact_phone;
            $whatsappClean = preg_replace('/\D+/', '', $waRaw);
        @endphp
        @if ($whatsappClean)
            <a href="https://wa.me/{{ $whatsappClean }}" class="whatsapp-float" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp" title="Chat on WhatsApp">
                <span class="whatsapp-tooltip">Chat with us</span>
                <svg class="whatsapp-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                </svg>
            </a>
        @endif
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 650,
            offset: 40
        });
    </script>
    @stack('scripts')
</body>

</html>
