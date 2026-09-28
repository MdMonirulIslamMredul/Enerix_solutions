@php
    $footerSetting = $settings ?? null;
    $social = $footerSetting?->social_links ?? [];
@endphp

<!-- Enerix Modern Dark Navy Footer -->
<footer class="enerix-footer pt-5 pb-4" style="background-color: #07132b; color: #94a3b8; font-size: 0.92rem;">
    <div class="container-fluid px-lg-5">
        <div class="row g-4 justify-content-between mb-4">
            <!-- Brand & Intro Column -->
            <div class="col-lg-4 col-md-6">
                <div class="mb-3">
                    @if ($footerSetting?->logo_path)
                        <img src="{{ asset('storage/' . $footerSetting->logo_path) }}" alt="{{ $footerSetting?->site_name ?? 'Enerix Solutions' }}" style="height: 48px; width: auto; filter: brightness(0) invert(1);" class="mb-2">
                    @else
                        <img src="{{ asset('images/enerix/logo-white.svg') }}" alt="{{ $footerSetting?->site_name ?? 'Enerix Solutions' }}" style="height: 48px; width: auto;" class="mb-2">
                    @endif
                </div>
                <p class="text-secondary-subtle lh-base pe-lg-4" style="color: #cbd5e1; font-size: 0.88rem;">
                    {{ $footerSetting?->company_intro ?? 'Enerix Solutions is an integrated engineering and technology solutions company delivering reliable Solar, Electrical, Civil, Architectural and IT solutions for residential, commercial and industrial clients.' }}
                </p>
            </div>

            <!-- Solutions Column -->
            <div class="col-lg-2 col-md-3 col-6">
                <h6 class="text-white fw-bold mb-3 text-uppercase" style="font-size: 0.9rem; letter-spacing: 0.5px;">Solutions</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
                    <li><a href="{{ route('solutions.index') }}" class="footer-link">Solar Energy</a></li>
                    <li><a href="{{ route('solutions.index') }}" class="footer-link">Engineering</a></li>
                    <li><a href="{{ route('solutions.index') }}" class="footer-link">Electrical</a></li>
                    <li><a href="{{ route('solutions.index') }}" class="footer-link">IT Solutions</a></li>
                    <li><a href="{{ route('solutions.index') }}" class="footer-link">Security & Surveillance</a></li>
                </ul>
            </div>

            <!-- Quick Links Column -->
            <div class="col-lg-2 col-md-3 col-6">
                <h6 class="text-white fw-bold mb-3 text-uppercase" style="font-size: 0.9rem; letter-spacing: 0.5px;">Quick Links</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
                    <li><a href="{{ route('about') }}" class="footer-link">About Us</a></li>
                    <li><a href="{{ route('projects.index') }}" class="footer-link">Projects</a></li>
                    <li><a href="{{ route('industries.index') }}" class="footer-link">Industries</a></li>
                    <li><a href="{{ route('contact.index') }}" class="footer-link">Contact</a></li>
                    <li><a href="{{ route('quote') }}" class="footer-link">Get a Quote</a></li>
                </ul>
            </div>

            <!-- Contact & Social Column -->
            <div class="col-lg-3 col-md-6">
                <h6 class="text-white fw-bold mb-3 text-uppercase" style="font-size: 0.9rem; letter-spacing: 0.5px;">Contact</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 mb-4" style="color: #cbd5e1; font-size: 0.88rem;">
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-geo-alt text-primary"></i>
                        <span>{{ $footerSetting?->contact_address ?? 'Dhaka, Bangladesh' }}</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-telephone text-primary"></i>
                        <a href="tel:{{ $footerSetting?->contact_phone ?? '+880 1234 567890' }}" class="text-decoration-none text-light">
                            {{ $footerSetting?->contact_phone ?? '+880 1234 567890' }}
                        </a>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-envelope text-primary"></i>
                        <a href="mailto:{{ $footerSetting?->contact_email ?? 'info@enerixbd.com' }}" class="text-decoration-none text-light">
                            {{ $footerSetting?->contact_email ?? 'info@enerixbd.com' }}
                        </a>
                    </li>
                </ul>

                <h6 class="text-white fw-bold mb-2 text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Follow Us</h6>
                <div class="d-flex gap-2">
                    <a href="{{ $social['facebook'] ?? 'https://facebook.com' }}" target="_blank" class="footer-social-btn" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="{{ $social['linkedin'] ?? 'https://linkedin.com' }}" target="_blank" class="footer-social-btn" aria-label="LinkedIn">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="{{ $social['youtube'] ?? 'https://youtube.com' }}" target="_blank" class="footer-social-btn" aria-label="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a href="{{ route('home') }}" class="footer-social-btn" aria-label="Website">
                        <i class="bi bi-globe"></i>
                    </a>
                </div>
            </div>
        </div>

        <hr style="border-color: rgba(255, 255, 255, 0.1);" class="my-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2" style="font-size: 0.82rem; color: #64748b;">
            <div>
                &copy; {{ date('Y') }} {{ $footerSetting?->site_name ?? 'Enerix Solutions' }}. All rights reserved.
            </div>
            <div class="d-flex gap-3">
                <a href="{{ route('about') }}" class="text-decoration-none text-secondary">Privacy Policy</a>
                <span>•</span>
                <a href="{{ route('about') }}" class="text-decoration-none text-secondary">Terms of Service</a>
                <span>•</span>
                <a href="{{ route('contact.index') }}" class="text-decoration-none text-secondary">Support</a>
            </div>
        </div>
    </div>
</footer>
