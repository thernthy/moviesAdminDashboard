@extends('front.layout')
@push('styles') 
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
<style>
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
        <h5 style="text-transform: capitalize;">{{  $category }}</h5>
        <a href="">see more</a>
    </div>
    <div class="swiper mySwiper container-fuild">
        <div class="swiper-wrapper content">
            @foreach($movies as $index => $item)
                <div class="swiper-slide text-left animate-box" onclick="toggleMovieDetails('{{ $category }}_{{ $index }}', '{{$item->title_id}}')">
                    <img src="{{ asset($item->movei_cover_path)}}" alt="" class="w-100">
                    <!-- <a href="#">New</a> -->
                    <h6>{{ $item->title }}</h6>
                    <div class="swiper-pagination"></div>
                </div>
                @php if($index+1 > 8) { break; } @endphp
            @endforeach
        </div>
    </div>
    @foreach($movies as $index => $item)
            <div class="container-fuild movei-detail" id="movie-details-{{ $category }}_{{ $index }}" style="background-image: url('{{ asset('img/movei/mv (1).jpg') }}'); display: none;">
                <div class="row close-btn-wrap">
                    <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="detail-wraper">
                    <div class="play_btn">
                        <i class="fa-regular fa-circle-play"></i>
                    </div>
                    <div class="movei-cotent">
                        <div class="reaction_icon">
                            <button class="reaction-btn reaction"><i class="fa-solid fa-heart"></i> <b>0</b></button>
                            <button class="reaction-btn"><i class="fa-solid fa-heart"></i><b>100</b></button>
                        </div>
                        <p class="key-word">
                            <a href="">#key word</a>  <a href="">#key word</a>  <a href="">#key word</a> 
                        </p>
                        <h2 id="{{$item->title_id}}">
                            Movie Title
                        </h2>
                        <p class="movie-dscr" id="movie-description-{{ $category }}_{{ $index }}">
                            <!-- Movie description -->
                        </p>
                    </div>
                </div>
            </div>
    @endforeach
</section>
@endforeach

<!--
<section>
    <div class="container-fuild category">
        <h3>Latest/Papular</h3>
        <a href="">see more</a>
    </div>
    <div class="swiper mySwiper container-fuild">
      <div class="swiper-wrapper content">
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
					<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                    <a href="#">New</a>
                    <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (3).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <h4>영화 제목</h4>
                        <a href="#">New</a>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
          </div>
        </div>
        <div class="container-fuild movei-detail" style="background-image: url('{{asset('img/movei/mv (1).jpg') }}');">
           <div class="row close-btn-wrap">
               <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
           </div>
            <div class="detail-wraper">
                <div class="play_btn">
                    <i class="fa-regular fa-circle-play"></i>
                </div>
                <div class="movei-cotent">
                    <div class="reaction_icon">
                        <button class="reaction-btn reaction"><i class="fa-solid fa-heart"></i> <b>0</b></button>
                        <button class="reaction-btn"><i class="fa-solid fa-heart"></i><b>100</b></button>
                    </div>
                    <p class="key-word">
                        <a href="">#key word</a>  <a href="">#key word</a>  <a href="">#key word</a> 
                    </p>
                    <h2>
                        Movie Title
                    </h2>
                    <p class="movie-dscr">
                    우당탕탕 패밀리
                    감독 : 김성근
                    출연 : 남상지, 이도겸, 강다빈, 이효나 外
                    제작사 : 몬스터유니온,아센디오 엔터테인먼트
                    30년 전 원수로 헤어진 부부가 자식들 사랑으로 인해 사돈 관계로 다시 만나면서 오래된 갈등과 반목을 씻고 진정한 가족으로 거듭나는 명랑 코믹 가족극
                    </p>
                </div>
            </div>
        </div>
</section>

<section>
    <div class="container-fuild category">
        <h3>Latest/Papular</h3>
        <a href="">see more</a>
    </div>
    <div class="swiper mySwiper container-fuild">
      <div class="swiper-wrapper content">
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
					<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                    <a href="#">New</a>
                    <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (3).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <h4>영화 제목</h4>
                        <a href="#">New</a>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
          </div>
        </div>
        <div class="container-fuild movei-detail" style="background-image: url('{{asset('img/movei/mv (1).jpg') }}');">
           <div class="row close-btn-wrap">
               <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
           </div>
            <div class="detail-wraper">
                <div class="play_btn">
                    <i class="fa-regular fa-circle-play"></i>
                </div>
                <div class="movei-cotent">
                    <div class="reaction_icon">
                        <button class="reaction-btn reaction"><i class="fa-solid fa-heart"></i> <b>0</b></button>
                        <button class="reaction-btn"><i class="fa-solid fa-heart"></i><b>100</b></button>
                    </div>
                    <p class="key-word">
                        <a href="">#key word</a>  <a href="">#key word</a>  <a href="">#key word</a> 
                    </p>
                    <h2>
                        Movie Title
                    </h2>
                    <p class="movie-dscr">
                    우당탕탕 패밀리
                    감독 : 김성근
                    출연 : 남상지, 이도겸, 강다빈, 이효나 外
                    제작사 : 몬스터유니온,아센디오 엔터테인먼트
                    30년 전 원수로 헤어진 부부가 자식들 사랑으로 인해 사돈 관계로 다시 만나면서 오래된 갈등과 반목을 씻고 진정한 가족으로 거듭나는 명랑 코믹 가족극
                    </p>
                </div>
            </div>
        </div>
