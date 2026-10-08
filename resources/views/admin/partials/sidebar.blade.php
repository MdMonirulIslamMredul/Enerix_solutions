@php
    $route = request()->route()?->getName() ?? '';

    // Auto-expand helpers
    $webOpen  = str_starts_with($route, 'admin.settings') || str_starts_with($route, 'admin.page-content') ||
                str_starts_with($route, 'admin.homepage-carousel') || str_starts_with($route, 'admin.counters') ||
                str_starts_with($route, 'admin.testimonials') || str_starts_with($route, 'admin.faqs') ||
                str_starts_with($route, 'admin.about') || str_starts_with($route, 'admin.team-members') ||
                str_starts_with($route, 'admin.blogs') || str_starts_with($route, 'admin.galleries');

    $solOpen  = str_starts_with($route, 'admin.services') || str_starts_with($route, 'admin.projects') ||
                str_starts_with($route, 'admin.industries');

    $prodOpen = str_starts_with($route, 'admin.products') || str_starts_with($route, 'admin.product-categories') ||
                str_starts_with($route, 'admin.product-subcategories');

    $mgmtOpen = str_starts_with($route, 'admin.users') || str_starts_with($route, 'admin.roles') ||
                str_starts_with($route, 'admin.permissions');
@endphp

<style>
    /* ── SIDEBAR STYLES ── */
    .adm-sidebar {
        padding: 0;
        position: fixed;
        background: var(--navy);
        overflow: hidden;
        border-right: 1px solid rgba(255, 255, 255, 0.07);
    }

    /* Background elements matching login page */
    .sb-bg {
        position: absolute;
        inset: 0;
        pointer-events: none;
        overflow: hidden;
        z-index: 0;
    }

    .sb-grid {
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(0, 114, 206, 0.07) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 114, 206, 0.07) 1px, transparent 1px);
        background-size: 48px 48px;
        animation: sbGridScroll 20s linear infinite;
        will-change: background-position;
    }

    @keyframes sbGridScroll {
        from { background-position: 0 0; }
        to { background-position: 48px 48px; }
    }

    @media (prefers-reduced-motion: reduce) {
        .sb-grid { animation: none; }
    }

    .sb-orb {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }

    .sb-orb-top {
        top: -120px;
        right: -90px;
        width: 360px;
        height: 360px;
        background: radial-gradient(circle, rgba(0, 114, 206, 0.28) 0%, transparent 70%);
    }

    .sb-orb-mid {
        top: 42%;
        right: -80px;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(0, 114, 206, 0.16) 0%, transparent 70%);
    }

    .sb-orb-bottom {
        bottom: -80px;
        left: -80px;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(56, 189, 248, 0.16) 0%, transparent 70%);
    }

    .sb-logo {
        position: relative;
        z-index: 1;
        flex-shrink: 0;
        display: flex; align-items: center; gap: 10px;
        padding: 1.1rem 1.25rem 1rem;
        border-bottom: 1px solid rgba(255,255,255,0.06);
        text-decoration: none;
    }

    .sb-logo img { height: 38px; width: auto; filter: brightness(0) invert(1); }

    .sb-logo-text { line-height: 1.1; }
    .sb-logo-text strong { display: block; color: #ffffff; font-size: 0.9rem; font-weight: 800; }
    .sb-logo-text span   { display: block; color: #64748b; font-size: 0.68rem; letter-spacing: 1px; text-transform: uppercase; }

    .sb-nav {
        position: relative;
        z-index: 1;
        flex: 1;
        padding: 0.75rem 0.75rem;
        overflow-y: auto;
        overflow-x: hidden;
        scrollbar-width: thin;
        scrollbar-color: rgba(255, 255, 255, 0.12) transparent;
    }

    .sb-nav::-webkit-scrollbar { width: 4px; }
    .sb-nav::-webkit-scrollbar-track { background: transparent; }
    .sb-nav::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.12); border-radius: 4px; }
    .sb-nav::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.22); }

    .sb-section-label {
        font-size: 0.65rem; font-weight: 700; letter-spacing: 1.4px;
        text-transform: uppercase; color: #475569;
        padding: 0.9rem 0.75rem 0.35rem;
        display: block;
    }

    /* Single link */
    .sb-link {
        display: flex; align-items: center; gap: 11px;
        padding: 8px 12px; border-radius: 10px; margin-bottom: 3px;
        color: #94a3b8; text-decoration: none; font-size: 0.875rem; font-weight: 600;
        transition: background 0.15s ease, color 0.15s ease;
        white-space: nowrap;
    }

    .sb-link:hover { background: rgba(255,255,255,0.06); color: #e2e8f0; }
    .sb-link.active { background: rgba(0,114,206,0.2); color: #ffffff; }

    /* Group toggle */
    .sb-group-toggle {
        display: flex; align-items: center; justify-content: space-between;
        padding: 8px 12px; border-radius: 10px; margin-bottom: 3px;
        color: #94a3b8; text-decoration: none; font-size: 0.875rem; font-weight: 600;
        cursor: pointer; transition: background 0.15s ease, color 0.15s ease;
        border: none; background: none; width: 100%; text-align: left;
    }

    .sb-group-toggle .sg-left { display: flex; align-items: center; gap: 11px; }
    .sb-group-toggle i.sg-caret { font-size: 0.72rem; transition: transform 0.25s ease; }
    .sb-group-toggle:hover { background: rgba(255,255,255,0.06); color: #e2e8f0; }
    .sb-group-toggle.open { color: #e2e8f0; }
    .sb-group-toggle.open i.sg-caret { transform: rotate(180deg); }
    .sb-group-toggle.group-active { background: rgba(0,114,206,0.12); color: #ffffff; }

    /* ── Colored Main Menu Icons ── */
    .sb-icon-box {
        width: 30px;
        height: 30px;
        border-radius: 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        flex-shrink: 0;
        transition: transform 0.2s ease, filter 0.2s ease, box-shadow 0.2s ease;
    }

    .sb-icon-box i {
        width: auto !important;
        font-size: 0.95rem;
        line-height: 1;
        text-align: center;
    }

    .sb-link:hover .sb-icon-box,
    .sb-group-toggle:hover .sb-icon-box {
        transform: scale(1.08);
        filter: brightness(1.2);
    }

    /* 1. Dashboard: Electric Cyan/Blue */
    .sb-icon-dash {
        background: rgba(56, 189, 248, 0.15);
        border: 1px solid rgba(56, 189, 248, 0.3);
        color: #38bdf8;
    }
    .sb-link.active .sb-icon-dash {
        background: rgba(56, 189, 248, 0.25);
        border-color: #38bdf8;
        box-shadow: 0 0 12px rgba(56, 189, 248, 0.45);
    }

    /* 2. Contact Messages: Emerald Green */
    .sb-icon-contacts {
        background: rgba(52, 211, 153, 0.15);
        border: 1px solid rgba(52, 211, 153, 0.3);
        color: #34d399;
    }
    .sb-link.active .sb-icon-contacts {
        background: rgba(52, 211, 153, 0.25);
        border-color: #34d399;
        box-shadow: 0 0 12px rgba(52, 211, 153, 0.45);
    }

    /* 3. Web Settings: Royal Purple / Violet */
    .sb-icon-web {
        background: rgba(167, 139, 250, 0.15);
        border: 1px solid rgba(167, 139, 250, 0.3);
        color: #a78bfa;
    }
    .sb-group-toggle.group-active .sb-icon-web,
    .sb-group-toggle.open .sb-icon-web {
        background: rgba(167, 139, 250, 0.25);
        border-color: #a78bfa;
        box-shadow: 0 0 12px rgba(167, 139, 250, 0.45);
    }

    /* 4. Solutions & Work: Amber Gold */
    .sb-icon-solutions {
        background: rgba(251, 191, 36, 0.15);
        border: 1px solid rgba(251, 191, 36, 0.3);
        color: #fbbf24;
    }
    .sb-group-toggle.group-active .sb-icon-solutions,
    .sb-group-toggle.open .sb-icon-solutions {
        background: rgba(251, 191, 36, 0.25);
        border-color: #fbbf24;
        box-shadow: 0 0 12px rgba(251, 191, 36, 0.45);
    }

    /* 5. Products: Coral Rose / Pink */
    .sb-icon-products {
        background: rgba(251, 113, 133, 0.15);
        border: 1px solid rgba(251, 113, 133, 0.3);
        color: #fb7185;
    }
    .sb-group-toggle.group-active .sb-icon-products,
    .sb-group-toggle.open .sb-icon-products {
        background: rgba(251, 113, 133, 0.25);
        border-color: #fb7185;
        box-shadow: 0 0 12px rgba(251, 113, 133, 0.45);
    }

    /* 6. Management: Indigo / Sky */
    .sb-icon-mgmt {
        background: rgba(96, 165, 250, 0.15);
        border: 1px solid rgba(96, 165, 250, 0.3);
        color: #60a5fa;
    }
    .sb-group-toggle.group-active .sb-icon-mgmt,
    .sb-group-toggle.open .sb-icon-mgmt {
        background: rgba(96, 165, 250, 0.25);
        border-color: #60a5fa;
        box-shadow: 0 0 12px rgba(96, 165, 250, 0.45);
    }

    /* Sub-menu */
    .sb-submenu {
        overflow: hidden;
        max-height: 0;
        transition: max-height 0.3s cubic-bezier(0.4,0,0.2,1);
        padding-left: 0.5rem;
    }

    .sb-submenu.open { max-height: 600px; }

    .sb-sub-link {
        display: flex; align-items: center; gap: 8px;
        padding: 7px 12px 7px 30px; border-radius: 8px; margin-bottom: 1px;
        color: #64748b; text-decoration: none; font-size: 0.835rem; font-weight: 500;
        position: relative; transition: background 0.15s ease, color 0.15s ease;
    }

    .sb-sub-link::before {
        content: '';
        position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
        width: 5px; height: 5px; border-radius: 50%;
        background: #334155; transition: background 0.15s ease;
    }

    .sb-sub-link:hover { background: rgba(255,255,255,0.05); color: #cbd5e1; }
    .sb-sub-link:hover::before { background: #38bdf8; }
    .sb-sub-link.active { background: rgba(0,114,206,0.15); color: #ffffff; font-weight: 600; }
    .sb-sub-link.active::before { background: #0072ce; width: 6px; height: 6px; }

    /* Bottom actions */
    .sb-bottom {
        position: relative;
        z-index: 1;
        flex-shrink: 0;
        padding: 0.75rem;
        border-top: 1px solid rgba(255,255,255,0.06);
    }

    @media (max-height: 520px) {
        .adm-sidebar { overflow-y: auto !important; }
        .sb-nav { overflow-y: visible; }
    }

    .sb-action-btn {
        display: flex; align-items: center; gap: 9px;
        width: 100%; padding: 8px 12px; border-radius: 10px;
        font-size: 0.835rem; font-weight: 600; text-decoration: none;
        transition: background 0.15s ease, color 0.15s ease;
        border: 1.5px solid; cursor: pointer; background: none;
        margin-bottom: 6px;
    }

    .sb-action-btn.visit {
        color: #38bdf8; border-color: rgba(56,189,248,0.25);
    }

    .sb-action-btn.visit:hover { background: rgba(56,189,248,0.1); color: #7dd3fc; }

    .sb-action-btn.logout {
        color: #f87171; border-color: rgba(248,113,113,0.25);
    }

    .sb-action-btn.logout:hover { background: rgba(248,113,113,0.1); color: #fca5a5; }

    /* User chip at bottom */
    .sb-user-chip {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px; margin-bottom: 8px;
        background: rgba(255,255,255,0.04);
        border-radius: 12px; border: 1px solid rgba(255,255,255,0.06);
    }

    .sb-avatar {
        width: 34px; height: 34px; border-radius: 50%;
        background: linear-gradient(135deg, #0072ce 0%, #38bdf8 100%);
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-weight: 800; font-size: 0.85rem; flex-shrink: 0;
    }

    .sb-user-info { overflow: hidden; }
    .sb-user-name { display: block; font-size: 0.82rem; font-weight: 700; color: #e2e8f0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .sb-user-role { display: block; font-size: 0.68rem; color: #64748b; }
</style>

<aside class="adm-sidebar" id="adm-sidebar">

    {{-- Background elements matching login page --}}
    <div class="sb-bg" aria-hidden="true">
        <div class="sb-grid"></div>
        <div class="sb-orb sb-orb-top"></div>
        <div class="sb-orb sb-orb-mid"></div>
        <div class="sb-orb sb-orb-bottom"></div>
    </div>

    {{-- Logo --}}
      <div style="position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.06); padding-right: 14px;">
          <a href="{{ route('admin.dashboard') }}" class="sb-logo" style="border-bottom: none; flex: 1;">
        @if ($settings?->logo_path)
            <img src="{{ asset('storage/' . $settings->logo_path) }}" alt="Logo">
        @else
            <img src="{{ asset('images/enerix/logo-white.svg') }}" alt="Enerix">
        @endif
        <div class="sb-logo-text">
            <strong>{{ $settings->site_name ?? 'Enerix' }}</strong>
            <span>Admin Panel</span>
        </div>
    </a>
          <a href="{{ route('home') }}" target="_blank" class="tb-icon-btn" title="View Frontend Website" style="width: 32px; height: 32px; font-size: 0.82rem; border-radius: 8px; flex-shrink: 0;">
              <i class="bi bi-box-arrow-up-right"></i>
          </a>
      </div>

    {{-- Nav --}}
    <nav class="sb-nav">

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
           class="sb-link {{ $route === 'admin.dashboard' ? 'active' : '' }}">
            <span class="sb-icon-box sb-icon-dash"><i class="bi bi-grid-1x2-fill"></i></span>
            <span>Dashboard</span>
        </a>

        {{-- Contact Inquiries & Quotes --}}
        @php
            $unreadContactCount = \App\Models\Contact::whereNull('read_at')->count();
        @endphp
        <a href="{{ route('admin.contacts.index') }}"
           class="sb-link {{ str_starts_with($route, 'admin.contacts') ? 'active' : '' }}">
            <span class="sb-icon-box sb-icon-contacts"><i class="bi bi-chat-left-dots-fill"></i></span>
            <span class="flex-grow-1">Contact Messages</span>
            @if ($unreadContactCount > 0)
                <span class="badge bg-danger rounded-pill px-2" style="font-size: 0.68rem; font-weight: 700;">{{ $unreadContactCount }}</span>
            @endif
        </a>

        {{-- WEB SETTINGS --}}
        @can('Web_Settings')
            <span class="sb-section-label">Website</span>

            <button class="sb-group-toggle {{ $webOpen ? 'open group-active' : '' }}"
                    onclick="toggleGroup('webMenu', this)">
                <span class="sg-left">
                    <span class="sb-icon-box sb-icon-web"><i class="bi bi-globe"></i></span>
                    <span>Web Settings</span>
                </span>
                <i class="bi bi-chevron-down sg-caret"></i>
            </button>
            <div class="sb-submenu {{ $webOpen ? 'open' : '' }}" id="webMenu">
                <a href="{{ route('admin.settings.edit') }}"
                   class="sb-sub-link {{ str_starts_with($route,'admin.settings') ? 'active' : '' }}">General &amp; Hero</a>
                <a href="{{ route('admin.page-content.edit') }}"
                   class="sb-sub-link {{ str_starts_with($route,'admin.page-content') ? 'active' : '' }}">about Content</a>
                {{-- <a href="{{ route('admin.homepage-carousel-images.index') }}"
                   class="sb-sub-link {{ str_starts_with($route,'admin.homepage-carousel') ? 'active' : '' }}">Hero Slides</a> --}}
                <a href="{{ route('admin.counters.index') }}"
                   class="sb-sub-link {{ str_starts_with($route,'admin.counters') ? 'active' : '' }}">Counters &amp; Stats</a>
                {{-- <a href="{{ route('admin.testimonials.index') }}"
                   class="sb-sub-link {{ str_starts_with($route,'admin.testimonials') ? 'active' : '' }}">Testimonials</a> --}}
                <a href="{{ route('admin.faqs.index') }}"
                   class="sb-sub-link {{ str_starts_with($route,'admin.faqs') ? 'active' : '' }}">FAQs</a>
                <a href="{{ route('admin.about.edit') }}"
                   class="sb-sub-link {{ str_starts_with($route,'admin.about') ? 'active' : '' }}">About Page</a>
                <a href="{{ route('admin.team-members.index') }}"
                   class="sb-sub-link {{ str_starts_with($route,'admin.team-members') ? 'active' : '' }}">Team Members</a>
                {{-- <a href="{{ route('admin.blogs.index') }}"
                   class="sb-sub-link {{ str_starts_with($route,'admin.blogs') ? 'active' : '' }}">Blogs</a> --}}
                {{-- <a href="{{ route('admin.galleries.index') }}"
                   class="sb-sub-link {{ str_starts_with($route,'admin.galleries') ? 'active' : '' }}">Gallery</a> --}}
            </div>
        @endcan

        {{-- SOLUTIONS & WORK --}}
        @canany(['manage services', 'manage projects', 'manage industries'])
            <span class="sb-section-label">Content</span>

            <button class="sb-group-toggle {{ $solOpen ? 'open group-active' : '' }}"
                    onclick="toggleGroup('solMenu', this)">
                <span class="sg-left">
                    <span class="sb-icon-box sb-icon-solutions"><i class="bi bi-diagram-3-fill"></i></span>
                    <span>Solutions &amp; Work</span>
                </span>
                <i class="bi bi-chevron-down sg-caret"></i>
            </button>
            <div class="sb-submenu {{ $solOpen ? 'open' : '' }}" id="solMenu">
                @can('manage services')
                    <a href="{{ route('admin.services.index') }}"
                       class="sb-sub-link {{ str_starts_with($route,'admin.services') ? 'active' : '' }}">Solutions</a>
                @endcan
                @can('manage projects')
                    <a href="{{ route('admin.projects.index') }}"
                       class="sb-sub-link {{ str_starts_with($route,'admin.projects') ? 'active' : '' }}">Projects</a>
                @endcan
                @can('manage industries')
                    <a href="{{ route('admin.industries.index') }}"
                       class="sb-sub-link {{ str_starts_with($route,'admin.industries') ? 'active' : '' }}">Industries</a>
                @endcan
            </div>
        @endcanany

        {{-- PRODUCTS --}}
        {{-- @can('manage products')
            <button class="sb-group-toggle {{ $prodOpen ? 'open group-active' : '' }}"
                    onclick="toggleGroup('prodMenu', this)">
                <span class="sg-left">
                    <span class="sb-icon-box sb-icon-products"><i class="bi bi-box-seam-fill"></i></span>
                    <span>Products</span>
                </span>
                <i class="bi bi-chevron-down sg-caret"></i>
            </button>
            <div class="sb-submenu {{ $prodOpen ? 'open' : '' }}" id="prodMenu">
                <a href="{{ route('admin.products.index') }}"
                   class="sb-sub-link {{ str_starts_with($route,'admin.products') && !str_contains($route,'categor') ? 'active' : '' }}">All Products</a>
                <a href="{{ route('admin.product-categories.index') }}"
                   class="sb-sub-link {{ str_starts_with($route,'admin.product-categories') ? 'active' : '' }}">Categories</a>
                <a href="{{ route('admin.product-subcategories.index') }}"
                   class="sb-sub-link {{ str_starts_with($route,'admin.product-subcategories') ? 'active' : '' }}">Subcategories</a>
            </div>
        @endcan --}}

        {{-- MANAGEMENT --}}
        {{-- @canany(['manage users', 'manage roles', 'manage permissions'])
            <span class="sb-section-label">Admin</span>

            <button class="sb-group-toggle {{ $mgmtOpen ? 'open group-active' : '' }}"
                    onclick="toggleGroup('mgmtMenu', this)">
                <span class="sg-left">
                    <span class="sb-icon-box sb-icon-mgmt"><i class="bi bi-people-fill"></i></span>
                    <span>Management</span>
                </span>
                <i class="bi bi-chevron-down sg-caret"></i>
            </button>
            <div class="sb-submenu {{ $mgmtOpen ? 'open' : '' }}" id="mgmtMenu">
                @can('manage users')
                    <a href="{{ route('admin.users.index') }}"
                       class="sb-sub-link {{ str_starts_with($route,'admin.users') ? 'active' : '' }}">Users</a>
                @endcan
                @can('manage roles')
                    <a href="{{ route('admin.roles.index') }}"
                       class="sb-sub-link {{ str_starts_with($route,'admin.roles') ? 'active' : '' }}">Roles</a>
                @endcan
                @can('manage permissions')
                    <a href="{{ route('admin.permissions.index') }}"
                       class="sb-sub-link {{ str_starts_with($route,'admin.permissions') ? 'active' : '' }}">Permissions</a>
                @endcan
            </div>
        @endcanany --}}

    </nav>

    {{-- Bottom --}}
    <div class="sb-bottom">
        {{-- User chip --}}
        <div class="sb-user-chip">
            <div class="sb-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div class="sb-user-info">
                <span class="sb-user-name">{{ auth()->user()->name }}</span>
                <span class="sb-user-role">{{ auth()->user()->is_admin ? 'Administrator' : 'Staff' }}</span>
            </div>
        </div>

        <a href="{{ route('home') }}" target="_blank" class="sb-action-btn visit">
            <i class="bi bi-box-arrow-up-right"></i> Visit Website
        </a>

        <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="sb-action-btn logout">
                <i class="bi bi-box-arrow-right"></i> Log Out
            </button>
        </form>
    </div>

</aside>

@push('scripts')
<script>
    function toggleGroup(id, btn) {
        const menu = document.getElementById(id);
        const isOpen = menu.classList.contains('open');
        menu.classList.toggle('open', !isOpen);
        btn.classList.toggle('open', !isOpen);
    }
</script>
@endpush

