@extends('front.layout')

@push('styles') 
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<style>
	body{
		overflow: hidden;
	}
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
<div class="container login-wraper" style="height:100vh;">
	<div class="row">
		<div class="login-logo">
			<h1>Login</h1>
		</div>
		<div class="form-wraper">
			<form action="{{ route('postLogin') }}" method="POST">
				@csrf
				<div class="form-control input-ifo">
					@if ( Session::get('message') != '' ) 
                            <span class="focus-input100 text-center text-danger" role="alert"> 
                                <strong>{{ Session::get('message') }}</strong> 
                            </span> 
                    @endif
				</div>
				<div class="form-control input-ifo">
					<label for="user-id">Id</label>
					<input type="text" name="email" id="user-id">
				</div>
				<div class="form-control input-ifo">
					<label for="password">Id</label>
					<input type="password" name="password" id="password">
				</div>
				<div class="form-control input-ifo">
					<div class="checkbox-container">
						<label for="outologin">
							<input type="checkbox" id="outologin">
							<div class="custom-checkbox">
								<span class="checkmark">&#10003;</span>
							</div>
							Auto Login
						</label>
					</div>
				</div>
				<div class="form-control optionbtn">
				   <button>Login</button>
				    <button><a href="#member">Join the membership</a></button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@push('scripts')
@endpush
