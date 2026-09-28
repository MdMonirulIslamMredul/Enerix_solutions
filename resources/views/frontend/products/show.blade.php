@extends('frontend.layouts.app')

@section('title', $product->title . ' - Equipment & Products')

@section('content')
    <!-- Banner -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, #07132b 0%, #004b87 100%);">
        <div class="container-fluid px-lg-5 py-3" data-aos="fade-up">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-white-50 text-decoration-none">Products</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ $product->title }}</li>
                </ol>
            </nav>
            <h1 class="display-6 fw-bold mb-1">{{ $product->title }}</h1>
            <p class="lead text-white-50 mb-0" style="font-size: 1.05rem;">{{ $product->short_description }}</p>
        </div>
    </section>

    <!-- Product Detail Content -->
    <section class="py-5 bg-white">
        <div class="container-fluid px-lg-5">
            <div class="row g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="rounded-4 overflow-hidden border p-3 bg-light text-center" style="min-height: 380px; display: flex; align-items: center; justify-content: center;">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-3 shadow-sm" alt="{{ $product->title }}" style="max-height: 400px; object-fit: contain;">
                        @else
                            <i class="bi bi-box-seam text-secondary" style="font-size: 6rem;"></i>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <span class="badge bg-primary-subtle text-primary fw-bold text-uppercase px-3 py-2 rounded-pill mb-2">Original Certified Equipment</span>
                    <h2 class="fw-bold mb-3">{{ $product->title }}</h2>

                    @if ($product->price)
                        <div class="mb-4">
                            <span class="fs-3 fw-bold text-primary">${{ number_format($product->price, 2) }}</span>
                            <span class="text-muted small ms-2">Excl. installation & taxes</span>
                        </div>
                    @endif

                    <div class="card p-3 rounded-3 bg-light border-0 mb-4">
                        <h6 class="fw-bold mb-1 text-dark">Specifications Overview:</h6>
                        <p class="text-secondary small mb-0">{{ $product->short_description }}</p>
                    </div>

                    <div class="text-secondary lh-lg mb-4">
                        {!! $product->description !!}
                    </div>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('quote') }}?product={{ urlencode($product->title) }}" class="btn btn-primary rounded-pill px-4 py-3 fw-bold">
                            Request Price Quotation <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                        <a href="{{ route('contact.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-3 fw-bold">
                            Speak to Sales Engineer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
