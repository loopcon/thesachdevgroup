@extends('frontend.layout.header')
@section('content')
<section id="privacy">
   <div class="privacy-heading">
       <h2>{{$site_title}}</h2>
   </div>
</section>

<section id="term-condition">
    <div class="container">
        <div class="term-content">
            {!! $pageInfo->description !!}
        </div>
    </div>
</section>
@endsection