@extends('frontend.layout.header')

@section('css')
<link rel="stylesheet" href="{{url('public/css/payment_new.css')}}">
@endsection

@section('content')
{{-- Loader --}}

<style>
    .payment-button {
        display: none;
    }
    .container .title {
    font-size: 18px;
    font-weight: 600;
    position: relative;
    padding: 5px 0px;
    }
    .events__tab {
        order: 0;
        position: static;
    width: auto;
    font-size: 13px;
    color: #5b5b5b;
    font-weight: 700;
    display: inline-flex;
    flex-direction: row;
    flex-wrap: nowrap;
    align-content: center;
    justify-content: center;
    align-items: center;
    padding: 0.625rem 0px; 
    gap: 0px 4px;
    }
   
    label{
        font-size: 13px;
        color: #5b5b5b;
        font-weight: 700;
        display: inline-flex;
    flex-direction: row;
    flex-wrap: nowrap;
    align-content: center;
    justify-content: center;
    align-items: center; 
    gap: 0px 4px;
    }
    .form-control{
        font-size: 13px;
        font-weight: 600; 
    }
    .para{
        font-size: 10px;
        color: #5b5b5b;
        font-weight: 700;
        padding: 5px 0px 0px 5px; 
    }
    .user__details .input__box .details {
    font-weight: 600;
    margin-bottom: 2px;
    display: block;
    }
    .user__details .input__box input {
    height: 35px;
    width: 100%;
    outline: none;
    border-radius: 5px;
    border: 1px solid var(--main-grey);
    padding-left: 15px;
    font-size: 14px;
    border-bottom-width: 2px;
    transition: all 0.3s ease;
    }
</style>

<div id="everything-wrapper" class="section-full p-t50" style="z-index:-1234567;">
    <main class="container">
        <section class="events">
            <div class="title">Select Business</div>

            {{-- Tab Navigation --}}
            <div class="tiwari">
                <nav class="events__tabs">
                    <label class="events__tab -active">
                        <input type="radio" name="eventTab" data-tabcontent="tab-1" checked="">Galaxy Toyota
                    </label>
                </nav>
            </div>

            {{-- Tab Content --}}
            <div id="tab-1" class="events__list -active">
                <div class="events__row">
                    <form action="{{route('payment.receipt')}}" method="post">
                        @csrf
                        <input type="hidden" name="merchant_id" value="1"> <!-- Assuming '1' is the ID for Galaxy Toyota -->
                        <input type="hidden" name="paymentTo" value="Galaxy Toyota">

                        {{-- Service Selection --}}
                        <div class="title">Select Services</div>
                        <div class="user__detail">
                            <div class="user__details">
                                <label>
                                    <input class="details" type="radio" name="PaymentTowards" value="service_center-1" required checked> Galaxy Toyota Service Centers
                                </label>
                            </div>

                            <div id="pay_loc_2">
                                <div class="form-group" id="payment_location">
                                    <label class="col-xs-3 control-label">Location <span class="text-danger">*</span></label>
                                    <div class="col-xs-9">
                                        <select class="form-control" required name="near_location">
                                            <option value="4">Galaxy Toyota Moti Nagar Service Center</option>
                                        </select>
                                        <p class="para">(Please ask your advisor what is your location)</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Personal Details --}}
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
                                <input type="number" name="Amount" maxlength="7" placeholder="&#8377; XXXXXX" required>
                            </div>
                        </div>

                        {{-- Payment Selection --}}
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
                                        <div style="width: 50%;">
                                            <input type="radio" name="subscription" id="sbi" checked>
                                            <label for="sbi">SBI Gateway</label>
                                            <div class="check"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Agreement and Submit --}}
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
        // Show the wrapper and hide the loader
        $("#everything-wrapper").show();
        $('.site-header').show();
        $('.site-footer').show();

        // Tab handling logic
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

        // Update merchant ID based on active tab
        const activeTab = document.querySelector('input[name="eventTab"][checked]');
        if (activeTab) {
            const merchantId = activeTab.dataset.tabcontent;
            document.querySelector('input[name="merchant_id"]').value = merchantId;
        }
    });
</script>
@endsection
