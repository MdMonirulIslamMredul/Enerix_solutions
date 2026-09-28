@extends('admin.layouts.app')
@section('title', 'Edit Project')
@section('content')
    <div class="card p-4 shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0 fw-bold">Edit Project: {{ $project->title }}</h4>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Back to Projects
            </a>
        </div>
        <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.projects._form')
            <button class="btn btn-primary mt-4 px-4">Update Project</button>
        </form>
    </div>
@endsection
