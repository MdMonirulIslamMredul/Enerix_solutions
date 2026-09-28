@extends('admin.layouts.app')
@section('title', 'Settings')
@section('content')
    @php
        $themeDefaults = [
            'primary_color' => '#0072ce',
            'secondary_color' => '#07132b',
            'accent_color' => '#00c6ff',
            'text_color' => '#1e293b',
            'bg_color' => '#ffffff',
        ];

        $themeValues = [
            'primary_color' => old('primary_color', $setting->primary_color ?? $themeDefaults['primary_color']),
            'secondary_color' => old('secondary_color', $setting->secondary_color ?? $themeDefaults['secondary_color']),
            'accent_color' => old('accent_color', $setting->accent_color ?? $themeDefaults['accent_color']),
            'text_color' => old('text_color', $setting->text_color ?? $themeDefaults['text_color']),
            'bg_color' => old('bg_color', $setting->bg_color ?? $themeDefaults['bg_color']),
        ];
    @endphp

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card p-4 shadow-sm border-0">
        <h4 class="mb-3 fw-bold">Enerix Website Settings</h4>
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf

            <!-- Theme Color Settings -->
            <div class="card border mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-3">
                        <div>
                            <h5 class="card-title mb-1 fw-bold">Brand & Theme Colors</h5>
                            <p class="text-secondary mb-0 small">Customize the primary blue, dark navy, and cyan accents across all pages.</p>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-sm btn-primary" id="presetEnerix">Enerix Theme</button>
                            <button type="button" class="btn btn-sm btn-outline-dark" data-theme-preset="dark">Dark Theme</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="resetThemeColors">Reset Defaults</button>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Primary Color (Vibrant Blue)</label>
                            <input type="color" class="form-control form-control-color w-100" name="primary_color"
                                id="primaryColor" value="{{ $themeValues['primary_color'] }}" title="Primary color">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Secondary / Hero & Footer Navy</label>
                            <input type="color" class="form-control form-control-color w-100"
                                name="secondary_color" id="secondaryColor"
                                value="{{ $themeValues['secondary_color'] }}" title="Secondary color">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Accent Color (Electric Cyan)</label>
                            <input type="color" class="form-control form-control-color w-100" name="accent_color"
                                id="accentColor" value="{{ $themeValues['accent_color'] }}" title="Accent color">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero Section Settings -->
            <div class="card border mb-4">
                <div class="card-header bg-light py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-window-sidebar me-2 text-primary"></i>Homepage Hero Section (Exact Design)</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Hero Top Tagline / Category Badges</label>
                            <input class="form-control" name="hero_tagline" value="{{ old('hero_tagline', $setting->hero_tagline ?? 'ENGINEERING | SOLAR | IT | REAL ESTATE') }}" placeholder="e.g. ENGINEERING | SOLAR | IT | REAL ESTATE">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Hero Main Heading (White Text)</label>
                            <input class="form-control" name="hero_title" value="{{ old('hero_title', $setting->hero_title ?? 'Engineering Tomorrow.') }}" placeholder="Engineering Tomorrow.">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Hero Highlight Heading (Cyan Text)</label>
                            <input class="form-control" name="hero_highlight" value="{{ old('hero_highlight', $setting->hero_highlight ?? 'Powering Possibilities.') }}" placeholder="Powering Possibilities.">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Hero Subtitle / Description</label>
                            <textarea class="form-control" name="hero_description" rows="2" placeholder="Integrated Engineering, Solar Energy & IT Solutions for Homes, Businesses and Industries.">{{ old('hero_description', $setting->hero_description ?? 'Integrated Engineering, Solar Energy & IT Solutions for Homes, Businesses and Industries.') }}</textarea>
                        </div>
                    </div>

                    <h6 class="mt-4 mb-3 fw-bold text-dark border-bottom pb-2">Hero 4-Panel Dynamic Visual Collage</h6>
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-3">
                            <label class="form-label small fw-semibold">1. Main Panel (Engineer + Solar)</label>
                            @if($setting->hero_image_main)
                                <img src="{{ asset('storage/' . $setting->hero_image_main) }}" class="rounded w-100 mb-2 border" style="height: 110px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/enerix/hero_main.jpg') }}" class="rounded w-100 mb-2 border" style="height: 110px; object-fit: cover;">
                            @endif
                            <input type="file" name="hero_image_main" class="form-control form-control-sm" accept="image/*">
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <label class="form-label small fw-semibold">2. Top Right (Civil Construction)</label>
                            @if($setting->hero_image_top)
                                <img src="{{ asset('storage/' . $setting->hero_image_top) }}" class="rounded w-100 mb-2 border" style="height: 110px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/enerix/hero_top.jpg') }}" class="rounded w-100 mb-2 border" style="height: 110px; object-fit: cover;">
                            @endif
                            <input type="file" name="hero_image_top" class="form-control form-control-sm" accept="image/*">
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <label class="form-label small fw-semibold">3. Mid Right (Datacenter / IT)</label>
                            @if($setting->hero_image_mid)
                                <img src="{{ asset('storage/' . $setting->hero_image_mid) }}" class="rounded w-100 mb-2 border" style="height: 110px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/enerix/hero_mid.jpg') }}" class="rounded w-100 mb-2 border" style="height: 110px; object-fit: cover;">
                            @endif
                            <input type="file" name="hero_image_mid" class="form-control form-control-sm" accept="image/*">
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <label class="form-label small fw-semibold">4. Bottom Right (CCTV Security)</label>
                            @if($setting->hero_image_bot)
                                <img src="{{ asset('storage/' . $setting->hero_image_bot) }}" class="rounded w-100 mb-2 border" style="height: 110px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/enerix/hero_bot.jpg') }}" class="rounded w-100 mb-2 border" style="height: 110px; object-fit: cover;">
                            @endif
                            <input type="file" name="hero_image_bot" class="form-control form-control-sm" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>

            <!-- General Company & Contact Info -->
            <div class="card border mb-4">
                <div class="card-header bg-light py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-info-circle me-2 text-primary"></i>Company Identity & Contact Info</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Company / Site Name</label>
                            <input class="form-control" name="site_name" value="{{ old('site_name', $setting->site_name ?? 'Enerix Solutions') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Meta SEO Title</label>
                            <input class="form-control" name="meta_title" value="{{ old('meta_title', $setting->meta_title) }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input class="form-control" name="contact_email" value="{{ old('contact_email', $setting->contact_email ?? 'info@enerixbd.com') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input class="form-control" name="contact_phone" value="{{ old('contact_phone', $setting->contact_phone ?? '+880 1234 567890') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">WhatsApp Number</label>
                            <input class="form-control" name="whatsapp_number" value="{{ old('whatsapp_number', $setting->whatsapp_number ?? '+880 1234 567890') }}">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Office Address / Location</label>
                            <input class="form-control" name="contact_address" value="{{ old('contact_address', $setting->contact_address ?? 'Dhaka, Bangladesh') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Why Enerix Title</label>
                            <input class="form-control" name="why_title" value="{{ old('why_title', $setting->why_title ?? 'Why Enerix Solutions?') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Why Enerix Subtitle</label>
                            <input class="form-control" name="why_subtitle" value="{{ old('why_subtitle', $setting->why_subtitle ?? 'Your trusted partner for sustainable, efficient and future-ready solutions.') }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Facebook URL</label>
                            <input class="form-control" name="facebook_url" value="{{ old('facebook_url', $setting->social_links['facebook'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">LinkedIn URL</label>
                            <input class="form-control" name="linkedin_url" value="{{ old('linkedin_url', $setting->social_links['linkedin'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">YouTube URL</label>
                            <input class="form-control" name="youtube_url" value="{{ old('youtube_url', $setting->social_links['youtube'] ?? '') }}">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">SEO Meta Description</label>
                            <textarea class="form-control" name="meta_description" rows="2">{{ old('meta_description', $setting->meta_description) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Logo (SVG or PNG)</label>
                            <div class="p-3 bg-light border rounded mb-2 d-flex align-items-center">
                                @if($setting->logo_path)
                                    <img src="{{ asset('storage/' . $setting->logo_path) }}" alt="Logo" style="max-height: 50px;">
                                @else
                                    <img src="{{ asset('images/enerix/logo.svg') }}" alt="Logo" style="max-height: 50px;">
                                @endif
                            </div>
                            <input type="file" class="form-control" name="logo" accept="image/*">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Favicon</label>
                            <div class="p-3 bg-light border rounded mb-2 d-flex align-items-center">
                                @if($setting->favicon_path)
                                    <img src="{{ asset('storage/' . $setting->favicon_path) }}" alt="Favicon" style="max-height: 36px;">
                                @else
                                    <span class="text-muted small">Default favicon</span>
                                @endif
                            </div>
                            <input type="file" class="form-control" name="favicon" accept="image/*,.ico">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">Save All Settings</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('presetEnerix')?.addEventListener('click', () => {
            document.getElementById('primaryColor').value = '#0072ce';
            document.getElementById('secondaryColor').value = '#07132b';
            document.getElementById('accentColor').value = '#00c6ff';
        });
    </script>
@endpush
