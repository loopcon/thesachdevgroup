<?php include('header.php'); ?>

<section id="contact-us">
    <div class="contact-banner">
            <img src="assets/image/After Sales Service.svg" alt="">
    </div>
</section>


<section id="servive-content">
<div class="container">
    <div class="service-text">
        <h2>Your Partner, Even After</h2>
        <p>Experience the epitome of service excellence with us. We're dedicated to not only meeting but exceeding your expectations at every step of your journey. Entrust your car's maintenance and concerns to our service centers, where our premium After Sales service guarantees unmatched expertise and care. </p>
    </div>
    <!--<div class="insurence-logo">-->
    <!--      <div class="insurence-company-logo">-->
    <!--      <img src="assets/image/Toyota1.1 (1).png" alt="">-->
    <!--      </div>-->
    <!--      <div class="insurence-company-logo">-->
    <!--        <img src="assets/image/ford-logo.webp" alt="">-->
    <!--        </div>-->
    <!--        <div class="insurence-company-logo">-->
    <!--        <img src="assets/image/Hyundai (1).png" alt="">-->
    <!--        </div>-->
    <!--        <div class="insurence-company-logo">-->
    <!--        <img src="assets/image/ACR.png" alt="">-->
    <!--        </div>-->
    <!--    </div>-->
        
          <div class="new-brand-logo">

    <div class="brand-one">
      <a href="https://hanshyundai.com/" target="_blank"><img src="assets/image/Hyundai (1).png" alt="" width="100%"></a>
         </div>
    <div class="brand-one">
            <a href="https://www.galaxytoyota.in/" target= "_blank"><img src="assets/image/Toyota1.1 (1).png" alt="" width="100%"></a>
      </div>
      
         <div class="brand-one">
            <a href="https://harpreetford.com/" target= "_blank"><img src="assets/image/Ford.svg" alt="" width="100%"></a>
      </div>
      
        <div class="brand-one">
            <a href="https://autocarrepair.in/" target= "_blank"><img src="assets/image/ACR.png" alt="" width="100%"></a>
      </div>
      
      
    </div>

</div>


</section>

<section id="bookservice-form">
<div class="container">
    <div class="heading-bookservice">
        <h2>BOOK A CAR SERVICE</h2>
    </div>


<div class="bookservice-form">
<form action="" method="post">
<div class="row">
    <div class="col-md-6 col-sm-12 margin-bookservice">
      <input type="text" class="form-control" placeholder="First Name" required>
    </div>
    <div class="col-md-6 col-sm-12 margin-bookservice">
      <input type="email" class="form-control" placeholder="Email" required>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-sm-12 margin-bookservice">
      <input type="tel" class="form-control" placeholder="Phone" required>
    </div>
    <div class="col-md-6 col-sm-12 margin-bookservice">
    <select id="inputState" class="form-control">
        <option selected>Choose Brand</option>
        <option>Hyundai</option>
        <option>Toyota</option>
        <option>Ford</option>
        <option>ACR</option>
    </select>
    </div>
  </div>

  <div class="form-group margin-bookservice">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
      I agree to the <a href="privacy-policy.php"> Privacy Policy. </a>
      </label>
    </div>
  </div>

  <button type="submit" class="btn btn-primary bookservice-button">Submit</button>


</form>
</div>

</div>
</section>





<?php
include('footer.php'); 

?>