</section>

<section>
    <div class="container-fuild category">
        <h3>Latest/Papular</h3>
        <a href="">see more</a>
    </div>
    <div class="swiper mySwiper container-fuild">
      <div class="swiper-wrapper content">
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
					<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                    <a href="#">New</a>
                    <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (3).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <h4>영화 제목</h4>
                        <a href="#">New</a>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
          </div>
        </div>
        <div class="container-fuild movei-detail" style="background-image: url('{{asset('img/movei/mv (1).jpg') }}');">
           <div class="row close-btn-wrap">
               <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
           </div>
            <div class="detail-wraper">
                <div class="play_btn">
                    <i class="fa-regular fa-circle-play"></i>
                </div>
                <div class="movei-cotent">
                    <div class="reaction_icon">
                        <button class="reaction-btn reaction"><i class="fa-solid fa-heart"></i> <b>0</b></button>
                        <button class="reaction-btn"><i class="fa-solid fa-heart"></i><b>100</b></button>
                    </div>
                    <p class="key-word">
                        <a href="">#key word</a>  <a href="">#key word</a>  <a href="">#key word</a> 
                    </p>
                    <h2>
                        Movie Title
                    </h2>
                    <p class="movie-dscr">
                    우당탕탕 패밀리
                    감독 : 김성근
                    출연 : 남상지, 이도겸, 강다빈, 이효나 外
                    제작사 : 몬스터유니온,아센디오 엔터테인먼트
                    30년 전 원수로 헤어진 부부가 자식들 사랑으로 인해 사돈 관계로 다시 만나면서 오래된 갈등과 반목을 씻고 진정한 가족으로 거듭나는 명랑 코믹 가족극
                    </p>
                </div>
            </div>
        </div>
</section>

<section>
    <div class="container-fuild category">
        <h3>Latest/Papular</h3>
        <a href="">see more</a>
    </div>
    <div class="swiper mySwiper container-fuild">
      <div class="swiper-wrapper content">
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
					<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                    <a href="#">New</a>
                    <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (3).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <h4>영화 제목</h4>
                        <a href="#">New</a>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
          </div>
        </div>
        <div class="container-fuild movei-detail" style="background-image: url('{{asset('img/movei/mv (1).jpg') }}');">
           <div class="row close-btn-wrap">
               <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
           </div>
            <div class="detail-wraper">
                <div class="play_btn">
                    <i class="fa-regular fa-circle-play"></i>
                </div>
                <div class="movei-cotent">
                    <div class="reaction_icon">
                        <button class="reaction-btn reaction"><i class="fa-solid fa-heart"></i> <b>0</b></button>
                        <button class="reaction-btn"><i class="fa-solid fa-heart"></i><b>100</b></button>
                    </div>
                    <p class="key-word">
                        <a href="">#key word</a>  <a href="">#key word</a>  <a href="">#key word</a> 
                    </p>
                    <h2>
                        Movie Title
                    </h2>
                    <p class="movie-dscr">
                    우당탕탕 패밀리
                    감독 : 김성근
                    출연 : 남상지, 이도겸, 강다빈, 이효나 外
                    제작사 : 몬스터유니온,아센디오 엔터테인먼트
                    30년 전 원수로 헤어진 부부가 자식들 사랑으로 인해 사돈 관계로 다시 만나면서 오래된 갈등과 반목을 씻고 진정한 가족으로 거듭나는 명랑 코믹 가족극
                    </p>
                </div>
            </div>
        </div>
</section>

