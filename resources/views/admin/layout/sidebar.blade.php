<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
      <a href="../../index3.html" class="brand-link">
        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{url('dashboard')}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            @php($has_permission = hasPermission('Home Slider'))
            @if(isset($has_permission) && $has_permission)
              @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
              <li class="nav-item">
                  <a href="{{url('homeslider_index')}}" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                      Home Slider
                    </p>
                  </a>
              </li>
              @endif
              @endif

              @php($has_permission = hasPermission('Home Our Businesses'))
              @if(isset($has_permission) && $has_permission)
                @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
              <li class="nav-item">
                  <a href="{{url('home_our_businesses_index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Home Our Businesses
                    </p>
                  </a>
              </li>
              @endif
              @endif
  
              @php($has_permission = hasPermission('Home Detail'))
              @if(isset($has_permission) && $has_permission)
                @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
              <li class="nav-item">
                <a href="{{url('home_detail')}}" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                   Home Detail
                  </p>
                </a>
            </li>
            @endif
            @endif

            @php($has_permission = hasPermission('Testimonials'))
            @if(isset($has_permission) && $has_permission)
              @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
              <li class="nav-item">
                <a href="{{url('testimonials_index')}}" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Testimonials
                  </p>
                </a>
            </li>
            @endif
            @endif

            @php($has_permission = hasPermission('Setting'))
            @if(isset($has_permission) && $has_permission)
                @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            <li class="nav-item">
              <a href="{{url('setting')}}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Setting
                </p>
              </a>
            </li>
            @endif
            @endif
            <li class="nav-item">
              <a href="{{url('brand_index')}}" class="nav-link">
                <i class="nav-icon fab fa-behance"></i>
                <p>
                  Brand
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('car_index')}}" class="nav-link">
                <i class="nav-icon fas fa-car-alt"></i>
                <p>
                  Car
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('showroom_index')}}" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
                <p>
                  Showroom
                </p>
              </a>
            </li>
            @if(Auth::user()->role_id == Constant::SUPERADMIN)
              <li class="nav-item">
                <a href="{{route('role-permission')}}" class="nav-link">
                  <i class="fa fa-users-cog" ></i>
                  <p>
                    Role Permission
                  </p>
                </a>
              </li>
            @endif  
          </ul>
        </nav>
      </div>
</aside>
  