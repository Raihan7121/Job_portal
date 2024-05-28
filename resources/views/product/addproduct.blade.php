@extends('panel.base')

@section('content')


@include('panel.alert')

<div class="card mb-3">
    <div class="card-body">
        <div class="pt-4 pb-2">
            <h5 class="card-title text-center pb-0 fs-4">Add a new Product</h5>
            <p class="text-center small">Enter your Product details to sell Product</p>
        </div>

        <form action="" name="registrationForm" id="registrationForm" method="POST" >
           @csrf
            <div class="mb-3">
                <label for="name" class="mb-2">Name*</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div> 

            <div class="mb-3">
                <label for="category" class="mb-2">Category<span class="req">*</span></label>
                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                    <option value="">Select a Category</option>
                    <option value="fruits">Fruits</option>
                    <option value="bread">Bread</option>
                    <option value="meat">Meat</option>
                    <option value="vegetables">Vegetables</option>         
                </select>
                @error('category')
                     <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="mb-2">Product Description<span class="req">*</span></label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="5" rows="5" placeholder="Description"></textarea>
                @error('description')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" class="form-control  @error('image') is-invalid @enderror" id="image"  name="image" />
                
                @error('image')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- <div class="mb-3">
                <label for="video" class="form-label">Product Video URL</label>
                <input type="text" class="form-control @error('video') is-invalid @enderror" id="video" name="video" >
                @error('video')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div> --}}
            

            <div class="mb-3">
                <label for="weight" class="mb-2">Weight*</label>
                <input type="text" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror" placeholder="Enter weight">
                @error('weight')
                 <p class="invalid-feedback">{{ $message }}</p>
                 @enderror
            </div> 

            <div class="mb-3">
                <label for="regular_price" class="mb-2">Regular price*</label>
                <input type="text" name="regular_price" id="regular_price" class="form-control @error('regular_price') is-invalid @enderror" placeholder="Enter regular_price" min="0">
                @error('regular_price')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div> 

            <div class="mb-3">
                <label for="offer_price" class="mb-2">Offer price</label>
                <input type="text" name="offer_price" id="offer_price" class="form-control @error('offer_price') is-invalid @enderror" placeholder="Enter offer_price" min="0">
                @error('offer_price')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div> 

            <div class=" mb-3">
                <label for="quantity" class="mb-2">Quantity*<span class="req">*</span></label>
                <input type="number" min="0" placeholder="Quantity" id="quantity" name="quantity" class="form-control @error('quantity') is-invalid @enderror">
                @error('quantity')
                      <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn btn-primary mt-2">Add Product</button>
            <div class="mt-4 text-center">
                <p>Go back home? <a  href="{{ route('panel.dashboard') }}">Go Home</a></p>
            </div>
        </form> 
    </div>
</div>



@endsection

@section('customJs')
<script>
     $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
$('#registrationForm').submit(function(e){
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        url:'{{route("product.add")}}',
        type: 'post',
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(response){
            if(response.status == false){
                var errors = response.errors;
                if(errors.image){
                    //$("#image-error").html(errors.image)
                }
            } else {
                window.location.href = '{{ route('panel.dashboard') }}';
            }          

        }
    });

});

</script>
    
@endsection