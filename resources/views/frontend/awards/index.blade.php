@extends('frontend.layout.header')
@section('css')
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
@endsection
@section('content')
<section id="contact-us">
    <div class="contact-banner">
        @if(isset($banner) && $banner)
            <img src="{{url('public/uploads/award_banner/'.$banner->banner_image)}}" alt="">
        @endif
    </div>
</section>

<div class="container">
    <h2 style="color:{{$banner->award_title_font_color}}; font-size: {{$banner->award_title_font_size}}; font-family: {{$banner->award_title_font_family}};">{{isset($banner->award_title) && $banner->award_title ? strtoupper($banner->award_title) : ''}}</h2>
    <div id="myBtnContainer">
        <button class="btn active" onclick="filterSelection('all')"> Show all</button>
        @foreach($awards_data as $award)
            <button class="btn" onclick="filterSelection('{{$award->business_id}}')"> {{isset($award->businessdDetail->title) && $award->businessdDetail->title ? $award->businessdDetail->title : ''}}</button>
        @endforeach
    </div>

    <!-- Portfolio Gallery Grid -->
    <div class="row">
        @foreach($awards as $award)
            <div class="columnn {{$award->business_id}}">
                <div class="content">
                @if(isset($award->image) && $award->image)
                  <img src="{{url('public/uploads/award/'.$award->image)}}" alt="" style="width:100%">
                  <h4>{{isset($award->businessdDetail->title) && $award->businessdDetail->title ? $award->businessdDetail->title : ''}}</h4>
                @endif
                <p></p>
                </div>
            </div>
        @endforeach
    </div> 
</div>
@endsection
@section('javascript')
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
@endsection