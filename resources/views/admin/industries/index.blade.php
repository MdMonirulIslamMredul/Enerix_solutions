@extends('admin.layouts.app')
@section('title', 'Industries')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-bold">Industries We Serve</h4>
            <p class="text-muted small mb-0">Manage industry sectors shown on the homepage and industries directory.</p>
        </div>
        <a href="{{ route('admin.industries.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add New Industry
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
                        <th>Icon</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($industries as $industry)
                        <tr>
                            <td>
                                @if($industry->image)
                                    <img src="{{ asset('storage/' . $industry->image) }}" class="rounded" style="width: 60px; height: 45px; object-fit: cover;">
                                @else
                                    <div class="bg-light text-muted d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 45px;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $industry->title }}</div>
                                <div class="small text-muted">{{ $industry->subtitle ?? '-' }}</div>
                            </td>
                            <td>
                                @if($industry->icon)
                                    <span class="badge bg-light text-primary border"><i class="bi {{ $industry->icon }} me-1"></i>{{ $industry->icon }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $industry->sort_order }}</td>
                            <td>
                                @if($industry->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.industries.edit', $industry) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.industries.destroy', $industry) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this industry?')">
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
                            <td colspan="6" class="text-center py-4 text-muted">No industries found. Click "Add New Industry" to create one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($industries->hasPages())
            <div class="p-3 border-top">
                {{ $industries->links() }}
            </div>
        @endif
    </div>
@endsection
