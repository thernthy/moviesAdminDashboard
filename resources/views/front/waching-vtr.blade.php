@extends('front.layout')

@push('styles') 
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/relativepage.css') }}">
<style>
        #nav {
                background-color: #1D1D1D !important; 
                transition: all .5s;
        }
        .dropdow-wraper.wrap{
            background-color: #1D1D1D !important;
    }
        
</style>
@endpush
@section('content')
<div class="container-fluid" id="relative_page">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title_page">최신/인기 {{$data['accessPoint']->$CategoryName}}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <iframe width="100%" height="315" src="https://youtu.be/--S3rccz9X0?si=hjiYJlvlUyGXz6HP" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen> 
                </iframe>
                <div class="row movie-info-wraper">
                   <div>
                    <h4 class="text-left">
                        이전 영상 보기
                    </h4>
                   </div>
                   <div>
                    <h4 class="text-right">
                        조회수 : 60,518
                    </h4>
                   </div>
                </div>
                <div class="row movei-apersot">
                    <ul>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                        <li class="movei-upersot-item"><a href="#">1Ep</a></li>
                    </ul>
                </div>
                <div class="row movei-cover-wraper">
                    <div class="col-sm-3">
                        <img src="{{asset('img/movei/mv (4).jpg')}}" alt="w-100" class="w-100">
                    </div>
                    <div class="col-sm-9 text-left">
                        <h6>
                            콜롬비아 메데인을 떠나 마이애미 마약 제국의 '대모'로 우뚝 선 그녀. 그리셀다 블랑코의 여정을 다룬 실화 바탕의 픽션 드라마. 
                        </h6>
                        <h6>
                            <b>출연:<b> <span>소피아 베르가라,알베르토 게라,크리스티안 타판</span> <br>
                            <b>감독:<b> <span>소피아 베르가라,알베르토 게라,크리스티안 타판</span> 
                        </h6>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="video-option-wraper">
                        <button class="opitonBnt videoPart active">Series (10)</button>
                        <button class="opitonBnt recomeded" >Recommended Videos</button>
                    </div>
                    <div class="card video_part_list">
                        <div class="card-body active">
                            <ul class="list-group">
                                <li class="list-group-item active">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                    <h5>이전 영상 보기</h5>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card recomeded_video">
                        <div class="card-body unactive">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                    <h6>이전 영상 보기</h6>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                    <h6>이전 영상 보기</h6>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                    <h6>이전 영상 보기</h6>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                    <h6>이전 영상 보기</h6>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                    <h6>이전 영상 보기</h6>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                    <h6>이전 영상 보기</h6>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                    <h6>이전 영상 보기</h6>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                    <h6>이전 영상 보기</h6>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                    <h6>이전 영상 보기</h6>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                    <h6>이전 영상 보기</h6>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                    <h6>이전 영상 보기</h6>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                    <h6>이전 영상 보기</h6>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                    <h6>이전 영상 보기</h6>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                    <h6>이전 영상 보기</h6>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                    <h6>이전 영상 보기</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
 <script>
   let optionButtons = document.querySelectorAll('.opitonBnt')
   let recomentVtr = document.querySelector('.recomeded_video .card-body')
   let moviePart = document.querySelector('.video_part_list .card-body')
   let options = ['videoPart', 'recomeded']
   optionButtons.forEach(button => {
        button.addEventListener('click', function() {
            optionButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            if (this.classList.contains(options[0])) {
                    moviePart.classList.replace('unactive', 'active')
                    recomentVtr.classList.replace('active', 'unactive')
            }else if(this.classList.contains(options[1])){
                    recomentVtr.classList.replace('unactive', 'active')
                    moviePart.classList.replace('active', 'unactive')
            }
        });
    });
</script>
    
@endpush
