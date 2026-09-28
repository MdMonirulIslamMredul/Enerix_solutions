@extends('admin.layouts.app')
@section('title', 'Edit Industry')
@section('content')
    <div class="card p-4 shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0 fw-bold">Edit Industry: {{ $industry->title }}</h4>
            <a href="{{ route('admin.industries.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Back to Industries
            </a>
        </div>
        <form method="POST" action="{{ route('admin.industries.update', $industry) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.industries._form')
            <button class="btn btn-primary mt-4 px-4">Update Industry</button>
        </form>
    </div>
@endsection
