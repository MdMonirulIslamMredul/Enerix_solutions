@extends('frontend.layouts.app')

@section('title', 'Equipment & Products - Enerix Solutions')

@push('styles')
<style>
    /* ── Products & BDT Price Styling ── */
    .filter-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.03);
    }

    .filter-section-title {
        font-size: 0.85rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #0f172a;
        margin-bottom: 0.9rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .filter-cat-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 12px;
        border-radius: 10px;
        color: #475569;
        text-decoration: none;
        font-size: 0.88rem;
        font-weight: 600;
        transition: all 0.15s ease;
        margin-bottom: 2px;
    }

    .filter-cat-link:hover {
        background: #f1f5f9;
        color: #0072ce;
        padding-left: 14px;
    }

    .filter-cat-link.active {
        background: rgba(0, 114, 206, 0.1);
        color: #0072ce;
        font-weight: 700;
    }

    .filter-cat-count {
        font-size: 0.72rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 50px;
        background: #e2e8f0;
        color: #64748b;
    }

    .filter-cat-link.active .filter-cat-count {
        background: #0072ce;
        color: #ffffff;
    }

    /* Price radio pills */
    .price-radio-label {
        display: block;
        padding: 7px 12px;
        border-radius: 8px;
        color: #475569;
        font-size: 0.86rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.15s ease;
        margin-bottom: 3px;
    }

    .price-radio-label:hover {
        background: #f8fafc;
        color: #0072ce;
    }

    .price-radio-label input[type="radio"] {
        accent-color: #0072ce;
        margin-right: 8px;
    }

    .price-radio-label.active {
        background: #eff6ff;
        color: #0072ce;
        font-weight: 700;
    }

    /* Product Card */
    .product-card {
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        background: #ffffff;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 36px rgba(0, 0, 0, 0.08);
        border-color: #cbd5e1;
    }

    .product-media {
        position: relative;
        height: 220px;
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
        overflow: hidden;
    }

    .product-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.35s ease;
    }

    .product-card:hover .product-media img {
        transform: scale(1.05);
    }

    /* BDT Price Floating Pill */
    .bdt-price-pill {
        position: absolute;
        bottom: 12px;
        right: 12px;
        background: rgba(7, 19, 43, 0.88);
        backdrop-filter: blur(8px);
        color: #ffffff;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.82rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .bdt-price-pill .taka-char {
        color: #38bdf8;
        font-size: 0.95rem;
        font-weight: 800;
    }

    .bdt-price-pill .bdt-tag {
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        opacity: 0.75;
    }

    .bdt-price-pill.pill-rfq {
        background: rgba(0, 114, 206, 0.92);
        color: #ffffff;
        font-size: 0.78rem;
    }

    /* Card Featured Badge */
    .badge-featured-flag {
        position: absolute;
        top: 12px;
        left: 12px;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: #ffffff;
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 50px;
        box-shadow: 0 4px 10px rgba(245, 158, 11, 0.35);
        z-index: 2;
    }

    .badge-category-tag {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(6px);
        color: #0f172a;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 50px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.04);
        z-index: 2;
    }

    /* Card Body Price Highlight */
    .price-bdt-box {
        display: flex;
        align-items: baseline;
        gap: 6px;
        margin-bottom: 0.75rem;
    }

    .price-bdt-box .symbol-bdt {
        color: #0072ce;
        font-size: 1.25rem;
        font-weight: 800;
        line-height: 1;
    }

    .price-bdt-box .val-bdt {
        font-size: 1.35rem;
        font-weight: 900;
        color: #07132b;
        line-height: 1;
        letter-spacing: -0.5px;
    }

    .price-bdt-box .code-bdt {
        font-size: 0.72rem;
        font-weight: 700;
        color: #64748b;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    /* Active filter badges */
    .filter-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px 4px 12px;
        background: #e0f2fe;
        color: #0369a1;
        border: 1px solid #bae6fd;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 600;
        margin-right: 6px;
        margin-bottom: 6px;
    }

    .filter-chip a {
        color: #0284c7;
        text-decoration: none;
        font-weight: 800;
        font-size: 0.9rem;
        line-height: 1;
    }

    .filter-chip a:hover {
        color: #b91c1c;
    }
</style>
@endpush

