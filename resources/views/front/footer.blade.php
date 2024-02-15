<style>
    .website-link {
        overflow: hidden;
        white-space: nowrap;
    }

    #marquee-link {
        display: inline-block;
        animation: marquee-animation 10s linear infinite;
    }

    @keyframes marquee-animation {
        0% {
            transform: translateX(100%);
        }
        100% {
            transform: translateX(calc(-100% - 100vw));
        }
    }
</style>
<div id="footer">
    <div class="row website-link">
        <a href="#" id="marquee-link">
            경 될 주소 안내 입니다. 지금 이곳을 눌러 확인하세요.
        </a>
    </div>
    <div class="row" style="width: 200px; padding: 40px 0; margin:0 auto;">
        <p class="text-center">
        해당 서비스는 대만에 설립된 서비스입니다. 
        광고문의 및 문의사항 텔레그램 : nanatv2020 
        Copyright ⓒ 나나티비 All rights reserved. 
        광고문의
        </p>
    </div>
</div>

<!-- <ul class="nav pull-right scroll-top">
    <li><a href="#" title="Scroll to top"><i class="glyphicon glyphicon-chevron-up"></i></a></li>
</ul> -->

