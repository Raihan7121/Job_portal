<!-- Recent Sales -->
<div class="col-12">
    <div class="card recent-sales ">

     
      <div class="card-body">
        <h5 class="card-title">My Orders</h5>

        <table class="table table-borderless ">
          <thead>
            <tr>
              <th scope="col">#Id</th>
             
              <th scope="col">Product</th>
              <th scope="col">Quantity</th>
              <th scope="col">Price</th>
              <th scope="col">Total Price</th>
            </tr>
          </thead>
         
            @if($sells->isNotEmpty())
                  <tbody>
           
                    @foreach ($sells as $sell)
                        <tr>
                            <th scope="row"><a href="#">#{{$sell->product->id}}</a></th>
                            
                            <td><a href="#" class="text-primary">{{$sell->product->name}}</a></td>
                            <td>{{$sell->quantity}}</td>
                            <td>${{$sell->price}}</td>
                            <td>${{$sell->total_price}}</td>
                        </tr>                  
                    @endforeach
                
                  </tbody>
           
            @else
                    <td>Not Found</td>
            @endif
         
          
        </table>

        {{ $sells->links()}}

      </div>

    </div>
  </div><!-- End Recent Sales -->