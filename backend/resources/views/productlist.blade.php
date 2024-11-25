@extends('index')

@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1> Product</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">

            <h5 class="card-title d-flex justify-content-between align-items-end">
              Ministore
              <a href="{{url('/addproductlist')}}"><button type="button" class="btn btn-primary">Add</button></a>
            </h5>

            <!-- Table with stripped rows -->
            <table class="table table-striped">
              <thead>
                <tr>
                <th scope="col" class="text-start">S.No</th>
                  <th scope="col" class="text-center">Name</th>
                  <th scope="col" class="text-center">Description</th>
                  <th scope="col" class="text-center">Image</th>
                  <th scope="col" class="text-center">Category</th> <!-- Add Category column -->
                  <th scope="col" class="text-end">Price</th>
                  <th scope="col" class="text-center">Stock</th>
                  <th scope="col" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                $i=1;
                @endphp
                @foreach($products as $product)

                <tr>
                <th scope="row" class="text-start">{{$i++ }}</th>
                  <td class="text-center">{{ $product->productname }}</td>
                  <td class="text-center">{{ $product->description }}</td>
                  <td class="text-start"> 
                  <img src="{{ $product->productimg ? asset($product->productimg) : asset('default-image.png') }}" alt="Product Image" width="100">
                  </td>
                  <td class="text-center">{{ $product->CategoryName }}</td> <!-- Display Category Name -->
                 
                  <td class="text-end">₹{{ $product->price }}</td>
                  <td class="text-center">{{ $product->stock }}</td>

                  <td class="text-center">
                    <a href="{{ url('/viewproduct/'.$product->productid) }}" class="btn btn-info btn-sm">View</a>
                  </td>

                  <td class="text-center">
                    <a href="{{ url('/editproduct/'.$product->productid) }}" class="btn btn-success btn-sm">Edit</a>
                   

                  </td>
                  <td class="text-center">
                    <a href="{{ url('/deleteproduct/'.$product->productid) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
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