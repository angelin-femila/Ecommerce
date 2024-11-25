@extends('index')

@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1> Categories</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">

            <h5 class="card-title d-flex justify-content-between align-items-end">
              Ministore
              <a href="{{url('/addcategory')}}"><button type="button" class="btn btn-primary">Add</button></a>
            </h5>

            <!-- Table with stripped rows -->
            <table class="table table-striped">
              <thead>
                <tr>
                <th scope="col" class="text-start">S.No</th>
                <th scope="col" class="text-start">Name</th>
                <th scope="col" class="text-start">Image</th>
                <th scope="col" class="text-end">Action</th>
                 
                </tr>
              </thead>
              <tbody>
                @php
                $i=1;
                @endphp
                @foreach($categories as $category)

                <tr>
                  <th scope="row" class="text-start">{{$i++ }}</th>
                  <td class="text-start">{{ $category->CategoryName }}</td>
                  <td class="text-start"> 
                  <img src="{{ $category->CategoryImg ? asset($category->CategoryImg) : asset('default-image.png') }}" alt="Category Image" width="100">
                  </td>
                 
                  <td class="text-center">
                    <a href="{{ url('/viewcategory/'.$category->CategoryID) }}" class="btn btn-info btn-sm">View</a>
                   
                </td>
                 
                 <td class="text-center">
                    <a href="{{ url('/editcategory/'.$category->CategoryID) }}" class="btn btn-success btn-sm">Edit</a>
                   
                </td>

                  <td class="text-start">
                    <a href="{{ url('/deletecategory/'.$category->CategoryID) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                  </td>


                  @endforeach
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

@endsection