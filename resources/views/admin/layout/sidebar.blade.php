<nav class="sidebar sidebar-offcanvas" id="sidebar" style="background: #000 !important;">
  <ul class="nav">
      <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ url('admin/dashboard') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/category*') || Request::is('admin/blog*') || Request::is('admin/slider*') || Request::is('admin/about*') || Request::is('admin/product*') || Request::is('admin/orders*') ? 'active' : '' }}" 
             data-toggle="collapse" href="#form-elementss" aria-expanded="false" aria-controls="form-elementss">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Pages Management</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse {{ Request::is('admin/category*') || Request::is('admin/blog*') || Request::is('admin/slider*') || Request::is('admin/about*') || Request::is('admin/product*') || Request::is('admin/orders*') ? 'show' : '' }}" id="form-elementss">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link {{ Request::is('admin/category*') ? 'active' : '' }}" href="{{ url('admin/category') }}">Category</a></li>
                  <li class="nav-item"><a class="nav-link {{ Request::is('admin/blog*') ? 'active' : '' }}" href="{{ url('admin/blog') }}">Blog</a></li>
                  <li class="nav-item"><a class="nav-link {{ Request::is('admin/slider*') ? 'active' : '' }}" href="{{ url('admin/slider') }}">Slider</a></li>
                  <li class="nav-item"><a class="nav-link {{ Request::is('admin/about*') ? 'active' : '' }}" href="{{ url('admin/about') }}">About Us</a></li>
                  <li class="nav-item"><a class="nav-link {{ Request::is('admin/product*') ? 'active' : '' }}" href="{{ url('admin/product') }}">Product</a></li>
                  <li class="nav-item"><a class="nav-link {{ Request::is('admin/orders*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">Order</a></li>
              </ul>
          </div>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/firstBanner*') || Request::is('admin/secondBanner*') || Request::is('admin/thirdBanner*') ? 'active' : '' }}" 
             data-toggle="collapse" href="#form-elementsss" aria-expanded="false" aria-controls="form-elementsss">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Banners Management</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse {{ Request::is('admin/firstBanner*') || Request::is('admin/secondBanner*') || Request::is('admin/thirdBanner*') ? 'show' : '' }}" id="form-elementsss">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link {{ Request::is('admin/firstBanner*') ? 'active' : '' }}" href="{{ url('admin/firstBanner') }}">First Banner</a></li>
                  <li class="nav-item"><a class="nav-link {{ Request::is('admin/secondBanner*') ? 'active' : '' }}" href="{{ url('admin/secondBanner') }}">Second Banner</a></li>
                  <li class="nav-item"><a class="nav-link {{ Request::is('admin/thirdBanner*') ? 'active' : '' }}" href="{{ url('admin/thirdBanner') }}">Third Banner</a></li>
              </ul>
          </div>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/contacts*') ? 'active' : '' }}" 
             data-toggle="collapse" href="#ui-basicccc" aria-expanded="false" aria-controls="ui-basicccc">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Contacts</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse {{ Request::is('admin/contacts*') ? 'show' : '' }}" id="ui-basicccc">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link {{ Request::is('admin/contacts*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">Contact Us</a></li>
              </ul>
          </div>
      </li>
      @if(Auth::user()->user_type == "admin")
          <li class="nav-item">
              <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" 
                 data-toggle="collapse" href="#ui-basicc" aria-expanded="false" aria-controls="ui-basicc">
                  <i class="icon-layout menu-icon"></i>
                  <span class="menu-title">User Management</span>
                  <i class="menu-arrow"></i>
              </a>
              <div class="collapse {{ Request::is('admin/users*') ? 'show' : '' }}" id="ui-basicc">
                  <ul class="nav flex-column sub-menu">
                      <li class="nav-item"><a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">Users</a></li>
                  </ul>
              </div>
          </li>
      @elseif(Auth::user()->user_type == "superadmin")
          <li class="nav-item">
              <a class="nav-link {{ Request::is('admin/admins*') ? 'active' : '' }}" 
                 data-toggle="collapse" href="#ui-basiccc" aria-expanded="false" aria-controls="ui-basiccc">
                  <i class="icon-layout menu-icon"></i>
                  <span class="menu-title">Admin Management</span>
                  <i class="menu-arrow"></i>
              </a>
              <div class="collapse {{ Request::is('admin/admins*') ? 'show' : '' }}" id="ui-basiccc">
                  <ul class="nav flex-column sub-menu">
                      <li class="nav-item"><a class="nav-link {{ Request::is('admin/admins*') ? 'active' : '' }}" href="{{ route('admin.admins.index') }}">Admins</a></li>
                  </ul>
              </div>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" 
                 data-toggle="collapse" href="#ui-basicc" aria-expanded="false" aria-controls="ui-basicc">
                  <i class="icon-layout menu-icon"></i>
                  <span class="menu-title">User Management</span>
                  <i class="menu-arrow"></i>
              </a>
              <div class="collapse {{ Request::is('admin/users*') ? 'show' : '' }}" id="ui-basicc">
                  <ul class="nav flex-column sub-menu">
                      <li class="nav-item"><a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">Users</a></li>
                  </ul>
              </div>
          </li>
      @endif
  </ul>
</nav>
