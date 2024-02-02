
    <div class="navbar navbar-custom navbar-inverse navbar-static-top " id="nav">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav nav-justified">
                    <li class="{{request()->is('/')?'menu_active':''}}"><a href="{{url('/')}}">Logo</a></li>
                    <li class="{{ request()->is('video/category/popularity') ? 'menu_active' : '' }}">
                        <a href="{{ url('/video/category/popularity') }}">최신/인기</a>
                    </li>
                    <li class="{{ request()->is('video/category/korea-Drama') ? 'menu_active' : '' }}">
                        <a href="{{ url('/video/category/korea-Drama') }}">한국 드라마</a>
                    </li>
                    <li class="{{ request()->is('video/category/tv') ? 'menu_active' : '' }}">
                        <a href="{{ url('/video/category/tv') }}">TV/엔터테인먼트</a>
                    </li>
                    <li class="{{ request()->is('video/category/movie') ? 'menu_active' : '' }}">
                        <a href="{{ url('/video/category/movie') }}">영화</a>
                    </li>
                    <li class="{{ request()->is('video/category/foreign_drama') ? 'menu_active' : '' }}">
                        <a href="{{ url('/video/category/foreign_drama') }}">외국 드라마</a>
                    </li>
                    <li class="{{ request()->is('video/category/anime_documentary') ? 'menu_active' : '' }}">
                        <a href="{{ url('/video/category/anime_documentary') }}">일본 만화 영화</a>
                    </li>
                    <li class="{{ request()->is('notice/notice_list') ? 'menu_active' : '' }}">
                        <a href="{{ url('notice/notice_list') }}">알아채다</a>
                    </li>
                    <li class="{{ request()->is('/board/board/free_list') ? 'menu_active' : '' }}">
                        <a href="{{ url('/board/board/free_list') }}">판자</a>
                    </li>
                    <li class="{{ request()->is('/board/board/free_list') ? 'menu_active' : '' }}">
                        <a href="{{ url('/board/board/free_list') }}">판자</a>
                    </li>
                    <li>
                        <a href="#">제휴업체<i class="fa-solid fa-circle-chevron-down"></i></a>
                        
                    </li>
                    <li class="{{request()->is('/')?'':''}} search_bar">
                        <i class="fa-solid fa-magnifying-glass" id="search_btn"></i>
                    </li>
                    <li class="{{request()->is('/')?'':''}}"><a href="{{url('/')}}"><img src="{{ asset('img/user_profile.png') }}" alt="" width="50px" height="50px"></a></li>

                    @if(!Auth::user())
                    <!--<li>
                        <a href="{{url('login')}}">Login</a>
                    </li>
                    <li>
                        <a href="{{ url('register')}}">register</a>
                    </li>-->
                    @else
                    <li>
                        <div class="user_profile">
                            <span></span>
                            <img src="{{ asset('img/user_avertar.jpg')}}" alt="">
                        </div>
                    </li>
                    <li>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit">Log Out</button>
                        </form>
                    </li>
                    <li>
                        <a href="{{url('view/cart')}}"
                        style="position: relative;"
                        >
                        <i class="fa-solid fa-cart-arrow-down"
                        style="font-size: 1.5rem;"
                        >
                        </i>
                        <span
                        style="
                        position: absolute; 
                        top:5px; 
                        right:25px; 
                        color:<?php if($totalCartItems!=0){echo'red';}else{echo'green';}?>;
                        "
                        >{{$totalCartItems}}</span>
                    </a>
                    </li>
                    @endif
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container -->
        <div class="search-bar-wrap" id="search-wrap">
            <div class="sh-inpu-wrap">
               <input type="text" placeholder="Seach movie">
               <a href=""><i class="fa-solid fa-magnifying-glass"></i></a>
            </div>
        </div>
    </div>
    <!--/.navbar -->
    @push('scripts')
    <script>
    const searchWraper = document.querySelector('#search-wrap');
    const searchBtn = document.getElementById('search_btn');
    // Toggle active class when search button is clicked
    searchBtn.addEventListener('click', function(){
        searchWraper.classList.toggle('active');
        if (searchWraper.classList.contains('active')) {
            document.body.style.overflow = 'hidden'; // Disable scrolling
        } else {
            document.body.style.overflow = ''; // Enable scrolling
        }
    });

    // Remove active class when clicking outside of the search wrapper
    document.addEventListener('click', function(event) {
        if (!searchWraper.contains(event.target) && event.target !== searchBtn) {
            searchWraper.classList.remove('active');
            document.body.style.overflow = ''; // Enable scrolling
        }
    });
    </script>

    @endpush