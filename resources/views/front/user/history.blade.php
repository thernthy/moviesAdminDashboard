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

    .container-movie-wrap {
        justify-content: flex-start;
        gap: 10px;
    }
    .wrap{
        padding-left:0;
    } 
    .video-list-wraper{
        display:flex;
        align-items:flex-start;
        justify-content:space-between;
        margin: 15px 0;
    }
    .video-list-wraper > .video-cover-pic{
        padding: 128px 207px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        border-radius: 10px;
    }
    .video-cover-content{
        padding: 10px;
    }
    .video-cover-content h6, h4{
        line-height:2.1;
        color:gray;
    }
    @media (max-width:750px){
        .video-list-wraper > .video-cover-pic{
            padding: 81px 130px;
        }
        .video-list-wraper{
            align-items:center;
        }
    }
    @media (max-width:680px){
        .user-tools{
            transform: translateY(-30%);
        }
        .user-tools > ul {
            justify-content: flex-start;
        }
        .user-tools ul > li{
            width:40%;
            padding:10px 0;
            display: flex;
            align-items:flex-start;
            justify-content:space-between;
        }
    }
</style>
@endpush
@section('content')
<div class="container-fuild" id="relative_page">
 @include('front/user/user_fix_component')
    <div class="row">
        <div class="user-page-body-wraper">
            <div class="video-list-wraper">
                <div class="video-cover-pic"
                    style="background-image:url('{{asset('img/movei/mv (1).jpg') }}')"
                    >
                </div>
                <div class="video-cover-content">
                    <h4>이전 영상 보기</h4>
                    <h6>
                            콜롬비아 메데인을 떠나 마이애미 마약 제국의 '대모'로 우뚝 선 그녀. 그리셀다 블랑코의 여정을 다룬 실화 바탕의 픽션 드라마. 
                    </h6>
                    <h6>
                        <b>출연:<b> <span>소피아 베르가라,알베르토 게라,크리스티안 타판</span> <br>
                        <b>감독:<b> <span>소피아 베르가라,알베르토 게라,크리스티안 타판</span> 
                    </h6>
                </div>
            </div>
            <div class="video-list-wraper">
                <div class="video-cover-pic"
                    style="background-image:url('{{asset('img/movei/mv (1).jpg') }}')"
                    >
                </div>
                <div class="video-cover-content">
                    <h4>이전 영상 보기</h4>
                    <h6>
                            콜롬비아 메데인을 떠나 마이애미 마약 제국의 '대모'로 우뚝 선 그녀. 그리셀다 블랑코의 여정을 다룬 실화 바탕의 픽션 드라마. 
                    </h6>
                    <h6>
                        <b>출연:<b> <span>소피아 베르가라,알베르토 게라,크리스티안 타판</span> <br>
                        <b>감독:<b> <span>소피아 베르가라,알베르토 게라,크리스티안 타판</span> 
                    </h6>
                </div>
            </div>
            <div class="video-list-wraper">
                <div class="video-cover-pic"
                    style="background-image:url('{{asset('img/movei/mv (1).jpg') }}')"
                    >
                </div>
                <div class="video-cover-content">
                    <h4>이전 영상 보기</h4>
                    <h6>
                            콜롬비아 메데인을 떠나 마이애미 마약 제국의 '대모'로 우뚝 선 그녀. 그리셀다 블랑코의 여정을 다룬 실화 바탕의 픽션 드라마. 
                    </h6>
                    <h6>
                        <b>출연:<b> <span>소피아 베르가라,알베르토 게라,크리스티안 타판</span> <br>
                        <b>감독:<b> <span>소피아 베르가라,알베르토 게라,크리스티안 타판</span> 
                    </h6>
                </div>
            </div>
            <div class="video-list-wraper">
                <div class="video-cover-pic"
                    style="background-image:url('{{asset('img/movei/mv (1).jpg') }}')"
                    >
                </div>
                <div class="video-cover-content">
                    <h4>이전 영상 보기</h4>
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
    </div>  
</div>
@endsection
@push('scripts')
@include('front/user/user_index_js')
@endpush