@section('content')
    <!-- Banner -->
    <section class="py-5 text-white position-relative" style="background: linear-gradient(135deg, #07132b 0%, #004b87 100%);">
        <div class="container-fluid px-lg-5 py-2" data-aos="fade-up">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2 small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Equipment &amp; Products</li>
                </ol>
            </nav>
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <h1 class="display-5 fw-bold mb-2">Industrial Equipment &amp; Products</h1>
                    <p class="lead text-white-50 mb-0" style="max-width: 680px; font-size: 1.05rem;">
                        Tier-1 solar modules, hybrid inverters, energy storage batteries, and datacenter hardware with authentic warranty and delivery across Bangladesh.
                    </p>
                </div>
                <div class="col-lg-5">
                    <!-- Quick Search in Hero -->
                    <form action="{{ route('products.index') }}" method="GET" class="p-2 rounded-4 bg-transparent border border-white border-opacity-20 backdrop-blur">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0 text-white-50 ps-3">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="q" class="form-control bg-transparent border-0 text-white shadow-none placeholder-white-50"
                                   placeholder="Search products by model, brand, spec..."
                                   value="{{ $search }}">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <section class="py-5 bg-light">
        <div class="container-fluid px-lg-5">
            <div class="row g-4">

                <!-- ── FILTER SIDEBAR (Desktop) ── -->
                <aside class="col-lg-3 col-xl-3">
                    <div class="filter-card sticky-top" style="top: 85px; z-index: 10;">

                        <!-- Header with Reset -->
                        <div class="d-flex align-items-center justify-content-between pb-3 border-bottom mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-sliders text-primary fs-5"></i>
                                <span class="fw-bold fs-6 text-dark">Filter Equipment</span>
                            </div>
                            @if($activeFiltersCount > 0)
                                <a href="{{ route('products.index') }}" class="btn btn-sm btn-link text-danger text-decoration-none p-0 fw-semibold">
                                    <i class="bi bi-x-circle me-1"></i>Reset
                                </a>
                            @endif
                        </div>

                        <!-- Active Filters Chips -->
                        @if($activeFiltersCount > 0)
                            <div class="mb-3 pb-3 border-bottom">
                                <div class="small text-muted fw-bold mb-2">Applied Filters ({{ $activeFiltersCount }}):</div>
                                <div class="d-flex flex-wrap">
                                    @if($search !== '')
                                        <span class="filter-chip">
                                            Search: "{{ Str::limit($search, 12) }}"
                                            <a href="{{ request()->fullUrlWithQuery(['q' => null, 'search' => null]) }}">&times;</a>
                                        </span>
                                    @endif
                                    @if($selectedCategory)
                                        <span class="filter-chip">
                                            Cat: {{ $selectedCategory->name }}
                                            <a href="{{ request()->fullUrlWithQuery(['category' => null, 'subcategory' => null]) }}">&times;</a>
                                        </span>
                                    @endif
                                    @if($selectedSubcategory)
                                        <span class="filter-chip">
                                            Sub: {{ $selectedSubcategory->name }}
                                            <a href="{{ request()->fullUrlWithQuery(['subcategory' => null]) }}">&times;</a>
                                        </span>
                                    @endif
                                    @if(request('featured'))
                                        <span class="filter-chip">
                                            Featured Only
                                            <a href="{{ request()->fullUrlWithQuery(['featured' => null]) }}">&times;</a>
                                        </span>
                                    @endif
                                    @if($priceRange)
                                        <span class="filter-chip">
                                            Price: {{ ucwords(str_replace('_', ' ', $priceRange)) }}
                                            <a href="{{ request()->fullUrlWithQuery(['price_range' => null]) }}">&times;</a>
                                        </span>
                                    @endif
                                    @if(request('min_price') || request('max_price'))
                                        <span class="filter-chip">
                                            ৳ {{ request('min_price', 0) }} - {{ request('max_price', 'Any') }}
                                            <a href="{{ request()->fullUrlWithQuery(['min_price' => null, 'max_price' => null]) }}">&times;</a>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <form id="filterForm" action="{{ route('products.index') }}" method="GET">
                            <!-- Retain search and sort -->
                            @if($search !== '')
                                <input type="hidden" name="q" value="{{ $search }}">
                            @endif
                            @if(request('sort'))
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                            @endif

                            <!-- 1. Categories Filter -->
                            <div class="mb-4">
                                <div class="filter-section-title">
                                    <span>Categories</span>
                                    <i class="bi bi-grid text-muted"></i>
                                </div>
                                <div class="filter-category-list">
                                    <a href="{{ request()->fullUrlWithQuery(['category' => null, 'subcategory' => null]) }}"
                                       class="filter-cat-link {{ !$selectedCategory ? 'active' : '' }}">
                                        <span>All Equipment</span>
                                        <span class="filter-cat-count">{{ $totalActiveCount }}</span>
                                    </a>

                                    @foreach($categories as $category)
                                        <a href="{{ request()->fullUrlWithQuery(['category' => $category->slug, 'subcategory' => null]) }}"
                                           class="filter-cat-link {{ $selectedCategory && $selectedCategory->id === $category->id ? 'active' : '' }}">
                                            <span class="text-truncate me-2">{{ $category->name }}</span>
                                            <span class="filter-cat-count">{{ $category->products_count }}</span>
                                        </a>

                                        {{-- Subcategories if current category selected --}}
                                        @if($selectedCategory && $selectedCategory->id === $category->id && $category->subcategories->count() > 0)
                                            <div class="ps-3 pe-1 py-1 mb-1 border-start border-2 border-primary ms-2">
                                                @foreach($category->subcategories as $subcat)
                                                    <a href="{{ request()->fullUrlWithQuery(['subcategory' => $subcat->slug]) }}"
                                                       class="filter-cat-link py-1 {{ $selectedSubcategory && $selectedSubcategory->id === $subcat->id ? 'active text-primary fw-bold' : 'text-muted' }}"
                                                       style="font-size: 0.8rem;">
                                                        <span>{{ $subcat->name }}</span>
                                                        <span class="small opacity-75">({{ $subcat->products_count }})</span>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <!-- 2. Price in BDT (৳) Filter -->
                            <div class="mb-4 pb-2 border-top pt-3">
                                <div class="filter-section-title">
                                    <span>Price in BDT (৳)</span>
                                    <span class="badge bg-primary-subtle text-primary fw-bold" style="font-size: 0.68rem;">BDT</span>
                                </div>

                                <div class="price-options mb-3">
                                    <label class="price-radio-label {{ !$priceRange && !request('min_price') && !request('max_price') ? 'active' : '' }}">
                                        <input type="radio" name="price_range" value="" onchange="this.form.submit()" {{ !$priceRange ? 'checked' : '' }}>
                                        All Price Ranges
                                    </label>
                                    <label class="price-radio-label {{ $priceRange === 'under_10k' ? 'active' : '' }}">
                                        <input type="radio" name="price_range" value="under_10k" onchange="this.form.submit()" {{ $priceRange === 'under_10k' ? 'checked' : '' }}>
                                        Under ৳ 10,000
                                    </label>
                                    <label class="price-radio-label {{ $priceRange === '10k_50k' ? 'active' : '' }}">
                                        <input type="radio" name="price_range" value="10k_50k" onchange="this.form.submit()" {{ $priceRange === '10k_50k' ? 'checked' : '' }}>
                                        ৳ 10,000 – ৳ 50,000
                                    </label>
                                    <label class="price-radio-label {{ $priceRange === '50k_150k' ? 'active' : '' }}">
                                        <input type="radio" name="price_range" value="50k_150k" onchange="this.form.submit()" {{ $priceRange === '50k_150k' ? 'checked' : '' }}>
                                        ৳ 50,000 – ৳ 150,000
                                    </label>
                                    <label class="price-radio-label {{ $priceRange === '150k_500k' ? 'active' : '' }}">
                                        <input type="radio" name="price_range" value="150k_500k" onchange="this.form.submit()" {{ $priceRange === '150k_500k' ? 'checked' : '' }}>
                                        ৳ 150,000 – ৳ 500,000
                                    </label>
                                    <label class="price-radio-label {{ $priceRange === 'above_500k' ? 'active' : '' }}">
                                        <input type="radio" name="price_range" value="above_500k" onchange="this.form.submit()" {{ $priceRange === 'above_500k' ? 'checked' : '' }}>
                                        Above ৳ 500,000
                                    </label>
                                </div>

                                <!-- Custom Min/Max BDT Input -->
                                <div class="p-2 rounded-3 bg-light border">
                                    <div class="small fw-bold text-dark mb-1">Custom Range (৳)</div>
                                    <div class="row g-2 align-items-center">
                                        <div class="col-5">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text px-1 bg-white text-muted">৳</span>
                                                <input type="number" name="min_price" class="form-control px-1" placeholder="Min"
                                                       value="{{ request('min_price') }}">
                                            </div>
                                        </div>
                                        <div class="col-2 text-center text-muted small">—</div>
                                        <div class="col-5">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text px-1 bg-white text-muted">৳</span>
                                                <input type="number" name="max_price" class="form-control px-1" placeholder="Max"
                                                       value="{{ request('max_price') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary btn-sm w-100 mt-2 fw-semibold">
                                        Apply Range
                                    </button>
                                </div>
                            </div>

                            <!-- 3. Featured Filter -->
                            <div class="border-top pt-3">
                                <label class="form-check form-switch d-flex align-items-center justify-content-between p-0 m-0 cursor-pointer">
                                    <span class="form-check-label small fw-bold text-dark" for="featuredSwitch">
                                        <i class="bi bi-star-fill text-warning me-1"></i> Featured Only ({{ $featuredCount }})
                                    </span>
                                    <input class="form-check-input ms-auto" type="checkbox" role="switch"
                                           id="featuredSwitch" name="featured" value="1"
                                           onchange="this.form.submit()"
                                           {{ request('featured') ? 'checked' : '' }}>
                                </label>
                            </div>
                        </form>
                    </div>
                </aside>

                <!-- ── MAIN PRODUCTS LIST & TOP CONTROL BAR ── -->
                <main class="col-lg-9 col-xl-9">

                    <!-- Top Bar: Result count & Sort Dropdown -->
                    <div class="card border-0 shadow-sm rounded-4 p-3 mb-4 bg-white">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                            <!-- Left: Count & Active category indicator -->
                            <div class="d-flex align-items-center gap-2">
                                <div class="fw-bold text-dark fs-6">
                                    {{ $products->total() }} <span class="fw-normal text-muted">Equipment Found</span>
                                </div>
                                @if($selectedCategory)
                                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1">
                                        {{ $selectedCategory->name }}
                                    </span>
                                @endif
                            </div>

                            <!-- Right: Sort & Mobile filter button -->
                            <div class="d-flex align-items-center gap-2 ms-auto">
                                <form action="{{ route('products.index') }}" method="GET" class="d-flex align-items-center gap-2 m-0" id="sortForm">
                                    {{-- Retain all query parameters except sort --}}
                                    @foreach(request()->except(['sort', 'page']) as $k => $v)
                                        @if(is_array($v))
                                            @foreach($v as $arrV)
                                                <input type="hidden" name="{{ $k }}[]" value="{{ $arrV }}">
                                            @endforeach
                                        @else
                                            <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                                        @endif
                                    @endforeach

                                    <label for="sortSelect" class="small fw-semibold text-muted text-nowrap d-none d-sm-inline">
                                        Sort by:
                                    </label>
                                    <select name="sort" id="sortSelect" class="form-select form-select-sm rounded-pill fw-semibold border-secondary-subtle px-3"
                                            style="min-width: 170px;" onchange="this.form.submit()">
                                        <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Latest First</option>
                                        <option value="price_low" {{ $sort === 'price_low' ? 'selected' : '' }}>Price: Low to High (৳)</option>
                                        <option value="price_high" {{ $sort === 'price_high' ? 'selected' : '' }}>Price: High to Low (৳)</option>
                                        <option value="featured" {{ $sort === 'featured' ? 'selected' : '' }}>Featured First</option>
                                        <option value="name_asc" {{ $sort === 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                                        <option value="name_desc" {{ $sort === 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
                        @forelse($products as $product)
                            <div class="col" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 6) * 50 }}">
                                <div class="product-card">

                                    <!-- Media with Badges -->
                                    <div class="product-media">
                                        @if($product->is_featured)
                                            <span class="badge-featured-flag">
                                                <i class="bi bi-star-fill me-1"></i> Featured
                                            </span>
                                        @endif

                                        @if($product->category)
                                            <span class="badge-category-tag">
                                                {{ $product->category->name }}
                                            </span>
                                        @endif

                                        <a href="{{ route('products.show', $product->slug) }}" class="d-block w-100 h-100 text-decoration-none">
                                            @if ($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}">
                                            @else
                                                <div class="d-flex align-items-center justify-content-center h-100 text-primary opacity-50">
                                                    <i class="bi bi-box-seam" style="font-size: 3.8rem;"></i>
                                                </div>
                                            @endif
                                        </a>

                                        <!-- Floating BDT Price Badge on Card Image -->
                                        @if($product->price && $product->price > 0)
                                            <div class="bdt-price-pill" title="Price in Bangladeshi Taka">
                                                <span class="taka-char">৳</span>
                                                <span>{{ number_format($product->price, $product->price == intval($product->price) ? 0 : 2) }}</span>
                                                <span class="bdt-tag">BDT</span>
                                            </div>
                                        @else
                                            <div class="bdt-price-pill pill-rfq" title="Contact for Quote">
                                                <i class="bi bi-chat-dots-fill me-1"></i> Quote on Request
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Card Content -->
                                    <div class="p-4 d-flex flex-column flex-grow-1">

                                        @if($product->subcategory)
                                            <div class="text-primary fw-bold text-uppercase small mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">
                                                {{ $product->subcategory->name }}
                                            </div>
                                        @endif

                                        <h3 class="fw-bold fs-6 mb-2">
                                            <a href="{{ route('products.show', $product->slug) }}" class="text-dark text-decoration-none text-truncate-2" style="line-height: 1.35;">
                                                {{ $product->title }}
                                            </a>
                                        </h3>

                                        <p class="text-muted small mb-3 flex-grow-1" style="line-height: 1.5;">
                                            {{ Str::limit($product->short_description, 85) }}
                                        </p>

                                        <!-- Primary BDT Price Row -->
                                        <div class="pt-3 border-top mt-auto">
                                            <div class="price-bdt-box">
                                                @if($product->price && $product->price > 0)
                                                    <span class="symbol-bdt">৳</span>
                                                    <span class="val-bdt">{{ number_format($product->price, $product->price == intval($product->price) ? 0 : 2) }}</span>
                                                    <span class="code-bdt">BDT</span>
                                                @else
                                                    <span class="text-muted fw-bold small"><i class="bi bi-telephone-outbound text-primary me-1"></i>Call for BDT Price</span>
                                                @endif
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between gap-2">
                                                <a href="{{ route('products.show', $product->slug) }}"
                                                   class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-semibold flex-grow-1 text-center">
                                                    Specs <i class="bi bi-arrow-right ms-1"></i>
                                                </a>
                                                <a href="{{ route('quote') }}?product={{ urlencode($product->title) }}"
                                                   class="btn btn-primary btn-sm rounded-pill px-3 fw-semibold text-center"
                                                   title="Request a quotation for this product">
                                                    Inquire
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @empty
                            <!-- Empty Search / Filter State -->
                            <div class="col-12 text-center py-5">
                                <div class="p-5 bg-white rounded-4 border">
                                    <div class="display-4 text-muted mb-3">
                                        <i class="bi bi-search"></i>
                                    </div>
                                    <h4 class="fw-bold text-dark mb-2">No Matching Equipment Found</h4>
                                    <p class="text-muted mb-4" style="max-width: 480px; margin: 0 auto;">
                                        We couldn't find any products matching your current search or price filters. Try widening your price range or clearing selected categories.
                                    </p>
                                    <a href="{{ route('products.index') }}" class="btn btn-primary rounded-pill px-4 fw-semibold">
                                        <i class="bi bi-arrow-counterclockwise me-1"></i> Clear All Filters
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if(method_exists($products, 'hasPages') && $products->hasPages())
                        <div class="mt-5 d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>
                    @endif

                </main>
            </div>
        </div>
    </section>

    <!-- Support Callout Section -->
    <section class="py-5 bg-white border-top">
        <div class="container-fluid px-lg-5">
            <div class="row align-items-center justify-content-between g-4 p-4 p-lg-5 rounded-4" style="background: linear-gradient(135deg, #f8fafc 0%, #edf2f7 100%); border: 1px solid #e2e8f0;">
                <div class="col-lg-8">
                    <span class="badge bg-primary text-white fw-bold px-3 py-1 rounded-pill mb-2">B2B &amp; Industrial Bulk Procurement</span>
                    <h3 class="fw-bold mb-2">Looking for custom engineering supplies or volume pricing in BDT?</h3>
                    <p class="text-muted mb-0">Our certified engineering specialists provide direct procurement assistance, factory testing compliance, and nationwide deployment in Bangladesh.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('contact.index') }}" class="btn btn-primary rounded-pill px-4 py-3 fw-bold me-2">
                        <i class="bi bi-chat-square-text-fill me-1"></i> Request Custom Quote
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
