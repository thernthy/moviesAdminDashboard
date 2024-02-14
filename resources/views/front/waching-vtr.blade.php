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

    @media (min-width:800px){
        .row .col-md-8 > iframe {
            height: 500px;
        }
    } 
    @media (max-width:800px){
        .row .col-md-8 > iframe {
         height: 350px;
        }
    } 
.row.video_view iframe{
    height: 90vh;
}
.row.commend-form  form > textarea{
    width: 100%;
    height: 205px;
    background: black;
    color: gray;
    outline: none;
    border: none;
    border-radius: 10px;
    padding:10px;
}
.row.commend-form form > div{
    width: 100%;
    margin-top:10px;
    display: flex;
    gap:10px;
    align-items:center;
    justify-content:center;
}
.row.commend-form form  div >input{
 width:50%;
 padding: 10px ;
 border-radius: 10px;
 outline:none;
 border:none;
 background:black;
}
.row.commend-form form button{
 margin-top:10px;
 background:blue;
 color:white;
 padding: 14px 10px;
}
.row.user-commend ul > li{
    display: flex;
    padding: 10px 10%;
    align-items:start;
    justify-content:flex-start;
}
.row.user-commend li > .profile{
    height: 50px;
    width: 50px;
    background: gray;
    transform: translate(-5px, 15px);
}
.row.user-commend li > div > h3, p{
    color:#fff;
}
.row.user-commend li > div > p{
    font-weight:200;
}
</style>
@endpush
@section('content')
<div class="container-fluid" id="relative_page">
    <div class="row video_view">
        <iframe width="100%"  class="face" src="{{$data['targetMovie']->link}}"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>
        <div class="row movei-apersot">
            <ul>
                <li class="movei-upersot-item"><a href="#"><i class="fa-regular fa-comment"></i> commend</a></li>
                <li class="movei-upersot-item"><a href="#"><i class="fa-regular fa-eye"></i> {{$data['viewer_count']}} 조회수</a></li>
                <li class="movei-upersot-item"><a href="#"><i class="fa-solid fa-exclamation"></i> Report</a></li>
                <li class="movei-upersot-item"><a href="#"><i class="fa-regular fa-heart"></i> Favorite</a></li>
            </ul>
        </div>
        <div class="row movei-apersot ep">
            <ul>
                <li class="movei-upersot-item ep active"><a href="#">Episode 1</a></li>
                <li class="movei-upersot-item ep"><a href="#">Episode 2</a></li>
                <li class="movei-upersot-item ep"><a href="#">Episode 3</a></li>
                <li class="movei-upersot-item ep"><a href="#">Episode 4</a></li>
            </ul>
        </div>
    </div>
        <div class="row">
            <div class="col-md-8">
                <div class="row movie-info-wraper">
                   <div>

                   </div>
                </div>
                <!-- <div class="row movei-apersot">
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
                </div> -->
                <div class="row movei-cover-wraper">
                    <div class="col-sm-3">
                        <img src="{{asset($data['targetMovie']->movei_cover_path)}}" alt="w-100" class="w-100">
                    </div>
                    <div class="col-sm-9 text-left">
                        <h2 class="title_page">최신/인기 {{$data['targetMovie']->title}}</h2>
                        <h6>
                            {{$data['targetMovie']->description}}
                        </h6>
                        <h6>
                            <b>출연:<b> <span>소피아 베르가라,알베르토 게라,크리스티안 타판</span> <br>
                            <b>감독:<b> <span>소피아 베르가라,알베르토 게라,크리스티안 타판</span> 
                        </h6>

                    </div>
                </div>
                <div class="row user-commend">
                    <ul>
                        <li>
                            <div class="profile"> 
                                <img src="{{ asset('img/user_profile.png') }}" 
                                alt="" width="50px" height="50px"></a>
                            </div>
                           <div>
                            <h3>
                                    user name
                                </h3>
                                <p>
                                    Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc.
                                    In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph.
                                </p>
                           </div>
                        </li>
                    </ul>
                </div>
                <div class="row commend-form pt-5">
                   <h3 style="color:white;">답글 남기기</h3>
                        <form id="commentForm" action="">
                            <textarea name="comment" id="comment" cols="100%" rows="10"></textarea>
                            @if(!session()->has('admin_name'))
                                <div>
                                    <input type="text" id="name" placeholder="Name">
                                    <input type="email" id="email" placeholder="Email">
                                </div>
                            @endif
                            <button id="submitBtn" class="btn">Leave a comment</button>
                        </form>
                   </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="video-option-wraper">
                        <h4>이것도 좋아하실 거예요!</h4>
                    </div>
                    <div class="card recomeded_video">
                        <div class="card-body active">
                            <ul class="list-group">
                                @foreach($data['recommend'] as $item)
                                <li class="list-group-item">
                                    <a href="{{url('movie', [$item->name, $item->episode, $item->title])}}">
                                        <div class="video-cover" style="background-image:url('{{asset($item->movei_cover_path)}}');"></div>
                                        <h6>이전 영상 보기</h6>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-4">
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
            </div> -->
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
    document.getElementById("submitBtn").addEventListener("click", function(event){
        event.preventDefault(); 
        var formData = {
            comment: document.getElementById("comment").value,
            name:"{{session()->get('admin_name')}}"
            @if(!session()->has('admin_name'))
                name: document.getElementById("name").value,
                email: document.getElementById("email").value
            @endif
        };
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/your-post-endpoint', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Success');
            } else {
                console.error('Error:', xhr.responseText);
            }
        };
        xhr.send(JSON.stringify(formData));
    });
</script>
    
@endpush
