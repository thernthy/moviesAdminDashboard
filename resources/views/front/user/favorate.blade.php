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
    .card {
        width: calc(20% - 10px);
    }
    .wrap{
        padding-left:0;
    }
</style>
@endpush
@section('content')
<div class="container-fuild" id="relative_page">
@include('front/user/user_fix_component')
<div class="row">
        <div class="user-page-body-wraper">
            <div class="container-movie-wrap"> 
                        <div class="card"> 
                            <a href="{{ url('video/category/categoryName/part/movieTile') }}">
                                <div class="img">
                                    <img src="{{asset('img/movei/mv (1).jpg') }}" alt="Placeholder Image"> 
                                </div>
                                <h4 class="card-title">영화 제목</h4> 
                            </a>
                        </div> 
                        <div class="card"> 
                            <a href="">
                                <div class="img">
                                    <img src="{{asset('img/movei/mv (1).jpg') }}" alt="Placeholder Image"> 
                                </div>
                                <h4 class="card-title">영화 제목</h4> 
                            </a>
                        </div> 
                        <div class="card"> 
                            <a href="">
                                <div class="img">
                                    <img src="{{asset('img/movei/mv (1).jpg') }}" alt="Placeholder Image"> 
                                </div>
                                <h4 class="card-title">영화 제목</h4> 
                            </a>
                        </div> 
                        <div class="card"> 
                            <a href="">
                                <div class="img">
                                    <img src="{{asset('img/movei/mv (1).jpg') }}" alt="Placeholder Image"> 
                                </div>
                                <h4 class="card-title">영화 제목</h4> 
                            </a>
                        </div> 
                        <div class="card"> 
                            <a href="">
                                <div class="img">
                                    <img src="{{asset('img/movei/mv (1).jpg') }}" alt="Placeholder Image"> 
                                </div>
                                <h4 class="card-title">영화 제목</h4> 
                            </a>
                        </div> 
                        <div class="card"> 
                            <a href="">
                                <div class="img">
                                    <img src="{{asset('img/movei/mv (1).jpg') }}" alt="Placeholder Image"> 
                                </div>
                                <h4 class="card-title">영화 제목</h4> 
                            </a>
                        </div> 
                        <div class="card"> 
                            <a href="">
                                <div class="img">
                                    <img src="{{asset('img/movei/mv (1).jpg') }}" alt="Placeholder Image"> 
                                </div>
                                <h4 class="card-title">영화 제목</h4> 
                            </a>
                        </div> 
            </div>
        </div>
    </div>  

</div>
@endsection
@push('scripts')
@include('front/user/user_index_js')
@endpush
