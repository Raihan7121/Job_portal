@extends('panel.master')
@section('content')
@include('panel.alert')
  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">
            @if (Auth::user() && Auth::user()->role == 'admin')
                @include('panel.adminDashboard')
            @elseif (Auth::user() && Auth::user()->role == 'seller')
                @include('panel.sellerDashboard')
            @elseif (Auth::user() && Auth::user()->role == 'user')
                @include('panel.buyerDashboard')
            @endif

            

           

           

            <!-- Top Selling -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">

              

                <div class="card-body pb-0">
                  <h5 class="card-title">Top Selling Product </h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Preview</th>
                        <th scope="col">Product</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Sold</th>
                        <th scope="col">Revenue</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($best_seller_products->isNotEmpty())
                          @foreach ($best_seller_products as $product )
                            <tr>
                              @if ($product->product_image)
                                <th scope="row"><a href="#"><img src="{{ asset('product_image/'.$product->product_image.'') }}" alt=""></a></th>
                              @else
                                <th scope="row"><a href="#"><img src="assets/img/product-1.jpg" alt=""></a></th>
                              @endif
                              
                              <td><a href="#" class="text-primary fw-bold">{{ $product->name }}</a></td>
                              <td>{{$product->category}}</td>
                              <td>$ {{  ($product->offer_price)? $product->offer_price : $product->regular_price }}</td>
                              <td class="fw-bold">{{ $product->no_of_sales }}</td>
                              <td>$ {{ $product->total_revenue }}</td>
                            </tr>
                          @endforeach
                     
                      @endif
                      
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Top Selling -->

          </div>
        </div><!-- End Left side columns -->


        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->


  @endsection

  