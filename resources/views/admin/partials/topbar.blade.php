<style>
    .adm-topbar {
        position: sticky;
        top: 0;
        z-index: 1030;
        background: var(--navy);
        border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        justify-content: space-between;
    }

    /* Background elements matching sidebar and login page */
    .tb-bg {
        position: absolute;
        inset: 0;
        overflow: hidden;
        pointer-events: none;
        z-index: 0;
    }

    .tb-grid {
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(0, 114, 206, 0.07) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 114, 206, 0.07) 1px, transparent 1px);
        background-size: 48px 48px;
        animation: tbGridScroll 20s linear infinite;
        will-change: background-position;
    }

    @keyframes tbGridScroll {
        from { background-position: 0 0; }
        to { background-position: 48px 48px; }
    }

    @media (prefers-reduced-motion: reduce) {
        .tb-grid { animation: none; }
    }

    .tb-orb {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }

    .tb-orb-left {
        top: -60px;
        left: 40px;
        width: 220px;
        height: 180px;
        background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, transparent 70%);
    }

    .tb-orb-mid {
        top: -70px;
        left: 45%;
        width: 260px;
        height: 180px;
        background: radial-gradient(circle, rgba(0, 114, 206, 0.18) 0%, transparent 70%);
    }

    .tb-orb-right {
        top: -60px;
        right: 40px;
        width: 240px;
        height: 180px;
        background: radial-gradient(circle, rgba(0, 114, 206, 0.28) 0%, transparent 70%);
    }

    .tb-hamburger {
        display: none;
        position: relative;
        z-index: 1;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        cursor: pointer;
        color: #94a3b8;
        font-size: 1.25rem;
        padding: 5px 8px;
        border-radius: 8px;
        transition: all 0.15s ease;
    }
    .tb-hamburger:hover {
        background: rgba(0, 114, 206, 0.2);
        color: #ffffff;
        border-color: rgba(56, 189, 248, 0.4);
    }
    @media (max-width: 991px) {
        .tb-hamburger { display: inline-flex; align-items: center; }
    }

    .tb-title-wrap {
        position: relative;
        z-index: 1;
    }

    .tb-page-title {
        font-size: 1.05rem;
        font-weight: 800;
        color: #ffffff;
        letter-spacing: -0.2px;
        line-height: 1.2;
    }

    .tb-breadcrumb {
        font-size: 0.72rem;
        color: #64748b;
        margin-top: 2px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .tb-bc-sep {
        font-size: 0.65rem;
        color: #475569;
    }

    .tb-bc-current {
        color: var(--accent, #38bdf8);
        font-weight: 600;
    }

    .tb-right {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-left: auto;
    }

    .tb-icon-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(255, 255, 255, 0.05);
        color: #94a3b8;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .tb-icon-btn:hover {
        background: rgba(0, 114, 206, 0.22);
        border-color: rgba(56, 189, 248, 0.4);
        color: #38bdf8;
        box-shadow: 0 0 12px rgba(56, 189, 248, 0.25);
        transform: translateY(-1px);
    }

    .tb-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, #0072ce 0%, #38bdf8 100%);
        color: #ffffff;
        font-weight: 800;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 1.5px solid rgba(255, 255, 255, 0.2);
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0, 114, 206, 0.3);
    }
    .tb-avatar:hover {
        border-color: #38bdf8;
        box-shadow: 0 0 14px rgba(56, 189, 248, 0.4);
        transform: translateY(-1px);
    }

    /* Dark theme dropdown */
    .tb-dropdown {
        min-width: 210px;
        background: #08142c;
        border: 1px solid rgba(0, 114, 206, 0.3);
        border-radius: 14px;
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.05);
        padding: 6px;
        margin-top: 8px !important;
    }

    .tb-dropdown-header {
        padding: 8px 12px 10px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        margin-bottom: 4px;
    }

    .tb-dropdown-name {
        font-size: 0.84rem;
        font-weight: 700;
        color: #ffffff;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .tb-dropdown-role {
        font-size: 0.68rem;
        color: #64748b;
    }

    .tb-dropdown .dropdown-item {
        border-radius: 8px;
        font-size: 0.84rem;
        font-weight: 600;
        padding: 8px 12px;
        color: #94a3b8;
        display: flex;
        align-items: center;
        transition: all 0.15s ease;
    }

    .tb-dropdown .dropdown-item:hover {
        background: rgba(0, 114, 206, 0.2);
        color: #ffffff;
    }

    .tb-dropdown .dropdown-item i {
        font-size: 0.95rem;
        color: #38bdf8;
    }

    .tb-dropdown .dropdown-item.text-danger {
        color: #f87171 !important;
    }

    .tb-dropdown .dropdown-item.text-danger i {
        color: #f87171 !important;
    }

    .tb-dropdown .dropdown-item.text-danger:hover {
        background: rgba(239, 68, 68, 0.15);
        color: #fca5a5 !important;
    }

    .tb-dropdown .dropdown-divider {
        margin: 4px 0;
        border-color: rgba(255, 255, 255, 0.07);
    }
</style>

<div class="adm-topbar">
    {{-- Background elements matching sidebar and login page --}}
    <div class="tb-bg" aria-hidden="true">
        <div class="tb-grid"></div>
        <div class="tb-orb tb-orb-left"></div>
        <div class="tb-orb tb-orb-mid"></div>
        <div class="tb-orb tb-orb-right"></div>
    </div>

    {{-- Mobile hamburger --}}
    <button class="tb-hamburger" onclick="openSidebar()" aria-label="Open menu">
        <i class="bi bi-list"></i>
    </button>

    {{-- Page title --}}
    @php
        $topbarTitle = trim($__env->yieldContent('title')) ?: (trim($__env->yieldContent('page_title')) ?: 'Dashboard');
    @endphp
    <div class="tb-title-wrap ms-2">
        <div class="tb-page-title">{{ $topbarTitle }}</div>
        <div class="tb-breadcrumb">
            <span>Enerix Admin</span>
            <i class="bi bi-chevron-right tb-bc-sep"></i>
            <span class="tb-bc-current">{{ $topbarTitle }}</span>
        </div>
    </div>

    {{-- Right actions --}}
    <div class="tb-right">
        <a href="{{ route('home') }}" target="_blank" class="tb-icon-btn" title="View Website">
            <i class="bi bi-box-arrow-up-right"></i>
        </a>

        <div class="dropdown">
            <div class="tb-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <ul class="dropdown-menu dropdown-menu-end tb-dropdown">
                <li class="tb-dropdown-header">
                    <div class="tb-dropdown-name">{{ auth()->user()->name }}</div>
                    <div class="tb-dropdown-role">{{ auth()->user()->is_admin ? 'Administrator' : 'Staff' }}</div>
                </li>
                <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.password.edit') }}"><i class="bi bi-key me-2"></i>Change Password</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Log Out</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
