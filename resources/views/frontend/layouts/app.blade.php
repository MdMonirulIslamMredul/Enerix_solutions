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

        /* Solutions Cards */
        .solution-card {
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .solution-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0, 114, 206, 0.12);
            border-color: rgba(0, 114, 206, 0.2);
        }

        .solution-card-img-wrapper {
            position: relative;
            height: 140px;
            overflow: hidden;
        }

        .solution-card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .solution-card:hover .solution-card-img-wrapper img {
            transform: scale(1.08);
        }

        .solution-icon-badge {
            width: 44px;
            height: 44px;
            background: var(--primary-color);
            color: #ffffff;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            border: 3px solid #ffffff;
            box-shadow: 0 4px 12px rgba(0, 114, 206, 0.35);
            position: absolute;
            bottom: -16px;
            left: 18px;
            z-index: 2;
        }

        .solution-card-body {
            padding: 1.5rem 1.1rem 1.1rem 1.1rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .solution-title {
            font-size: 1.05rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.35;
            margin-bottom: 0.75rem;
        }

        .solution-bullet-list {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 0.84rem;
            color: #475569;
        }

        .solution-bullet-list li {
            position: relative;
            padding-left: 14px;
            margin-bottom: 5px;
            line-height: 1.3;
        }

        .solution-bullet-list li::before {
            content: '•';
            color: var(--primary-color);
            font-weight: 900;
            position: absolute;
            left: 0;
            top: -1px;
            font-size: 1rem;
        }

        /* Why Enerix Badges */
        .why-badge {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            color: #ffffff;
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
            color: var(--accent-color);
            margin-bottom: 8px;
            transition: all 0.25s ease;
        }

        .why-badge:hover .why-badge-icon {
            background: rgba(0, 198, 255, 0.2);
            transform: scale(1.08);
            border-color: var(--accent-color);
        }

        .why-badge-text {
            font-size: 0.8rem;
            font-weight: 600;
            line-height: 1.25;
            max-width: 105px;
            color: #e2e8f0;
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

        /* Floating WhatsApp Button */
        .whatsapp-float {
            position: fixed;
            right: 1.5rem;
            bottom: 1.5rem;
            z-index: 1080;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.85rem 1.1rem;
            border-radius: 999px;
            background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
            color: #ffffff;
            text-decoration: none;
            box-shadow: 0 12px 32px rgba(37, 211, 102, 0.35);
            transition: all 0.25s ease;
            font-weight: 700;
            font-size: 0.95rem;
        }

        .whatsapp-float:hover {
            transform: translateY(-3px) scale(1.02);
            color: #ffffff;
            box-shadow: 0 16px 40px rgba(37, 211, 102, 0.45);
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
            <a href="https://wa.me/{{ $whatsappClean }}" class="whatsapp-float" target="_blank" rel="noopener noreferrer" aria-label="Chat with Enerix on WhatsApp">
                <i class="bi bi-whatsapp fs-5"></i>
                <span class="d-none d-sm-inline">WhatsApp</span>
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
