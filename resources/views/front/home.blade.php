@extends('front.layout')
@push('styles') 
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
<style>
    body {
        scroll-behavior: smooth;
    }

    .empty-state__content .empty-state__icon{
        background-color: transparent;
        box-shadow: -1px 3px 0px 0px #e83a3069;
    }
    .empty-state__title, .empty-state__subtitle {
        color: #83757547;
    }
    button.btn.save{
        background:purple;
    }
    button.btn.active{
        background:green;
    }
</style>
@endpush
@section('content')
    <div class="slider_wrap">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="{{ asset('img/001 (2).png') }}" class="d-block w-100">
                </div>
                <div class="item">
                <img src="{{ asset('img/001 (2).png') }}" class="d-block w-100" alt="...">
                </div>
                <div class="item">
                <img src="{{ asset('img/001 (3).png') }}" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="container" style="padding: 0;">
        @foreach($data['sponsor_banner'] as $item)
        <a href="">
            <img src="{{ asset($item->banner_path)}}" alt="" width="100%">
        </a>
        @endforeach
    </div>

<!-- ===============section one ========= Latest/Papular -->
@if($data['0']=='')
@foreach($data['category'] as $category => $movies)
<section>
    <div class="container-fuild category">
        <h3 style="text-transform: capitalize;">
            {{
            ($category == 'Popular-movies') ? '인기 있는' :
            (($category == 'K-drama-movies') ? 'K-드라마' :
            (($category == 'TV-Entertainment') ? '예능/오락
' :
            (($category == 'movies') ? '영화 산업' :
            (($category == 'foreign-drama') ? '외국 드라마' :
            (($category == 'Cartoon') ? '만화|애니메이션' :
            'OOP')))))
            }}
            
        </h3>
        <a href="{{ url('video/category', 
                    ($category == 'Popular-movies') ? 'popular' :
                    (($category == 'K-drama-movies') ? 'K-drama' :
                    (($category == 'TV-Entertainment') ? 'entertain' :
                    (($category == 'movies') ? 'movies' :
                    (($category == 'foreign-drama') ? 'foreign-drama' :
                    (($category == 'Cartoon') ? 'cartoon' :
                    'OOP'
                    )))))) }}">
            더보기
        </a>

    </div>
    <div class="swiper mySwiper container-fuild">
        <div class="swiper-wrapper content">
             @foreach($movies as $index => $item)
                <div class="swiper-slide text-left animate-box" onclick="toggleMovieDetails('{{ $category }}', '{{$item->title_id}}')">
                    <img src="{{ asset($item->movei_cover_path)}}" alt="" class="w-100">
                    <!-- <a href="#">New</a> -->
                    <h6>{{ $item->title }}</h6>
                    <!--<div class="swiper-pagination"></div>-->
                </div>
                @php if($index+1 > 16) { break; } @endphp
            @endforeach
        </div>
    </div>
    <div class="container-fuild movei-detail" id="movie-details-{{ $category }}" style="display: none;">
        <div class="row close-btn-wrap">
            <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="detail-wraper">
            <div class="play_btn detail-wraper-{{ $category }}">
                <i class="fa-regular fa-circle-play"></i>
            </div>
            <div class="movei-cotent movei-cotent-{{ $category }}">
                <div class="reaction_icon">
                    <button class="reaction-btn reaction"><i class="fa-solid fa-heart"></i> <b>0</b></button>
                    <button class="reaction-btn"><i class="fa-solid fa-heart"></i><b>100</b></button>
                </div>
                <p class="key-word">
                    <a href="">#key word</a>  <a href="">#key word</a>  <a href="">#key word</a> 
                </p>
                <h2 id="movie-{{$category}}">
                </h2>
                <p class="movie-dscr" id="movie-description-{{ $category}}">
                    <!-- Movie description -->
                </p>
            </div>
        </div>
    </div>
</section>
@endforeach

@else
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
    @endif
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script type="text/javascript">
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
    
    //saving button this saving button will work when the user has login 
    let saveButton = document.createElement('button');
    function toggleMovieDetails(category_id, titleId) {
        var movieDetail = document.getElementById('movie-details-' + category_id);
        var contentBlock = document.querySelector('.movei-cotent-' + category_id)
        movieDetail.style.display = 'block';
        fetchMovieDetails(category_id, titleId);
        saveButton.className = 'btn save';
        saveButton.innerText = 'Save';
        @if(session()->has('admin_name'))
         contentBlock.appendChild(saveButton);
        @endif
    }
    
    // functions for handling fetch api for detail movies
    function fetchMovieDetails(category_id, titleId) {
        @if(session()->has('admin_name'))
         const userId = '{{session()->get("admin_id")}}';
        @endif
        fetch('/movie/details?id=' + titleId)
            .then(response => response.json())
            .then(data => {
                // Update movie detail content with data received from server
                const basImgUrl = "{{asset('')}}"
                var movieTitle = document.getElementById('movie-' + category_id);
                var movieDescription = document.getElementById('movie-description-' + category_id);
                var movieDetailbg = document.getElementById('movie-details-' + category_id);
                var movieDetail = document.querySelector('.detail-wraper-' + category_id);
                if (data.moviesDetail) {
                    movieTitle.innerHTML = data.moviesDetail.title;
                    movieDescription.innerHTML = data.moviesDetail.description;
                    movieDetailbg.style.backgroundImage = `url('${basImgUrl}${data.moviesDetail.movei_cover_path}')`
                    @if(session()->has('admin_name'))
                    if(data.saveMovie)
                    {
                        saveButton.classList.add('active')
                        saveButton.innerText = 'Saved';
                    }else{
                        if(!saveButton.classList.contains('active')){
                            //if user has login this function will work
                            if(userId){
                                saveButton.onclick = function() {
                                    Handlesave(data.moviesDetail.video_id, userId);
                                }
            
                            }
                        }
                    }
                    @endif
                    
                    //when user click on play button the website will derect to:
                    movieDetail.addEventListener('click', function(){
                        window.location.href = '{{ url('/movie') }}/' + data.moviesDetail.name + '/' + data.moviesDetail.episode + '/' + data.moviesDetail.title;
                    });
                }
            })
            .catch(error => console.error('Error fetching movie details:', error));
    }
    
    //function for handling saving movie 
    function Handlesave(video_id, userId){
        const url = `/movie/save?userId=${userId}&video_id=${video_id}`;
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
               if(data.success){
                   saveButton.classList.add('active')
                   saveButton.innerText = 'Saved';
               }
            })
            .catch(error => {
                console.error('Error fetching movie details:', error);
            });
    }
    
    //closing button after showing detain movie blok
    document.addEventListener('DOMContentLoaded', function() {
        var closeButtons = document.querySelectorAll('.close-btn');
        closeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var movieDetail = button.closest('.movei-detail');
                if (movieDetail) {
                    movieDetail.style.display = 'none';
                }
            });
        });
    });


</script>

@endpush
