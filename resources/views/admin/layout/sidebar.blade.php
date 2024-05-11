<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item"> 
            <a href="{{url('dashboard')}}" class="nav-link {{ request()->is('dashboard') ? 'active' : ''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
            </a>
        </li>

        @php($has_header_menu_permission = hasPermission('Header Menu'))
            @php($has_social_media_permission = hasPermission('Header Menu Social Media Icon'))
            @if($has_header_menu_permission && ($has_header_menu_permission->read_permission == 1 || $has_header_menu_permission->full_permission == 1) || 
                $has_social_media_permission && ($has_social_media_permission->read_permission == 1 || $has_social_media_permission->full_permission == 1))
                <li class="nav-item">
                    <a href="{{url('header_menu_index')}}" class="nav-link {{ request()->is('header_menu_index*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-heading"></i><p>Header Menu</p>
                    </a>
                </li>
            @endif

        @if(hasPermission('Home Slider') || hasPermission('Home Our Businesses') || hasPermission('Home Detail') || hasPermission('Mission Vision') || hasPermission('Faqs') || hasPermission('Testimonials'))
            <li class="nav-item {{ (request()->is('homeslider_index*') || request()->is('home_our_businesses_index*') || request()->is('home_detail') || request()->is('mission_vision') || request()->is('count') || request()->is('testimonials_index')) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ (request()->is('homeslider_index*') || request()->is('home_our_businesses_index*') || request()->is('home_detail') || request()->is('mission_vision') || request()->is('count') || request()->is('testimonials_index')) ? 'active' : '' }}"> 
                    <i class="nav-icon fa fa-house-user"></i><p>Home Setting<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul id="sidebar_communication" class="nav nav-treeview">
                    @php($has_permission = hasPermission('Home Slider'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item"> 
                                <a href="{{url('homeslider_index')}}" class="nav-link {{ request()->is('homeslider_index*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-sliders-h"></i><p>Home Slider</p>
                                </a>
                            </li>
                        @endif
                    @endif
        
                    @php($has_permission = hasPermission('Home Our Businesses'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item"> 
                                <a href="{{url('home_our_businesses_index')}}" class="nav-link {{ request()->is('home_our_businesses_index*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i><p>Home Our Businesses</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    @php($has_permission = hasPermission('Mission Vision'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item"> 
                                <a href="{{url('mission_vision')}}" class="nav-link {{ request()->is('mission_vision*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tasks"></i> <p>Mission Vision</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    @php($has_permission = hasPermission('Count'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item"> 
                                <a href="{{url('count')}}" class="nav-link {{ request()->is('count*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-sort-numeric-down"></i><p>Count</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    @php($has_permission = hasPermission('Home Detail'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item"> 
                                <a href="{{url('home_detail')}}" class="nav-link {{request()->is('home_detail*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-home"></i><p>Home Detail</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    @php($has_permission = hasPermission('Testimonials'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item"> 
                                <a href="{{url('testimonials_index')}}" class="nav-link {{ (request()->is('testimonials_index*')) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-address-card"></i><p>Testimonials</p>
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </li>
        @endif

        @php($has_permission = hasPermission('Footer Menu'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                <li class="nav-item">
                    <a href="{{url('footer_menu')}}" class="nav-link {{ request()->is('footer_menu*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bars"></i><p>Footer Menu</p>
                    </a>
                </li>
            @endif
        @endif

        @if(hasPermission('Business') || hasPermission('Business Insurance'))
            <li class="nav-item {{ (request()->is('our-business*') || request()->is('our-business-insurance*')) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ (request()->is('our-business*') || request()->is('our-business-insurance*')) ? 'active' : '' }}">
                    <i class="nav-icon fa fa-briefcase"></i><p>Our Business<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    @php($has_business_permission = hasPermission('Business'))
                    @if(isset($has_business_permission) && $has_business_permission)
                        @if($has_business_permission->read_permission == 1 || $has_business_permission->full_permission == 1)
                            <li class="nav-item"> 
                                <a href="{{url('our-business')}}" class="nav-link {{ (request()->is('our-business*') && !request()->is('our-business-insurance*')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i><p>Business</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    @php($has_business_insurance_permission = hasPermission('Business Insurance'))
                    @if(isset($has_business_insurance_permission) && $has_business_insurance_permission)
                        @if($has_business_insurance_permission->read_permission == 1 || $has_business_insurance_permission->full_permission == 1)
                            <li class="nav-item"> 
                                <a href="{{url('our-business-insurance')}}" class="nav-link {{ (request()->is('our-business-insurance*')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i><p>Business Insurance</p>
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </li>
        @endif

        @if(hasPermission('New Cars') || hasPermission('After Sales Service') || hasPermission('Car Insurance'))
            <li class="nav-item {{ (request()->is('new-cars*') || request()->is('after-sales-service*') || request()->is('car-insurance*')) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ (request()->is('new-cars*') || request()->is('after-sales-service*') || request()->is('car-insurance*')) ? 'active' : '' }}">
                    <i class="fa fa-wrench nav-icon" aria-hidden="true"></i><p>Our Services<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    @php($has_business_permission = hasPermission('New Cars'))
                    @if(isset($has_business_permission) && $has_business_permission)
                        @if($has_business_permission->read_permission == 1 || $has_business_permission->full_permission == 1)
                            <li class="nav-item"> 
                                <a href="{{url('new-cars')}}" class="nav-link {{ (request()->is('new-cars*')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i><p>New Cars</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    @php($has_business_insurance_permission = hasPermission('After Sales Service'))
                    @if(isset($has_business_insurance_permission) && $has_business_insurance_permission)
                        @if($has_business_insurance_permission->read_permission == 1 || $has_business_insurance_permission->full_permission == 1)
                            <li class="nav-item"> 
                                <a href="{{url('after-sales-service')}}" class="nav-link {{ (request()->is('after-sales-service*')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i><p>After Sales Service</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    @php($has_business_insurance_permission = hasPermission('Car Insurance'))
                    @if(isset($has_business_insurance_permission) && $has_business_insurance_permission)
                        @if($has_business_insurance_permission->read_permission == 1 || $has_business_insurance_permission->full_permission == 1)
                            <li class="nav-item"> 
                                <a href="{{url('car-insurance')}}" class="nav-link {{ (request()->is('car-insurance*')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i><p>Car Insurance</p>
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </li>
        @endif

        @php($has_permission = hasPermission('Car'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                <li class="nav-item">
                    <a href="{{url('car_index')}}" class="nav-link {{ (request()->is('car_index*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-car-alt"></i><p>Car Models</p>
                    </a>
                </li>
            @endif
        @endif

        @php($has_permission = hasPermission('Brand'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                <li class="nav-item">
                    <a href="{{url('brand_index')}}" class="nav-link {{ (request()->is('brand_index*')) ? 'active' : '' }}">
                        <i class="nav-icon fab fa-behance"></i><p>Brand</p>
                    </a>
                </li>   
            @endif
        @endif

        @if(hasPermission('Service Center') || hasPermission('Service') || hasPermission('Service Center Facility Customer Gallery') || hasPermission('Service Center Testimonial'))
            <li class="nav-item has-treeview {{ (request()->is('service-center') || request()->is('service') || request()->is('service-center-facility-customergallery') || request()->is('service-center-testimonial')) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ (request()->is('service-center') || request()->is('service') || request()->is('service-center-facility-customergallery') || request()->is('service-center-testimonial')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tools"></i><p>Services<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    @php($has_permission = hasPermission('Service Center'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item">
                                <a href="{{route('service-center')}}" class="nav-link {{ request()->is('service-center') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i><p>Service Center</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    @php($has_permission = hasPermission('Service'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item">
                                <a href="{{route('service')}}" class="nav-link {{ request()->is('service') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i><p>Service</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    @php($has_permission = hasPermission('Service Center Facility Customer Gallery'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item">
                                <a href="{{route('service-center-facility-customergallery')}}" class="nav-link {{ request()->is('service-center-facility-customergallery') ? 'active' : '' }}">
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
                                <a href="{{route('service-center-testimonial')}}" class="nav-link {{ request()->is('service-center-testimonial') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Service Center Testimonial</p>
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </li>
        @endif


        @php($has_permission = hasPermission('Setting'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                <li class="nav-item">
                    <a href="{{url('setting')}}" class="nav-link {{ (request()->is('setting*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                        Setting
                        </p>
                    </a>
                </li>
            @endif
        @endif

        @if(hasPermission('Showroom') || hasPermission('Showroom Testimonial') || hasPermission('Showroom Model'))
            <li class="nav-item has-treeview {{ (request()->is('showroom_list*') || request()->is('showroom-testimonial*')) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ (request()->is('showroom_list*') || request()->is('showroom-testimonial*')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-building"></i>
                    <p>
                        Showrooms
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    @php($has_showroom_permission = hasPermission('Showroom'))
                    @php($has_facility_customer_gallery_permission = hasPermission('Showroom Facility Customer Gallery'))
                    @if($has_showroom_permission && ($has_showroom_permission->read_permission == 1 || $has_showroom_permission->full_permission == 1) || 
                        $has_facility_customer_gallery_permission && ($has_facility_customer_gallery_permission->read_permission == 1 || $has_facility_customer_gallery_permission->full_permission == 1))
                        <li class="nav-item">
                            <a href="{{url('showroom_list')}}" class="nav-link {{ request()->is('showroom_list') ? ' active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Showroom</p>
                            </a>
                        </li>
                    @endif

                    @php($has_permission = hasPermission('Showroom Testimonial'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                        <li class="nav-item">
                            <a href="{{route('showroom-testimonial')}}" class="nav-link {{ request()->is('showroom-testimonial') ? ' active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Showroom Testimonial</p>
                            </a>
                        </li>
                        @endif
                    @endif

                   <?php /* @php($has_permission = hasPermission('Showroom Model'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                        <li class="nav-item">
                            <a href="{{route('showroom-model')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Showroom Model</p>
                            </a>
                        </li>
                        @endif
                    @endif */ ?>
                </ul>
            </li>
        @endif

        @if(hasPermission('Vacancies') || hasPermission('Career'))
            <li class="nav-item has-treeview {{ (request()->is('career*') || request()->is('vacancies*')) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ (request()->is('career*') || request()->is('vacancies*')) ? 'active' : '' }}">
                <i class="nav-icon fa fa-graduation-cap"></i>

                    <p>
                    Careers
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @php($has_permission = hasPermission('Career'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item">
                                <a href="{{route('career')}}" class="nav-link {{ request()->is('career*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Career</p>
                                </a>
                            </li>
                        @endif
                    @endif

                    @php($has_permission = hasPermission('Vacancies'))
                    @if(isset($has_permission) && $has_permission)
                        @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                            <li class="nav-item">
                                <a href="{{route('vacancies')}}" class="nav-link {{ request()->is('vacancies*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Vacancies</p>
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </li>
        @endif

        @php($has_permission = hasPermission('Awards'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                <li class="nav-item"> 
                    <a href="{{url('awards')}}" class="nav-link {{ request()->is('awards*') ? 'active' : '' }}">
                    <i class="fa fa-award nav-icon"></i>
                        <p>Awards</p>
                    </a>
                </li>
            @endif
        @endif

        @php($has_permission = hasPermission('Pages'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                <li class="nav-item"> 
                    <a href="{{url('pages')}}" class="nav-link {{ request()->is('pages*') ? 'active' : '' }}">
                    <i class="fas fa-file nav-icon"></i>
                        <p>CMS Pages</p>
                    </a>
                </li>
            @endif
        @endif

        @php($has_permission = hasPermission('Faqs'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
                <li class="nav-item"> 
                    <a href="{{url('faq')}}" class="nav-link {{ request()->is('faq*') ? 'active' : '' }}">
                    <i class="fa fa-question-circle nav-icon"></i>
                        <p>Faqs</p>
                    </a>
                </li>
            @endif
        @endif


        @php($has_permission = hasPermission('Body Shops'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1) 
                <li class="nav-item"> 
                    <a href="{{url('body_shop')}}" class="nav-link {{request()->is('body_shop*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-window-restore"></i>
                        <p>
                            Body Shops
                        </p>
                    </a>
                </li>
            @endif
        @endif


        @php($has_permission = hasPermission('Used Car'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1) 
                <li class="nav-item"> 
                    <a href="{{url('used_car')}}" class="nav-link {{request()->is('used_car*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-ellipsis-h"></i>
                        <p>
                            Used Car
                        </p>
                    </a>
                </li>
            @endif
        @endif

        
        @php($has_permission = hasPermission('Contact Us'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1) 
                <li class="nav-item"> 
                    <a href="{{url('contact_us')}}" class="nav-link {{request()->is('contact_us*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-phone"></i> 
                        <p>
                            Contact Us
                        </p>
                    </a>
                </li>
            @endif
        @endif

        

        @php($has_permission = hasPermission('Our Locations'))
        @if(isset($has_permission) && $has_permission)
            @if($has_permission->read_permission == 1 || $has_permission->full_permission == 1) 
                <li class="nav-item"> 
                    <a href="{{url('our_location')}}" class="nav-link {{request()->is('our_location*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-location-arrow"></i>
                        <p>
                            Our Locations
                        </p>
                    </a>
                </li>
            @endif
        @endif

        @if(isset(Auth::user()->role_id) && Auth::user()->role_id == 1)
                <li class="nav-item">
                <a href="{{route('role-permission')}}" class="nav-link {{ request()->is('role-permission*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>
                    Role Permission
                </p>
                </a>
            </li>
        @endif

        @if(isset(Auth::user()->role_id) && Auth::user()->role_id == 1)
            <li class="nav-item">
                <a href="{{route('user')}}" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Users
                    </p>
                </a>
            </li>
        @endif
    </ul>
</nav>