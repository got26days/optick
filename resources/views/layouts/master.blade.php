<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>{{ $seo_title ?? "Оптика Стиль г.Братск" }}</title>
  <meta name="description" content="{{ $seo_desc ?? 'Если вы ищете качественные очки и линзы, приходите в салоны «Оптика Стиль». Забудьте о плохом зрении!' }}">
  <meta name="keywords" content="{{ $seo_keywords ?? 'оптика, стиль, братск, контактные линзы, линзы, очки, оправы, растворы, глаз, купить в братске' }}">

  <meta property="og:title" content="Оптика Стиль | Братск | Контактные линзы, очки, оправы, растворы">
  <meta property="og:url" content="{{ Request::url() }}">
  <meta property="og:description" content="Если вы ищете качественные очки и линзы, приходите в салоны «Оптика Стиль». Забудьте о плохом зрении!">
  <meta property="og:image" href="/imgs/logo1.png" content="/imgs/logo1.png">

  <meta property="og:image" href="/storage/{{ $seo_img ?? 'pages/logo1.png' }}" content="/storage/{{ $seo_img ?? 'pages/logo1.png' }}"  />
  <meta property="og:site_name" content="Оптика Стиль г.Братск">

  <link rel="shortcut icon" href="/imgs/favicon.ico" type="image/x-icon">
  <meta name="yandex-verification" content="4a7050709870771b" />
  <meta name="google-site-verification" content="bH_sFVke1EsVcm-A1vOGvvGxcPS7VmpA1QHLVQrYpQI" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/css/app.css">

  <style>
    .maincards-row:after{
      top: -20px !important;
      background-size: 94% !important;
    }
    
    .area-card-desc{
      margin-top: 17px !important;
    }
    
    .section6 .area-price {
    padding-top: 74px !important;
    }
  </style>
</head>
<body>
  <div id="app">
    @include('layouts.nav')
    @yield('content')
    @include('layouts.footer')
  </div>
  <script src="/js/app.js"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-127727256-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
  
    gtag('config', 'UA-127727256-1');
  </script>
  <!-- Yandex.Metrika counter -->
  <script type="text/javascript" >
      (function (d, w, c) {
          (w[c] = w[c] || []).push(function() {
              try {
                  w.yaCounter50786227 = new Ya.Metrika2({
                      id:50786227,
                      clickmap:true,
                      trackLinks:true,
                      accurateTrackBounce:true,
                      webvisor:true
                  });
              } catch(e) { }
          });
  
          var n = d.getElementsByTagName("script")[0],
              s = d.createElement("script"),
              f = function () { n.parentNode.insertBefore(s, n); };
          s.type = "text/javascript";
          s.async = true;
          s.src = "https://mc.yandex.ru/metrika/tag.js";
  
          if (w.opera == "[object Opera]") {
              d.addEventListener("DOMContentLoaded", f, false);
          } else { f(); }
      })(document, window, "yandex_metrika_callbacks2");
  </script>
  <noscript><div><img src="https://mc.yandex.ru/watch/50786227" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
  <!-- /Yandex.Metrika counter -->


</body>
</html>
