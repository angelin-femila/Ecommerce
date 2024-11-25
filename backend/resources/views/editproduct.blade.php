@extends('index')

@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Product</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Product Details</h5>

            <!-- Vertical Form -->
            <form id="editProductForm" class="row g-3">
              <input type="hidden" id="productid" name="productid" value="{{ $product->productid }}">

              <div class="col-12">
                <label for="productname" class="form-label">Name</label>
                <input type="text" class="form-control" name="productname" id="productname" value="{{ $product->productname }}">
              </div>
              <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" name="description" id="description" value="{{ $product->description }}">
              </div>
              <!-- Image upload section -->
              <div class="col-12">
                <label for="productimg" class="form-label">Product Image</label>
                <img src="{{ $product->productimg ? asset($product->productimg) : asset('default-image.png') }}" alt="Product Image" id="currentProductImg" style="max-width: 200px; display: block; margin-bottom: 10px;">

                <input type="file" class="form-control" name="productimg" id="productimg" name="productimg">
              </div>

              <div class="col-12">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" name="price" id="price" value="{{ $product->price }}">
              </div>
              <div class="col-12">
                <label for="stock" class="form-label">Stock</label>
                <input type="text" class="form-control" name="stock" id="stock" value="{{ $product->stock }}">
              </div>

              <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url('/productlist') }}" class="btn btn-secondary">Cancel</a>
              </div>
            </form><!-- Vertical Form -->
            
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<!-- jQuery script for handling form submission -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    // Preview image on file input change
    $('#productimg').on('change', function() {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#currentProductImg').attr('src', e.target.result);
      }
      if (this.files && this.files[0]) {
        reader.readAsDataURL(this.files[0]);
      }
    });

    // Handle form submission
    $('#editProductForm').on('submit', function(e) {
      e.preventDefault();

      var formData = new FormData(this);
      formData.append('_token', '{{ csrf_token() }}');

      $.ajax({
        type: 'POST',
        url: "{{ url('/updateproduct') }}",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          alert(response.success);
          // Optionally, you might want to update the image URL here
          // $('#currentProductImg').attr('src', response.imageUrl);
          // Redirect or update the page content as needed
          window.location.href = "{{ url('/productlist') }}";
        },
        error: function(response) {
          console.error(response.responseText); // Log full error response
          alert('An error occurred while processing the request.');
        }
      });
    });
  });
</script>

@endsection