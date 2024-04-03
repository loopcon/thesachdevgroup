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

            @if(hasPermission('Home Slider') || hasPermission('Home Our Businesses') || hasPermission('Home Detail') || hasPermission('Mission Vision') || hasPermission('Faqs'))
                <li class="nav-item">
                    <a href="#" class="nav-link"> 
                        <i class="nav-icon fa fa-house-user"></i><p>Home Setting<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul id="sidebar_communication" class="nav nav-treeview">
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

                        @php($has_permission = hasPermission('Mission Vision'))
                        @if(isset($has_permission) && $has_permission)
                            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item"> 

                            <a href="{{url('mission_vision')}}" class="nav-link">
                                <i class="nav-icon fas fa-tasks"></i> 
                                <p>
                                Mission Vision
                                </p>
                            </a>
                        </li>
                        @endif
                        @endif

                        @php($has_permission = hasPermission('Count'))
                        @if(isset($has_permission) && $has_permission)
                            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item{{ request()->is('count') ? ' sidebar_active_li' : '' }}"> 
                                <a href="{{url('count')}}" class="nav-link">
                                    <i class="nav-icon fas fa-sort-numeric-down"></i>
                                    <p>
                                        Count
                                    </p>
                                </a>
                            </li>
                        @endif
                        @endif

                        @php($has_permission = hasPermission('Faqs'))
                            @if(isset($has_permission) && $has_permission)
                                @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                                <li class="nav-item"> 

                                <a href="{{url('faq')}}" class="nav-link">
                                    <i class="nav-icon fas fa-tasks"></i> 
                                    <p>
                                    Faqs
                                    </p>
                                </a>
                            </li>
                            @endif
                        @endif

                        @php($has_permission = hasPermission('Pages'))
                            @if(isset($has_permission) && $has_permission)
                                @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                                <li class="nav-item"> 

                                <a href="{{url('pages')}}" class="nav-link">
                                    <i class="nav-icon fas fa-tasks"></i> 
                                    <p>
                                    Pages
                                    </p>
                                </a>
                            </li>
                            @endif
                        @endif
                    </ul>
                </li>
            @endif

        @php($has_permission = hasPermission('Testimonials'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                <li class="nav-item"> 
                    <a href="{{url('testimonials_index')}}" class="nav-link">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>Testimonials</p>
                    </a>
                </li>
            @endif
        @endif



        @php($has_permission = hasPermission('Setting'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                <li class="nav-item">
                    <a href="{{url('setting')}}" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
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

        @if(hasPermission('Showroom') || hasPermission('Showroom Testimonial') || hasPermission('Showroom Model'))
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-building"></i>
                    <p>
                        Showrooms
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @php($has_permission = hasPermission('Showroom'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item">
                                <a href="{{url('showroom_index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Showroom</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    @php($has_permission = hasPermission('Showroom Testimonial'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                        <li class="nav-item">
                            <a href="{{route('showroom-testimonial')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Showroom Testimonial</p>
                            </a>
                        </li>
                        @endif
                    @endif

                    @php($has_permission = hasPermission('Showroom Model'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                        <li class="nav-item">
                            <a href="{{route('showroom-model')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Showroom Model</p>
                            </a>
                        </li>
                        @endif
                    @endif
                </ul>
            </li>
        @endif

        @if(hasPermission('Service Center') || hasPermission('Service'))
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tools"></i>
                    <p>
                    Services
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @php($has_permission = hasPermission('Service Center'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item">
                                <a href="{{route('service-center')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Service Center</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    @php($has_permission = hasPermission('Service'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item">
                                <a href="{{route('service')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Service</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    @php($has_permission = hasPermission('Service Center Facility Customer Gallery'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item">
                                <a href="{{route('service-center-facility-customergallery')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Service Center Facility Customer Gallery</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    @php($has_permission = hasPermission('Service Center Testimonial'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item">
                                <a href="{{route('service-center-testimonial')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Service Center Testimonial</p>
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </li>
        @endif

        @php($has_header_menu_permission = hasPermission('Header Menu'))
        @php($has_social_media_permission = hasPermission('Header Menu Social Media Icon'))
        @if($has_header_menu_permission && ($has_header_menu_permission->read_permission == 1 || $has_header_menu_permission->full_permission == 1) || 
            $has_social_media_permission && ($has_social_media_permission->read_permission == 1 || $has_social_media_permission->full_permission == 1))
            <li class="nav-item{{ request()->is('header_menu_index') ? ' sidebar_active' : '' }}">
                <a href="{{url('header_menu_index')}}" class="nav-link">
                    <i class="nav-icon fas fa-heading"></i>
                    <p>Header Menu</p>
                </a>
            </li>
        @endif



        @php($has_permission = hasPermission('Footer Menu'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                <li class="nav-item">
                    <a href="{{url('footer_menu')}}" class="nav-link">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>
                        Footer Menu
                        </p>
                    </a>
                </li>
            @endif
        @endif

        @if(isset(Auth::user()->role_id) && Auth::user()->role_id == 1)
                <li class="nav-item">
                <a href="{{route('role-permission')}}" class="nav-link">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>
                    Role Permission
                </p>
                </a>
            </li>
        @endif

        @if(isset(Auth::user()->role_id) && Auth::user()->role_id == 1)
                <li class="nav-item">
                <a href="{{route('user')}}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Users
                </p>
                </a>
            </li>
        @endif
    </ul>
</nav>
@section('javascript')
<script>
    // $(document).ready(function(){
    //     $('.nav-item').click(function(){
    //         $('.nav-item').removeClass('active'); 
    //         $(this).addClass('active'); 
    //     });
    // });

    // $(document).ready(function(){
    //     $('.nav-item').click(function(){
    //         $('.nav-item').removeClass('show'); 
    //         $(this).addClass('show'); 
    //     });
    // });
</script>
@endsection
