<?php include('header.php'); ?>
<!--<section id="contact-us">-->
<!--    <div class="contact-banner">-->
<!--            <img src="assets/image/c-v-cf.jpg" alt="">-->
<!--    </div>-->
<!--</section>-->



<section id="faq-section">
<div class="container">
      <h2>Frequently Asked Questions</h2>
      <div class="accordion">
        <div class="accordion-item">
          <button id="accordion-button-1" aria-expanded="false">
            <span class="accordion-title">What services does The Sachdev Group offer?</span>
            <span class="icon" aria-hidden="true"></span>
          </button>
          <div class="accordion-content">
            <p>
            The Sachdev Group has been meeting the automotive needs of customers by offering new cars,  used cars, car maintenance services, etc. The group is committed to providing a hassle-free experience to their customers.
            </p>
          </div>
        </div>
        <div class="accordion-item">
          <button id="accordion-button-2" aria-expanded="false">
            <span class="accordion-title">With which automobile brands does The Sachdev Group have partnerships?</span>
            <span class="icon" aria-hidden="true"></span>
          </button>
          <div class="accordion-content">
            <p>
            We are the authorized dealers of Toyota and Hyundai. We offer new cars as well as maintenance services for them at our facilities.
            </p>
          </div>
        </div>
        <div class="accordion-item">
          <button id="accordion-button-3" aria-expanded="false">
            <span class="accordion-title">Where is The Sachdev Group located?
</span>
            <span class="icon" aria-hidden="true"></span>
          </button>
          <div class="accordion-content">
            <p>
            We cater to customers across various locations in Delhi NCR.

            </p>
          </div>
        </div>
        <div class="accordion-item">
          <button id="accordion-button-4" aria-expanded="false">
            <span class="accordion-title">How can I join your team?</span>
            <span class="icon" aria-hidden="true"></span>
          </button>
          <div class="accordion-content">
            <p>
            We're always looking for talented individuals to join our team. Check out our Careers page for current job openings and information on how to apply.

            </p>
          </div>
        </div>
        <div class="accordion-item">
          <button id="accordion-button-5" aria-expanded="false">
            <span class="accordion-title">How can I stay updated with The Sachdev Group's latest news? </span>
            <span class="icon" aria-hidden="true"></span>
          </button>
          <div class="accordion-content">
            <p>
            Stay informed about our latest news, updates, and announcements by visiting our website, and by following us on social media.
            </p>
          </div>
        </div>

        <div class="accordion-item">
          <button id="accordion-button-5" aria-expanded="false">
            <span class="accordion-title">Does The Sachdev Group offer customer support?</span>
            <span class="icon" aria-hidden="true"></span>
          </button>
          <div class="accordion-content">
            <p>
            Absolutely! We provide dedicated customer support. If you have any questions, feel free to contact us.

            </p>
          </div>
        </div>

        <div class="accordion-item">
          <button id="accordion-button-5" aria-expanded="false">
            <span class="accordion-title">Does The Sachdev Group support community initiatives? 
 </span>
            <span class="icon" aria-hidden="true"></span>
          </button>
          <div class="accordion-content">
            <p>
            Yes, we are dedicated to giving back to our community. Discover more about our CSR and philanthropic efforts on our website.
            </p>
          </div>
        </div>

        <div class="accordion-item">
          <button id="accordion-button-5" aria-expanded="false">
            <span class="accordion-title">How do you ensure quality in your products/services?  </span>
            <span class="icon" aria-hidden="true"></span>
          </button>
          <div class="accordion-content">
            <p>
            We maintain a rigorous quality control process to ensure our products/services meet customer expectations.
            </p>
          </div>
        </div>




      </div>
    </div>



</section>






<?php
include('footer.php'); 
?>

<script>
    const items = document.querySelectorAll('.accordion button');

function toggleAccordion() {
  const itemToggle = this.getAttribute('aria-expanded');

  for (i = 0; i < items.length; i++) {
    items[i].setAttribute('aria-expanded', 'false');
  }

  if (itemToggle == 'false') {
    this.setAttribute('aria-expanded', 'true');
  }
}

items.forEach((item) => item.addEventListener('click', toggleAccordion));




</script>