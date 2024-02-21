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
    @media (min-width:1150px){
    #footer{
        padding-left: 24%;
    }
}
</style>
@endpush
@section('content')
<div class="container-fuild" id="relative_page">
@include('front/user/user_fix_component')
<div class="row">
        <div class="user-page-body-wraper">
            <div class="container-movie-wrap">
                   
                       @foreach($data['favorite_movies'] as $item) 
                        <div class="card"> 
                            <a href="{{url('movie', [$item->name, $item->episode, $item->title])}}">
                                <div class="img">
                                    <img src="{{asset($item->movei_cover_path) }}" alt="Placeholder Image"> 
                                </div>
                                <div style="display:flex; align-items:center; justify-content:space-between;">
                                    <h4 class="card-title">{{$item->title}}</h4> 
                                    <lord-icon src="https://cdn.lordicon.com/xyboiuok.json" trigger="hover" 
                                        style="width: 25px;height: 25px;background: #fff;border-radius: 50%;"
                                        >
                                    </lord-icon>
                                </div>
                            </a>
                        </div> 
                        @endforeach
            </div>
        </div>
    </div>  

</div>
@endsection
@push('scripts')
@include('front/user/user_index_js')
@endpush
