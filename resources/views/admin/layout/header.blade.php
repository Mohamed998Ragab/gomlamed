<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="box-shadow: none !important;">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" style="background: #000 !important;">
      <a class="navbar-brand brand-logo mr-5" href="{{ url('admin/dashboard') }}"><img src="{{ asset('front/img/Gomla.png') }}" class="mr-2" alt="logo" style="background: #000 !important;"/></a>
      <a class="navbar-brand brand-logo-mini" href="{{ url('admin/dashboard') }}"><img src="{{ asset('front/img/Gomla.png') }}" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end" style="background: #000 !important;">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="icon-menu text-white"></span>
      </button>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" data-toggle="dropdown" id="profileDropdown">
           Settings
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
                <button class="dropdown-item" type="submit">
                  <i class="ti-power-off text-primary"></i>
                  Logout
                </button>
            </form>

          </div>
        </li>
      </ul>
    </div>
  </nav>