@php
    $navSetting = $settings ?? null;
    $currentRoute = request()->route()->getName();
@endphp

<!-- Enerix Modern Navbar -->
<nav class="navbar navbar-expand-xl navbar-light bg-white sticky-top shadow-sm py-2" id="mainHeaderNavbar" style="border-bottom: 1px solid rgba(0,0,0,0.06);">
    <div class="container-fluid px-lg-5">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center py-1" href="{{ route('home') }}">
            @if ($navSetting?->logo_path)
                <img src="{{ asset('storage/' . $navSetting->logo_path) }}" alt="{{ $navSetting->site_name ?? 'Enerix Solutions' }}" style="height: 44px; width: auto;" class="me-2">
            @else
                <img src="{{ asset('images/enerix/logo.svg') }}" alt="{{ $navSetting->site_name ?? 'Enerix Solutions' }}" style="height: 44px; width: auto;" class="me-2">
            @endif
        </a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler border-0 shadow-none p-2" type="button" data-bs-toggle="collapse" data-bs-target="#enerixNavbarContent" aria-controls="enerixNavbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav Links & Actions -->
        <div class="collapse navbar-collapse" id="enerixNavbarContent">
            <ul class="navbar-nav mx-auto mb-2 mb-xl-0 gap-lg-3 gap-xl-4 align-items-center">
                <li class="nav-item">
                    <a class="nav-link enerix-nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link enerix-nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        About Us
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link enerix-nav-link {{ request()->routeIs('solutions.*') || request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('solutions.index') }}">
                        Solutions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link enerix-nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" href="{{ route('projects.index') }}">
                        Projects
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link enerix-nav-link {{ request()->routeIs('industries.*') ? 'active' : '' }}" href="{{ route('industries.index') }}">
                        Industries
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link enerix-nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                        Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link enerix-nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}" href="{{ route('contact.index') }}">
                        Contact
                    </a>
                </li>
            </ul>

            <!-- Right Actions: Search + Get a Quote Button -->
            <div class="d-flex align-items-center gap-3 mt-3 mt-xl-0 justify-content-center">
                <!-- Search Button -->
                <button type="button" class="btn btn-search-icon" data-bs-toggle="modal" data-bs-target="#headerSearchModal" aria-label="Search website">
                    <i class="bi bi-search"></i>
                </button>

                <!-- Get a Quote Button -->
                <a href="{{ route('quote') }}" class="btn btn-quote-pill">
                    Get a Quote <i class="bi bi-arrow-right ms-1"></i>
                </a>

                <!-- User Account / Admin Badge if logged in -->
                @auth
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle rounded-pill px-3" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                            @if (auth()->user()->is_admin)
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Admin Dashboard</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="bi bi-person me-2"></i>My Dashboard</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ auth()->user()->is_admin ? route('admin.logout') : route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Header Search Modal -->
<div class="modal fade" id="headerSearchModal" tabindex="-1" aria-labelledby="headerSearchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-0 bg-light pb-0">
                <h5 class="modal-title fw-bold fs-6" id="headerSearchModalLabel">Search Enerix Solutions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('products.index') }}" method="GET">
                    <div class="input-group input-group-lg border rounded-pill overflow-hidden shadow-sm">
                        <span class="input-group-text bg-white border-0 ps-3"><i class="bi bi-search text-primary"></i></span>
                        <input type="text" name="search" class="form-control border-0 shadow-none ps-2" placeholder="Search solutions, products, projects..." autofocus required>
                        <button class="btn btn-primary px-4 fw-semibold" type="submit">Search</button>
                    </div>
                </form>
                <div class="mt-3 d-flex flex-wrap gap-2 align-items-center">
                    <span class="small text-muted">Popular:</span>
                    <a href="{{ route('solutions.index') }}" class="badge bg-light text-dark text-decoration-none border">Solar Energy</a>
                    <a href="{{ route('solutions.index') }}" class="badge bg-light text-dark text-decoration-none border">Electrical Substation</a>
                    <a href="{{ route('projects.index') }}" class="badge bg-light text-dark text-decoration-none border">Commercial Rooftop</a>
                    <a href="{{ route('industries.index') }}" class="badge bg-light text-dark text-decoration-none border">Hospitals</a>
                </div>
            </div>
        </div>
    </div>
</div>
