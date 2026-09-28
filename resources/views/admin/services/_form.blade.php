@php
    $featuresText = '';
    if (isset($service) && !empty($service->features)) {
        $featuresText = is_array($service->features) ? implode("\n", $service->features) : $service->features;
    }
@endphp
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Solution Title</label>
        <input name="title" class="form-control" value="{{ old('title', $service->title ?? '') }}" placeholder="e.g. Solar Energy Solutions" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Slug (Auto-generated if blank)</label>
        <input name="slug" class="form-control" value="{{ old('slug', $service->slug ?? '') }}" placeholder="solar-energy-solutions">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Bootstrap Icon Class</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi {{ $service->icon ?? 'bi-lightbulb' }}"></i></span>
            <input name="icon" class="form-control" value="{{ old('icon', $service->icon ?? 'bi-sun-fill') }}" placeholder="e.g. bi-sun-fill, bi-buildings, bi-shield-check">
        </div>
        <small class="text-muted">Enter Bootstrap Icon class (e.g. bi-sun-fill, bi-buildings, bi-lightning-charge-fill, bi-pc-display, bi-shield-check, bi-people-fill)</small>
    </div>

    <div class="col-md-2">
        <label class="form-label fw-semibold">Sort Order</label>
        <input name="sort_order" type="number" class="form-control" value="{{ old('sort_order', $service->sort_order ?? 0) }}">
    </div>

    <div class="col-md-2 form-check mt-4 pt-2">
        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{ old('is_featured', $service->is_featured ?? true) ? 'checked' : '' }}>
        <label class="form-check-label fw-semibold" for="is_featured">Featured on Home</label>
    </div>

    <div class="col-md-2 form-check mt-4 pt-2">
        <input class="form-check-input" type="checkbox" name="status" value="1" id="status" {{ old('status', $service->status ?? true) ? 'checked' : '' }}>
        <label class="form-check-label fw-semibold" for="status">Active</label>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Key Bullet Features (One per line for the card)</label>
        <textarea name="features" class="form-control" rows="4" placeholder="On-Grid, Off-Grid & Hybrid&#10;ESS & Battery Solutions&#10;Design, Supply & Installation&#10;Consultancy & Maintenance">{{ old('features', $featuresText) }}</textarea>
        <small class="text-muted">Each line will be displayed with a clean bullet point on the homepage card.</small>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Short Description</label>
        <input name="short_description" class="form-control" value="{{ old('short_description', $service->short_description ?? '') }}">
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Detailed Description</label>
        <textarea name="description" class="form-control" rows="5">{{ old('description', $service->description ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Featured Image</label>
        @if(!empty($service->image))
            <div class="mb-2">
                <img src="{{ asset('storage/' . $service->image) }}" alt="Current Image" class="rounded border" style="height: 100px; object-fit: cover;">
                <span class="text-muted ms-2 small">Current image</span>
            </div>
        @endif
        <input type="file" name="image" class="form-control" accept="image/*">
    </div>
</div>
