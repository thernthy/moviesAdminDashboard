
    <div class="navbar navbar-custom navbar-inverse navbar-static-top " id="nav">
        <div class="container-fluid wrap navbar-wraper">
            <div class="tools-wrap logo-wrap">
                <ul>
                    <li class="{{request()->is('/')?'menu_active':''}}"><a href="{{url('/')}}">Logo</a></li>    
                </ul>
            </div>
            <div class="navbar-menue-wraper">
                <ul class="nav navbar-nav nav-justified">
                    <li class="{{ request()->is('video/category/popular') ? 'menu_active' : '' }}">
                        <a href="{{ url('/video/category/popular') }}">최신/인기</a>
                    </li>
                    <li class="{{ request()->is('video/category/K-drama') ? 'menu_active' : '' }}">
                        <a href="{{ url('/video/category/K-drama') }}">한국 드라마</a>
                    </li>
                    <li class="{{ request()->is('video/category/entertain') ? 'menu_active' : '' }}">
                        <a href="{{ url('/video/category/entertain') }}">TV/엔터테인먼트</a>
                    </li>
                    <li class="{{ request()->is('video/category/movies') ? 'menu_active' : '' }}">
                        <a href="{{ url('/video/category/movies') }}">영화</a>
                    </li>
                    <li class="{{ request()->is('video/category/foreign drama') ? 'menu_active' : '' }}">
                        <a href="{{ url('/video/category/foreign drama') }}">외국 드라마</a>
                    </li>
                    <li class="{{ request()->is('video/category/Japanes cartoon') ? 'menu_active' : '' }}">
                        <a href="{{ url('/video/category/Japanes cartoon') }}">만화 영화</a>
                    </li>
                    <li class="{{ request()->is('notice')?'menu_active' : '' }}">
                        <a href="{{ url('/notice') }}">발표</a>
                    </li>
                    <li class="{{ request()->is('board/free_list') ? 'menu_active' : '' }}">
                        <a href="{{ url('board/free_list') }}">업로드 문의</a>
                    </li>
                    <li class="dropdown-mn" id="dropdow-wraper1">
                        <a href="#">제휴업체<i class="fa-solid fa-circle-chevron-down"></i></a>
                        <div class="dropdow-wraper wrap">
                            <ul>
                                <li><a href="">Menu one</a></li>
                                <li><a href="">Menu one</a></li>
                                <li><a href="">Menu one</a></li>
                                <li><a href="">Menu one</a></li>
                                <li><a href="">Menu one</a></li>
                                <li><a href="">Menu one</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="tools-wrap user_tools">
                <ul class="nav navbar-nav nav-justified" >
                        <li class="{{request()->is('/')?'':''}} search_bar">
                            <i class="fa-solid fa-magnifying-glass" id="search_btn"></i>
                        </li>
                        @if(session()->has('admin_name'))
                            <li>
                                <div class="user_profile">
                                    <span></span>
                                    <a href="{{ url('user', session()->get('admin_name')) }}"><img src="{{ asset('img/001 (2).png')}}" alt=""></a>
                                </div>
                            </li>
                        @else
                            <li class="{{request()->is('/login')?'':''}}"><a href="{{url('/login')}}"><img src="{{ asset('img/user_profile.png') }}" 
                            alt="" width="50px" height="50px"></a>
                            </li>
                        @endif
                </ul>
                <div class="navbar-header"> 
                <span class="navTrigger unactive"> 
                    <i></i> 

                    <i></i> 

                    <i></i> 
                </span>
                </div>
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
    @if(request()->is('/'))
        <script>
            window.addEventListener('scroll', function() {
                var nav = document.getElementById('nav');
                if (window.scrollY >= 80) {
                    nav.classList.add('nav-scroll');
                } else {
                    nav.classList.remove('nav-scroll');
                }
            });
        </script>
    @endif
    <script>
    const menueWraper = document.querySelector('.navbar-menue-wraper')
    const showingMueBtn = document.querySelector('.navTrigger')
        showingMueBtn.addEventListener('click', function() {
        showingMueBtn.classList.toggle('active')
        menueWraper.classList.toggle('active')
    })
    const dropdoWraperOne = document.querySelector('#dropdow-wraper1 a')
    const dropDowIcon = document.querySelector('.fa-solid.fa-circle-chevron-down')
    const dropdowwraper = document.querySelector('.dropdow-wraper')
    const searchWraper = document.querySelector('#search-wrap');
    const searchBtn = document.getElementById('search_btn');
    searchBtn.addEventListener('click', function(){
        searchWraper.classList.toggle('active');
        if (searchWraper.classList.contains('active')) {
            document.body.style.overflow = 'hidden'; 
        } else {
            document.body.style.overflow = ''; 
        }
    });

    // function to reomve active class when the click target is not tru to that section
    document.addEventListener('click', function(event) {
        if (!searchWraper.contains(event.target) && event.target !== searchBtn) {
            searchWraper.classList.remove('active');
            document.body.style.overflow = ''; 
        }
        if (!dropdowwraper.contains(event.target) && event.target !== dropdoWraperOne) {
            dropdowwraper.classList.remove('active');
            dropDowIcon.classList.remove('active')
        }
        if (!showingMueBtn.contains(event.target)) {
            showingMueBtn.classList.remove('active')
            menueWraper.classList.remove('active')
        }
    });



    dropdoWraperOne.addEventListener('click', function(){
        if(dropdowwraper.classList.contains('active') && dropDowIcon.classList.contains('active')){
            dropdowwraper.classList.remove('active')
            dropDowIcon.classList.remove('active')
        }else{
            dropdowwraper.classList.add('active')
            dropDowIcon.classList.add('active')
        }
    });
    </script>

    @endpush