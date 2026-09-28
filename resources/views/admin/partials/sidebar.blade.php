<div class="col-lg-2 sidebar p-3">
    <div class="mb-4 d-flex align-items-center gap-2">
        <div style="width: 10px; height: 10px; border-radius: 50%; background: #00c6ff;"></div>
        <h5 class="text-white mb-0 fw-bold">Enerix Admin</h5>
    </div>
    <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
    
    @can('Web_Settings')
        <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#webSettingsMenu"
            role="button" aria-expanded="false" aria-controls="webSettingsMenu">
            <span><i class="bi bi-gear me-2"></i> Web Settings</span>
            <i class="bi bi-chevron-down"></i>
        </a>
        <div class="collapse ps-3" id="webSettingsMenu">
            <a href="{{ route('admin.settings.edit') }}">General & Hero</a>
            <a href="{{ route('admin.page-content.edit') }}">Pages Content</a>
            <a href="{{ route('admin.homepage-carousel-images.index') }}">Hero Slides</a>
            <a href="{{ route('admin.counters.index') }}">Counters & Stats</a>
            <a href="{{ route('admin.testimonials.index') }}">Testimonials</a>
            <a href="{{ route('admin.faqs.index') }}">FAQs</a>
            <a href="{{ route('admin.about.edit') }}">About Page</a>
            <a href="{{ route('admin.team-members.index') }}">Team Members</a>
            <a href="{{ route('admin.blogs.index') }}">Blogs</a>
            <a href="{{ route('admin.galleries.index') }}">Gallery</a>
        </div>
    @endcan

    @canany(['manage services', 'manage projects', 'manage industries'])
        <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#enerixModulesMenu"
            role="button" aria-expanded="true" aria-controls="enerixModulesMenu">
            <span><i class="bi bi-diagram-3 me-2"></i> Solutions & Work</span>
            <i class="bi bi-chevron-down"></i>
        </a>
        <div class="collapse show ps-3" id="enerixModulesMenu">
            @can('manage services')
                <a href="{{ route('admin.services.index') }}"><i class="bi bi-lightbulb me-1"></i> Solutions</a>
            @endcan
            @can('manage projects')
                <a href="{{ route('admin.projects.index') }}"><i class="bi bi-briefcase me-1"></i> Projects</a>
            @endcan
            @can('manage industries')
                <a href="{{ route('admin.industries.index') }}"><i class="bi bi-buildings me-1"></i> Industries</a>
            @endcan
        </div>
    @endcanany

    @can('manage products')
        <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#productsMenu"
            role="button" aria-expanded="false" aria-controls="productsMenu">
            <span><i class="bi bi-box-seam me-2"></i> Products</span>
            <i class="bi bi-chevron-down"></i>
        </a>
        <div class="collapse ps-3" id="productsMenu">
            <a href="{{ route('admin.products.index') }}">Products</a>
            <a href="{{ route('admin.product-categories.index') }}">Categories</a>
            <a href="{{ route('admin.product-subcategories.index') }}">Subcategories</a>
        </div>
    @endcan

    @canany(['manage users', 'manage roles', 'manage permissions'])
        <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#managementMenu"
            role="button" aria-expanded="false" aria-controls="managementMenu">
            <span><i class="bi bi-people me-2"></i> Management</span>
            <i class="bi bi-chevron-down"></i>
        </a>
        <div class="collapse ps-3" id="managementMenu">
            @can('manage users')
                <a href="{{ route('admin.users.index') }}">Users</a>
            @endcan
            @can('manage roles')
                <a href="{{ route('admin.roles.index') }}">Roles</a>
            @endcan
            @can('manage permissions')
                <a href="{{ route('admin.permissions.index') }}">Permissions</a>
            @endcan
        </div>
    @endcanany

    <div class="mt-4 pt-3 border-top border-secondary">
        <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-info w-100 mb-2 text-start">
            <i class="bi bi-box-arrow-up-right me-1"></i> Visit Website
        </a>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger w-100 text-start">
                <i class="bi bi-box-arrow-right me-1"></i> Log Out
            </button>
        </form>
    </div>
</div>
