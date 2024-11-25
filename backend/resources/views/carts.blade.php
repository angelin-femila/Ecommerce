@extends('index')

@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Shopping Cart</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">

            <h5 class="card-title">Cart Items</h5>

            <!-- Table with cart items -->
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col" class="text-start">S.No</th>
                  <th scope="col" class="text-center">Name</th>
                  <th scope="col" class="text-center">Quantity</th>
                  <th scope="col" class="text-end">Price</th>
                  <th scope="col" class="text-end">Total</th>
                  <th scope="col" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                $i = 1;
                $totalAmount = 0;
                @endphp
                @foreach($cartItems as $item)
                <tr>
                  <th scope="row" class="text-start">{{ $i++ }}</th>
                  <td class="text-center">{{ $item->productname }}</td>
                  <td class="text-center">{{ $item->CartQuantity }}</td>
                  <td class="text-end">₹{{ $item->price }}</td>
                  <td class="text-end">₹{{ $item->CartQuantity * $item->price }}</td>
                  <td class="text-center">
                    <!-- Add any actions for cart items if needed -->
                  </td>
                </tr>
                @php
                $totalAmount += $item->CartQuantity * $item->price;
                @endphp
                @endforeach
              </tbody>
            </table>
            <!-- End Table with cart items -->

           

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

@endsection
