@extends('frontend.layout.header')
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
@section('css')
    <link rel="stylesheet" href="{{url('public/css/payment_new.css')}}">
@endsection
@section('content')
{{-- <div id="loader" style="margin-top:20px;passing:10px;">
    <h3 class="btn btn-info">Loading.. Please Wait.</h3>
</div> --}}
<div  id="everything-wrapper" class="section-full p-t50" style="z-index:-1234567;">
    <main class="container">
        <section class="events">
            <div class="title">Select Business</div> 
            <div class="atul">
                <nav class="events__tabs">
                    <?php foreach($brands as $brand) { ?>
                        <label class="events__tab -active">
                            <input type="radio" name="eventTab" data-tabcontent="tab-<?php echo $brand->id ?>" checked>
                            <?php echo $brand->title; ?>
                        </label>
                    <?php } ?>
                </nav>
            </div>
            <div class="harsh" style="padding: 16px 0 0 0;">
                <nav class="events__tabs">
                    <?php foreach($brands as $key => $brand) { ?>
                        <label class="events__tab -active">
                            <input type="radio" name="eventTab" data-tabcontent="tab-<?php echo $brand->id ?>" <?php if($key == 0){ echo 'checked'; } ?>>
                            <?php echo $brand->title; ?>
                        </label>
                    <?php } ?>
                </nav>
            </div>
            <?php foreach($brands as $key => $brand) { ?>
                <div id="tab-<?php echo $brand->id ?>" class="events__list <?php if($key == 0){ echo '-active'; } ?>  ">
                        <div class="events__row">
                            <form action="{{route('payment.receipt')}}" method="post">
                                @csrf
                                <input type="hidden" name="paymentTo" value="<?php echo $brand->title; ?>">
                                <div class="title">Select Services</div>
                                <div class="user__detail">
                                    <div class="user__details">
                                        <?php
                                            // $sql2='SELECT * FROM payment_towards WHERE vehicle_brand = ? AND status = 0 ORDER BY id';
                                            // $stmt2=$pdo->prepare($sql2);
                                            // $stmt2->execute([$brand->id]);
                                            // $find=$stmt2->fetchAll();
                                        ?>
                                        <?php // foreach($brand->payment_towards()->where('status', 0)->orderBy('id')->get() as $fval) { ?>
                                            {{-- <label><input class="details" type="radio" name="PaymentTowards" value="<?php // echo $fval->name.'-'.$fval->id; ?>"><?php // echo $fval->name; ?></label> --}}
                                        <?php // } ?>

                                        @if (isset($brand->showrooms) && $brand->showrooms->count())
                                            <label>
                                                <input class="details" type="radio" name="PaymentTowards" value="showroom-{{$brand->id}}">{{ $brand->showroom_title ?? "Showroom" }}
                                            </label>
                                        @endif

                                        @if (isset($brand->serviceCenters))
                                            <label>
                                                <input class="details" type="radio" name="PaymentTowards" value="service_center-{{$brand->id}}">{{ $brand->service_center_title ?? "Service Center" }}
                                            </label>
                                        @endif

                                        @if (isset($brand->bodyShops) && $brand->bodyShops->count())
                                            <label>
                                                <input class="details" type="radio" name="PaymentTowards" value="body_shop-{{$brand->id}}">{{ $brand->body_shop_title }}
                                            </label>
                                        @endif

                                        @if (isset($brand->usedCars) && $brand->usedCars->count())
                                            <label>
                                                <input class="details" type="radio" name="PaymentTowards" value="used_car-{{$brand->id}}">{{ $brand->used_car_title }}
                                            </label>
                                        @endif

                                        @if (isset($brand->businessInsurance) && $brand->businessInsurance->count())
                                            <label>
                                                <input class="details" type="radio" name="PaymentTowards" value="insurance-{{$brand->id}}">{{ $brand->insurance_title }}
                                            </label>
                                        @endif
                                        
                                        @if ($brand->id == 1 ||  $brand->id == 2 || $brand->id == 3)
                                            <label>
                                                <input class="details" type="radio" name="PaymentTowards" value="Other Specify-{{$brand->id}}">Other Specify
                                            </label>
                                        @endif

                                        @if ($brand->id == 4 ||  $brand->id == 5 || $brand->id == 7)
                                            <label>
                                                <input class="details" type="radio" name="PaymentTowards" value="Other-{{$brand->id}}">Other
                                            </label>
                                        @endif
                                        
                                    </div>
                                    <div id="pay_loc_<?php echo $brand->id ?>"></div>
                                </div>
                                <div class="title">Personal Details</div>
                                    <div class="user__details">
                                        <div class="input__box">
                                            <span class="details">Full Name</span>
                                            <input type="text" name="Name" placeholder="E.g: XYZ" required>
                                        </div>
                                        <div class="input__box">
                                            <span class="details">Phone Number</span>
                                            <input type="tel" name="MobileNo" pattern="[0-9]{10}" placeholder="0123456789" required>
                                        </div>
                                        <div class="input__box">
                                            <span class="details">Email</span>
                                            <input type="email" name="EmailId" placeholder="xyz@gmail.com" required>
                                        </div>
                                        <div class="input__box">
                                            <span class="details">Car Registration No.</span>
                                            <input type="text" name="carRegistrationNo" placeholder="E.g: DL9CX0001" required>
                                        </div>
                                        <div class="input__box">
                                            <span class="details">Invoice No. (Please ask advisor/outlet for Invoice No.)</span>
                                            <input type="text" name="InvoiceNo" placeholder="xxxxxxx" required>
                                        </div>
                                        <div class="input__box">
                                            <span class="details">Amount</span>
                                            <input type="amount" name="Amount" maxlength="7" placeholder="? XXXXXX" required>
                                        </div>
                                    </div>
                                    <div class="payment-container">
                                    <header>
                                        <div class="title">Payment Selection</div>
                                    </header>
                                    <div class="payment-item">
                                        <!-- <div class="item-title"> <span>1. </span>Bank</div> -->
                                        <div class="item-options">            
                                            <div class="selection"> 
                                                <!--<img src="https://logowik.com/content/uploads/images/payu9653.logowik.com.webp" alt="" style="width: 56px;">-->
                                                <img src="https://logowik.com/content/uploads/images/sbi-state-bank-of-india9251.logowik.com.webp" alt="" style="width: 56px;">
                                            </div>
                                            <div class="selection">
                                                <div style=" width: 50%; ">
                                                    <input type="radio" name="subscription" id="sbi" checked=""/>
                                                    <label for="sbi">SBI Gateway</label> 
                                                    <div class="check"></div>
                                                </div>            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="enhancements">
                                    <input id="agreement" type="checkbox" value="red" name="agreement">
                                    <label for="agreement">I have read and agree to the terms and conditions specified above by The Sachdev Group.</label>
                                </p>
                                <div class="button">
                                    <button class="btn" name="submit" value="save" type="submit">Pay Now</button>
                                    <!--<input type="submit" name="submit" value="Pay Now">-->
                                </div>
                            </form>
                        </div>
                    </div>
            <?php }?>
        </section><!-- .events -->
    </main><!-- .container -->
</div>
@endsection
@section('javascript')
<script>
    window.onload=function(){
        //  alert("hello");
        document.getElementById("loader").style.display = "none";
        $("#everything-wrapper").show();
        $('.site-header').show();
        $('.site-footer').show();
    }
    </script>
    <script>
        $(document).ready(function(){
            // document.getElementById("loader").style.display = "none";
            $("#everything-wrapper").show();
            $('.site-header').show();
            $('.site-footer').show();
            $(document).on('change', '.details', function(){
                var val = $(this).val();
                var $this = $(this);
                $.ajax({ 
                    type: "post",  
                    url: "{{route('payment.get-data-by-service')}}", 
                    data:{get_option:val, _token:"{{csrf_token()}}"}, 
                    success: function (response) 
                    {   
                       $this.parent().parent().next().html(response);
                    } 
                });
            })
        });
    const dropwdownTab = function () {
        console.clear();
        const parent = document.querySelector('.events');
        const trigger = parent.querySelector('.events__trigger');
        const tabNav = parent.querySelector('.events__tabs');
        const tabs = parent.querySelectorAll('.events__tab');
        const tabsContent = parent.querySelectorAll('.events__list');
    
        function openNav() {
            tabNav.classList.toggle('-open');
        }
    
        function openTab(e) {
            e.preventDefault();
            const thisTab = e.target;
            const thisTabId = thisTab.dataset.tabcontent;
            const thisTabContent = parent.querySelector(`#${thisTabId}`);
    
            tabs.forEach(tab => tab.classList.remove('-active'));
            thisTab.classList.add('-active');
            tabsContent.forEach(content => content.classList.remove('-active'));
            thisTabContent.classList.add('-active');
            tabNav.classList.remove('-open');
        }
    
        trigger.addEventListener('click', openNav);
        tabs.forEach(tab => tab.addEventListener('click', openTab));
    }();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.events__tab');
            const radioButtons = document.querySelectorAll('input[type="radio"]');
            const tabContents = document.querySelectorAll('.events__list');
          
            tabs.forEach(tab => {
                tab.addEventListener('click', function () {
                  // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('-active'));
                    // Add active class to the clicked tab
                    this.classList.add('-active');
                    // Trigger the change event on the associated radio button
                    const radioButton = this.querySelector('input[type="radio"]');
                    radioButton.checked = true;
                    radioButton.dispatchEvent(new Event('change'));
                });
            });
          
            radioButtons.forEach(radioButton => {
                radioButton.addEventListener('change', function () {
                    const tabContentId = this.dataset.tabcontent;
                    const tabContent = document.getElementById(tabContentId);
                    if(tabContent) {
                        // Hide all tab contents
                        tabContents.forEach(content => {
                          content.classList.remove('-active');
                        });
                        // Show the selected tab content
                        tabContent.classList.add('-active');
                    }
                });
            });
          
            const parent = document.querySelector('.events');
            const trigger = parent.querySelector('.events__trigger');
    
            function openNav() {
                parent.querySelector('.events__tabs').classList.toggle('-open');
            }
          
            function openTab(e) {
                e.preventDefault();
                const thisTab = e.target;
                const thisTabId = thisTab.dataset.tabcontent;
                const thisTabContent = document.getElementById(thisTabId);
    
                tabs.forEach(tab => tab.classList.remove('-active'));
                thisTab.classList.add('-active');
                tabContents.forEach(content => content.classList.remove('-active'));
                thisTabContent.classList.add('-active');
                parent.querySelector('.events__tabs').classList.remove('-open');
            }
          
            trigger.addEventListener('click', openNav);
            // Change event listener to target only radio buttons
    //        radioButtons.forEach(radioButton => {
    //            radioButton.parentElement.addEventListener('click', function (e) {
    //                e.stopPropagation(); // Prevent click event from propagating to parent
    //            });
    //        });
            // Add event listener for opening tab when label is clicked
            tabs.forEach(tab => tab.querySelector('label').addEventListener('click', openTab));
        });
    </script>
    <script>
    function payment_location(val){
        //alert(val); 
        $.ajax({ 
            type: "post",  
            url: "payment_location.php", 
            data:{get_option:val}, 
            success: function (response) {   
                document.getElementById("payment_location").innerHTML= response;        //alert(new_select);
            } 
        });
    }
    
    </script>
    <script>
    function payment_to(val){
        console.log('weryu');
        $.ajax({ 
            type: "post",  
            url: "payment_to_new.php", 
            data:{get_option:val}, 
            success: function (response) 
            {   
               console.log(response);
            } 
        });
    
    }
    
    </script>
@endsection

