<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Project Title</label>
        <input name="title" class="form-control" value="{{ old('title', $project->title ?? '') }}" placeholder="e.g. Commercial Rooftop Solar Project" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Slug (Auto-generated if blank)</label>
        <input name="slug" class="form-control" value="{{ old('slug', $project->slug ?? '') }}" placeholder="commercial-rooftop-solar-project">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Specification / Capacity Subtitle</label>
        <input name="spec_subtitle" class="form-control" value="{{ old('spec_subtitle', $project->spec_subtitle ?? '') }}" placeholder="e.g. 10 kW Hybrid System, Server & Network Setup">
        <small class="text-muted">Displayed under the project title on cards.</small>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Project Location</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
            <input name="location" class="form-control" value="{{ old('location', $project->location ?? '') }}" placeholder="e.g. Dhaka, Bangladesh">
        </div>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Category / Sector</label>
        <input name="category" class="form-control" value="{{ old('category', $project->category ?? '') }}" placeholder="e.g. Solar Energy, IT Solutions, Electrical">
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Related Solution</label>
        <select name="service_id" class="form-select">
            <option value="">-- Select Solution (Optional) --</option>
            @foreach($services as $serv)
                <option value="{{ $serv->id }}" {{ old('service_id', $project->service_id ?? '') == $serv->id ? 'selected' : '' }}>
                    {{ $serv->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <label class="form-label fw-semibold">Sort Order</label>
        <input name="sort_order" type="number" class="form-control" value="{{ old('sort_order', $project->sort_order ?? 0) }}">
    </div>

    <div class="col-md-3 form-check mt-4 pt-2">
        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{ old('is_featured', $project->is_featured ?? true) ? 'checked' : '' }}>
        <label class="form-check-label fw-semibold" for="is_featured">Featured on Homepage</label>
    </div>

    <div class="col-md-3 form-check mt-4 pt-2">
        <input class="form-check-input" type="checkbox" name="status" value="1" id="status" {{ old('status', $project->status ?? true) ? 'checked' : '' }}>
        <label class="form-check-label fw-semibold" for="status">Active</label>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Short Summary</label>
        <input name="short_description" class="form-control" value="{{ old('short_description', $project->short_description ?? '') }}" placeholder="Brief overview of project scope">
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Detailed Case Study / Description</label>
        <textarea name="description" class="form-control" rows="5" placeholder="Project challenge, technical solution, equipment used, and results...">{{ old('description', $project->description ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Project Photo</label>
        @if(!empty($project->image))
            <div class="mb-2">
                <img src="{{ asset('storage/' . $project->image) }}" alt="Current Project Image" class="rounded border" style="height: 100px; object-fit: cover;">
                <span class="text-muted ms-2 small">Current image</span>
            </div>
        @endif
        <input type="file" name="image" class="form-control" accept="image/*">
    </div>
</div>
