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
<form>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>Title</th>

                <th>Url</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
@foreach($data['videos'] as $item)
    @php 
        if($item->movei_cover_path == '') continue;
    @endphp
    <tr>
        <td>{{$item->title}}</td>
        
        <td><a href="{{$item->link}}">{{$item->title}}</a></td>
        <td><button class="btn btn-danger">Delete</button></td>
    </tr>
@endforeach
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</form>
</div>
@endsection
@push('scripts')

@endpush