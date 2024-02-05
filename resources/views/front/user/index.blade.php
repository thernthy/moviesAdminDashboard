@extends('front.layout')
@push('styles') 
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush
@section('content')
<div class="container-fuild" id="relative_page">
    <div class="row">
    </div>
    <div class="row">
        <div class="col-sm-3 user-tools">
            <ul>
                <li><i class="fa-solid fa-circle-chevron-left"></i></li>
                <li><a href="#">user_menu</a></li>
                <li><a href="#">user_menu</a></li>
                <li><a href="#">user_menu</a></li>
                <li><a href="#">user_menu</a></li>
                <li><a href="#">user_menu</a></li>
            </ul>
        </div>
        <div class="col-sm-9">
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
    <script>
    </script>
@endpush
