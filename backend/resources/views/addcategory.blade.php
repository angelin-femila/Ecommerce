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
                        <h5 class="card-title">Add Category List</h5>
                        <form id="categoryForm" class="row g-3" enctype="multipart/form-data">

                            <div class="col-12">
                                <label for="CategoryName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="CategoryName" name="CategoryName" required>
                            </div>

                            <div class="col-12">
                                <label for="CategoryImg" class="form-label">File Upload</label>
                                <input class="form-control" type="file" id="CategoryImg" name="CategoryImg" required>
                            </div>

                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>


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
        // Attach the submit event handler to the form by its ID
        $('#categoryForm').on('submit', function(e) {
            e.preventDefault(); // Prevent form from submitting the default way

            var formData = new FormData(this); // Create FormData object
            formData.append('_token', '{{ csrf_token() }}'); // Append CSRF token

            $.ajax({
                type: 'POST',
                url: "{{ url('/addcategory') }}", // Route to add category
                data: formData, // Pass FormData object
                processData: false, // Prevent jQuery from automatically processing the data
                contentType: false, // Prevent jQuery from setting content type automatically
                success: function(response) {
                    alert('Category added successfully'); // Show success message
                    // Redirect to the category list page after successful submission
                    window.location.href = "{{ url('/categorylist') }}";
                },
                error: function(response) {
                    alert('Error: ' + response.responseJSON.message); // Show error message
                }
            });
        });
    });
</script>

@endsection