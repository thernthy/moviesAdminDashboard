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
                <div class="user-info-form-wraper">
                    <div class="edite-btn" onclick="HanddleuserEditContainer()">
                       <i class="fa-solid fa-pen-to-square editeicon"></i>
                    </div>
                    <div class="form">
                        <div class="form-control">
                            <h5 class="active"><i class="fa-regular fa-address-book"></i><span class="user_name">{{$session->get('admin_name')}}</span></h5>
                            <input type="text" name="user-name" id="user-name" value="{{$session->get('admin_name')}}">
                            <div class="tool-btn-wraper">
                                <button class="cofirm-btn" onclick="updateName({{$session->get('admin_id')}})"> <i class="fa-solid fa-check"></i> </button> 
                                <button class="cancel-btn"><i class="fa-solid fa-xmark"></i></button> 
                            </div>
                        </div>
                        <div class="form-control">
                            <h5 class="active"><i class="fa-solid fa-envelope-circle-check"></i><span class="user_email">{{$session->get('admin_email')}}</span></h5>
                            <input type="email" name="user-email" id="user-email" value="{{$session->get('admin_email')}}" > 
                            <div class="tool-btn-wraper">
                                <button class="cofirm-btn" onclick="UpdateEmail({{$session->get('admin_id')}})"> <i class="fa-solid fa-check"></i> </button> 
                                <button class="cancel-btn"><i class="fa-solid fa-xmark"></i></button> 
                            </div>
                        </div>
                        <div class="form-control">
                            <h5 class="active"><i class="fa-solid fa-image"></i>Profile Image</h5>
                            <input type="file" name="profile" id="user-profile" accept=".png, .jpg, .jpeg">
                            <div class="tool-btn-wraper">
                                <button class="cofirm-btn" onclick="UpdateProfile({{$session->get('admin_id')}})"> <i class="fa-solid fa-check"></i> </button> 
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
                            <input type="password" name="new_pass" id="new_pass" placeholder="New password"> 
                            <div class="tool-btn-wraper">
                                <button class="cofirm-btn new-btn" onclick="Updatepass({{$session->get('admin_id')}})"> <i class="fa-solid fa-check"></i> </button> 
                                <button class="cancel-btn"><i class="fa-solid fa-xmark"></i></button> 
                            </div>
                        </div>
                        <div class="form-control">
                            <h5 class="active"><i class="fa-solid fa-check-double"></i>........................</h5>
                            <input type="password" onkeyup="confirmPassInterface()" name="user-confirm-pass" id="user-confirm-pass" placeholder="Comfirm Password"> 
                            <div class="tool-btn-wraper cofirm">
                                <button class="cofirm-btn  confirm"> <i class="fa-solid fa-xmark"></i> </button> 
                            </div>
                        </div>
                        <div onclick="HandleSubmition({{$session->get('admin_id')}})"
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
function HanddleuserEditContainer(){
     let allInput =  document.querySelectorAll('.form-control > input')
     let h5 =  document.querySelectorAll('.form-control > h5')
     let allBtnwraper = document.querySelectorAll('.tool-btn-wraper')
     let functionIcon  = document.querySelector('.editeicon')
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
    
function confirmPassInterface() {
        var userPasswordValue = document.getElementById("new_pass").value;
        var userConfirmPassValue = document.getElementById("user-confirm-pass").value;
        var comfirmBtn = document.querySelector(".cofirm-btn.confirm > i.fa-solid")
        //(userPasswordValue === userConfirmPassValue)? comfirmBtn.classList.replace('fa-xmark', 'fa-check'):comfirmBtn.classList.replace('fa-check', 'fa-xmark');
}

function showingPass(){
    let passwordhandling =  document.querySelector('.password')
		passwordhandling.type = passwordhandling.type === "password" ? "text" : "password";
    if(document.querySelector('.password_icon').classList.contains('fa-eye-slash')){
        document.querySelector('.password_icon').classList.replace('fa-eye-slash', 'fa-eye')
    }else{
        document.querySelector('.password_icon').classList.replace('fa-eye', 'fa-eye-slash')
    }
  }
  
function HandleSubmition(user_id) {
        var userNameValue = document.getElementById("user-name").value;
        var userEmailValue = document.getElementById("user-email").value;
        var userProfileValue = document.getElementById("user-profile").value;
        var userPasswordValue = document.getElementById("password").value;
        var userConfirmPassValue = document.getElementById("user-confirm-pass").value;
        var newpass = document.getElementById("new_pass").value;
        if (userNameValue !== '' && userEmailValue !== '' && userProfileValue !== '' && userPasswordValue !== '' && userConfirmPassValue !== '') {
         (newpass === userConfirmPassValue) ? postingSubmit(user_id) : alert('Passwords do not match');
        } else {
            (userNameValue === '') ? alert('Please enter username') :
            (userEmailValue === '') ? alert('Please enter email') :
            (userProfileValue === '') ? alert('Please select a profile picture') :
            (userPasswordValue === '') ? alert('Please enter password') :
            (userConfirmPassValue === '') ? alert('Please enter confirm password') : null;
        }
        function postingSubmit(user_id) {
                var formData = new FormData();
                formData.append('user-name', userNameValue);
                formData.append('email', userEmailValue);
                formData.append('profile', userProfileValue);
                formData.append('password', userPasswordValue);
                formData.append('newpass', newpass);
                var url = "{{ route('user.requstEdite', ['username' => session()->get('admin_name'), 'user_id' => ':user_id']) }}",
                url = url.replace(':user_id', user_id);
                $.ajax({
                    url: url,
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
}
function updateName(user_id){
        var userNameValue = document.getElementById("user-name").value;
        var formData = new FormData();
        formData.append('user-name', userNameValue);
        var url = "{{ route('user.requstEdite', ['username' => session()->get('admin_name'), 'user_id' => ':user_id']) }}",
        url = url.replace(':user_id', user_id);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                updateUserInterFaceHandle(response.data);
                (response.Success!='')?
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.Success,
                    })
                :
                (response.Errors!='')?
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: response.Errors,
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

function UpdateEmail(user_id){
        var userEmailValue = document.getElementById("user-email").value;
        var formData = new FormData();
        formData.append('email', userEmailValue);
        var url = "{{ route('user.requstEdite', ['username' => session()->get('admin_name'), 'user_id' => ':user_id']) }}",
        url = url.replace(':user_id', user_id);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                updateUserInterFaceHandle(response.data);
                (response.Success!='')?
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.Success,
                    })
                :
                (response.Errors!='')?
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: response.Errors,
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
function Updatepass(user_id){
        var userPasswordValue = document.getElementById("password").value;
        var userConfirmPassValue = document.getElementById("user-confirm-pass").value;
        var newpass = document.getElementById("new_pass").value;
        var formData = new FormData();
        formData.append('newpass', newpass);
        formData.append('password', userPasswordValue);
            if(newpass===userConfirmPassValue){
                var url = "{{ route('user.requstEdite', ['username' => session()->get('admin_name'), 'user_id' => ':user_id']) }}",
                url = url.replace(':user_id', user_id);
                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response)
                        if(response && response.status === 200){
                                (response.Success!=='')?
                                    (
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success!',
                                            text: response.Success,
                                        }),
                                        updateUserInterFaceHandle(response.data)
                                    )
                                :
                                (response.Errors!=='')?
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: response.Errors,
                                })
                                :Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'An error occurred while submitting the form.',
                                });
                        }
                    },
                    error: function(xhr, status, error) {
                        const errors = JSON.parse(xhr.responseText); // Parse the JSON response
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errors,
                        });
                    }
                });
             }
}
function UpdateProfile(user_id) {
    var userProfileValue = document.getElementById("user-profile").files[0];
    var formData = new FormData();
    formData.append('profile', userProfileValue);
    var url = "{{ route('user.requstEdite', ['username' => session()->get('admin_name'), 'user_id' => ':user_id']) }}";
    url = url.replace(':user_id', user_id);
    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response.requestData);
            updateUserInterFaceHandle(response.data);
            if (response.Success !== '') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.Success,
                });
            } else if (response.Errors !== '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: response.Errors,
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while submitting the form.',
                });
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

function updateUserInterFaceHandle(userData){

            let allInput =  document.querySelectorAll('.form-control > input')
            let h5 =  document.querySelectorAll('.form-control > h5')
            let allBtnwraper = document.querySelectorAll('.tool-btn-wraper')
            let functionIcon  = document.querySelector('.editeicon')
            const userIfon = userData.newUserInfo
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
            var backgrouUrl = `url('{{asset('${userIfon.photo}')}}')`;
            document.querySelector('.user_name').innerHTML = userIfon.name
            document.querySelector('.user_email').innerHTML = userIfon.email
            document.querySelector('.user_name_face').innerHTML = userIfon.name
            document.querySelector('.profile-wraper').style.backgroundImage = backgrouUrl;
  }
       


    

</script>
@endpush
