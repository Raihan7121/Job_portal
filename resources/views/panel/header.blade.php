<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{route('panel.profile')}}" class="logo d-flex align-items-center">
        <img src="{{asset('assets/assets/img/logo.png')}}" alt="">
        <span class="d-none d-lg-block">Foodi App</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                @if (Auth::check() && Auth::user()->image != '')
                    <img src="{{ asset('profile_pic/thumb/'.Auth::user()->image) }}" alt="" class="rounded-circle">                  
                @else
                    <img src="{{asset('assets/images/avatar7.png')}}" alt="" class="rounded-circle">
                
                @endif
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::check() ? Auth::user()->name : " "}}</span>
          </a><!-- End Profile Iamge Icon -->

          
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{Auth::check() ? Auth::user()->name : " "}}</h6>
              <span>{{Auth::check() ? Auth::user()->designation : " "}}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('panel.profile')}}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('panel.logout')}}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->