<section>
    <div class="container-fuild category">
        <h3>Latest/Papular</h3>
        <a href="">see more</a>
    </div>
    <div class="swiper mySwiper container-fuild">
      <div class="swiper-wrapper content">
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
					<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                    <a href="#">New</a>
                    <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (3).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <h4>영화 제목</h4>
                        <a href="#">New</a>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
          </div>
        </div>
        <div class="container-fuild movei-detail" style="background-image: url('{{asset('img/movei/mv (1).jpg') }}');">
           <div class="row close-btn-wrap">
               <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
           </div>
            <div class="detail-wraper">
                <div class="play_btn">
                    <i class="fa-regular fa-circle-play"></i>
                </div>
                <div class="movei-cotent">
                    <div class="reaction_icon">
                        <button class="reaction-btn reaction"><i class="fa-solid fa-heart"></i> <b>0</b></button>
                        <button class="reaction-btn"><i class="fa-solid fa-heart"></i><b>100</b></button>
                    </div>
                    <p class="key-word">
                        <a href="">#key word</a>  <a href="">#key word</a>  <a href="">#key word</a> 
                    </p>
                    <h2>
                        Movie Title
                    </h2>
                    <p class="movie-dscr">
                    우당탕탕 패밀리
                    감독 : 김성근
                    출연 : 남상지, 이도겸, 강다빈, 이효나 外
                    제작사 : 몬스터유니온,아센디오 엔터테인먼트
                    30년 전 원수로 헤어진 부부가 자식들 사랑으로 인해 사돈 관계로 다시 만나면서 오래된 갈등과 반목을 씻고 진정한 가족으로 거듭나는 명랑 코믹 가족극
                    </p>
                </div>
            </div>
        </div>
</section>

<section>
    <div class="container-fuild category">
        <h3>Latest/Papular</h3>
        <a href="">see more</a>
    </div>
    <div class="swiper mySwiper container-fuild">
      <div class="swiper-wrapper content">
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
					<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                    <a href="#">New</a>
                    <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (3).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <h4>영화 제목</h4>
                        <a href="#">New</a>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
                <div class="swiper-slide col-md-4 text-left animate-box">
						<img src="{{asset('img/movei/mv (1).jpg') }}" alt="" class="w-100">
                        <a href="#">New</a>
                        <h4>영화 제목</h4>
				</div>
          </div>
        </div>
        <div class="container-fuild movei-detail" style="background-image: url('{{asset('img/movei/mv (1).jpg') }}');">
           <div class="row close-btn-wrap">
               <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
           </div>
            <div class="detail-wraper">
                <div class="play_btn">
                    <i class="fa-regular fa-circle-play"></i>
                </div>
                <div class="movei-cotent">
                    <div class="reaction_icon">
                        <button class="reaction-btn reaction"><i class="fa-solid fa-heart"></i> <b>0</b></button>
                        <button class="reaction-btn"><i class="fa-solid fa-heart"></i><b>100</b></button>
                    </div>
                    <p class="key-word">
                        <a href="">#key word</a>  <a href="">#key word</a>  <a href="">#key word</a> 
                    </p>
                    <h2>
                        Movie Title
                    </h2>
                    <p class="movie-dscr">
                    우당탕탕 패밀리
                    감독 : 김성근
                    출연 : 남상지, 이도겸, 강다빈, 이효나 外
                    제작사 : 몬스터유니온,아센디오 엔터테인먼트
                    30년 전 원수로 헤어진 부부가 자식들 사랑으로 인해 사돈 관계로 다시 만나면서 오래된 갈등과 반목을 씻고 진정한 가족으로 거듭나는 명랑 코믹 가족극
                    </p>
                </div>
            </div>
        </div>
</section>-->
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
    function updateSwiperWidth() {
        var screenWidth = window.innerWidth;
        if (screenWidth <= 768) { 
        swiper.params.width = 250;
        } else {
        swiper.params.width = null; 
        }
        swiper.update();
    }
    window.onload = updateSwiperWidth;
    window.onresize = updateSwiperWidth;

    function toggleMovieDetails(id, titleId) {
        var movieDetail = document.getElementById('movie-details-' + id);
        if (movieDetail.style.display === 'none') {
            movieDetail.style.display = 'block';
            fetchMovieDetails(id, titleId);
        } else {
            movieDetail.style.display = 'none';
        }
    }
function fetchMovieDetails(id, titleId) {
    fetch('/movie/details?id=' + titleId)
        .then(response => response.json())
        .then(data => {
            // Update movie detail content with data received from server
            var movieTitle = document.getElementById(titleId);
            var movieDescription = document.getElementById('movie-description-' + id);
            var movieDetail = document.getElementById('movie-details-' + id);
            if (data.moviesDetail) {
                movieTitle.innerHTML = data.moviesDetail.title;
                movieDescription.innerHTML = data.moviesDetail.description;
                movieDetail.addEventListener('click', function(){
                    window.location.href = '{{ url('/movie') }}/' + data.moviesDetail.name + '/' + data.moviesDetail.episode + '/' + data.moviesDetail.title;
                });
            }
        })
        .catch(error => console.error('Error fetching movie details:', error));
}


</script>

@endpush
