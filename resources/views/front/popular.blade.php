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
    .empty-state__content .empty-state__icon{
        background-color: transparent;
        box-shadow: -1px 3px 0px 0px #e83a3069;
    }
    .empty-state__title, .empty-state__subtitle {
        color: #83757547;
    }
</style>
@endpush
@section('content')
<div class="container-fuild" id="relative_page">
    @if($data['movies']->isEmpty())
        <div class="empty-state">
            <div class="empty-state__content">
                <div class="empty-state__icon">
                    <lord-icon
                        src="https://cdn.lordicon.com/pcllgpqm.json"
                        trigger="loop"
                        delay="1000"
                        colors="primary:#911710,secondary:#e83a30,tertiary:#f4f19c"
                        style="width:250px;height:250px">
                    </lord-icon>
                </div>
                <h2 class="empty-state__title">No Records Found</h2>
                <p class="empty-state__subtitle"></p>
            </div>
        </div>
    @else
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
    @endif
</div>
@endsection

@push('scripts')
    <script>

    </script>
    
@endpush
