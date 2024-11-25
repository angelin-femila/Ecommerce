@extends('index')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>View Category</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Category Details</h5>

                        <!-- Category Details Form (Read-only) -->
                        <form id="viewCategoryForm" class="row g-3">
                            <input type="hidden" id="categoryid" name="categoryid" value="{{ $category->CategoryID }}" readonly>

                            <div class="col-12">
                                <label for="categoryname" class="form-label">Name</label>
                                <input type="text" class="form-control" name="categoryname" id="categoryname" value="{{ $category->CategoryName }}" readonly>
                            </div>

                            <!-- Display Category Image -->
                            <div class="col-12">
                                <label for="categoryimg" class="form-label">Category Image</label>
                                <img src="{{ $category->CategoryImg ? asset($category->CategoryImg) : asset('default-image.png') }}" alt="Category Image" id="currentCategoryImg" style="max-width: 200px; display: block; margin-bottom: 10px;">
                            </div>

                            <div class="text-center">
                                <a href="{{ url('/categorylist') }}" class="btn btn-primary">Back</a> <!-- Back to categories list -->
                            </div>
                        </form><!-- End of Read-only Form -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End Main -->

@endsection
