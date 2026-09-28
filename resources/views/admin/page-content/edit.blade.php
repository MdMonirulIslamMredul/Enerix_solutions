@extends('admin.layouts.app')
@section('title', 'Page Content')
@section('content')
    <div class="card p-4 shadow-sm border-0">
        <h4 class="mb-3 fw-bold">Manage Pages & Sections Content</h4>
        <form method="POST" action="{{ route('admin.page-content.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <h5 class="fw-bold border-bottom pb-2 text-primary">Company & About Content</h5>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-semibold">About Page Main Title</label>
                    <input class="form-control" name="about_title" value="{{ old('about_title', $setting->about_title) }}">
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Company Introduction / Footer Summary</label>
                    <textarea class="form-control" name="company_intro" rows="2">{{ old('company_intro', $setting->company_intro) }}</textarea>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">About Details Full Text</label>
                    <textarea class="form-control" name="about_content" rows="4">{{ old('about_content', $setting->about_content) }}</textarea>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Mission Statement</label>
                    <textarea class="form-control" name="mission" rows="3">{{ old('mission', $setting->mission) }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Vision Statement</label>
                    <textarea class="form-control" name="vision" rows="3">{{ old('vision', $setting->vision) }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Company History</label>
                    <textarea class="form-control" name="history" rows="3">{{ old('history', $setting->history) }}</textarea>
                </div>

                <div class="col-12 mt-4">
                    <h5 class="fw-bold border-bottom pb-2 text-primary">"Why Enerix Solutions?" Section</h5>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Section Title</label>
                    <input class="form-control" name="why_title" value="{{ old('why_title', $setting->why_title ?? 'Why Enerix Solutions?') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Section Subtitle</label>
                    <input class="form-control" name="why_subtitle" value="{{ old('why_subtitle', $setting->why_subtitle ?? 'Your trusted partner for sustainable, efficient and future-ready solutions.') }}">
                </div>

                <div class="col-12 mt-4">
                    <h5 class="fw-bold border-bottom pb-2 text-primary">Call to Action (Blue Ribbon Banner)</h5>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">CTA Title</label>
                    <input class="form-control" name="cta_title" value="{{ old('cta_title', $setting->cta_title ?? 'Have a Project in Mind?') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">CTA Button Text</label>
                    <input class="form-control" name="cta_button_text" value="{{ old('cta_button_text', $setting->cta_button_text ?? 'Get a Free Consultation') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">CTA Button Link</label>
                    <input class="form-control" name="cta_button_link" value="{{ old('cta_button_link', $setting->cta_button_link ?? '/contact') }}">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">CTA Subtext</label>
                    <textarea class="form-control" name="cta_text" rows="2">{{ old('cta_text', $setting->cta_text ?? 'Talk to our engineering team and discover the right solution for your project.') }}</textarea>
                </div>

                <div class="col-12 mt-4">
                    <h5 class="fw-bold border-bottom pb-2 text-primary">Contact & Communications</h5>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Contact Email</label>
                    <input class="form-control" name="contact_email" value="{{ old('contact_email', $setting->contact_email) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Contact Phone</label>
                    <input class="form-control" name="contact_phone" value="{{ old('contact_phone', $setting->contact_phone) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">WhatsApp Number</label>
                    <input class="form-control" name="whatsapp_number" value="{{ old('whatsapp_number', $setting->whatsapp_number) }}">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Office Address</label>
                    <input class="form-control" name="contact_address" value="{{ old('contact_address', $setting->contact_address) }}">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Google Map Embed URL</label>
                    <input class="form-control" name="google_map_embed" value="{{ old('google_map_embed', $setting->google_map_embed) }}">
                </div>
            </div>
            <button class="btn btn-primary btn-lg mt-4 px-5">Save Content</button>
        </form>
    </div>
@endsection
