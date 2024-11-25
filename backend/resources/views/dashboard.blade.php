@extends('index')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1> Ecommerce Dashboard</h1>
    </div><!-- End Page Title -->

    @if (session('success'))
    <div class="alert alert-success" id="success-alert">
        {{ session('success') }}
    </div>

    <script>
        // Wait for the DOM to fully load
        document.addEventListener("DOMContentLoaded", function() {
            // Set a timeout to hide the alert after 5 seconds (5000 ms)
            setTimeout(function() {
                var alertElement = document.getElementById('success-alert');
                if (alertElement) {
                    // Fade out by reducing opacity, and then hide
                    alertElement.style.transition = 'opacity 0.5s ease-out';
                    alertElement.style.opacity = '0'; // Start fading out
                    setTimeout(function() {
                        alertElement.style.display = 'none'; // Hide it after fade
                    }, 500); // 500ms for the fade effect
                }
            }, 1000); // Wait for 1 second before hiding
        });
    </script>

    @endif

   <!--  <div class="position-relative">
        <img src="{{ asset('public/images/Banner2.png') }}" alt="eCommerce Banner" class="img-fluid">

        <div class="position-absolute top-0 end-0 p-3">
            <div class="d-flex flex-column align-items-end">
                <a href="#" class="btn btn-primary mb-2"><i class="fas fa-plus"></i></a>
                <a href="#" class="btn btn-warning mb-2"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
            </div>
        </div>
    </div> -->

</main>

@endsection