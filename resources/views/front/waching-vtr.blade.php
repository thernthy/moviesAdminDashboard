@extends('front.layout')

@push('styles') 
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<style>
        #nav {
                background-color: #1D1D1D !important; 
                transition: all .5s;
        }
        .dropdow-wraper.wrap{
            background-color: #1D1D1D !important;
        }
        .title_page {
            margin-bottom: 20px; /* Add margin to the bottom of the title */
        }
        .video_part_list .list-group{
            width:100%;
            margin:0 !important;
            height: 60vh;
            overflow-y: auto;
            transition:all 2s;
        }
        .list-group::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #12161F;
        }

        .list-group::-webkit-scrollbar
        {
            width: 6px;
            background-color: #2F3542;
        }


        .list-group::-webkit-scrollbar-thumb
        {
            background-color: #2F3542;
        }
        .card {
            width:100%;
            background:transpearent;
            box-shadow:none;
        }
        .card.video_part_list{

        }
        .video-option-wraper button{
            border:none;
            border-radius:5px 5px 0px 0px;
            padding:10px;
            background:#434343;
            font-size:1.3rem;
            font-weight:500;
            color:#DBDBDB;
        }
        .video-option-wraper button.active{
          background:#A1A1A1A1;
        }
        .list-group-item{
            border:none;
            background-color:transparent;
            transition:all .5s;
            cursor: pointer;
            display:flex;
            align-items:center;
            justify-content:flex-start;
        }
        .list-group-item h5{
            margin-left:10px;
        }
        .list-group-item.active{
            border:none;
            background-color:#838383;
        }
        .video_part_list .list-group-item .video-cover{
            padding:40px 0;
            width: 30%;
            background-size:cover;
            background-position:center;
            background-repeat:no-repeat;
            border-left:1px solid white;
            transform: scale(1);
        }
        .list-group-item:hover{
            background-color:#838383;
        }
        .list-group-item.active:hover{
            background-color:#838383;
        }
        /* this is video recomeded section style */
        .recomeded_video .list-group {
            margin: 0 auto; 
            display: flex; 
            flex-wrap: wrap; 
            justify-content: space-between;
            gap: 20px 0; 
        }
        .recomeded_video  .list-group-item{
            width: calc(33.33% - 5px); /* 7 cards per row */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            overflow: hidden; 
            border: 0;
            border-radius: 0;
            background-color: transparent;
        }
        .recomeded_video  .list-group-item .video-cover{
          width:100%;
          height:250px;
          background-size:cover;
          background-position:center;
          background-repeat:no-repeat;
          transform: scale(1.5);
        }
        .recomeded_video .card-body.active {
            opacity: 0; 
            animation: loadingPage 1s forwards;
        }

        .video_part_list .card-body.active {
            opacity: 0; 
            animation: loadingPage 1s forwards; 
        }
        .recomeded_video .card-body.unactive{
            display: none;
        }
        .video_part_list .card-body.unactive{
            display: none;
        }

        @keyframes loadingPage {
            0%{
                opacity: 0;
            }
            50%{
                opacity: .6;
            }
            100%{
                opacity: 1;
            }
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
                                <li class="list-group-item">
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
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
                                </li>
                                <li class="list-group-item ">
                                    <div class="video-cover" style="background-image:url('{{asset('img/movei/mv (4).jpg')}}');"></div>
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
