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
    @if($data['movies']->isEmpty())
        <div class="empty-state">
            <div class="empty-state__content">
                <div class="empty-state__icon">
                    <lord-icon
                        src="https://cdn.lordicon.com/pcllgpqm.json"
                        trigger="loop"
                        delay="1000"
                        colors="primary:#911710,secondary:#e83a30,tertiary:#f4f19c"
                        style="width:250px;height:250px">
                    </lord-icon>
                </div>
                <h2 class="empty-state__title">No Records Found</h2>
                <p class="empty-state__subtitle"></p>
            </div>
        </div>
    @else
        @php
            $pageTitle = '';
            if ($data['pageTitle'] === "popular") {
                $pageTitle = '최신/인기';
            } elseif ($data['pageTitle'] === 'K-drama') {
                $pageTitle = '한국 드라마';
            } elseif ($data['pageTitle'] === 'entertain') {
                $pageTitle = 'TV/엔터테인먼트';
            } elseif ($data['pageTitle'] === 'movies') {
                $pageTitle = '영화';
            } elseif ($data['pageTitle'] === 'foreign drama') {
                $pageTitle = '외국 드라마';
            } elseif ($data['pageTitle'] === 'cartoon') {
                $pageTitle = '만화 영화';
            }
        @endphp
    <div class="row"><h2 class="title_page">{{ $pageTitle }}</h2></div>
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
    <div style="
    width:50%;
    margin:auto;
    display:flex;
    align-items:center;
    justify-content:center;
    ">
        {{$data['movies']->links()}}
    </div>
    @endif
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
