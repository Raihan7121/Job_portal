@extends('panel.base')

@section('content')

<div class="card mb-3">

    <div class="card-body">

      <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
        <p class="text-center small">Enter your personal details to create account</p>
      </div>

      {{-- <form class="row g-3 needs-validation" novalidate>
        <div class="col-12">
          <label for="yourName" class="form-label">Your Name</label>
          <input type="text" name="name" class="form-control" id="yourName" required>
          <p></p>
        </div>

        <div class="col-12">
          <label for="yourEmail" class="form-label">Your Email</label>
          <input type="email" name="email" class="form-control" id="yourEmail" required>
          <p></p>
        </div>

        

        <div class="col-12">
          <label for="yourPassword" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="yourPassword" required>
          <div class="invalid-feedback">Please enter your password!</div>
        </div>

        <div class="col-12">
          <label for="yourPassword" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="yourPassword" required>
          <div class="invalid-feedback">Please enter your password!</div>
        </div>

        <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
            <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
            <div class="invalid-feedback">You must agree before submitting.</div>
          </div>
        </div>
        <div class="col-12">
          <button class="btn btn-primary w-100" type="submit">Create Account</button>
        </div>
        <div class="col-12">
          <p class="small mb-0">Already have an account? <a href="pages-login.html">Log in</a></p>
        </div>
      </form> --}}
      <form action="" name="registrationForm" id="registrationForm">
        <div class="mb-3">
            <label for="" class="mb-2">Name*</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
            <p></p>
        </div> 
        {{-- <div class="mb-3">
          <label for="" class="mb-2">Category<span class="req">*</span></label>
          <select name="role" id="role" class="form-control">
              <option value="">Select a Category</option>
             
                  <option value="admin">Admin </option>
                  <option value="seller">Seller </option>
                  <option value="user">User</option>
                 
          </select>
          <p></p>
      </div> --}}
        <div class="mb-3">
            <label for="" class="mb-2">Email*</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email">
            <p></p>
        </div> 
        <div class="mb-3">
            <label for="" class="mb-2">Password*</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
            <p></p>
        </div> 
        <div class="mb-3">
            <label for="" class="mb-2">Confirm Password*</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Please Confirm Password">
            <p></p>
        </div> 
        <button class="btn btn-primary mt-2">Register</button>
        <div class="mt-4 text-center">
          <p>Have an account? <a  href="{{ route('panel.login') }}">Login</a></p>
      </div>
        
    </form> 

    </div>
  </div>
    
@endsection

@section('customJs')

<script>

$("#registrationForm").submit(function(e){
    e.preventDefault();

    $.ajax({
        url: '{{ route("panel.processRegistration") }}',
        type: 'post',
        data: $("#registrationForm").serializeArray(),
        dataType: 'json',
        success: function(response) {
            if (response.status == false){
                var errors = response.errors;
                if(errors.name){
                    $("#name").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').
                    html(errors.name)
                }else{
                    $("#name").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').
                    html('')
                }

                if(errors.email){
                    $("#email").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').
                    html(errors.email)
                }else{
                    $("#email").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').
                    html('')
                }

                if(errors.password){
                    $("#password").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').
                    html(errors.password)
                }else{
                    $("#password").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').
                    html('')
                }

                if(errors.confirm_password){
                    $("#confirm_password").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').
                    html(errors.confirm_password)
                }else{
                    $("#confirm_password").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').
                    html('')
                }
            } else {

                $("#name").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').
                    html('')

                $("#email").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').
                    html('')

                $("#password").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').
                    html('')

                $("#confirm_password").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').
                    html('')

                window.location.href='{{ route("panel.login") }}';
            }
        }
    })
});

</script>

@endsection