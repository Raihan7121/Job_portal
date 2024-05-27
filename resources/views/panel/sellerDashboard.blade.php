<!-- Recent Sales -->
<div class="col-12">
    <div class="card recent-sales ">

     
      <div class="card-body">
        <h5 class="card-title">My Sales</h5>

        <table class="table table-borderless ">
          <thead>
            <tr>
              <th scope="col">#Id</th>
              <th scope="col">Customer Id</th>
              <th scope="col">Product</th>
              <th scope="col">Quantity</th>
              <th scope="col">Price</th>
              <th scope="col">Total Price</th>
            </tr>
          </thead>
          <tbody>
            @if($products->isNotEmpty())
            @foreach ($products as $product )
                    @foreach ($product->sells as $sell)
                        <tr>
                            <th scope="row"><a href="#">#{{$product->id}}</a></th>
                            <td>#{{$sell->customer_id}}</td>
                            <td><a href="#" class="text-primary">{{$product->name}}</a></td>
                            <td>{{$sell->quantity}}</td>
                            <td>${{$sell->price}}</td>
                            <td>${{$sell->total_price}}</td>
                        </tr>                  
                    @endforeach
                
                
            @endforeach
            @else
                    <tr>Not Found</tr>
            @endif
          </tbody>
          
        </table>
        {{ $products->links()}}

      </div>

    </div>
  </div><!-- End Recent Sales -->