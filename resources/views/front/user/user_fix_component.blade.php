<div class="row">
        <div class="user-page-body-wraper">
                <div class="user-cover-pic" 
                    style="background-image:url('{{asset('img/movei/mv (1).jpg')}}')">
                    <input type="file" name="user-cover" id="cover_picker" hidden>
                </div>
             <div class="user-profile-pic">
                <div class="profile-wraper" 
                    style="background-image:url('{{asset('img/movei/mv (1).jpg')}}')"></div>
                    <h2>user name</h2>
             </div>
        </div>      
    </div>
    <div class="user-tools">
        <ul>
                <li><i id="backButton" class="fa-solid fa-circle-chevron-left"></i>
                </li>
                <li class="{{(request()->route()->named('user.dashboard'))? 'active' : ''}}">
                    <a href="{{url('user', session()->get('admin_name'))}}"><i class="fa-regular fa-address-card"></i>About You</a>
                </li>
                
                <li class="{{(request()->route()->named('user.history'))? 'active' : ''}}">
                    <a href="{{ route('user.history', ['username' => session()->get('admin_name')]) }}">
                    <i class="fa-solid fa-clock-rotate-left"></i>History
                    </a>
                </li>
                <li><a href="#"><i class="fa-regular fa-clock"></i>Watch Later</a></li>
                <li class="{{(request()->route()->named('user.favorite'))? 'active' : ''}}">
                    <a href="{{ route('user.favorite', ['username' => session()->get('admin_name')]) }}">
                    <i class="fa-regular fa-heart"></i>Favorite</a>
                </li>
                <li class="bt-logout">
                    <a href="#">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        Logout
                    </a>
                </li>
        </ul>
    </div>
 