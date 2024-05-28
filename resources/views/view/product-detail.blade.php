@extends('view.master')
@section('content')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Product Detail</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Product Detail</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Single Product Start -->
<div class="container-fluid py-5 mt-5">

    

    

    <div class="container py-5">
        <div class="row g-4 mb-5" style="position: relative">
            <div class="col-lg-8 col-xl-9" style="display: flex;flex-direction:row ;border:4px solid blue; border-radius:40px;padding:20px;margin:40px">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="border rounded">
                            <a href="#">
                                @if ($product->product_image)
                                        <img src="{{ asset('product_image/'.$product->product_image.'') }}" class="img-fluid rounded" alt="">
                                        
                                    @else
                                        <img src="{{ asset('img/vegetable-item-6.jpg')}}" class="img-fluid rounded" alt="">
                                       
                                    @endif
                                
                                
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="fw-bold mb-3">{{ $product->name }}</h4>
                        <p class="mb-3">Category: {{ $product->category }}</p>
                        <p class="mb-3">Weight: {{ $product->weight }} kg</p>

                        <div class="d-flex mb-4">
                           
                            @for( $i=0; $i<5 ;$i++)                                                 
                                @if ( $product->no_of_sales/3 >$i )
                                    <i class="fas fa-star text-primary"></i>
                                @else
                                    <i class="fas fa-star"></i>
                                @endif              
                            @endfor
                                    
                        </div>
                        @if ($product->offer_price )
                            <h4 class="mb-3">{{ $product->offer_price }} $  <sub class="text-danger text-decoration-line-through">{{ $product->regular_price }} $</sub>  </h4>
                        @else
                            <h4 class="mb-3">{{ $product->regular_price }} $ </h4>
                        @endif
                        <p class="mb-4">{{ $product->product_description }}</p>
                        
                        {{-- <div class="input-group quantity mb-5" style="width: 200px;border:1px solid black ;padding:10px; border-radius:5px">
                            <div class="input-group-btn" style="margin-right: 5px;">
                                <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                            <div class="input-group-btn" style="margin-left: 5px;">
                                <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div> --}}
                        <a href="{{ route('product.addCart',$product->id)}}" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                    </div>  
                          
                </div>
                
            </div>
           
            <div  style="margin-left:400px">
                {{-- @if ($product->product_video)
                    <iframe width="560" height="315" src="{{$product->product_video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                @else
                    <iframe width="560" height="315" src="https://www.youtube.com/watch?v=ijDGDRUAo74&list=PL0b6OzIxLPbz7JK_YYrRJ1KxlGG4diZHJ&index=36&t=5s&ab_channel=YahooBaba" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                @endif --}}
            </div> 
            
        

        
    </div>
        <h1 class="fw-bold mb-0">Related products</h1>
       
        <div class="vesitable">
            <div class="owl-carousel vegetable-carousel justify-content-center">

                @if ($relative_products->isNotEmpty())
                @foreach ($relative_products as $r_product )

                        <div class="border border-primary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                                @if ($r_product->product_image)
                                        <img src="{{ asset('product_image/'.$r_product->product_image.'') }}" class="img-fluid rounded-circle w-100" alt="">
                                               
                                @else
                                    <img src="{{ asset('assets/images/banner-1.jpg') }}" class="img-fluid rounded-circle w-100" alt="">
                                                
                                @endif
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">{{ $r_product->category }}</div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4>{{ $r_product->name }}</h4>
                                <p>{{ $r_product->product_description }}</p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                        @if ($r_product->offer_price )
                                            <h4 class="mb-3">{{ $r_product->offer_price }} $  <sub class="text-danger text-decoration-line-through">{{ $product->regular_price }} $</sub>  </h4>
                                        @else
                                            <h4 class="mb-3">{{ $r_product->regular_price }} $ </h4>
                                        @endif
                                    <a href="{{ route('product.addCart',$r_product->id)}}" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                    <a href="{{ route('product.product-detail',$r_product->id)}}" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary" style="margin-left: 83px"><i class="fa fa-shopping-bag me-2 text-primary"></i> Show Product</a>
                                    
                                </div>
                            </div>
                        </div>


                @endforeach
                
                
                @endif

                
                
            </div>
        </div>
    </div>
</div>
<!-- Single Product End -->

@endsection