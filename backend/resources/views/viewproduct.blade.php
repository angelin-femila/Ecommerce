@extends('index')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>View Product</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Product Details</h5>

                        <!-- Product Details Form (Read-only) -->
                        <form id="viewProductForm" class="row g-3">
                            <input type="hidden" id="productid" name="productid" value="{{ $product->productid }}" readonly>

                            <div class="col-12">
                                <label for="productname" class="form-label">Name</label>
                                <input type="text" class="form-control" name="productname" id="productname" value="{{ $product->productname }}" readonly>
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" name="description" id="description" value="{{ $product->description }}" readonly>
                            </div>
                            
                            <!-- Display Product Image -->
                            <div class="col-12">
                                <label for="productimg" class="form-label">Product Image</label>
                                <img src="{{ $product->productimg ? asset($product->productimg) : asset('default-image.png') }}" alt="Product Image" id="currentProductImg" style="max-width: 200px; display: block; margin-bottom: 10px;">
                            </div>

                            <div class="col-12">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" class="form-control" name="price" id="price" value="{{ $product->price }}" readonly>
                            </div>
                            <div class="col-12">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="text" class="form-control" name="stock" id="stock" value="{{ $product->stock }}" readonly>
                            </div>

                            <div class="text-center">
                                <a href="{{ url('/productlist') }}" class="btn btn-primary">Back</a> <!-- Back to product list -->
                            </div>
                        </form><!-- End of Read-only Form -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End Main -->

@endsection
