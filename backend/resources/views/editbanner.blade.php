@extends('index')

@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Banner</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Banner Details</h5>

            <!-- Vertical Form -->
            <form id="editBannerForm" class="row g-3" enctype="multipart/form-data>">
              @csrf
            <input type="hidden" id="BannerID" name="BannerID"  value="{{ $banners->BannerID }}">

             

              <!-- Image upload section -->
              <div class="col-12">
                <label for="bannerimg" class="form-label">Banner Image</label>
                @if($banners->BannerImg)
                <img src="{{ $banners->BannerImg ? asset($banners->BannerImg) : asset('default-image.png') }}" alt="Banner Image" id="currentBannerImg" style="max-width: 200px; display: block; margin-bottom: 10px;">

                <input type="file" class="form-control" id="BannerImg" name="BannerImg">
                @else
                <input type="file" class="form-control" id="BannerImg" name="BannerImg">
                @endif
              </div>
              

              <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url('/bannerlist') }}" class="btn btn-secondary">Cancel</a>
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
        $('#BannerImg').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#currentBannerImg').attr('src', e.target.result);
            }
            if (this.files && this.files[0]) {
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Handle form submission
        $('#editBannerForm').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "{{url('/updatebanner') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert(response.success);
                    window.location.href = "{{ url('/bannerlist') }}";
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
