@extends('index')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>View Banner</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Banner Details</h5>

                        <!-- Category Details Form (Read-only) -->
                        <form id="viewBannerForm" class="row g-3">
                        <input type="hidden" id="bannerid" name="bannerid" value="{{ $banners->BannerID }}" readonly>

                            
                            <!-- Display Category Image -->
                            <div class="col-12">
                                <label for="BannerImg" class="form-label">Banner Image</label>
                                <img src="{{ $banners->BannerImg ? asset($banners->BannerImg) : asset('default-image.png') }}" alt="Banner Image" id="currentBannerImg" style="max-width: 500px; display: block; margin-bottom: 10px;">
                            </div>

                            <div class="text-center">
                                <a href="{{ url('/bannerlist') }}" class="btn btn-primary">Back</a> <!-- Back to categories list -->
                            </div>
                        </form><!-- End of Read-only Form -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End Main -->

@endsection
