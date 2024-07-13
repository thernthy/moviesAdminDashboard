<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>코끼리티비 - 최신드라마, 드라마, 예능다시보기, 인기드라마, 공포영화, 액션영화, 코미디영화, 코믹영화, 성인영화, 19금영화, 최신뉴스, 스포츠뉴스, 스포츠방송, 최신영화, 무료영화,
        영화다시보기, 다시보기, 드라마 다시보기</title>
    <meta name="description" content="
코끼리티비 - 최신드라마, 드라마, 예능다시보기, 인기드라마, 공포영화, 액션영화, 코미디영화, 코믹영화, 성인영화, 19금영화, 최신뉴스, 스포츠뉴스, 스포츠방송, 최신영화, 무료영화, 영화다시보기, 다시보기, 드라마 다시보기
">
    @foreach($data['key_words'] as $keyword)
    <meta name="keywords" content="{{ $keyword }}">
    @endforeach
    <meta name="keywords" content="새로운">
    <meta name="keywords" content="최신드라마, 드라마, 예능다시보기, 인기드라마, 공포영화, 액션영화, 코미디영화, 
코믹영화, 성인영화, 19금영화, 최신뉴스, 스포츠뉴스, 스포츠방송, 최신영화, 무료영화, 영화다시보기, 다시보기, 드라마 다시보기, 한드다시보기,미드다시보기">
    <meta name="keywords" content="새 영화">
    <meta name="keywords" content="2024년 새 영화">
    <meta name="keywords" content="រឿងកូរ៉េចេញថ្មីៗ">
    <meta name="keywords" content="រឿងកូរ៉េចេញថ្មី">
    <meta name="keywords" content="kotv001">
    <link rel="icon" type="image/x-icon" href="{{ asset('logofivicon.ico') }}">
    <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome-4.5.0/css/font-awesome.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/css/bootstrap.min.css') }}">
    <!-- Bootstrap style -->
    <link rel="stylesheet" href="{{ asset('vendor/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/style.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kreon:400,700">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <script src="https://kit.fontawesome.com/c49fa14979.js" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8365829716237780"
        crossorigin="anonymous"></script>

    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "Your Organization",
        "url": "https://kotv-001.com",
        "logo": "{{ asset('logofivicon.ico') }}",
        "description": "
        enjoy watching korean drama,
        japanese animation,
        cartoon,
        hollywood and amny action movie on our website.ejoy with your watching.
        សូ មរី ករា យទស្ សនា រឿ ងភា គកូ រ៉េ គំ នូ រជី វចលជប៉ុ ន តុ ក្ កតា ហូ លី វូ ដ និ ងភា ពយន្ តសកម្ មភា ពអា មនី នៅ លើ គេ ហទំ ព័ ររបស់ យើ ង។ រី ករា យជា មួ យនឹ ងកា រមើ លរបស់ អ្ នក។
        저희 웹사이트에서 한국 드라마,
        일본 애니메이션,
        만화,
        헐리우드,
        앰니 액션 영화를 즐겨보세요.즐겁게 시청하세요.
        "
    }
    </script>
    <style>
    @media (min-width:760px) {
        li.search_bar {
            margin: 12px 47px 10px 42px;
        }
    }
    </style>
    @stack('styles')
</head>

<body>
    <!-- content -->
    <div class="wrap">
        @yield('content')

    </div>
    @include('front.footer')
    @include('front.scripts')
</body>
<script>

</script>

</html>