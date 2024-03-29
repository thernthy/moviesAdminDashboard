@extends('front.layout')

@push('styles') 
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
<style>
   #nav {
        background-color: #1D1D1D !important; 
        transition: all .5s;
    }
    .dropdow-wraper.wrap{
        background-color: #1D1D1D !important;
    }
    .empty-state__content .empty-state__icon{
        background-color: transparent;
        box-shadow: -1px 3px 0px 0px #e83a3069;
    }
    .empty-state__title, .empty-state__subtitle {
        color: #83757547;
    }
</style>
@endpush
@section('content')
<div class="container-fuild" id="relative_page">
    <div class="row"><h2 class="title_page">{{$data['title']}}</h2></div>
    <div class="container-movie-wrap"> 
        @foreach($data['movies'] as  $item)
            <div class="card"> 
                <a href="{{url('movie', [$item->name, $item->episode, $item->title])}}">
                    <div class="img">
                        <img data-src="{{ asset($item->movei_cover_path)}}" 
                        src="{{asset('loding.gif')}}" 
                        loading="lazy"  alt="{{ $item->title }}" 
                        class="w-100 lazyrate"
                        >
                        
                    </div>
                    <h4 class="card-title">{{$item->title}}</h4> 
                </a>
            </div> 
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
    <script>

    </script>
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.lazyrate.js"></script>
<script>
    $(document).ready(function() {
        // Array to keep track of failed images
        var failedImages = [];
        // Function to load images dynamically
        function loadImages() {
            $('.lazyrate').each(function() {
                var $img = $(this);
                var src = $img.data('src'); // Get data-src attribute value
                var tempImg = new Image(); // Create a temporary image object

                // Check if the image has already failed in previous attempts
                if (!failedImages.includes(src)) {
                    tempImg.onload = function() {
                        $img.attr('src', src); // Set the src attribute once the image is loaded
                    };
                    tempImg.onerror = function() {
                        failedImages.push(src); // Add the failed image to the list
                    };
                    tempImg.src = src; // Start loading the image
                }
            });
        }

        // Load images dynamically on document ready
        loadImages();

        // Retry loading failed images
        var retryInterval = setInterval(function() {
            // Clear the failedImages array before retrying
            failedImages = [];
            loadImages(); // Retry loading failed images
        }, 5000); // Retry every 5 seconds
    });
</script>
@endpush
