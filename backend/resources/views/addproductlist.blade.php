@extends('index')

@section('content')

<main id="main" class="main">



    <div class="pagetitle">
        <h1>Form</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Product List</h5>

                        <!-- Vertical Form -->
                        <form id="productForm" class="row g-3" enctype="multipart/form-data">
                            <div class="col-12">
                                <label for="productname" class="form-label">Name</label>
                                <input type="text" class="form-control" id="productname" name="name">
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                            <div class="col-12">
                                <label for="productimg" class="form-label">File Upload</label>
                                <input class="form-control" type="file" id="productimg" name="productimg" required>
                            </div>
                            <div class="col-12">
                                <label for="CategoryName" class="form-label">Category</label>
                                <select class="form-select" aria-label="Default select example" id="CategoryName" name="category">
                                    <option selected disabled>Choose a category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->CategoryID }}">{{ $category->CategoryName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" class="form-control" id="price" name="price">
                            </div>
                            <div class="col-12">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="text" class="form-control" id="stock" name="stock">
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                        <!-- Vertical Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- jQuery script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#productForm').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                type: 'POST',
                url: "{{ url('/addproductlist') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert('Product added successfully');
                    window.location.href = "{{ url('/productlist') }}";
                },
                error: function(response) {
                    console.log(response.responseJSON.errors); // Log validation errors
                    alert('Error: ' + JSON.stringify(response.responseJSON.errors));
                }
            });
        });
    });
</script>


@endsection