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
</style>
@endpush
@section('content')
<div class="container-fuild" id="relative_page">
    <div class="row"><h2 class="title_page">최신/인기</h2></div>
    <div class="container-movie-wrap"> 
        @foreach($data['movies'] as  $item)
            <div class="card"> 
                <a href="{{url('movie', [$item->name, $item->episode, $item->title])}}">
                    <div class="img">
                        <img src="{{asset($item->movei_cover_path) }}" alt="Placeholder Image"> 
                    </div>
                    <h4 class="card-title">영화 제목</h4> 
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
</div>
@endsection

@push('scripts')
    <script>

    </script>
    
@endpush
