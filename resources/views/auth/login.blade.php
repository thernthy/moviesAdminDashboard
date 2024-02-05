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
	.container.login-wraper{
		display:flex;
		align-items:center;
		justify-content:center;
	}
	.container.login-wraper .row{
		width: 50%;
	}
	.container.login-wraper .login-logo {
		padding-bottom: 5rem;
	}
	.container.login-wraper .login-logo > h1{
		text-align:center;
		color:#fff;
	}
	.container.login-wraper form > .form-control{
		 display:flex;
		 background:none;
		 height:fit-content;
		 border:none;
	}
	
	.container.login-wraper form > .input-ifo{
		 flex-direction:column;
	}
	.container.login-wraper form .form-control > label{
		 color:#fff;
		 font-weight:500;
	}
	.container.login-wraper form .form-control > input{
		 padding:10px;
		 outline:none;
		 border:0;
		 border-radius:5px;
		 font-weight:700;
	}
    .form-control.optionbtn{
	    flex-direction:row;
		align-items:center;
		justify-content:space-between;
	}
    .form-control.optionbtn > button{
	    width:40%;
		padding: 10px;
		border-radius:6px;
		border:none;
		outline:none;
		color:#fff;
		font-weight:700;
	}
    .form-control.optionbtn > button:first-child{
	    background:#4c1475;
	}
    .form-control.optionbtn > button:last-child{
	    background:#000;
	}
    .form-control.optionbtn > button{
	    width:40%;
		padding: 10px;
		border-radius:6px;
		border:none;
		outline:none;
		color:#fff;
		font-weight:700;
	}
    .form-control.optionbtn > button a{
		color:#fff;
		font-weight:700;
	}

    /* Style for the checkbox container */
    .checkbox-container {
        display: inline-block;
        position: relative;
        cursor: pointer;
        margin-right: 10px; /* Adjust as needed */
    }

    /* Hide the actual checkbox */
    .checkbox-container input[type="checkbox"] {
        display: none;
    }

    /* Style for the custom checkbox */
    .custom-checkbox {
        width: 20px; /* Adjust the size of the checkbox */
        height:20px; /* Adjust the size of the checkbox */
        border-radius: 50%; /* Make it circular */
        background-color: #535353; /* Default background color */
        display: inline-block;
        vertical-align: middle;
		position: relative;
    }

    /* Style for the checkmark icon */
    .checkmark {
        display: none;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white; /* Color of the checkmark */
    }

    /* Style for the label */
    .checkbox-container label {
        vertical-align: middle;
        cursor: pointer;
    }

    /* When the checkbox is checked, change the background color */
    .checkbox-container input[type="checkbox"]:checked + .custom-checkbox {
        background-color: #4C1475;
    }

    /* Show the checkmark icon when the checkbox is checked */
    .checkbox-container input[type="checkbox"]:checked + .custom-checkbox .checkmark {
        display: block;
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
			<form action="">
				<div class="form-control input-ifo">
					<label for="user-id">Id</label>
					<input type="text" name="user-id" id="user-id">
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
