<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Enerix Admin</title>
    @if ($settings?->favicon_path)
        <link rel="icon" href="{{ asset('storage/' . $settings->favicon_path) }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-w: 260px;
            --topbar-h: 64px;
            --navy: #07132b;
            --navy-mid: #0d1f45;
            --primary: #0072ce;
            --accent: #38bdf8;
            --sidebar-text: #94a3b8;
            --sidebar-hover: rgba(255,255,255,0.07);
            --sidebar-active-bg: rgba(0,114,206,0.18);
            --sidebar-active-text: #ffffff;
            --bg: #f1f5f9;
            --surface: #ffffff;
            --border: #e2e8f0;
            --text: #0f172a;
            --muted: #64748b;
        }

        *, *::before, *::after { box-sizing: border-box; }

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            font-size: 0.925rem;
        }

        /* ── LAYOUT ── */
        .admin-shell { display: flex; min-height: 100vh; }

        /* ── SIDEBAR ── */
        .adm-sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--navy);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 1040;
            overflow: hidden;
            border-right: 1px solid rgba(255, 255, 255, 0.07);
            transition: transform 0.28s cubic-bezier(0.4,0,0.2,1);
        }

        .adm-sidebar::-webkit-scrollbar { width: 4px; }
        .adm-sidebar::-webkit-scrollbar-track { background: transparent; }
        .adm-sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.12); border-radius: 4px; }

        /* ── MAIN CONTENT ── */
        .adm-main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── TOPBAR ── */
        .adm-topbar {
            height: var(--topbar-h);
            background: var(--navy);
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
            position: sticky;
            top: 0;
            z-index: 1030;
            display: flex;
            align-items: center;
            padding: 0 1.75rem;
            gap: 1rem;
        }

        /* ── PAGE BODY ── */
        .adm-body {
            flex: 1;
            padding: 1.75rem;
        }

        /* ── FLASH ALERTS ── */
        .adm-flash {
            border-radius: 12px;
            padding: 12px 16px;
            font-weight: 600;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.25rem;
            border: 1px solid;
        }

        .adm-flash.success {
            background: #f0fdf4;
            border-color: #bbf7d0;
            color: #15803d;
        }

        .adm-flash.danger {
            background: #fef2f2;
            border-color: #fecaca;
            color: #b91c1c;
        }

        /* ── MOBILE OVERLAY ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 1039;
        }

        @media (max-width: 991px) {
            .adm-sidebar { transform: translateX(-100%); }
            .adm-sidebar.is-open { transform: translateX(0); }
            .sidebar-overlay.is-open { display: block; }
            .adm-main { margin-left: 0; }
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<div class="admin-shell">
    @include('admin.partials.sidebar')

    <div class="adm-main">
        @include('admin.partials.topbar')

        <div class="adm-body">
            @if (session('success'))
                <div class="adm-flash success">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="adm-flash danger">
                    <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first() }}
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openSidebar()  { document.getElementById('adm-sidebar').classList.add('is-open');  document.getElementById('sidebarOverlay').classList.add('is-open'); }
    function closeSidebar() { document.getElementById('adm-sidebar').classList.remove('is-open'); document.getElementById('sidebarOverlay').classList.remove('is-open'); }
</script>
@stack('scripts')
</body>
</html>

