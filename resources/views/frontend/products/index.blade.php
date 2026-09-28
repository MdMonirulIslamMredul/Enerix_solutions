@extends('frontend.layouts.app')

@section('title', 'Equipment & Products - Enerix Solutions')

@section('content')
    <!-- Banner -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, #07132b 0%, #004b87 100%);">
        <div class="container-fluid px-lg-5 py-3" data-aos="fade-up">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Products</li>
                </ol>
            </nav>
            <h1 class="display-5 fw-bold mb-2">Industrial Equipment & Products</h1>
            <p class="lead text-white-50 mb-0" style="max-width: 760px;">
                Tier-1 solar modules, hybrid inverters, energy storage batteries, and datacenter hardware supplied with full warranty.
            </p>
        </div>
    </section>

    <!-- Product Grid -->
    <section class="py-5 bg-light">
        <div class="container-fluid px-lg-5">
            <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                @forelse($products as $product)
                    <div class="col" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                            <div class="position-relative" style="height: 200px; background: #f1f5f9;">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $product->title }}">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 text-primary">
                                        <i class="bi bi-box-seam" style="font-size: 3.5rem;"></i>
                                    </div>
                                @endif
                                @if($product->price)
                                    <div class="position-absolute top-0 end-0 m-3 px-3 py-1 rounded-pill bg-primary text-white small fw-bold shadow-sm">
                                        ${{ number_format($product->price, 2) }}
                                    </div>
                                @endif
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <h3 class="fw-bold fs-6 mb-2">{{ $product->title }}</h3>
                                <p class="text-muted small mb-3 flex-grow-1">{{ Str::limit($product->short_description, 90) }}</p>
                                <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top">
                                    <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-semibold">
                                        Specifications <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                    <a href="{{ route('quote') }}?product={{ urlencode($product->title) }}" class="small fw-bold text-dark text-decoration-none">
                                        Inquire
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-muted">
                        No products available.
                    </div>
                @endforelse
            </div>

            @if(method_exists($products, 'hasPages') && $products->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
