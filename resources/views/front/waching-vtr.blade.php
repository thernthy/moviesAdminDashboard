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
        .title_page {
            margin-bottom: 20px; /* Add margin to the bottom of the title */
        }
        .list-group{
            background:red;
            width:100%;
            height:60vh;
        }
</style>
@endpush
@section('content')
<div class="container-fluid" id="relative_page">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title_page">최신/인기 {{$data['accessPoint']->$CategoryName}}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <!-- Left Column Content -->
                <iframe width="100%" height="315" src="https://youtu.be/--S3rccz9X0?si=hjiYJlvlUyGXz6HP" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-md-4">
                <!-- Right Column Content -->
                <div class="card" style="height:100vh;">
                    <div class="card-body">
                        <h5 class="card-title">Related Videos</h5>
                        <!-- Example related videos -->
                        <ul class="list-group">
                            <li class="list-group-item">Related Video 1</li>
                            <li class="list-group-item">Related Video 2</li>
                            <li class="list-group-item">Related Video 3</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush
