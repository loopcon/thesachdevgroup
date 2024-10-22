@extends('frontend.layout.header')
@section('css')
<link rel="stylesheet" href="{{url('public/css/payment_new.css')}}">
@endsection
@section('content')
<div id="everything-wrapper" class="section-full p-t50" style="z-index:-1234567;">
    <main class="container">
        <section class="events">
            <div class="title">Select Business</div>
            <div class="tiwari">
                <nav class="events__tabs">
                    <label class="events__tab -active">
                        <input type="radio" name="eventTab" data-tabcontent="tab-2" value="1" checked>Hans Hyundai 
                    </label>
                </nav>
            </div>

            <!-- Ensure you only have one brand as per your requirements -->
            <div id="tab-2" class="events__list -active">
                <div class="events__row">
                    <form action="{{route('payment.receipt')}}" method="post">
                        @csrf
                        <input type="hidden" name="merchant_id" value="1"> <!-- Assuming '1' is the ID for Hans Hyundai -->
                        <input type="hidden" name="paymentTo" value="Hans Hyundai">
                        <div class="title">Select Services</div>
                        <div class="user__detail">
                            <div class="user__details">
                                <label>
                                    <input class="details" type="radio" name="PaymentTowards" value="service_center-2" checked> Hans Hyundai Service Center
                                </label>
                            </div>
                            <div id="pay_loc_2">
                                <div class="form-group" id="payment_location">
                                    <label class="col-xs-3 control-label">Location <span class="text-danger">*</span></label>
                                    <div class="col-xs-9">
                                        <select class="form-control" required name="near_location">
										<option value="12">Hans Hyundai Zakhira Service Center</option>
                                        </select>
                                        <p class="para">(Please ask your advisor what is your location)</p>
                                    </div>
                                </div>
                            </div>
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
                                <input type="number" name="Amount" maxlength="7" placeholder="? XXXXXX" required>
                            </div>
                        </div>
                        <div class="payment-container">
                            <header>
                                <div class="title">Payment Selection</div>
                            </header>
                            <div class="payment-item">
                                <div class="item-options">
                                    <div class="selection">
                                        <img src="https://logowik.com/content/uploads/images/sbi-state-bank-of-india9251.logowik.com.webp" alt="" style="width: 56px;">
                                    </div>
                                    <div class="selection">
                                        <div style=" width: 50%; ">
                                            <input type="radio" name="subscription" id="sbi" checked="" />
                                            <label for="sbi">SBI Gateway</label>
                                            <div class="check"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="enhancements">
                            <input id="agreement" type="checkbox" value="red" name="agreement" required>
                            <label for="agreement">I have read and agree to the terms and conditions specified above by The Sachdev Group.</label>
                        </p>
                        <div class="button">
                            <button class="btn" name="submit" value="save" type="submit">Pay Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </section><!-- .events -->
    </main><!-- .container -->
</div>
@endsection
@section('javascript')
<script>
    window.onload = function () {
        document.getElementById("loader").style.display = "none";
        $("#everything-wrapper").show();
        $('.site-header').show();
        $('.site-footer').show();
    }

    $(document).ready(function () {
        $("#everything-wrapper").show();
        $('.site-header').show();
        $('.site-footer').show();

        // Keep the first tab active and the merchant_id set correctly
        const activeTab = document.querySelector('input[name="eventTab"][checked]');
        if (activeTab) {
            const merchantId = activeTab.value; // Get merchant ID from active tab
            document.querySelector('input[name="merchant_id"]').value = merchantId; // Set merchant_id
        }

        // Tab handling
        const tabs = document.querySelectorAll('.events__tab');

        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                tabs.forEach(t => t.classList.remove('-active'));
                this.classList.add('-active');
                const radioButton = this.querySelector('input[type="radio"]');
                radioButton.checked = true;
                radioButton.dispatchEvent(new Event('change'));
            });
        });
    });
</script>
@endsection
