@extends('frontend.layout.header')
@section('content')
<section id="faq-section">
  <div class="container">
    @if(isset($faq_title) && $faq_title)
      <h2 style="color:{{$faq_title->title_color}}; font-size:{{$faq_title->title_font_size}}; font-family:{{$faq_title->title_font_family}};">{{isset($faq_title->title) && $faq_title->title ? $faq_title->title : ''}}</h2>
    @endif
      @foreach($faqs as $faq)
        <div class="accordion">
          <div class="accordion-item">
            <button id="accordion-button-1" aria-expanded="false">
              <span class="accordion-title">{{$faq->name}}</span>
              <span class="icon" aria-hidden="true"></span>
            </button>
            <div class="accordion-content">
              <p>{!! $faq->description !!}</p>
            </div>
          </div>
        </div>
      @endforeach
  </div>
</section>

@endsection
@section('javascript')
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
@endsection