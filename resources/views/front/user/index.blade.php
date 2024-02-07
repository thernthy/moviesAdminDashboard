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
    .user-info-form-wraper{
        width: 60%;
        margin: 0 auto;
    }
</style>
@endpush
@section('content')
<div class="container-fuild" id="relative_page">
    @include('front/user/user_fix_component')
    <div class="row">
        <div class="user-page-body-wraper">
                <div class="user-info-form-wraper">
                    <div class="edite-btn" onclick="HanddleuserEditContainer()">
                       <i class="fa-solid fa-pen-to-square editeicon"></i>
                    </div>
                    <div class="form">
                        <div class="form-control">
                            <h5 class="active"><i class="fa-regular fa-address-book"></i>Mr. Thern thy</h5>
                            <input type="text" name="user-name" id="user-name">
                            <div class="tool-btn-wraper">
                                <button class="cofirm-btn"> <i class="fa-solid fa-check"></i> </button> 
                                <button class="cancel-btn"><i class="fa-solid fa-xmark"></i></button> 
                            </div>
                        </div>
                        <div class="form-control">
                            <h5 class="active"><i class="fa-solid fa-envelope-circle-check"></i>Thernthy2003@gmail.com</h5>
                            <input type="email" name="user-email" id="user-email"> 
                            <div class="tool-btn-wraper">
                                <button class="cofirm-btn"> <i class="fa-solid fa-check"></i> </button> 
                                <button class="cancel-btn"><i class="fa-solid fa-xmark"></i></button> 
                            </div>
                        </div>
                        <div class="form-control">
                            <h5 class="active"><i class="fa-solid fa-image"></i>Profile Image</h5>
                            <input type="file" name="user-profile" id="user-profile" accept=".png, .jpg, .jpeg">
                            <div class="tool-btn-wraper">
                                <button class="cofirm-btn"> <i class="fa-solid fa-check"></i> </button> 
                                <button class="cancel-btn"><i class="fa-solid fa-xmark"></i></button> 
                            </div>
                        </div>
                        <div class="form-control">
                            <h5 class="active"><i class="fa-solid fa-building-lock"></i>........................</h5>
                            <input type="password" class="password" name="user-password" id="password" placeholder="Curren Password"> 
                            <div class="tool-btn-wraper">
                                <button class="cofirm-btn"> <i class="fa-regular fa-eye-slash password_icon"  onclick="showingPass()"></i></button> 
                                <button class="cancel-btn"><i class="fa-solid fa-xmark"></i></button> 
                            </div>
                        </div>
                        <div class="form-control">
                            <h5 class="active"><i class="fa-solid fa-check-double"></i>........................</h5>
                            <input type="password" name="user-confirm-pass" id="user-confirm-pass" placeholder="Comfirm Password"> 
                            <div class="tool-btn-wraper">
                                <button class="cofirm-btn"> <i class="fa-solid fa-check"></i> </button> 
                                <button class="cancel-btn"><i class="fa-solid fa-xmark"></i></button> 
                            </div>
                        </div>
                        <div onclick="HandleSubmition()"
                          style="
                            float: right;
                            padding: 10px;
                            background: #fff;
                            border-radius: 5px;
                            cursor: pointer;
                            color: green;
                            ">
                          <i class="fa-solid fa-road-circle-check"></i> <b>Save</b>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@include('front/user/user_index_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let allInput =  document.querySelectorAll('.form-control > input')
    let h5 =  document.querySelectorAll('.form-control > h5')
    let allBtnwraper = document.querySelectorAll('.tool-btn-wraper')
    let functionIcon  = document.querySelector('.editeicon')
 function HanddleuserEditContainer(){
        if(functionIcon.classList.contains('fa-pen-to-square')){
            functionIcon.classList.replace('fa-pen-to-square', 'fa-xmark')
            for(let i = 0; i<h5.length; i++){
                h5[i].classList.replace('active', 'unactive')
            }
            for(let i = 0; i<allBtnwraper.length; i++){
                allBtnwraper[i].classList.add('active')
            }
            for(let i = 0; i<allInput.length; i++){
                allInput[i].classList.add('active')
            }
        }else{
            functionIcon.classList.replace('fa-xmark', 'fa-pen-to-square')
            for(let i = 0; i<h5.length; i++){
                h5[i].classList.replace('unactive', 'active')
            }

            for(let i = 0; i<allBtnwraper.length; i++){
                allBtnwraper[i].classList.remove('active')
            }
            for(let i = 0; i<allInput.length; i++){
                allInput[i].classList.remove('active')
            }
        }
    }
    const cancelButtons = document.querySelectorAll('.cancel-btn');
        cancelButtons.forEach(cancelButton => {
        cancelButton.addEventListener('click', function() {
            const formControl = cancelButton.closest('.form-control');
            const input = formControl.querySelector('input');
            input.value = '';
        });
    });
  function showingPass(){
    let passwordhandling =  document.querySelector('.password')
		passwordhandling.type = passwordhandling.type === "password" ? "text" : "password";
    if(document.querySelector('.password_icon').classList.contains('fa-eye-slash')){
        document.querySelector('.password_icon').classList.replace('fa-eye-slash', 'fa-eye')
    }else{
        document.querySelector('.password_icon').classList.replace('fa-eye', 'fa-eye-slash')
    }
  }

  function HandleSubmition() {
        var userNameValue = document.getElementById("user-name").value;
        var userEmailValue = document.getElementById("user-email").value;
        var userProfileValue = document.getElementById("user-profile").value;
        var userPasswordValue = document.getElementById("password").value;
        var userConfirmPassValue = document.getElementById("user-confirm-pass").value;
        if (userNameValue !== '' && userEmailValue !== '' && userProfileValue !== '' && userPasswordValue !== '' && userConfirmPassValue !== '') {
        (userPasswordValue === userConfirmPassValue) ? postingSubmit() : alert('Passwords do not match');
        } else {
            (userNameValue === '') ? alert('Please enter username') :
            (userEmailValue === '') ? alert('Please enter email') :
            (userProfileValue === '') ? alert('Please select a profile picture') :
            (userPasswordValue === '') ? alert('Please enter password') :
            (userConfirmPassValue === '') ? alert('Please enter confirm password') : null;
        }
        function postingSubmit() {
                var formData = new FormData();
                formData.append('user-name', userNameValue);
                formData.append('email', userEmailValue);
                formData.append('profile', userProfileValue);
                formData.append('userpassword', userPasswordValue);
                $.ajax({
                    url: "{{ route('user.requstEdite', ['username' => session()->get('admin_name')]) }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        updateUserInterFaceHandle(response.data)
                        (response.success!='')?
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.success,
                            })
                            functionIcon.classList.replace('fa-xmark', 'fa-pen-to-square')
                            for(let i = 0; i<h5.length; i++){
                                h5[i].classList.replace('unactive', 'active')
                            }

                            for(let i = 0; i<allBtnwraper.length; i++){
                                allBtnwraper[i].classList.remove('active')
                            }
                            for(let i = 0; i<allInput.length; i++){
                                allInput[i].classList.remove('active')
                            }
                        :
                        (response.errors!='')?
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.errors,
                        })
                        :Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while submitting the form.',
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        function updateUserInterFaceHandle(userData){
            const userIfon = userData.userInfo;
            console.log(userIfon.name)
        }

  }



</script>
@endpush
