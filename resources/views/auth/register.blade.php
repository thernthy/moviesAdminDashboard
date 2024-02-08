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
			<h1>Joine the membership</h1>
		</div>
		<div class="form-wraper">
			<form id="register" onsubmit="submitForm(event)">
				@csrf
				<div class="form-control input-ifo">
					<label for="user-id">Account name</label>
					<input type="text" name="user-name" id="user-name">
				</div>
				<div class="form-control input-ifo">
					<label for="user-id">Email</label>
					<input type="text" name="email" id="user-email">
				</div>
				<div class="form-control input-ifo">
					<label for="password">Password</label>
					<div class="password-input-wraper">
						<input type="password" name="password" id="password">
						<i Onclick="passwordHandle()" class="fa-regular fa-eye-slash passwordhandling"></i>
					</div>
				</div>
				<div class="form-control input-ifo">
					<label for="password">Comnfirm Password</label>
					<div class="password-input-wraper">
						<input type="password" name="r-password" id="r-password">
					</div>
				</div>
				<div class="form-control optionbtn" >
				   <button style="float-right">Join the membership</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	function passwordHandle() {  
		let passInputField = document.getElementById('password');
        let passwordhandling =  document.querySelector('.passwordhandling')
		passInputField.type = passInputField.type === "password" ? "text" : "password";
		if(passwordhandling.classList.contains('fa-eye-slash')){
			passwordhandling.classList.replace('fa-eye-slash','fa-eye')
		}else{
			passwordhandling.classList.replace('fa-eye','fa-eye-slash')
		}
	 }

     function submitForm(event) {
        event.preventDefault();
        var formData = new FormData(document.getElementById("register"));
        var rPassword = document.querySelector('#r-password').value; // Get the value of r-password
        var password = document.querySelector('#password').value; // Get the value of password
        formData.append("_token", "{{ csrf_token() }}");
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "{{ route('registerPost') }}");
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest"); 
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.Success != '') {
                        window.location.href = '/login';
                    }
                    if (response.Error !== '') {
                        alert(response.Error);
                        window.location.href = '/login';    
                    }
                } else {
                    console.error(xhr.responseText);
                }
            }
        };
    
    // Check if the confirmation password matches the password
    if (rPassword !== password) {
        alert('Confirm Password does not match!');
    } else {
        xhr.send(formData);
    }
}


</script>
@endpush
