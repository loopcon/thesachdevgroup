<?php  $title="Dearlers and Service Station Gallery And Photos: TSG
"; ?>


<?php

require_once('header.php');

?>

<section id="contact-us">
    <div class="contact-banner">
            <img src="assets/image/gallery-img/Gallery.svg" alt="">
            <!--<div class="contact-text">-->
            <!--<h3>Gallery</h3>-->
            <!--</div>-->
    </div>
</section>

<!-- <p class="heading">Gallery</p> -->
  <!--<div class="gallery-image">-->
  <!--  <div class="img-box">-->
  <!--    <img src="assets/image/gallery-img/photo-24.png" alt="gallery-image" />-->
  <!--  </div>-->
  <!--  <div class="img-box">-->
  <!--    <img src="assets/image/gallery-img/photo-31.png" alt="" />-->
  <!--  </div>-->
  <!--  <div class="img-box">-->
  <!--    <img src="assets/image/gallery-img/photo-34.png" alt="" />-->
  <!--  </div>-->
  <!--  <div class="img-box">-->
  <!--    <img src="assets/image/gallery-img/photo-36.png" alt="" />-->
  <!--  </div>-->
  <!--  <div class="img-box">-->
  <!--    <img src="assets/image/gallery-img/photo-37.png" alt="" />-->
  <!--  </div>-->
  <!--  <div class="img-box">-->
  <!--    <img src="assets/image/gallery-img/photo-38.png" alt="" />-->
  <!--  </div>-->
  <!--  <div class="img-box">-->
  <!--    <img src="assets/image/gallery-img/photo-40.png" alt="" />-->
  <!--  </div>-->
  <!--  <div class="img-box">-->
  <!--    <img src="assets/image/gallery-img/photo-44.png" alt="" />-->
  <!--  </div>-->
  <!--  <div class="img-box">-->
  <!--    <img src="assets/image/gallery-img/photo-45.png" alt="" />-->
  <!--  </div>-->
  
  <!--</div>-->













<div class="container">



 <h2>AWARDS</h2>
<div id="myBtnContainer">
  <button class="btn active" onclick="filterSelection('all')"> Show all</button>
  <button class="btn" onclick="filterSelection('nature')"> Galaxy Toyota</button>
  <button class="btn" onclick="filterSelection('cars')"> Hans Hyundai</button>
  <button class="btn" onclick="filterSelection('people')"> Ford</button>
</div>

<!-- Portfolio Gallery Grid -->
<div class="row">
  <div class="columnn nature">
    <div class="content">
      <img src="assets/image/gallery-img/photo-34.png" alt="Mountains" style="width:100%">
      <h4>Galaxy Toyota </h4>
      <p></p>
    </div>
  </div>
  <div class="columnn nature">
    <div class="content">
      <img src="assets/image/gallery-img/photo-31.png" alt="Mountains" alt="Lights" style="width:100%">
      <h4>Galaxy Toyota</h4>
      <p></p>
    </div>
  </div>
  <div class="columnn nature">
    <div class="content">
      <img src="assets/image/gallery-img/photo-37.png" alt="Mountains" alt="Nature" style="width:100%">
      <h4>Galaxy Toyota</h4>
      <p></p>
    </div>
  </div>

  <div class="columnn cars">
    <div class="content">
      <img src="assets/image/gallery-img/photo-45.png" alt="Car" style="width:100%">
      <h4>Hans Hyundai</h4>
      <p></p>
    </div>
  </div>
  <div class="columnn cars">
    <div class="content">
      <img src="assets/image/gallery-img/photo-44.png" alt="Car" style="width:100%">
      <h4>Hans Hyundai</h4>
      <p></p>
    </div>
  </div>
  <div class="columnn cars">
    <div class="content">
      <img src="assets/image/gallery-img/photo-38.png" alt="Car" style="width:100%">
      <h4>Hans Hyundai</h4>
      <p></p>
    </div>
  </div>

  <div class="columnn people">
    <div class="content">
      <img src="assets/image/gallery-img/photo-40.png" alt="People" style="width:100%">
      <h4>Ford</h4>
      <p></p>
    </div>
  </div>
  <div class="columnn people">
    <div class="content">
      <img src="assets/image/gallery-img/photo-36.png" alt="People" style="width:100%">
      <h4>Ford</h4>
      <p></p>
    </div>
  </div>
  <div class="columnn people">
    <div class="content">
      <img src="assets/image/gallery-img/photo-24.png" alt="People" style="width:100%">
      <h4>Ford</h4>
      <p></p>
    </div>
  </div>
<!-- END GRID -->
</div> 

</div>

<style>
 


.columnn {
  float: left;
  width: 33.33%;
  display: none; /* Hide columns by default */
}
/* Content */
.content {
  background-color: white;
  padding: 10px;
}

/* The "show" class is added to the filtered elements */
.show {
  display: block;
}

/* Style the buttons */
.btn {
  border: none;
  outline: none;
  padding: 12px 16px;
  background-color: white;
  cursor: pointer;
}

/* Add a grey background color on mouse-over */
.btn:hover {
  background-color: #ddd;
}

/* Add a dark background color to the active button */
.btn.active {
  background-color: #666;
   color: white;
}
</style>



<script>
    filterSelection("all") // Execute the function and show all columns
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("columnn");
  if (c == "all") c = "";
  // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

// Show filtered elements
function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

// Hide elements that are not selected
function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>










  
<?php require_once('footer.php'); ?>


<script src="https://thesachdevgroup.com/myown/js/lightbox-plus-jquery.min.js" ></script>