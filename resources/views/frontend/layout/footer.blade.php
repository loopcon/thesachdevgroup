<!-- footer section  -->

<footer id="footer">
   <div class="container">
      <div class="footer-new">
         <div class="row">
            <div class="col-md-3 col-sm-6">
               <div class="footer-about">
                  @php($setting = getSettingDetail())

                  @if(isset($setting) && isset($setting->logo))
                     <img src="{{asset('logo/'.$setting->logo)}}" alt="">
                  @endif
                  @foreach ($footer_menus as $footer_menu)
                     <p>{!! $footer_menu->footer_description !!}</p>
                  @endforeach
                  <div class="social-icon-footer float-left">
                     <a href=""> <img src="myown/css/images/facebook (1).png" alt="" width="40px"> </a>
                     <a href=""> <img src="myown/css/images/instagram (2).png" alt="" width="40px"></a>
                     <a href=""> <img src="myown/css/images/linkedin (1).png" alt="" width="40px"> </a>
                     <a href=""> <img src="myown/css/images/twitter (2).png" alt="" width="40px"> </a>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-sm-6">
               <div class="our-service">
                  <h3>Our Services</h3>
                  @foreach($footer_menu_our_services as $footer_menu_our_service)

                  <a href="{{$footer_menu_our_service->link}}"> 
                     <p><i class="fa fa-chevron-right" aria-hidden="true"></i>
                        {{$footer_menu_our_service->name}}
                     </p> 
                  </a>
                  @endforeach
               </div>
            </div>
            <div class="col-md-3 col-sm-6">
               <div class="brands">
                  <h3>Our Businesses</h3>

                  @foreach($footer_menu_our_businesses as $footer_menu_our_businesse)
                     <a href="{{$footer_menu_our_businesse->link}}"> 
                        <p><i class="fa fa-chevron-right" aria-hidden="true"></i>
                           {{$footer_menu_our_businesse->name}}
                        </p> 
                     </a>
                  @endforeach

               </div>
            </div>
            <div class="col-md-3 col-sm-6">
               <div class="useful-link">
                  <h3>Useful Links</h3>
                  @foreach($footer_menu_useful_links as $footer_menu_useful_link)
                  <a href="{{$footer_menu_useful_link->link}}">
                     <p><i class="fa fa-chevron-right" aria-hidden="true"></i>
                        {{$footer_menu_useful_link->name}}
                     </p> 
                  </a> 
                  @endforeach
               </div> 
            </div>
         </div>
      </div>
   </div>
 
   <div class="bottom-bar">
      <div class="container">
         <div class="full-bottom-info">
            <div class="row">
               <div class="col-md-4 nopadding">
                  <div class="email-footer">
                     <div class="image-footerlogo">
                        @if(isset($setting) && isset($setting->email_icon))
                           <img src="{{url('public/email_icon/'.$setting->email_icon)}}" style="height:50px; width:50px">
                        @endif
                     </div>
                     <div class="footer-right-text">
                        <a href="mailto:info@thesachdevgroup.com">
                           @if(isset($setting) && isset($setting->email))
                              <p>{{$setting->email}}</p>
                           @endif 
                        </a>
                        <a href="mailto:info@thesachdevgroup.com"><p>Drop Us a Line</p></a>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 nopadding">
                  <div class="call-footer">
                     <div class="image-footerlogo">
                        @if(isset($setting) && isset($setting->call_icon))
                           <img src="{{url('public/call_icon/'.$setting->call_icon)}}" style="height:50px; width:50px">
                        @endif
                     </div>
                     <div class="footer-right-text">
                        @if(isset($setting) && isset($setting->mobile_number))
                           <a href="tel:+4733378901">
                              <p>
                                 {{$setting->mobile_number}}
                              </p>
                           </a>
                        @endif
                        <a href="tel:+4733378901"><p>Call Us Now</p></a>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 nopadding">
                  <div class="address">
                     <div class="image-footerlogo">
                        @if(isset($setting) && isset($setting->address_icon))
                           <img src="{{url('public/address_icon/'.$setting->address_icon)}}" style="height:50px; width:50px">
                        @endif
                     </div>
                     
                     <div class="footer-right-text">
                        @if(isset($setting) && isset($setting->address))
                           <a href="https://www.google.com/maps/dir//Galaxy+Toyota+Service+Center+69+Unit-2,+TSG+Complex+69+Najafgarh+Rd,+Moti+Nagar,+Crossing,+New+Delhi,+Delhi+110015/@28.6595613,77.1467438,16z/data=!4m5!4m4!1m0!1m2!1m1!1s0x390d03dd7ed65ed7:0xa85eb68c0a6c5def" target="_blank">
                              <p>{{$setting->address}}</p>
                           </a>
                        @endif
                        <a href="https://www.google.com/maps/dir//Galaxy+Toyota+Service+Center+69+Unit-2,+TSG+Complex+69+Najafgarh+Rd,+Moti+Nagar,+Crossing,+New+Delhi,+Delhi+110015/@28.6595613,77.1467438,16z/data=!4m5!4m4!1m0!1m2!1m1!1s0x390d03dd7ed65ed7:0xa85eb68c0a6c5def" target="_blank"><p>Get Directions</p></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
 
   <div class="copyright">
      <div class="container">
         <div class="row">
            <div class="col-md-8 p-0">
               <div class="term-page">
                  <a href="terms-conditions.php"><p>Terms of Use</p></a> 
                  <a href="privacy-policy.php"><p> Privacy Policy </p> </a>
                  <a href="purchasing-t&c.php"><p>Purchasing-T&C</p> </a>
                  <a href="refund-cancellation-policy.php"><p>Refund Cancellation Policy</p> </a>
               </div>
            </div>
            <div class="col-md-4 p-0">
               <div class="copyright-text">
                  <p>TSG (THE SACHDEV GROUP) © 2024</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</footer>
 
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
 
 </body>
 </html>
