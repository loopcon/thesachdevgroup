@extends('frontend.layout.header')
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
@section('css')
<style>
    .nav-tabs-divider .nav-item:not(:last-child) {
        border-right: 1px solid #ccc; 
    }
    .justify-content-between {
        justify-content: center !important;
    }
    .nav-link { 
        display: block;  
        color: black;
        font-weight: 600;
        padding: 0.5rem 0.5rem;
    }
    .section-b{
        padding:10px;
    } 
    .tabbable-panel{
        border: none;
    }
    .btns {
        position: relative;
        display: inline-block;
        margin: 1px;
        padding:0;
        border: 0;
        border-radius: 30px;
        text-align: center;
        white-space: nowrap;
        cursor: pointer; 
        font-size: 13px; 
    }
    .btns:hover {
        box-shadow: inset 0 -3px 0 #ec3237;
    }
    .btns:active {
        transform: translateY(1px);
        box-shadow: inset 0 3px 0 0 rgba(0, 0, 0, 0.15);
    } 
    .btns:focus {
        outline: none;
    }
    .btns--basic {
        background-color: #e3eacc;
        color: #455a00;
    }
    a:hover {
        color: #ec3237;
    }
    .btns--ghost {
        background-color: transparent;
        border: 1px solid #00000073;
        color: #ec3237;
    }
    .btns--dark { 
        background-color: #455a00;
        color: white;
    }
    .btns--action {
        background-color: #739600;
        color: white;
    }
    .btns--danger {
        background-color: #ff0000;
        color: white;
    }
    .btns--link {
        background-color: transparent;
        color: #5786bd;
    }
    .btns--dropdown {
        padding-right: 3em;
    }
    .btns--dropdown:before {
        content: "";
        right: 24px;
        top: 22px;
        width: 2px;
        height: 6px;
        background-color: rgba(0, 0, 0, 0.1);
        position: absolute;
        transform: rotate(-45deg);
    }
    .btns--dropdown:after {
        content: "";
        right: 20px;
        top: 22px;
        width: 2px;
        height: 6px;
        background-color: rgba(0, 0, 0, 0.1);
        position: absolute;
        transform: rotate(45deg);
    }     
    .btns-group {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        flex-wrap: wrap; 
        justify-content: center;
    }
    .btns-group__item {
        float: left;
    }
    .btns-group__item:first-child .btns {
        border-radius: 30px 0 0 30px;
    }
    .btns-group__item .btns {
        border-radius: 0;
        margin: 0;
        border-right: 1px solid rgba(0, 0, 0, 0.1);
    }
    .btns-group__item:last-child .btns {
        border-radius: 0 30px 30px 0;
        border-right: 0;
    }
    article.job-card {
        width: 700px;
        position: relative;
        border-top: 1px solid #e3e3e3;
        border-bottom: 1px solid #e3e3e3;
        padding: 24px;
    }
    article.job-card:hover,
    article.job-card:focus {
        background-color: rgba(0,166,194,.03);
        border-color: #b2e4ec;
    }
    .company-logo-img {
        grid-area: 1 / 1 / 2 / 2;
        background-color: #fff;
        
        height: 80px;
        width: 80px;
        box-sizing: border-box;
        position: relative;
        padding: 5px;
    }
    .company-logo-img img {
        max-height: calc(100% - 10px);
        max-width: calc(100% - 10px);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .job-title {
        grid-area: 1 / 2 / 2 / 3;
        font-size: 16px;
        align-self: start;
        font-weight: 500;
        margin-top: 5px;
        padding: 0 24px;
    }
    .company-name {
        grid-area: 2 / 2 / 3 / 3;
        align-self: center;
        font-size: 14px;
        color: #777;
        margin-bottom: 5px;
        padding: 0 24px;
    }
    .skills-container {
        grid-area: 3 / 2 / 4 / 3;
        align-self: center;
        padding-top: 10px;
        padding: 0 24px;
    }
    .skill {
        display: inline;
        color: #00a6c2;
        border-radius: 2px;
        background-color: rgba(0,166,194,.05);
        border: 1px solid rgba(0,166,194,.15);
        padding: 5px 8px;
        font-size: 12px;
    }
    .apply {
        grid-area: 1 / 3 / 2 / 4;
        background-color: #ec3237;
        color: #fff;
    }
    .save {
        grid-area: 3 / 3 / 4 / 4;
        background-color: #fff;
        border: 1px solid #a4a5a8;
        color: #777;
    }
    .mobile-wrapper {
        margin-top: 20px;
        width: 100%;
    }
    .mobile-wrapper article {
        width: 100%;
        padding: 16px 0px;
    }
    .mobile-wrapper .company-logo-img {
        grid-area: 1 / 1 / 3 / 2;
        height: 100px;
        width: 100%;
    }
    .mobile-wrapper .job-title {
        grid-area: 1 / 2 / 2 / 2;
        padding: 8px 16px 0 16px;
    }
    .mobile-wrapper .company-name {
        grid-area: 2 / 2 / 3 / 2;
        padding: 0 16px;
    }
    .mobile-wrapper .skills-container {
        grid-area: 3 / 1 / 4 / 3;
        padding: 16px 0;
        font-size: 2vh;
    }
    .mobile-wrapper .btn-container {
        grid-area: 4 / 1 / 5 / 3;
        display: flex;
    }
    .mobile-wrapper .btn-container button {
        height: 38px;
        flex: 1;
        width: 0;
    }
    .mobile-wrapper .btn-container .apply {
        margin-right: 10px;
    }
</style>
@endsection
@section('content')
    <section id="contact-us">
        <div class="contact-banner">
            <img src="assets/image/gdf.jpg" alt="">
        </div>
    </section>
    <section id="loaction-wise-map">
        <div class="tabs-location">
            <div class="row" style="margin-right:0px ; margin-left:0px">
                <div class="col-md-12">
			        <div class="tabbable-panel">
				        <div class="tabbable-line"> 
                            <div class="tab-content">
                                <div class="col-md-5">
                                    <div class="tabbable-panel">
                                        <div class="tabbable-line">
                                        </div>
                                    </div>
                                </div>		    
                                <div class="tab-pane active" id="tab_default_1">
                                    <div class="location-tab-parent">
                                    <section class=" header">
                                        <div class="container py-4" style="max-width: -webkit-fill-available;">
                                            <div class="row">
                                                <div class="col-md-5" style="overflow-x: hidden; overflow-y: auto; margin-bottom: 30px;">
                                                    <div class="section-b">     
                                                        <h1 style="color: #ec3237; font-size: 2rem;  text-align: -webkit-center;">Our Showrooms & Service Centers</h1>
                                                        <ul class="btns-group">
                                                            <li>
                                                                <button class="btns btns--ghost">
                                                                    <a class="nav-link" href="#tab_default_1" data-toggle="tab">Galaxy Toyota</a>
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="btns btns--ghost"> 
                                                                    <a class="nav-link" href="#tab_default_2" data-toggle="tab">Hans Hyundai</a>
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="btns btns--ghost"> 
                                                                    <a class="nav-link" href="#tab_default_6" data-toggle="tab">Auto Car Repair</a>
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="btns btns--ghost"> 
                                                                    <a class="nav-link" href="#tab_default_8" data-toggle="tab">TSG Used Cars</a>
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="btns btns--ghost"> 
                                                                    <a class="nav-link" href="#tab_default_3" data-toggle="tab">Harpreet Ford</a>
                                                                </button>
                                                            </li> 
                                                            <li>
                                                                <button class="btns btns--ghost"> 
                                                                    <a class="nav-link" href="#tab_default_5" data-toggle="tab">AMS Dry Ice</a>
                                                                </button>
                                                            </li> 
                                                            <li>
                                                                <button class="btns btns--ghost"> 
                                                                    <a class="nav-link" href="#tab_default_4" data-toggle="tab">TSG Insure</a>
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="btns btns--ghost"> 
                                                                    <a class="nav-link" href="#tab_default_7" data-toggle="tab">Tsg Auction Mart</a>
                                                                </button>
                                                            </li>     
                                                        </ul> 
                                                    </div>
                                                    <div class="nav nav-pills-custom custom-height" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                        <div class="mobile-wrapper">
                                                            <article class="job-card">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <div class="company-logo-img">
                                                                            <img src="assets/image/2022-02-18.jpg" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="job-title">
                                                                            GALAXY TOYOTA (SALES) - SHALIMAR PLACE
                                                                        </div>
                                                                        <div class="company-name">
                                                                            A - Block, Plot - II Outer Ring Road Near, Jail, Shalimar Place, District Center, Rohini
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="skills-container">
                                                                    <p class="mobile-font-color">Mobile Number: <a href="tel:+91 96543 92839">+91 96543 92839</a></p>
                                                                    <p class="mobile-font-color">E-mail: <a href="mailto:galaxytoyota@thesachdevagroup.com">galaxytoyota@thesachdevagroup.com</a></p>
                                                                </div>
                                                                <a class="nav-link mb-0 p-0 left-location active location-anchore" data-toggle="pill" href="#shalimar-sales" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                                    <div class="btn-container">
                                                                        <button class="apply">Click Here</button>      
                                                                    </div>
                                                                </a>
                                                            </article>
                                                            <article class="job-card">
                                                                <div class="row">
                                                                    <div class="col-sm-4">      
                                                                        <div class="company-logo-img">
                                                                            <img src="assets/image/phoo/moti.jpeg" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="job-title">
                                                                            GALAXY TOYOTA (SALES) - MOTINAGAR
                                                                        </div> 
                                                                        <div class="company-name">
                                                                            Unit-2, 69/1-A, Najafgarh Road, Moti Nagar Crossing New Delhi 110015
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="skills-container">
                                                                    <p>Mobile Number: <a href="tel:+91 96431 01006">+91 96431 01006</a></p>
                                                                    <p>E-mail: <a href="mailto:galaxytoyota@thesachdevagroup.com">galaxytoyota@thesachdevagroup.com</a></p>
                                                                </div>
                                                                <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-profile-tab" data-toggle="pill" href="#motinagar-sales" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                                                    <div class="btn-container">
                                                                        <button class="apply">Click Here</button>
                                                                    </div>
                                                                </a>
                                                            </article>
                                                            <article class="job-card">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <div class="company-logo-img">
                                                                            <img src="assets/image/phoo/lajpat.png" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="job-title">
                                                                            GALAXY TOYOTA (SALES) - LAJPAT NAGAR
                                                                        </div> 
                                                                        <div class="company-name">
                                                                            9A, Ring Rd, opposite Moolchand Medicity, Vikram Vihar, Lajpat Nagar IV, Sunlight Colony, New Delhi, Delhi 110024
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="skills-container">
                                                                    <p>Mobile Number: <a href="tel:+9195829 40202">+9195829 40202</a></p>
                                                                    <p>E-mail: <a href="mailto:galaxytoyota@thesachdevagroup.com">galaxytoyota@thesachdevagroup.com</a></p>
                                                                </div>
                                                                <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-messages-tab" data-toggle="pill" href="#lajpatnagar-sales" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                                                    <div class="btn-container">
                                                                        <button class="apply">Click Here</button>
                                                                    </div>
                                                                </a>
                                                            </article>       
                                                            <article class="job-card">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <div class="company-logo-img">
                                                                            <img src="assets/image/phoo/dwarka.jpg" />
                                                                        </div>
                                                                    </div>          
                                                                    <div class="col-sm-8">
                                                                        <div class="job-title">
                                                                            GALAXY TOYOTA (SALES) - DWARKA
                                                                        </div> 
                                                                        <div class="company-name">
                                                                            Plot No. 23, Sector 20, Marbel Market Metro Station Near Dwarka Sector 9, Dwarka
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="skills-container">
                                                                    <p>Mobile Number: <a href="tel:+91 96431 02001">+91 96431 02001</a></p>
                                                                    <p>E-mail: <a href="mailto:galaxytoyota@thesachdevagroup.com">galaxytoyota@thesachdevagroup.com</a></p>
                                                                </div>
                                                                <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-settings-tab" data-toggle="pill" href="#dwarka-sales" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                                                    <div class="btn-container">
                                                                        <button class="apply">Click Here</button>
                                                                    </div>
                                                                </a>
                                                            </article>
                                                            <article class="job-card">
                                                                <div class="row">
                                                                    <div class="col-sm-4">                   
                                                                        <div class="company-logo-img">
                                                                            <img src="assets/image/phoo/chhatarpur.png" />
                                                                        </div>
                                                                    </div>      
                                                                    <div class="col-sm-8">
                                                                        <div class="job-title">
                                                                            GALAXY TOYOTA (SALES) - CHHATARPUR
                                                                        </div> 
                                                                        <div class="company-name">  
                                                                            G1, Station Box Chattarpur Metro Station, Mehrauli-Gurgaon Rd, New Delhi, Delhi 110070
                                                                        </div>
                          </div>
                          </div>
                          <div class="skills-container">
                            <p>Mobile Number: <a href="tel:+91 9313928302">+91 9313928302</a></p>
                        <p>E-mail: <a href="mailto:galaxytoyota@thesachdevagroup.com">galaxytoyota@thesachdevagroup.com</a></p>
                          </div>
         <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-settings-tab" data-toggle="pill" href="#chhatarpur-sales" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                                       <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article>
                        
                        
                        
        <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
                                <img src="assets/image/phoo/moti.jpeg" />
                          </div></div>
                              
                <div class="col-sm-8">
                          <div class="job-title">GALAXY TOYOTA (BODYSHOP) - MOTINAGAR</div> 
                          <div class="company-name">28 DLF Industrial Area, Moti Nagar, New Delhi 110015</div>
                          </div></div><div class="skills-container">
                            <p>Mobile Number: <a href="tel:91 96431 01006">+91 96431 01006</a></p>
                        <p>E-mail: <a href="mailto:galaxytoyota@thesachdevagroup.com">galaxytoyota@thesachdevagroup.com</a></p>
                          </div>
         <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-settings-tab" data-toggle="pill" href="#motinagar-bodyshop" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                                    <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article>
                        
                        
                        
        <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
                                <img src="assets/image/phoo/servicekundli.jpeg" />
                          </div>
                          </div><div class="col-sm-8"><div class="job-title">GALAXY TOYOTA (SERVICE) - KUNDLI</div> 
                          <div class="company-name">Khasra No. 31/16 Opp: Parnami Ortho Hospital GT Karnal Road Sonipat 131028</div>
          </div></div><div class="job-title">
                            <p>Mobile Number: <a href="tel:+91 96431 00263">+91 96431 00263</a></p>
                        <p>E-mail: <a href="mailto:galaxytoyota@thesachdevagroup.com">galaxytoyota@thesachdevagroup.com</a></p>
                          </div>
         <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-settings-tab" data-toggle="pill" href="#kundli-service" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                                       <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article>
                        
                        
                        
        <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
                                <img src="assets/image/phoo/azadpur.jpeg" />
                          </div>
                          </div><div class="col-sm-8"><div class="job-title">GALAXY TOYOTA (SERVICE) - AZADPUR</div> 
                          <div class="company-name">Shop No:5, Rajasthani Udyog 16 Mutiny Memorial, Azadpur New Delhi 110033</div>
          </div></div><div class="job-title">
                            <p>Mobile Number: <a href="tel:91 96431 00263">+91 96431 00263</a></p>
                        <p>E-mail: <a href="mailto:galaxytoyota@thesachdevagroup.com">galaxytoyota@thesachdevagroup.com</a></p>
                          </div>
        <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-settings-tab" data-toggle="pill" href="#azadpur-service" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                                     <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article>
                        
                        
        <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
                                <img src="assets/image/phoo/motiservice.jpeg" />
                          </div>
                         </div><div class="col-sm-8"> <div class="job-title">GALAXY TOYOTA (SERVICE) - MOTINAGAR</div> 
                          <div class="company-name">Unit-2, 69/1-A, Najafgarh Road, Moti Nagar Crossing
        New Delhi 110015</div>
        </div></div>
                          <div class="job-title">
                            <p>Mobile Number: <a href="tel:+91 96431 01006">+91 96431 01006</a></p>
                        <p>E-mail: <a href="mailto:galaxytoyota@thesachdevagroup.com">galaxytoyota@thesachdevagroup.com</a></p>
                          </div>
         <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-settings-tab" data-toggle="pill" href="#motinagar-service" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                                      <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article>
                        
                        
                        
                        
        <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
                                <img src="assets/image/phoo/serviceokhla.jpeg" />
                          </div>
                          </div><div class="col-sm-8"><div class="job-title">GALAXY TOYOTA (SERVICE) - OKHLA</div> 
                          <div class="company-name">F-84, Okhla Okhla Phase I, Okhla Industrial Area
        New Delhi 110020</div>
                          </div></div><div class="job-title">
                            <p>Mobile Number: <a href="tel:+91 95829 40202">+91 95829 40202</a></p>
                        <p>E-mail: <a href="mailto:galaxytoyota@thesachdevagroup.com">galaxytoyota@thesachdevagroup.com</a></p>
                          </div>
         <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-settings-tab" data-toggle="pill" href="#okhla-service-1" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                                     <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div> 
                   </a>
                        </article>
        
        
        </div>
        
                            
                             
                  
         
                    <!-- <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-settings-tab" data-toggle="pill" href="#okhla-service-2" role="tab" aria-controls="v-pills-settings" aria-selected="false"> -->
                                <!-- <i class="fa fa-check mr-2"></i> -->
                                <!-- <span class="">GALAXY TOYOTA (SERVICE) -OKHLA</span>
                                <div class="locationwise-text">
                        <p>C-44/1 Near Vodafone Office, Pocket C, Okhla Phase II, Okhla Industrial Area, New Delhi 110020</p>
                        <p>Mobile Number: <a href="">+91 95829 40202</a></p>
                        <p>E-mail: <a href="">galaxytoyota@thesachdevagroup.com</a></p>
                        </div> 
                    </a> -->
                            </div>
                    </div>
        
        
                    <div class="col-md-7">
                        <!-- Tabs content -->
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade rounded bg-white show active" id="shalimar-sales" role="tabpanel" aria-labelledby="v-pills-home-tab">
                               <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13995.048518046608!2d77.1449843!3d28.726654!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d01c1fd6ab459%3A0x37e5a6ef646ee83!2sGalaxy%20Toyota%20Showroom!5e0!3m2!1sen!2sin!4v1691990084427!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            
                            <div class="tab-pane fade  rounded bg-white" id="motinagar-sales" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                               <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14004.021022705392!2d77.1467438!3d28.6595613!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d03dc0387cd09%3A0xb622965543714d9a!2sGalaxy%20Toyota%20Showroom!5e0!3m2!1sen!2sin!4v1691990383295!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            
                            <div class="tab-pane fade rounded bg-white" id="lajpatnagar-sales" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14016.630727623673!2d77.2354085!3d28.5650274!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce38154ef1f99%3A0x357454fac62137ce!2sGalaxy%20Toyota%20Showroom!5e0!3m2!1sen!2sin!4v1691990436217!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            
                            <div class="tab-pane fade  rounded bg-white" id="dwarka-sales" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                               <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14016.19364006216!2d77.0629251!3d28.568309!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1b3ecaf33e29%3A0x50d0ac1d8d1cca54!2sGalaxy%20Toyota%20Showroom!5e0!3m2!1sen!2sin!4v1691990488297!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
                             <div class="tab-pane fade  rounded bg-white" id="chhatarpur-sales" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3506.098376097879!2d77.17253727455216!3d28.506687789786014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1fec0052ab71%3A0x78bf6724473fe463!2sGalaxy%20Toyota%20Showroom!5e0!3m2!1sen!2sin!4v1706529548105!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
        
                            <div class="tab-pane fade  rounded bg-white" id="motinagar-bodyshop" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14004.021022705392!2d77.1467438!3d28.6595613!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d03dd7ed65ed7%3A0xa85eb68c0a6c5def!2sGalaxy%20Toyota%20Service%20Center!5e0!3m2!1sen!2sin!4v1691990637861!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></ifram>
                            </div>
        
                            <div class="tab-pane fade  rounded bg-white" id="kundli-service" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                             <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13974.532985168695!2d77.1171281!3d28.8795249!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390dabf1adbec169%3A0xc7831fca4def5fa5!2sGalaxy%20Toyota%20Service%20Center%20%26%20Bodyshop!5e0!3m2!1sen!2sin!4v1691990845469!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
        
                            <div class="tab-pane fade  rounded bg-white" id="azadpur-service" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                             <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13995.670004786321!2d77.1627636!3d28.7220114!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d01a9a6051cf1%3A0x8a45caab366481aa!2sGalaxy%20Toyota%20Service%20Center!5e0!3m2!1sen!2sin!4v1691990910819!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
        
                            </div>
        
                            <div class="tab-pane fade  rounded bg-white" id="motinagar-service" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                               <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14004.021022705392!2d77.1467438!3d28.6595613!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d03dd7ed65ed7%3A0xa85eb68c0a6c5def!2sGalaxy%20Toyota%20Service%20Center!5e0!3m2!1sen!2sin!4v1691990637861!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
        
                            <div class="tab-pane fade  rounded bg-white" id="okhla-service-1" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                             <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14022.942477709985!2d77.2818694!3d28.517601!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce10b1fd1268f%3A0x5395729ccd3a0e30!2sGalaxy%20Toyota%20Service%20Center!5e0!3m2!1sen!2sin!4v1691991060836!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
        
                            <div class="tab-pane fade  rounded bg-white" id="okhla-service-2" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                <h4 class="font-italic mb-4">Confirm booking</h4>
                                <p class="font-italic text-muted mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>       
                                    </div>  
                                    </div>
                                <div class="tab-pane" id="tab_default_2">
                                <div class="location-tab-parent">
                                   <!-- Demo header-->
        <section class="header">
            <div class="container py-4"     style="max-width: -webkit-fill-available;">
                <!-- <header class="text-center mb-5 pb-5 text-white">
                    <h1 class="display-4">Bootstrap vertical tabs</h1>
                    <p class="font-italic mb-1">Making advantage of Bootstrap 4 components, easily build an awesome tabbed interface.</p>
                    <p class="font-italic">
                        <a class="text-white" href="">
                            <u></u>
                        </a>
                    </p>
                </header> -->
        
        
                <div class="row">
                    <div class="col-md-5" style="
            overflow-x: hidden;
            overflow-y: auto;
        ">
                        
                        
                        
                        <div class="section-b">     <h1 style="color: #ec3237; font-size: 2rem;  text-align: -webkit-center;">Our Showrooms & Service Centers</h1>
                                <ul class="btns-group">
                                  <li >
                                      
                                    <button class="btns btns--ghost">
                                        <a class="nav-link" href="#tab_default_1" data-toggle="tab">Galaxy Toyota</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_2" data-toggle="tab">Hans Hyundai</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_6" data-toggle="tab">Auto Car Repair</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_8" data-toggle="tab">TSG Used Cars</a>
                                    </button></li>
                                      <li >
                                                <button class="btns btns--ghost"> 
                                                    <a class="nav-link" href="#tab_default_3" data-toggle="tab">Harpreet Ford</a>
                                                </button></li> 
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_5" data-toggle="tab">AMS Dry Ice</a>
                                    </button></li> 
                                    <li >
                                            <button class="btns btns--ghost"> 
                                                <a class="nav-link" href="#tab_default_4" data-toggle="tab">TSG Insure</a>
                                            </button></li>
                                    <li >
                                        <button class="btns btns--ghost"> 
                                            <a class="nav-link" href="#tab_default_7" data-toggle="tab">Tsg Auction Mart</a>
                                        </button></li> 
                                         
                                          
                                </ul> 
                              </div>
                        
                        
                        <!-- Tabs nav -->
                        <div class="nav nav-pills-custom custom-height" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            
                            
        
        <div class="mobile-wrapper">
        
        <article class="job-card"><div class="row"><div class="col-sm-4">
          <div class="company-logo-img">
                <img src="assets/image/phoo/hhmotinagar.jpeg" />
          </div>
          </div><div class="col-sm-8"><div class="job-title">HANS HYUNDAI (SALES) - MOTINAGAR</div>
          <div class="company-name">Unit-4, TSG Complex, 69/1A, Moti Nagar Crossing Najafgarh Road</div>
          </div></div><div class="job-title">
            <p class="mobile-font-color">Mobile Number: <a href="tel:+91 84477 35009">+91 84477 35009</a></p>
            <p class="mobile-font-color">E-mail: <a href="mailto:info@hanshyundai.com">info@hanshyundai.com</a></p>
          </div>
         <a class="nav-link mb-0 p-0 left-location active location-anchore" id="v-pills-home-tab" data-toggle="pill" href="#hundai-motinagar-sales" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                
        
          <div class="btn-container">
            <button class="apply">Click Here</button>
           
          </div>
               
        </a>
        </article>
                    
        
                        <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
                <img src="assets/image/phoo/hhbadli.png" />
                          </div>
                          </div><div class="col-sm-8"><div class="job-title">HANS HYUNDAI (SERVICE) - BADLI</div> 
                          <div class="company-name">B5, Badli Industrial Area, Phase 1, Near Samay Pur, Badli Metro Station New Delhi 110042</div>
          </div></div><div class="job-title">
                            <p>Mobile Number: <a href="tel:+91 84477 35009">+91 84477 35009</a></p>
                        <p>E-mail: <a href="mailto:info@hanshyundai.com">info@hanshyundai.com</a></p>
                          </div>
         <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-profile-tab" data-toggle="pill" href="#hyundai-service-badli" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                                  <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article>
                        
        
        
        
           <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
                <img src="assets/image/phoo/servicemotihh.jpeg" />
                          </div>
                          </div><div class="col-sm-8"><div class="job-title">HANS HYUNDAI (SERVICE) - MOTINAGAR</div> 
                          <div class="company-name">Unit-5, TSG Complex 69/1A, Najafgarh Road, Block C, Industrial Area Moti Nagar Delhi 110015</div>
          </div></div><div class="job-title">
                            <p>Mobile Number: <a href="tel:+91 84477 35009">+91 84477 35009</a></p>
                        <p>E-mail: <a href="mailto:info@hanshyundai.com">info@hanshyundai.com</a></p>
                          </div>
         <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-messages-tab" data-toggle="pill" href="#hyundai-motinagar-service" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                            
                               <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article>
                        
                        
                        
                        
        <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
                <img src="assets/image/phoo/narainahh.jpeg" />
                          </div>
                          </div><div class="col-sm-8"><div class="job-title">HANS HYUNDAI (SERVICE) - NARAINA</div> 
                          <div class="company-name">A57 Industrial Area Phase I, Block A, Naraina Industrial Area Phase 1, Naraina New Delhi 110028</div>
          </div></div><div class="job-title">
                            <p>Mobile Number: <a href="tel:+91 95990 04581">+91 95990 04581</a></p>
                        <p>E-mail: <a href="mailto:info@hanshyundai.com">info@hanshyundai.com</a></p>
                          </div>
        <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-settings-tab" data-toggle="pill" href="#hyundai-naraina-service" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                                                           <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article>
                        
                        
                        
                        
        <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
                <img src="assets/image/phoo/zakhirahh.jpeg" />
                          </div>
                          </div><div class="col-sm-8"><div class="job-title">HANS HYUNDAI (BODYSHOP) - Zakhira</div> 
                          <div class="company-name">B-13, Najafgarh road, Zakhira, New Delhi Zakhira Delhi 110015</div>
          </div></div><div class="job-title">
                            <p>Mobile Number: <a href="tel:+91 84477 35009">+91 84477 35009</a></p>
                        <p>E-mail: <a href="mailto:info@hanshyundai.com">info@hanshyundai.com</a></p>
                          </div>
         <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-settings-tab" data-toggle="pill" href="#hyundai-service-bodyshop" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                                                         <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article>
                        
                        
                        
                          
        
        
        </div>
        
                            
                            
                    
                    </div>
        
        </div>
                    <div class="col-md-7">
                        <!-- Tabs content -->
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade rounded bg-white show active" id="hundai-motinagar-sales" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14004.07405754987!2d77.1465663!3d28.6591643!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d030401411043%3A0x287a7f70f0d4562e!2sHans%20Hyundai%20Showroom!5e0!3m2!1sen!2sin!4v1691992551681!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
                            
                            <div class="tab-pane fade  rounded bg-white" id="hyundai-service-badli" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                               <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13992.60384792561!2d77.1349095!3d28.7449094!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d011b1af89e01%3A0x8af64738d759b5ac!2sHans%20Hyundai%20Service%20Center!5e0!3m2!1sen!2sin!4v1691992622819!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
                            
                            <div class="tab-pane fade rounded bg-white" id="hyundai-motinagar-service" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14004.070504102716!2d77.1465974!3d28.6591909!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d03a81d6252dd%3A0x8c1564acf720f78b!2sHans%20Hyundai%20Service%20Center!5e0!3m2!1sen!2sin!4v1691992656479!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
                            
                            <div class="tab-pane fade  rounded bg-white" id="hyundai-naraina-service" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14007.353883502177!2d77.1376373!3d28.6346029!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d032337e6f67f%3A0xcd2cc4b645fd69d6!2sHans%20Hyundai%20Service%20Center!5e0!3m2!1sen!2sin!4v1691992717961!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
        
                            <div class="tab-pane fade  rounded bg-white" id="hyundai-service-bodyshop" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                               <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14003.14389988381!2d77.162893!3d28.6661264!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d0258fa6aa8f5%3A0x5e176a4dd13776e8!2sHans%20Hyundai%20Service%20Center!5e0!3m2!1sen!2sin!4v1691992780489!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </section>
        
                                    
                                    </div>
        
                                </div>
                                <div class="tab-pane" id="tab_default_3">
                                <div class="location-tab-parent">
                                   <!-- Demo header-->
        <section class="header">
            <div class="container py-4"     style="max-width: -webkit-fill-available;">
                <!-- <header class="text-center mb-5 pb-5 text-white">
                    <h1 class="display-4">Bootstrap vertical tabs</h1>
                    <p class="font-italic mb-1">Making advantage of Bootstrap 4 components, easily build an awesome tabbed interface.</p>
                    <p class="font-italic">
                        <a class="text-white" href="">
                            <u></u>
                        </a>
                    </p>
                </header> -->
        
        
                <div class="row">
                    <div class="col-md-5" style="
            overflow-x: hidden;
            overflow-y: auto;
        ">
                        
                        <div class="section-b">     <h1 style="color: #ec3237; font-size: 2rem;  text-align: -webkit-center;">Our Showrooms & Service Centers</h1>
                                <ul class="btns-group">
                                  <li >
                                      
                                    <button class="btns btns--ghost">
                                        <a class="nav-link" href="#tab_default_1" data-toggle="tab">Galaxy Toyota</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_2" data-toggle="tab">Hans Hyundai</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_6" data-toggle="tab">Auto Car Repair</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_8" data-toggle="tab">TSG Used Cars</a>
                                    </button></li>
                                      <li >
                                                <button class="btns btns--ghost"> 
                                                    <a class="nav-link" href="#tab_default_3" data-toggle="tab">Harpreet Ford</a>
                                                </button></li> 
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_5" data-toggle="tab">AMS Dry Ice</a>
                                    </button></li> 
                                    <li >
                                            <button class="btns btns--ghost"> 
                                                <a class="nav-link" href="#tab_default_4" data-toggle="tab">TSG Insure</a>
                                            </button></li>
                                    <li >
                                        <button class="btns btns--ghost"> 
                                            <a class="nav-link" href="#tab_default_7" data-toggle="tab">Tsg Auction Mart</a>
                                        </button></li> 
                                         
                                          
                                </ul> 
                              </div>
                        
                        <!-- Tabs nav -->
                        <div class="nav nav-pills-custom custom-height" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  
                  
                  <div class="mobile-wrapper">
        
        <article class="job-card"><div class="row"><div class="col-sm-4">
          <div class="company-logo-img">
            <img src="assets/image/phoo/hfokhla.jpg" />
            </div>
          </div><div class="col-sm-8"><div class="job-title">HARPREET FORD (SERVICE) -OKHLA</div>
          <div class="company-name">B-120, Pocket B, Okhla Phase- 1 Okhla Industrial Area, Delhi</div>
          </div></div><div class="job-title">
            <p class="mobile-font-color">Mobile Number: <a href="tel:+91 84482 82871">+91 84482 82871</a></p>
            <p class="mobile-font-color">E-mail: <a href="mailto:info@harpreetford.com">info@harpreetford.com</a></p>
          </div>
        <a class="nav-link mb-0 p-0 left-location active location-anchore" id="v-pills-home-tab" data-toggle="pill" href="#harpreet-service-okhla" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                            
        
          <div class="btn-container">
            <button class="apply">Click Here</button>
           
          </div>
               
        </a> 
        </article>
                    
        
                        <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
            <img src="assets/image/phoo/hfsahibabad.jpg" />
            </div>
                          </div><div class="col-sm-8"><div class="job-title">HARPREET FORD (SERVICE) -SAHIBABAD</div> 
                          <div class="company-name">PN, Sahibabad 8/1a site no 4, Gamma 2 Sahibabad Road Ghaziabad 201010</div>
          </div></div><div class="job-title">
                            <p>Mobile Number: <a href="tel:+91 92051 80921">+91 92051 80921</a></p>
                        <p>E-mail: <a href="mailto:info@harpreetford.com">info@harpreetford.com</a></p>
                          </div>
         <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-profile-tab" data-toggle="pill" href="#harpreet-service-sahibabad" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                                                      <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article>
                        
        
        
        
           <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
            <img src="assets/image/fordico.png" />
            </div>
                          </div><div class="col-sm-8"><div class="job-title">HARPREET FORD (SERVICE) - MOTINAGAR</div> 
                          <div class="company-name">29, DLF Towers Shivaji Marg, Najafgarh Rd, Ind Area Opp DLF Greens, Najafgarh Road Najafgarh Road Industrial Area</div>
          </div></div><div class="job-title">
                            <p>Mobile Number: <a href="tel:+91 84482 82871">+91 84482 82871</a></p>
                        <p>E-mail: <a href="mailto:info@harpreetford.com">info@harpreetford.com</a></p> 
                          </div>
         <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-messages-tab" data-toggle="pill" href="#harpreet-service-motinagar" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                              
                               <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article> 
                        
                         
                        
                        
        <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
            <img src="assets/image/phoo/jahangirpur.jpg" />
            </div>
                          </div><div class="col-sm-8"><div class="job-title">HARPREET FORD (SERVICE) -JAHANGIRPURI</div> 
                          <div class="company-name">Plot no 68 SSI Ind.Area opp metro pilar no-144 Jahangirpuri Delhi 110033</div>
          </div></div><div class="job-title">
                            <p>Mobile Number: <a href="tel:+91 92058 92074">+91 92058 92074</a></p>
                        <p>E-mail: <a href="mailto:info@harpreetford.com">info@harpreetford.com</a></p>
                          </div>
         <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-settings-tab" data-toggle="pill" href="#harpreet-service-jahangirpuri" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                                                                                <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article>
                        
                        
                        
                        
        <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
            <img src="assets/image/fordico.png" />
            </div>
                          </div><div class="col-sm-8"><div class="job-title">HARPREET FORD (SERVICE) - GURGAON</div> 
                          <div class="company-name">Plot No 29 & 30, Near Hero Honda Plant Info Technology Park, Sector 34 Gurugram 122001</div>
          </div></div><div class="job-title">
                            <p>Mobile Number: <a href="tel:+91 95997 85023">+91 95997 85023</a></p>
                        <p>E-mail: <a href="mailto:info@harpreetford.com">info@harpreetford.com</a></p>
                          </div>
         <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-settings-tab" data-toggle="pill" href="#harpreet-service-gurgaon" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                                                                               <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article>
                        
           <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
                                <img src="assets/image/phoo/kundlihf.jpg" />
                          </div>
                          </div><div class="col-sm-8"><div class="job-title">HARPREET FORD (BODYSHOP) -KUNDLI</div> 
                          <div class="company-name">Khasra No. 31/16, Near Parnami Hospital, GT Karnal Road, Kundli Sonipat</div>
          </div></div><div class="job-title">
                            <p>Mobile Number: <a href="tel:+91 92058 92074">+91 92058 92074</a></p>
                        <p>E-mail: <a href="mailto:info@harpreetford.com">info@harpreetford.com</a></p>
                          </div>
         <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-settings-tab" data-toggle="pill" href="#harpreet-service-gurgaon" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                                                                               <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article>
                        
                        
                          
        
        
        </div>
                  
                            </div>
                    </div>
        
        
                    <div class="col-md-7">
                        <!-- Tabs content -->
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade rounded bg-white show active" id="
        harpreet-service-okhla" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5237.933217542872!2d77.27851661564975!3d28.531568586348612!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce1dafffcf02d%3A0x95ef22bf0f18fa5e!2sHarpreet%20Ford%20Service%20Center!5e0!3m2!1sen!2sin!4v1691993317324!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
                            
                            <div class="tab-pane fade  rounded bg-white" id="harpreet-service-sahibabad" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14004.741010168067!2d77.3261979!3d28.6541713!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfb222eef1503%3A0x172f0e17ef17fa46!2sHarpreet%20Ford!5e0!3m2!1sen!2sin!4v1691993441692!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
                            
                            <div class="tab-pane fade rounded bg-white" id="harpreet-service-motinagar" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                               <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14003.597000312744!2d77.1541177!3d28.6627352!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d036192e09041%3A0x73bf43becfd87765!2sHarpreet%20Ford%20Service%20Center!5e0!3m2!1sen!2sin!4v1691993627691!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
                            
                            <div class="tab-pane fade  rounded bg-white" id="harpreet-service-jahangirpuri" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d111957.61548567438!2d77.07393799671719!3d28.72924272442913!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d01f90bcc7947%3A0x5b23eb3a2906c632!2sHarpreet%20Ford%20Service%20Center!5e0!3m2!1sen!2sin!4v1691993710460!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
                            <div class="tab-pane fade  rounded bg-white" id="harpreet-service-gurgaon" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14034.360108001181!2d77.0119453!3d28.431625!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d19660742305b%3A0xfe535646fa7e4553!2sHarpreet%20Ford%20Service%20Center!5e0!3m2!1sen!2sin!4v1691993825943!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
                            <div class="tab-pane fade  rounded bg-white" id="harpreet-service-kundli" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3493.6381473488104!2d77.11471547456738!3d28.879379172830042!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390dabd8ea379511%3A0x86b5a58e77d4f178!2sHarpreet%20Ford!5e0!3m2!1sen!2sin!4v1706685135056!5m2!1sen!2sin"  width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </div>
        </div>
        
        
        
        
        <div class="tab-pane" id="tab_default_4">
                                <div class="location-tab-parent">
                                   <!-- Demo header-->
        <section class="header">
            <div class="container py-4"     style="max-width: -webkit-fill-available;">
                <!-- <header class="text-center mb-5 pb-5 text-white">
                    <h1 class="display-4">Bootstrap vertical tabs</h1>
                    <p class="font-italic mb-1">Making advantage of Bootstrap 4 components, easily build an awesome tabbed interface.</p>
                    <p class="font-italic">
                        <a class="text-white" href="">
                            <u></u>
                        </a>
                    </p>
                </header> -->
        
        
                <div class="row">
                    <div class="col-md-5" style="
            overflow-x: hidden;
            overflow-y: auto;
        ">
                        
                        <div class="section-b">     <h1 style="color: #ec3237; font-size: 2rem;  text-align: -webkit-center;">Our Showrooms & Service Centers</h1>
                                <ul class="btns-group">
                                  <li >
                                      
                                    <button class="btns btns--ghost">
                                        <a class="nav-link" href="#tab_default_1" data-toggle="tab">Galaxy Toyota</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_2" data-toggle="tab">Hans Hyundai</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_6" data-toggle="tab">Auto Car Repair</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_8" data-toggle="tab">TSG Used Cars</a>
                                    </button></li>
                                      <li >
                                                <button class="btns btns--ghost"> 
                                                    <a class="nav-link" href="#tab_default_3" data-toggle="tab">Harpreet Ford</a>
                                                </button></li> 
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_5" data-toggle="tab">AMS Dry Ice</a>
                                    </button></li> 
                                    <li >
                                            <button class="btns btns--ghost"> 
                                                <a class="nav-link" href="#tab_default_4" data-toggle="tab">TSG Insure</a>
                                            </button></li>
                                    <li >
                                        <button class="btns btns--ghost"> 
                                            <a class="nav-link" href="#tab_default_7" data-toggle="tab">Tsg Auction Mart</a>
                                        </button></li> 
                                         
                                          
                                </ul> 
                              </div>
                        
                        
                        <!-- Tabs nav -->
                        <div class="nav nav-pills-custom custom-height" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    
                    
                    
                    
                    
                    
                    
                    
                              <div class="mobile-wrapper">
        
        <article class="job-card"><div class="row"><div class="col-sm-4">
          <div class="company-logo-img">
                <img src="assets/image/phoo/moti.jpeg" />
          </div>
          </div><div class="col-sm-8"><div class="job-title">TSG Insure -MOTINAGAR</div>
          <div class="company-name">Unit-2, 69/1-A, Najafgarh Road, Moti Nagar Crossing New Delhi 110015</div>
          </div></div><div class="job-title">
            <p class="mobile-font-color">Mobile Number: <a href="tel:+91 96431 01006">+91 96431 01006</a></p>
            <p class="mobile-font-color">E-mail: <a href="mailto:galaxytoyota@thesachdevagroup.com">galaxytoyota@thesachdevagroup.com</a></p>
          </div>
         <a class="nav-link mb-0 p-0 left-location active location-anchore" id="v-pills-home-tab" data-toggle="pill" href="#insure-service-okhla" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                                
        
          <div class="btn-container">
            <button class="apply">Click Here</button>
           
          </div>
               
        </a>
        </article>
        </div>
                        </div>
                    </div>
        
        
                    <div class="col-md-7">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade rounded bg-white show active" id="insure-service-okhla" role="tabpanel" aria-labelledby="insure-service-okhla-tab">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.0141766744623!2d77.14407127455837!3d28.65929418286659!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d0358c32cb467%3A0xd1a3d87351e3af60!2sTSG%20Used%20Cars!5e0!3m2!1sen!2sin!4v1706001088411!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
        <!--                    <div class="tab-pane fade rounded bg-white show active" id="-->
        <!--harpreet-service-okhla" role="tabpanel" aria-labelledby="v-pills-home-tab">-->
        <!--                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5237.933217542872!2d77.27851661564975!3d28.531568586348612!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce1dafffcf02d%3A0x95ef22bf0f18fa5e!2sHarpreet%20Ford%20Service%20Center!5e0!3m2!1sen!2sin!4v1691993317324!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>-->
        
        <!--                    </div>-->
               
          
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </div>
        </div>
        
        <div class="tab-pane" id="tab_default_5">
            <div class="location-tab-parent">
                <!-- Demo header -->
                <section class="header">
                    <div class="container py-4" style="max-width: -webkit-fill-available;">
                        <!-- Header content goes here -->
                        <div class="row">
                            <div class="col-md-5" style="overflow-x: hidden; overflow-y: auto;">
                                
                        <div class="section-b">     <h1 style="color: #ec3237; font-size: 2rem;  text-align: -webkit-center;">Our Showrooms & Service Centers</h1>
                                <ul class="btns-group">
                                  <li >
                                      
                                    <button class="btns btns--ghost">
                                        <a class="nav-link" href="#tab_default_1" data-toggle="tab">Galaxy Toyota</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_2" data-toggle="tab">Hans Hyundai</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_6" data-toggle="tab">Auto Car Repair</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_8" data-toggle="tab">TSG Used Cars</a>
                                    </button></li>
                                      <li >
                                                <button class="btns btns--ghost"> 
                                                    <a class="nav-link" href="#tab_default_3" data-toggle="tab">Harpreet Ford</a>
                                                </button></li> 
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_5" data-toggle="tab">AMS Dry Ice</a>
                                    </button></li> 
                                    <li >
                                            <button class="btns btns--ghost"> 
                                                <a class="nav-link" href="#tab_default_4" data-toggle="tab">TSG Insure</a>
                                            </button></li>
                                    <li >
                                        <button class="btns btns--ghost"> 
                                            <a class="nav-link" href="#tab_default_7" data-toggle="tab">Tsg Auction Mart</a>
                                        </button></li> 
                                         
                                          
                                </ul>  
                              </div>
                                
                                <!-- Tabs nav -->
                                <div class="nav nav-pills-custom custom-height" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <!-- AMS Dry Ice - MOTINAGAR -->
                                    
                                             <div class="mobile-wrapper">    
        
        <article class="job-card"><div class="row"><div class="col-sm-4">  
          <div class="company-logo-img">
                <img src="assets/image/phoo/amsdryice.jpg" />
          </div>
          </div><div class="col-sm-8"><div class="job-title">AMS Dry Ice - MOTINAGAR</div>
          <div class="company-name">Unit-2, 69/1-A, Najafgarh Road, Moti Nagar Crossing New Delhi 110015</div>
          </div></div><div class="job-title">
            <p class="mobile-font-color">Mobile Number: <a href="tel:+91 84482 82871">+91 96431 01006</a></p>
            <p class="mobile-font-color">E-mail: <a href="mailto:galaxytoyota@thesachdevagroup.com">galaxytoyota@thesachdevagroup.com</a></p>
          </div>
         <a class="nav-link mb-0 p-0 left-location active location-anchore" id="ams-service-okhla-tab" data-toggle="pill" href="#ams-service-okhla" role="tab" aria-controls="ams-service-okhla" aria-selected="true">
                                                                            
        
          <div class="btn-container">
            <button class="apply">Click Here</button>
           
          </div>
               
        </a>
        </article>
                    
        
                        
        </div>                            <!-- Add other locations as needed -->
                                </div>
                            </div>
        
                            <div class="col-md-7">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <!-- AMS Dry Ice - MOTINAGAR Map -->
                                    <div class="tab-pane fade rounded bg-white show active" id="ams-service-okhla" role="tabpanel" aria-labelledby="ams-service-okhla-tab">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.007883382722!2d77.14207607658666!3d28.659482620095215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d038e3380f33d%3A0x9022404ec0def16f!2sAMS%20Dry%20Ice!5e0!3m2!1sen!2sin!4v1706685602086!5m2!1sen!2sin"  width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
        
                                    <!-- Add other locations and maps as needed -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        
        <div class="tab-pane" id="tab_default_6">
                                <div class="location-tab-parent">
                                   <!-- Demo header-->
        <section class="header">
            <div class="container py-4"     style="max-width: -webkit-fill-available;">
                <!-- <header class="text-center mb-5 pb-5 text-white">
                    <h1 class="display-4">Bootstrap vertical tabs</h1>
                    <p class="font-italic mb-1">Making advantage of Bootstrap 4 components, easily build an awesome tabbed interface.</p>
                    <p class="font-italic">
                        <a class="text-white" href="">
                            <u></u>
                        </a>
                    </p>
                </header> -->
        
        
                <div class="row">
                    <div class="col-md-5" style="
            overflow-x: hidden;
            overflow-y: auto;
        ">
                        
                        <div class="section-b">     <h1 style="color: #ec3237; font-size: 2rem;  text-align: -webkit-center;">Our Showrooms & Service Centers</h1>
                                <ul class="btns-group">
                                  <li >
                                      
                                    <button class="btns btns--ghost">
                                        <a class="nav-link" href="#tab_default_1" data-toggle="tab">Galaxy Toyota</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_2" data-toggle="tab">Hans Hyundai</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_6" data-toggle="tab">Auto Car Repair</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_8" data-toggle="tab">TSG Used Cars</a>
                                    </button></li>
                                      <li >
                                                <button class="btns btns--ghost"> 
                                                    <a class="nav-link" href="#tab_default_3" data-toggle="tab">Harpreet Ford</a>
                                                </button></li> 
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_5" data-toggle="tab">AMS Dry Ice</a>
                                    </button></li> 
                                    <li >
                                            <button class="btns btns--ghost"> 
                                                <a class="nav-link" href="#tab_default_4" data-toggle="tab">TSG Insure</a>
                                            </button></li>
                                    <li >
                                        <button class="btns btns--ghost"> 
                                            <a class="nav-link" href="#tab_default_7" data-toggle="tab">Tsg Auction Mart</a>
                                        </button></li> 
                                         
                                          
                                </ul> 
                              </div>
                        
                        
                        <!-- Tabs nav -->
                        <div class="nav nav-pills-custom custom-height" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    
                    
                              <div class="mobile-wrapper">
        
        <article class="job-card"><div class="row"><div class="col-sm-4">
          <div class="company-logo-img">
                <img src="assets/image/phoo/acrmoti.jpeg" />
          </div>
          </div><div class="col-sm-8"><div class="job-title">Auto Car Repair (SERVICE) - MOTINAGAR</div>
          <div class="company-name">60 N G Road, Rama Rd, Moti Nagar, New Delhi, Delhi 110015</div>
          </div></div><div class="job-title">
            <p class="mobile-font-color">Mobile Number: <a href="tel:+91 9810446692">+91 9810446692</a></p>
            <p class="mobile-font-color">E-mail: <a href="mailto:info@autocarrepair.in">info@autocarrepair.in</a></p>
          </div>
         <a class="nav-link mb-0 p-0 left-location active location-anchore" id="v-pills-home-tab" data-toggle="pill" href="#acr-service-motinagar" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                                    
        
          <div class="btn-container">
            <button class="apply">Click Here</button>
           
          </div>
               
        </a>
        </article>
                    
        
                        <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
                <img src="assets/image/phoo/acrgurgaon.jpeg" />
                          </div>
                          </div><div class="col-sm-8"><div class="job-title">Auto Car Repair (SERVICE) - GURUGRAM</div> 
                          <div class="company-name"> Unit-1 Plot No 29 & 30, near, Kargil Shaheed Sukhbir Singh Yadav Marg, Info Technology Park, Sector 34, Gurugram, Haryana 122001</div>
          </div></div><div class="job-title">
                            <p>Mobile Number: <a href="tel:+91 9810446692">+91 9810446692</a></p>
                        <p>E-mail: <a href="mailto:info@autocarrepair.in">info@autocarrepair.in</a></p>
                          </div>
         <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-profile-tab" data-toggle="pill" href="#acr-service-gurgaon" role="tab" aria-controls="v-pills-profile" aria-selected="true">
                                                                                        <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article>
                        
        
        
        
           <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
                <img src="assets/image/acr-logo.webp" />
                          </div>
                          </div><div class="col-sm-8"><div class="job-title">Auto Car Repair (SERVICE) - NOIDA</div> 
                          <div class="company-name">Coming Soon</div>
          </div></div><div class="job-title">
                            <p>Mobile Number: <a href="tel:+919810446692">9810446692</a></p>
                        <p>E-mail: <a href="mailto:info@autocarrepair.in">info@autocarrepair.in</a></p>
                          </div>
         <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-messages-tab" data-toggle="pill" href="#acr-service-noida" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                                                    
                               <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article>
                        
                        
                        
                        
        <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
                <img src="assets/image/acr-logo.webp" />
                          </div>
                          </div><div class="col-sm-8"><div class="job-title">Auto Car Repair (SERVICE) - OKHLA</div> 
                          <div class="company-name">Coming Soon</div>
          </div></div><div class="job-title">
                            <p>Mobile Number: <a href="tel:+91 9810446692">+91 9810446692</a></p>
                        <p>E-mail: <a href="mailto:info@autocarrepair.in">info@autocarrepair.in</a></p>
                          </div>
         <a class="nav-link mb-0 p-0 left-location location-anchore" id="v-pills-settings-tab" data-toggle="pill" href="#acr-service-okhla" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                                                                                                  <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article>
                        
        </div>                    </div>
                    </div>
        
        
                    <div class="col-md-7">
                        <!-- Tabs content -->
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade rounded bg-white show active" id="acr-service-motinagar" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.036385565029!2d77.1502387745583!3d28.658629182896778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d0331cdd62da9%3A0xdac227ddc17a8031!2sAuto%20Car%20Repair%20(ACR)!5e0!3m2!1sen!2sin!4v1706000071716!5m2!1sen!2sin"  width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
                            
                            <div class="tab-pane fade rounded bg-white" id="acr-service-gurgaon" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3508.593299532652!2d77.00977747454908!3d28.431526293181914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d17df3e2c6c05%3A0xe71b41b0f86ca715!2sAuto%20Car%20Repair%20(ACR)!5e0!3m2!1sen!2sin!4v1706000311756!5m2!1sen!2sin"  width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            </div>
                            
                            <!--<div class="tab-pane fade rounded bg-white" id="acr-service-noida" role="tabpanel" aria-labelledby="v-pills-messages-tab">-->
                            <!--   <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14003.597000312744!2d77.1541177!3d28.6627352!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d036192e09041%3A0x73bf43becfd87765!2sHarpreet%20Ford%20Service%20Center!5e0!3m2!1sen!2sin!4v1691993627691!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>-->
        
                            <!--</div>-->
                            
                            <!--<div class="tab-pane fade  rounded bg-white" id="acr-service-okhla" role="tabpanel" aria-labelledby="v-pills-settings-tab">-->
                            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d111957.61548567438!2d77.07393799671719!3d28.72924272442913!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d01f90bcc7947%3A0x5b23eb3a2906c632!2sHarpreet%20Ford%20Service%20Center!5e0!3m2!1sen!2sin!4v1691993710460!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>-->
        
                            <!--</div>-->
                         
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </div>
        </div>
         
          <div class="tab-pane" id="tab_default_7">
           <div class="location-tab-parent">
                                   <!-- Demo header-->
        <section class="header">
            <div class="container py-4"     style="max-width: -webkit-fill-available;">
                <!-- <header class="text-center mb-5 pb-5 text-white">
                    <h1 class="display-4">Bootstrap vertical tabs</h1>
                    <p class="font-italic mb-1">Making advantage of Bootstrap 4 components, easily build an awesome tabbed interface.</p>
                    <p class="font-italic">
                        <a class="text-white" href="">
                            <u></u>
                        </a>
                    </p>
                </header> -->
        
        
                <div class="row">
                    <div class="col-md-5" style="
            overflow-x: hidden;
            overflow-y: auto;
        ">
                        
                        <div class="section-b">     <h1 style="color: #ec3237; font-size: 2rem;  text-align: -webkit-center;">Our Showrooms & Service Centers</h1>
                                <ul class="btns-group">
                                  <li >
                                      
                                    <button class="btns btns--ghost">
                                        <a class="nav-link" href="#tab_default_1" data-toggle="tab">Galaxy Toyota</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_2" data-toggle="tab">Hans Hyundai</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_6" data-toggle="tab">Auto Car Repair</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_8" data-toggle="tab">TSG Used Cars</a>
                                    </button></li>
                                      <li >
                                                <button class="btns btns--ghost"> 
                                                    <a class="nav-link" href="#tab_default_3" data-toggle="tab">Harpreet Ford</a>
                                                </button></li> 
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_5" data-toggle="tab">AMS Dry Ice</a>
                                    </button></li> 
                                    <li >
                                            <button class="btns btns--ghost"> 
                                                <a class="nav-link" href="#tab_default_4" data-toggle="tab">TSG Insure</a>
                                            </button></li>
                                    <li >
                                        <button class="btns btns--ghost"> 
                                            <a class="nav-link" href="#tab_default_7" data-toggle="tab">Tsg Auction Mart</a>
                                        </button></li> 
                                         
                                          
                                </ul> 
                              </div>
                        
                                
                                <!-- Tabs nav -->
                                <div class="nav nav-pills-custom custom-height" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <!-- TSG Auction Mart (SHOWROOM) - MOTINAGAR -->
                                   
                                   
                                  
                       <div class="mobile-wrapper">
        
        <article class="job-card"><div class="row"><div class="col-sm-4">
          <div class="company-logo-img">
                <img src="assets/image/phoo/moti.jpeg" />
          </div>
          </div><div class="col-sm-8"><div class="job-title">TSG Auction Mart (SHOWROOM) - MOTINAGAR</div>
          <div class="company-name">Unit-6, 69, 1-A, Najafgarh Rd, Moti Nagar, Block C, Najafgarh Road Industrial Area, Delhi, 110015</div>
          </div></div><div class="job-title">
            <p class="mobile-font-color">Mobile Number: <a href="tel:+91 96431 01006">+91 96431 01006</a></p>
            <p class="mobile-font-color">E-mail: <a href="mailto:galaxytoyota@thesachdevagroup.com">galaxytoyota@thesachdevagroup.com</a></p>
          </div>
         <a class="nav-link mb-0 p-0 left-location active location-anchore" id="tsgused-service-okhla-tab" data-toggle="pill" href="#auction-service-okhla" role="tab" aria-controls="auction-service-okhla" aria-selected="true">
                                                                           
        
          <div class="btn-container">
            <button class="apply">Click Here</button>
           
          </div>
               
        </a>
        </article>
                    
        
                        <article class="job-card"><div class="row"><div class="col-sm-4">
                          <div class="company-logo-img">
                <img src="assets/image/2022-02-18.jpg" />
                          </div>
                          </div><div class="col-sm-8"><div class="job-title">TSG Auction Mart (SHOWROOM) - SHALIMAR PLACE</div> 
                          <div class="company-name">A - Block, Plot - II Outer Ring Road Near, Jail, Shalimar Place, District Center, Rohini</div>
          </div></div><div class="job-title">
                            <p>Mobile Number: <a href="tel:+91 96543 92839">+91 96543 92839</a></p>
                        <p>E-mail: <a href="mailto:galaxytoyota@thesachdevagroup.com">galaxytoyota@thesachdevagroup.com</a></p>
                          </div>
         <a class="nav-link mb-0 p-0 left-location location-anchore" id="auction-service-shalimar-tab" data-toggle="pill" href="#auction-service-shalimar" role="tab" aria-controls="auction-service-shalimar" aria-selected="true">
                                                                                                     <div class="btn-container">
                            <button class="apply">Click Here</button>
                           
                          </div>
                   </a>
                        </article>
        
        </div>
        
                                </div>
                            </div>
        
                            <div class="col-md-7">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <!-- TSG Auction Mart (SHOWROOM) - MOTINAGAR Map -->
                                    <div class="tab-pane fade rounded bg-white show active" id="auction-service-okhla" role="tabpanel" aria-labelledby="tsgused-service-okhla-tab">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.0141766744623!2d77.14407127455837!3d28.65929418286659!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d0358c32cb467%3A0xd1a3d87351e3af60!2sTSG%20Used%20Cars!5e0!3m2!1sen!2sin!4v1706001088411!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
        
                                    <!-- TSG Auction Mart (SHOWROOM) - SHALIMAR PLACE Map -->
                                    <div class="tab-pane fade rounded bg-white" id="auction-service-shalimar" role="tabpanel" aria-labelledby="auction-service-shalimar-tab">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3498.7573325394164!2d77.14250256047505!3d28.726797325511686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d01c1fd6ab459%3A0x37e5a6ef646ee83!2sGalaxy%20Toyota%20Showroom!5e0!3m2!1sen!2sin!4v1706158187189!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
        
                                    <!-- Add other locations and maps as needed -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        
        
                            <div class="tab-pane" id="tab_default_8">
            <div class="location-tab-parent">
                <!-- Demo header -->
                <section class="header">
                    <div class="container py-4" style="max-width: -webkit-fill-available;">
                        <!-- Header content goes here -->
                        <div class="row">
                            <div class="col-md-5" style="overflow-x: hidden; overflow-y: auto;">
                                
                        <div class="section-b">     <h1 style="color: #ec3237; font-size: 2rem;  text-align: -webkit-center;">Our Showrooms & Service Centers</h1>
                                <ul class="btns-group">
                                  <li >
                                      
                                    <button class="btns btns--ghost">
                                        <a class="nav-link" href="#tab_default_1" data-toggle="tab">Galaxy Toyota</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_2" data-toggle="tab">Hans Hyundai</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_6" data-toggle="tab">Auto Car Repair</a>
                                    </button></li>
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_8" data-toggle="tab">TSG Used Cars</a>
                                    </button></li>
                                      <li >
                                                <button class="btns btns--ghost"> 
                                                    <a class="nav-link" href="#tab_default_3" data-toggle="tab">Harpreet Ford</a>
                                                </button></li> 
                                  <li >
                                    <button class="btns btns--ghost"> 
                                               <a class="nav-link" href="#tab_default_5" data-toggle="tab">AMS Dry Ice</a>
                                    </button></li> 
                                    <li >
                                            <button class="btns btns--ghost"> 
                                                <a class="nav-link" href="#tab_default_4" data-toggle="tab">TSG Insure</a>
                                            </button></li>
                                    <li >
                                        <button class="btns btns--ghost"> 
                                            <a class="nav-link" href="#tab_default_7" data-toggle="tab">Tsg Auction Mart</a>
                                        </button></li> 
                                         
                                          
                                </ul> 
                              </div>
                                
                                <!-- Tabs nav -->
                                <div class="nav nav-pills-custom custom-height" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <!-- TSG Used Cars (SHOWROOM) - MOTINAGAR -->
                                  
                                                 <div class="mobile-wrapper">
        
        
        
        
        
        <article class="job-card">
            <div class="row">
                <div class="col-sm-4">
                    <div class="company-logo-img">  
                        <img src="assets/image/phoo/moti.jpeg" />  
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="job-title">TSG Used Cars (SHOWROOM) - MOTINAGAR</div> 
                    <div class="company-name">Unit-6, 69, 1-A, Najafgarh Rd, Moti Nagar, Block C, Najafgarh Road Industrial Area, Delhi, 110015</div>
                </div>
            </div>
            <div class="job-title">
                <p class="mobile-font-color">Mobile Number: <a href="tel:+91 9205582202">+91 9205582202</a></p>
                <p class="mobile-font-color">E-mail: <a href="mailto:info@tsgusedcars.com">info@tsgusedcars.com</a></p>
            </div>
            <a class="nav-link mb-0 p-0 left-location active location-anchore" id="tsgused-service-okhla-tab" data-toggle="pill" href="#tsgused-service-okhla" role="tab" aria-controls="tsgused-service-okhla" aria-selected="true">
                <div class="btn-container">
                    <button class="apply">Click Here</button>
                </div>  
            </a>
        </article>
        
        <article class="job-card">
            <div class="row">
                <div class="col-sm-4">
                    <div class="company-logo-img">
                        <img src="assets/image/2022-02-18.jpg" />  
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="job-title">TSG Used Cars (SHOWROOM) - SHALIMAR PLACE</div> 
                    <div class="company-name">A - Block, Plot - II Outer Ring Road Near, Jail, Shalimar Place, District Center, Rohini</div>
                </div>
            </div>
            <div class="job-title">
                <p>Mobile Number: <a href="tel:+91 9311953658">+91 9311953658</a></p>
                <p>E-mail: <a href="mailto:info@tsgusedcars.com">info@tsgusedcars.com</a></p>
            </div>
            <a class="nav-link mb-0 p-0 left-location location-anchore" id="used-service-shalimar-tab" data-toggle="pill" href="#used-service-shalimar" role="tab" aria-controls="used-service-shalimar" aria-selected="true">
                <div class="btn-container">
                    <button class="apply">Click Here</button>
                </div>
            </a> 
        </article>
        
        
        
         
        </div>
        
                                   
                                   
                                </div>  
                            </div>
        
                          <div class="col-md-7">
            <div class="tab-content" id="v-pills-tabContent">
                <!-- TSG Used Cars (SHOWROOM) - MOTINAGAR Map -->
                <div class="tab-pane fade rounded bg-white show active" id="tsgused-service-okhla" role="tabpanel" aria-labelledby="tsgused-service-okhla-tab">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.0141766744623!2d77.14407127455837!3d28.65929418286659!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d0358c32cb467%3A0xd1a3d87351e3af60!2sTSG%20Used%20Cars!5e0!3m2!1sen!2sin!4v1706001088411!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
        
                <!-- TSG Used Cars (SHOWROOM) - SHALIMAR PLACE Map -->
                <div class="tab-pane fade rounded bg-white" id="used-service-shalimar" role="tabpanel" aria-labelledby="used-service-shalimar-tab">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3498.7573325394164!2d77.14250256047505!3d28.726797325511686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d01c1fd6ab459%3A0x37e5a6ef646ee83!2sGalaxy%20Toyota%20Showroom!5e0!3m2!1sen!2sin!4v1706158187189!5m2!1sen!2sin" width="100%" height="625" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                <!-- Add other locations and maps as needed -->
            </div>
        </div>
                        </div>
                    </div>
                </section> 
            </div>
        </div>   
        
        
        
        
                  
                            </div>
                        </div>
                    </div>
        
            </div>
          </div>
        
        
                </div>
            <!--</div>-->
        
        </section>
        
        




@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        // Event delegation for 'a' tags
        $(document).on('click', 'a', function() {
            console.log('Clicked a');
        });

        // Event delegation for 'button' tags
        $(document).on('click', 'button', function() {
            console.log('Clicked button');
        });
    });
</script>
@endsection

