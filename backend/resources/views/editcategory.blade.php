@extends('index')

@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Category</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Category Details</h5>

            <!-- Vertical Form -->
            <form id="editCategoryForm" class="row g-3" enctype="multipart/form-data>">
              @csrf
            <input type="hidden" id="CategoryID" name="CategoryID"  value="{{ $category->CategoryID }}">

              <div class="col-12">
                <label for="CategoryName" class="form-label">Name</label>
                <input type="text" class="form-control" id="CategoryName" name="CategoryName"  value="{{ $category->CategoryName }}">
              </div>

              <!-- Image upload section -->
              <div class="col-12">
                <label for="productimg" class="form-label">Category Image</label>
                @if($category->CategoryImg)
                <img src="{{ $category->CategoryImg ? asset($category->CategoryImg) : asset('default-image.png') }}" alt="Category Image" id="currentCategoryImg" style="max-width: 200px; display: block; margin-bottom: 10px;">

                <input type="file" class="form-control" id="CategoryImg" name="CategoryImg">
                @else
                <input type="file" class="form-control" id="CategoryImg" name="CategoryImg">
                @endif
              </div>
              

              <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url('/categorylist') }}" class="btn btn-secondary">Cancel</a>
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
        // Update image preview when a new file is selected
        $('#CategoryImg').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#currentCategoryImg').attr('src', e.target.result);
            }
            if (this.files && this.files[0]) {
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Handle form submission
        $('#editCategoryForm').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "{{url('/updatecategory') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert(response.success);
                    window.location.href = "{{ url('/categorylist') }}";
                },
                error: function(response) {
                    if (response.responseJSON && response.responseJSON.errors) {
                        let errors = response.responseJSON.errors;
                        let errorMessages = '';
                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + '\n';
                        });
                        alert('Validation errors:\n' + errorMessages);
                    } else {
                        alert('An error occurred while processing the request.');
                    }
                }
            });
        });
    });
</script>




@endsection
