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
</div>
@endsection
@push('scripts')
@include('front/user/user_index_js')
@endpush
