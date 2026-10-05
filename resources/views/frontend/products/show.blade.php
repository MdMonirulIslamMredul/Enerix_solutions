@extends('frontend.layouts.app')

@section('title', $product->title . ' - Equipment & Products')

@push('styles')
<style>
    .bdt-price-detail-box {
        background: linear-gradient(135deg, #f8fafc 0%, #edf2f7 100%);
        border: 1.5px solid #e2e8f0;
        border-radius: 18px;
        padding: 1.25rem 1.5rem;
    }
    .bdt-price-detail-box .symbol-main {
        color: #0072ce;
        font-size: 2.2rem;
        font-weight: 800;
        line-height: 1;
    }
    .bdt-price-detail-box .amount-main {
        color: #07132b;
        font-size: 2.4rem;
        font-weight: 900;
        line-height: 1;
        letter-spacing: -0.5px;
    }
    .bdt-price-detail-box .badge-bdt {
        background: #0072ce;
        color: #ffffff;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 0.8px;
        padding: 4px 10px;
        border-radius: 50px;
        text-transform: uppercase;
    }
</style>
@endpush

@section('content')
    <!-- Banner -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, #07132b 0%, #004b87 100%);">
        <div class="container-fluid px-lg-5 py-3" data-aos="fade-up">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-white-50 text-decoration-none">Products</a></li>
                    @if($product->category)
                        <li class="breadcrumb-item"><a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="text-white-50 text-decoration-none">{{ $product->category->name }}</a></li>
                    @endif
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ Str::limit($product->title, 40) }}</li>
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
                    <div class="rounded-4 overflow-hidden border p-3 bg-light text-center position-relative shadow-sm" style="min-height: 420px; display: flex; align-items: center; justify-content: center;">
                        @if($product->is_featured)
                            <span class="position-absolute top-0 start-0 m-3 badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill shadow-sm">
                                <i class="bi bi-star-fill me-1"></i> Featured Product
                            </span>
                        @endif

                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-3" alt="{{ $product->title }}" style="max-height: 400px; object-fit: contain;">
                        @else
                            <i class="bi bi-box-seam text-secondary opacity-50" style="font-size: 6rem;"></i>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                        <span class="badge bg-primary-subtle text-primary fw-bold text-uppercase px-3 py-2 rounded-pill">Original Certified Equipment</span>
                        @if($product->category)
                            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="badge bg-light text-dark border text-decoration-none px-3 py-2 rounded-pill">
                                {{ $product->category->name }}
                            </a>
                        @endif
                    </div>

                    <h2 class="fw-bold mb-3 text-dark">{{ $product->title }}</h2>

                    <!-- BDT Price Box -->
                    <div class="bdt-price-detail-box mb-4">
                        <div class="d-flex flex-wrap align-items-baseline gap-2 mb-2">
                            <span class="text-muted small fw-bold text-uppercase me-1">Unit Price:</span>
                            @if ($product->price && $product->price > 0)
                                <div class="d-inline-flex align-items-baseline gap-1">
                                    <span class="symbol-main">৳</span>
                                    <span class="amount-main">{{ number_format($product->price, $product->price == intval($product->price) ? 0 : 2) }}</span>
                                    <span class="badge-bdt ms-1">BDT</span>
                                </div>
                            @else
                                <span class="fs-4 fw-bold text-primary">
                                    <i class="bi bi-telephone-fill me-1"></i> Price on Request
                                </span>
                            @endif
                        </div>
                        <div class="d-flex flex-wrap gap-3 text-muted small border-top pt-2">
                            <span><i class="bi bi-check-circle-fill text-success me-1"></i>Genuine Manufacturer Warranty</span>
                            <span><i class="bi bi-currency-exchange text-primary me-1"></i>Prices in Bangladeshi Taka (BDT)</span>
                            <span><i class="bi bi-truck text-info me-1"></i>Delivery Available Across Bangladesh</span>
                        </div>
                    </div>

                    <div class="card p-3 rounded-3 bg-light border-0 mb-4">
                        <h6 class="fw-bold mb-1 text-dark">Specifications Overview:</h6>
                        <p class="text-secondary small mb-0">{{ $product->short_description }}</p>
                    </div>

                    <div class="text-secondary lh-lg mb-4">
                        {!! $product->description !!}
                    </div>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('quote') }}?product={{ urlencode($product->title) }}" class="btn btn-primary rounded-pill px-4 py-3 fw-bold shadow-sm">
                            <i class="bi bi-file-earmark-text me-1"></i> Request Price Quotation
                        </a>
                        <a href="{{ route('contact.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-3 fw-bold">
                            <i class="bi bi-headset me-1"></i> Speak to Sales Engineer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <section class="py-5 bg-light border-top">
            <div class="container-fluid px-lg-5">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-1 rounded-pill mb-1">Catalog Recommendations</span>
                        <h3 class="fw-bold mb-0">Similar Equipment &amp; Solutions</h3>
                    </div>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-semibold">
                        View All Products <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-4">
                    @foreach($relatedProducts as $relProduct)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                                <div class="position-relative" style="height: 180px; background: #f8fafc;">
                                    @if ($relProduct->image)
                                        <img src="{{ asset('storage/' . $relProduct->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $relProduct->title }}">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center h-100 text-primary opacity-50">
                                            <i class="bi bi-box-seam" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                    @if($relProduct->price && $relProduct->price > 0)
                                        <div class="position-absolute bottom-0 end-0 m-2 px-2 py-1 rounded-pill bg-dark bg-opacity-75 text-white small fw-bold" style="font-size: 0.75rem;">
                                            <span class="text-info">৳</span> {{ number_format($relProduct->price, $relProduct->price == intval($relProduct->price) ? 0 : 2) }} BDT
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body p-3 d-flex flex-column">
                                    <h4 class="fw-bold fs-6 mb-2">
                                        <a href="{{ route('products.show', $relProduct->slug) }}" class="text-dark text-decoration-none">
                                            {{ Str::limit($relProduct->title, 45) }}
                                        </a>
                                    </h4>
                                    <div class="mt-auto pt-2 border-top d-flex justify-content-between align-items-center">
                                        <a href="{{ route('products.show', $relProduct->slug) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                            Specs
                                        </a>
                                        <a href="{{ route('quote') }}?product={{ urlencode($relProduct->title) }}" class="small fw-bold text-primary text-decoration-none">
                                            Inquire
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
