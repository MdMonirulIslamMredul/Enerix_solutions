<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Industry Title</label>
        <input name="title" class="form-control" value="{{ old('title', $industry->title ?? '') }}" placeholder="e.g. Residential, Commercial, Hospitals" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Slug (Auto-generated if blank)</label>
        <input name="slug" class="form-control" value="{{ old('slug', $industry->slug ?? '') }}" placeholder="e.g. residential">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Subtitle / Tagline</label>
        <input name="subtitle" class="form-control" value="{{ old('subtitle', $industry->subtitle ?? '') }}" placeholder="e.g. Healthcare & Critical Infrastructure">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Bootstrap Icon Class</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi {{ $industry->icon ?? 'bi-building' }}"></i></span>
            <input name="icon" class="form-control" value="{{ old('icon', $industry->icon ?? 'bi-building') }}" placeholder="e.g. bi-hospital, bi-bank, bi-house-door">
        </div>
    </div>

    <div class="col-md-2">
        <label class="form-label fw-semibold">Sort Order</label>
        <input name="sort_order" type="number" class="form-control" value="{{ old('sort_order', $industry->sort_order ?? 0) }}">
    </div>

    <div class="col-md-12 form-check mt-3">
        <input class="form-check-input" type="checkbox" name="status" value="1" id="status" {{ old('status', $industry->status ?? true) ? 'checked' : '' }}>
        <label class="form-check-label fw-semibold" for="status">Active & Visible on Frontend</label>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Short Summary</label>
        <input name="short_description" class="form-control" value="{{ old('short_description', $industry->short_description ?? '') }}" placeholder="Summary of industry engineering services">
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Full Description</label>
        <textarea name="description" class="form-control" rows="5" placeholder="Detailed engineering solutions we provide for this industry sector...">{{ old('description', $industry->description ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Industry Card Image</label>
        @if(!empty($industry->image))
            <div class="mb-2">
                <img src="{{ asset('storage/' . $industry->image) }}" alt="Current Industry Image" class="rounded border" style="height: 100px; object-fit: cover;">
                <span class="text-muted ms-2 small">Current image</span>
            </div>
        @endif
        <input type="file" name="image" class="form-control" accept="image/*">
    </div>
</div>
