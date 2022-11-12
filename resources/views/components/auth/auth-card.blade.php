<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4 col-xxxl-3">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary px-5 py-1">
                    <a href="{{ route('home') }}" class="link-light">
                        <x-svg.brand-logo />
                    </a>
                </div>
                <div class="card-body">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
