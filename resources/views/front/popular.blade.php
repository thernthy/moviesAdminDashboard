@extends('front.layout')

@push('styles') 
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
@endpush
@section('content')
<div class="container-fuild">
    <div class="row move-category">
        <ul>
            <li>
                <img src="" alt="">
                <h4>Movei title</h4>
            </li>
        </ul>
    </div>
</div>
@endsection

@push('scripts')
   <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 8,
      spaceBetween:5,
      slidesPerGroup: 1,
      loop: true,
      loopFillGroupWithBlank: false,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },

    });
    </script>
    
@endpush
