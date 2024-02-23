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
           @foreach($data['videoSaved'] as $item)
                <a href="{{ url('movie', [$item->name, $item->episode, $item->title]) }}">
                    <div class="video-list-wraper">
                        <div class="video-cover-pic" style="background-image: url('{{ asset($item->movei_cover_path) }}')">
                            
                        </div>
            
                        <div class="video-cover-content">
                            <h4>{{ $item->title }}</h4>
                            <h6>{{ $item->description }}</h6>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>  
</div>
@endsection
@push('scripts')
@include('front/user/user_index_js')
@endpush
