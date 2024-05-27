@extends('view.master')
@section('content')

   <!-- Single Page Header start -->
   <div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Cart Page Start -->

@include('panel.alert')


<form action="{{route('checkout')}}" name="registrationForm" id="registrationForm" method="POST" >
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Products</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Available</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                        @if ($orders)
                            @foreach ($orders as $order)
                                <tr data-product-id="{{ $order->product->id }}" data-product-price="{{ $order->product->offer_price }}">
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            @if ($order->product->product_image)
                                                <img src="{{ asset('product_image/'.$order->product->product_image) }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                            @else
                                                <img src="{{ asset('assets/img/vegetable-item-3.png')}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                            @endif
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4">{{ $order->product->name }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4">{{ $order->product->category }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4 unitprice">$ {{ $order->product->offer_price }} </p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4 unitquantity">{{ $order->product->quantity }} </p>
                                    </td>
                                    <td>
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control form-control-sm text-center border-0 quantity-input" min="1" name="quantities[{{ $order->product->id }}]"   value="1">
                                            {{-- <input type="text" class="form-control form-control-sm text-center border-0 quantity-input" onchange="pdateSubtotal()" value="1"> --}}
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4 total-price">${{ $order->product->offer_price }} </p>
                                    </td>
                                    <td>
                                        <a href="{{route('product.delete-cart',$order->id)}}" class="btn btn-md rounded-circle bg-light border mt-4">
                                            <i class="fa fa-times text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0 subtotal">$96.00</p>
                            </div>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">VAT/TAX:</h5>
                                <p class="mb-0 tax">$96.00</p>
                            </div>
                            
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <input type="hidden" name="total_bill" id="total_bill" value="1">
                            <p class="mb-0 pe-4 totalbill">$99.00</p>
                        </div>
                        {{-- <button type="submit">Checkout</button> --}}
                        <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="submit">Pay Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Cart Page End -->

    
@endsection

@section('customJs')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-minus').forEach(button => {
            button.addEventListener('click', function () { 
                const quantityInput = this.closest('tr').querySelector('.quantity-input');
                let quantity = parseInt(quantityInput.value);
                if (quantity < 1) {
                    quantityInput.value = 1;
                }
                  
                updateSubtotal();
            });
        });
    
        document.querySelectorAll('.btn-plus').forEach(button => {
            button.addEventListener('click', function () {
                const row = this.closest('tr');
                const quantityInput = row.querySelector('.quantity-input');
                let quantity = parseInt(quantityInput.value);
                const available = parseInt(row.querySelector('.unitquantity').textContent);

                if (quantity < available) {
                    quantityInput.value = quantity;
                } else {
                    quantityInput.value = available;
                    alert('Quantity cannot be more than available stock. Adjusted to available stock.');
                }
                // const quantityInput = this.closest('tr').querySelector('.quantity-input');
                // let quantity = parseInt(quantityInput.value);
                updateSubtotal();
                //updateTotalPrice(this.closest('tr'));
            });
        });

        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function () {
                const row = this.closest('tr');
                let quantity = parseInt(this.value);
                const available = parseInt(row.querySelector('.unitquantity').textContent);

                if (quantity > available) {
                    alert('Quantity cannot be more than available stock. Adjusted to available stock.');
                    this.value = available;
                } else if (quantity < 1 || isNaN(quantity)) {
                    this.value = 1;
                }
                updateTotalPrice(row);
            });
        });
    
        function updateTotalPrice(row) {
           // const productPrice = parseFloat(row.dataset.productPrice);
           // const quantity = parseInt(row.querySelector('.quantity-input').value);
           // const totalPriceElement = row.querySelector('.total-price');
           // totalPriceElement.textContent = ' $'+(productPrice * quantity).toFixed(2);
            updateSubtotal(); 
        }

        function updateSubtotal() {
            let subtotal = 0;
            let totalPrice=0;
            document.querySelectorAll('tr[data-product-id]').forEach(row => {

                

                const unitPriceElement = row.querySelector('.unitprice');
                const unitPrice = parseFloat(unitPriceElement.textContent.replace('$', ''));
                unitPriceElement.textContent = '$' + unitPrice.toFixed(2);

               // const available = parseInt(row.querySelector('.unitquantity').textContent);
                
                const quantity = parseInt(row.querySelector('.quantity-input').value);

                // if(quantity>=available){
                //     quantity=available;
                //     const unitQuantityElement = row.querySelector('.quantity-input');
                //     unitQuantityElement.value = quantity;
                // }
                totalPrice = unitPrice*quantity;
                const totalPriceElement = row.querySelector('.total-price');
                //const totalPriceElement = row.querySelector('.total-price');
                //const totalPrice = parseFloat(totalPriceElement.textContent.replace('$', ''));
                totalPriceElement.textContent = '$' + totalPrice.toFixed(2);
                subtotal += totalPrice;
            });

            let tax = subtotal*.15;
            let total = subtotal+tax;
            const subtotalElement = document.querySelector('.subtotal');
            subtotalElement.textContent = '$' + subtotal.toFixed(2);
            const taxElement = document.querySelector('.tax');
            taxElement.textContent = '$' + tax.toFixed(2);
            const totalElement = document.querySelector('.totalbill');
            totalElement.textContent = '$' + total.toFixed(2);

            const totalBillInput = document.getElementById('total_bill');
            totalBillInput.value = total.toFixed(2);
        }

        updateSubtotal();
    });

    </script>
@endsection