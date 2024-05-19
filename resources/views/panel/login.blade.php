@extends('panel.base')

@section('content')

@include('panel.alert')

<div class="card mb-3">

  <div class="card-body">

    <div class="pt-4 pb-2">
      <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
      <p class="text-center small">Enter your username & password to login</p>
    </div>

    <form class="row g-3 needs-validation" action="{{ route('panel.authenticate')}}" method="post" novalidate>
      @csrf
      <div class="mb-3">
        <label for="" class="mb-2">Email*</label>
        <input type="text" value="{{ old('email') }}" name="email" id="email" class="form-control @error('email') is-invalid @enderror"  placeholder="example@example.com">

        @error('email')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror

      </div> 
    <div class="mb-3">
        <label for="" class="mb-2">Password*</label>
        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password">

        @error('password')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>


      <div class="col-12">
        <button class="btn btn-primary w-100" type="submit">Login</button>
      </div>
      <div class="col-12">
        <p class="small mb-0">Don't have account? <a href="{{route('panel.registration')}}">Create an account</a></p>
      </div>
    </form>

  </div>
</div>
  
@endsection

            

            