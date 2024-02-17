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
.movei-upersot-item.fav.active{
    background:red;
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
                <li class="movei-upersot-item"><a href="#commentform"><i class="fa-regular fa-comment"></i> commend</a></li>
                <li class="movei-upersot-item"><a href="#"><i class="fa-regular fa-eye"></i> {{$data['viewer_count']}} 조회수</a></li>
                <li class="movei-upersot-item"><a href="#"><i class="fa-solid fa-exclamation"></i>Report</a></li>
                <?php  $video_id = $data['targetMovie']->id; $user_id = session()->get('admin_id')?>
                <li class="movei-upersot-item fav {{($data['favorited']->favorite_id!='')?'active':''}}" Onclick="favoriteHandle({{$video_id}}, {{$user_id}})"><span><i class="fa-regular fa-heart"></i>Favorite</span></li>
            </ul>
        </div>
        <div class="row movei-apersot ep">
            @if($data['targetMovie']->episode!='' || $data['targetMovie']->episode!=0)
            <ul>
                @foreach($data['Movies'] as $item => $index)
                    <li class="movei-upersot-item ep {{($data['targetMovie']->episode == $index->episode)? 'active' : '' }}"><a href="#">Episode {{$index->episode}}</a></li>
                    @php if($index <= 0) break @endphp
                @endforeach
            </ul>
            @endif
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
                        @foreach($data['comments'] as $item)
                        <li>
                            <div class="profile"> 
                                <img src="{{ asset('img/user_profile.png') }}" 
                                alt="" width="50px" height="50px"></a>
                            </div>
                           <div>
                               <h3>
                                  {{$item->user_name}}
                                </h3>
                                <p>
                                  {{$item->comment}}
                                </p>
                           </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="row commend-form pt-5" id="commentform">
                   <h3 style="color:white;">답글 남기기</h3>
                   <form id="commentForm">
                        @csrf
                        <textarea name="comment" id="comment" cols="100%" rows="10"></textarea>
                        @unless(session()->has('admin_name'))
                            <div>
                                <input type="text" id="name" placeholder="Name">
                                <input type="email" id="email" placeholder="Email">
                            </div>
                        @endunless
                        <button id="submitBtn" class="btn">Leave a comment</button>
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
    document.getElementById("commentForm").addEventListener("submit", function(event) {
    event.preventDefault(); 
    var formData = {
        comment: document.getElementById("comment").value,
        videoId: "{{$data['targetMovie']->id}}",
        name: "{{ session()->get('admin_name') }}"
    };
    if (!formData.name) {
        formData.name = document.getElementById("name").value;
        formData.email = document.getElementById("email").value;
    }
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ url("/leavecomment") }}', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById("comment").value = '';
            @unless(session()->has('admin_name'))
            document.getElementById("name").value = '';
            document.getElementById("email").value = '';
            @endunless
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                var commentBox = document.querySelector('.row.user-commend > ul');
                commentBox.innerHTML = '';
                var comments = response.comments.comments;
                var based_Img_url = "{{ asset('') }}";

                comments.forEach(item => {
                    var html = `
                        <li>
                            <div class="profile"> 
                                <img src="${based_Img_url}img/user_profile.png" alt="" width="50px" height="50px">
                            </div>
                            <div>
                                <h3>${item.user_name}</h3>
                                <p>${item.comment}</p>
                            </div>
                        </li>
                    `;
                    commentBox.insertAdjacentHTML('beforeend', html);
                });
            } else {
                console.error('Error:', response.message);
            }
        } else {
            var errorMessage;
            if (xhr.status === 419) {
                var parser = new DOMParser();
                var responseDoc = parser.parseFromString(xhr.responseText, 'text/html');
                errorMessage = responseDoc.querySelector('.message').innerText.trim();
            } else {
                errorMessage = xhr.responseText;
            }
            console.error('Error:', errorMessage);
        }
    };
    xhr.onerror = function() {
        console.error('Network Error');
    };
    xhr.send(JSON.stringify(formData));
});

function favoriteHandle(video_id, user_id) {
    let buttonTartget =  document.querySelector('.movei-upersot-item.fav');
    if(!buttonTartget.classList.contains('active')){
        const url = `/movie/favoriteset?userId=${user_id}&video_id=${video_id}`;
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
                buttonTartget.classList.add('active');
            })
            .then(data => {
                if (data['favorited-set']) {
                    buttonTartget.classList.add('active');
                     //console.log('Movie details:', data['favorited-set']);
                 } else {
                     console.log('No movie details found');
                 }
            })
            .catch(error => {
                console.error('Error fetching movie details:', error);
            });
    }
}



</script>
    
@endpush
