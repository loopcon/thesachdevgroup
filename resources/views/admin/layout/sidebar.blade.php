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
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-house-user"></i>
                <p>
                  Home Setting
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @php($has_permission = hasPermission('Home Slider'))
                @if(isset($has_permission) && $has_permission)
                  @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                    <li class="nav-item">
                        <a href="{{url('homeslider_index')}}" class="nav-link">
                          <i class="nav-icon fas fa-sliders-h"></i>
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
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                        Home Detail
                        </p>
                      </a>
                  </li>
                  @endif
                @endif

              </ul>
            </li>

        @php($has_permission = hasPermission('Testimonials'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                <li class="nav-item">
                    <a href="{{url('testimonials_index')}}" class="nav-link">
                    <i class="nav-icon fas fa-address-card"></i>
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
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                        Setting
                        </p>
                    </a>
                </li>
            @endif
        @endif

        @php($has_permission = hasPermission('Brand'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                <li class="nav-item">
                <a href="{{url('brand_index')}}" class="nav-link">
                    <i class="nav-icon fab fa-behance"></i>
                    <p>
                    Brand
                    </p>
                </a>
                </li>   
            @endif
        @endif

        @php($has_permission = hasPermission('Car'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                <li class="nav-item">
                    <a href="{{url('car_index')}}" class="nav-link">
                        <i class="nav-icon fas fa-car-alt"></i>
                        <p>
                        Car
                        </p>
                    </a>
                </li>
            @endif
        @endif

        @php($has_permission = hasPermission('Showroom'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Showroom
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('showroom_index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Showroom</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('showroom-testimonial')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Showroom Testimonial</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        @endif
        @if(isset(Auth::user()->role_id) && Auth::user()->role_id)
            <li class="nav-item">
                <a href="{{route('role-permission')}}" class="nav-link">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>
                    Role Permission
                </p>
                </a>
            </li>
            @endif 
        @endif 
    </ul>
</nav>
