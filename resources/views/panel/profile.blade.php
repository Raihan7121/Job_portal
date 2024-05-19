@extends('panel.master')
@section('content')

  <main id="main" class="main">

    @include('panel.alert')

    @error('currentpassword')
            <p class="invalid-feedback">{{ $message }}</p>
    @enderror
    @error('newpassword')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">


              @if (Auth::check() && Auth::user()->image != '')
              
                  <img src="{{ asset('profile_pic/thumb/'.Auth::user()->image) }}" alt="Profile" class="rounded-circle">
              @else
                  <img src="{{asset('assets/images/avatar7.png')}}" alt="Profile" class="rounded-circle">
                  
              @endif
      

              <h2>{{ Auth::check() ? Auth::user()->name :" "}}</h2>
              <h3>{{ Auth::check() ? Auth::user()->designation :" " }}</h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#https://www.facebook.com/profile.php?id=100060307328465" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

     


        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <a class="nav-link active" data-bs-toggle="tab" href="#profile-overview">Overview</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#profile-edit">Edit Profile</a>
                </li>
              

                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#profile-change-password">Change Password</a>
                </li>

              </ul>
              <div class="tab-content pt-2">


                      <div class="tab-pane fade show active profile-overview" id="profile-overview">
                          <h5 class="card-title">About</h5>
                          <p class="small fst-italic">{{ Auth::check()  ? Auth::user()->bio : 'hello!'}}</p>
                      
                          <h5 class="card-title">Profile Details</h5>
                      
                          <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Full Name</div>
                            <div class="col-lg-9 col-md-8">{{Auth::check() ? Auth::user()->name : " "}}</div>
                          </div>
                      
                          
                      
                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Job</div>
                            <div class="col-lg-9 col-md-8">{{ ( Auth::check() && Auth::user()->designation )? Auth::user()->designation: "-- " }}</div>
                          </div>
                      
                        
                      
                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Phone</div>
                            <div class="col-lg-9 col-md-8">{{ ( Auth::check() && Auth::user()->mobile )? Auth::user()->mobile : '-- '}}</div>
                          </div>
                      
                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Email</div>
                            <div class="col-lg-9 col-md-8">{{Auth::check() ? Auth::user()->email :" "}}</div>
                          </div>
                      
                      </div>



                       <!-- Profile Edit Form -->
                <div class="tab-pane fade pt-3" id="profile-edit">
                  <form action="{{route('panel.updateProfile') }}" method="POST" id="userForm" name="userForm">
                    @csrf
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{Auth::check() ? Auth::user()->name : " "}}">
                        @error('name')
                          <p class="invalid-feedback">{{ $message }}</p>
                         @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" id="bio" style="height: 100px">{{Auth::check() ? Auth::user()->bio : " "}}</textarea>
                      </div>
                      @error('bio')
                        <p class="invalid-feedback">{{ $message }}</p>
                      @enderror
                    </div>

                    

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Designation</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="designation" type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" value="{{Auth::check() ? Auth::user()->desination : " "}}">
                      </div>
                      @error('designation')
                          <p class="invalid-feedback">{{ $message }}</p>
                      @enderror
                    </div>

                    

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" value="{{Auth::check() ? Auth::user()->mobile : " "}}">
                      </div>
                      @error('mobile')
                        <p class="invalid-feedback">{{ $message }}</p>
                       @enderror
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{Auth::check() ? Auth::user()->email : " "}}">
                        @error('email')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>    

                    <div class="text-center">
                      <button class="btn btn-primary"  type="submit" >Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>  
  

              <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="{{route('panel.changePassword')}}" id="changePasswordForm" name="changePasswordForm" method="POST">
                      @csrf
                    <div class="row mb-3">
                      <label for="currentpassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="currentpassword" type="password" class="form-control @error('currentpassword') is-invalid @enderror" id="currentpassword">
                      </div>
                      @error('currentpassword')
                        <p class="invalid-feedback">{{ $message }}</p>
                      @enderror
                    </div>
              
                    <div class="row mb-3">
                      <label for="newpassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control @error('newpassword') is-invalid @enderror" id="newpassword">
                      </div>
                      @error('newpassword')
                        <p class="invalid-feedback">{{ $message }}</p>
                      @enderror
                    </div>
              
                    <div class="row mb-3">
                      <label for="renewpassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control @error('renewpassword') is-invalid @enderror" id="renewpassword">
                      </div>
                      @error('renewpassword')
                        <p class="invalid-feedback">{{ $message }}</p>
                      @enderror
                    </div>
              
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->
              
              </div>

                
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  @endsection


@section('customJs')



@endsection