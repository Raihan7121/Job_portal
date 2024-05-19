@extends('panel.master')
@section('content')

  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Products</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Procduct</a></li>
          <li class="breadcrumb-item active">Show</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">


            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales ">

               
                <div class="card-body">
                  <h5 class="card-title">Your All Products List</h5>

                  <table class="table table-borderless ">
                    <thead>
                      <tr>
                        <th scope="col">#Id</th>
                
                        <th scope="col">Category</th>
                        <th scope="col">Product</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Regular_Price</th>
                        <th scope="col">Offer_  Price</th>
                        <th scope="col">Available</th>
                        <th scope="col">No_of_Sale</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody style="align-content: center">
                      @if ($products->isNotEmpty())
                        @foreach ($products as $product)
                            <tr>
                              <th scope="row"><a href="#">#{{ $product->id }}</a></th>
                           
                              <td><a href="#" class="text-primary">{{ $product->category }}</a></td>
                              <td>{{ $product->name }}</td>
                              <td>{{ $product->weight }}</td>
                              <td>${{ $product->regular_price }}</td>
                              <td>${{ $product->offer_price }}</td>
                              <td>{{ $product->quantity }}</td>
                              <td>{{ $product->no_of_sales }}</td>
                              <td style="display: flex margin:20px ">
                                <a href="{{route('product.edit',$product->id)}}"><span class="badge bg-success">Edit</span></a>
                                <a href="{{ route('product.delete', $product->id ) }}" onclick="return confirm('Are you sure you want to delete this product?')"><span class="badge bg-danger">X</span></a>
                                      
                              </td>
                            </tr>
      
                        @endforeach
                          
                      @endif
                     
                    </tbody>
                    
                  </table>
                  
                    <div class="pagination-links" style="">
                      {{ $products->links() }}
                    </div>
                

                </div>

              </div>
            </div><!-- End Recent Sales -->

            
          </div>
        </div><!-- End Left side columns -->


        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->


  @endsection

  