@extends('admin.layouts.app')
@section('title', 'Projects')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-bold">Projects Management</h4>
            <p class="text-muted small mb-0">Manage featured portfolio projects displayed on the frontend.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add New Project
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 80px;">Image</th>
                        <th>Title & Subtitle</th>
                        <th>Location</th>
                        <th>Category</th>
                        <th>Order</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td>
                                @if($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" class="rounded" style="width: 60px; height: 45px; object-fit: cover;">
                                @else
                                    <div class="bg-light text-muted d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 45px;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $project->title }}</div>
                                <div class="small text-muted">{{ $project->spec_subtitle ?? '-' }}</div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <i class="bi bi-geo-alt text-primary me-1"></i>{{ $project->location ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary">{{ $project->category ?? 'General' }}</span>
                            </td>
                            <td>{{ $project->sort_order }}</td>
                            <td>
                                @if($project->is_featured)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                            <td>
                                @if($project->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">No projects found. Click "Add New Project" to create one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($projects->hasPages())
            <div class="p-3 border-top">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
@endsection
