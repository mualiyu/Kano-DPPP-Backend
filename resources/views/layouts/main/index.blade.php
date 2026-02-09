<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Africa Minigrid Program">
    <meta name="keywords" content="Africa Minigrids Program, Rural Electrification Agency, GEF, UNDP, Solar, Renewable Energy">

    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="assets/favicon/site.webmanifest">
    <link rel="mask-icon" color="#6366f1" href="{{asset('assets/favicon/safari-pinned-tab.svg')}}">
    <meta name="msapplication-TileColor" content="#080032">
    <meta name="msapplication-config" content="{{asset('assets/favicon/browserconfig.xml')}}">
    <meta name="theme-color" content="white">
    <!-- Theme mode-->
    <script>
      let mode = window.localStorage.getItem('mode'),
          root = document.getElementsByTagName('html')[0];
      if (mode !== undefined && mode === 'dark') {
        root.classList.add('dark-mode');
      } else {
        root.classList.remove('dark-mode');
      }


    </script>
    <!-- Page loading styles-->
    <style>
      .page-loading {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        -webkit-transition: all .4s .2s ease-in-out;
        transition: all .4s .2s ease-in-out;
        background-color: #fff;
        opacity: 0;
        visibility: hidden;
        z-index: 9999;
      }
      .dark-mode .page-loading {
        background-color: #121519;
      }
      .page-loading.active {
        opacity: 1;
        visibility: visible;
      }
      .page-loading-inner {
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        text-align: center;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        -webkit-transition: opacity .2s ease-in-out;
        transition: opacity .2s ease-in-out;
        opacity: 0;
      }
      .page-loading.active > .page-loading-inner {
        opacity: 1;
      }
      .page-loading-inner > span {
        display: block;
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        font-weight: normal;
        color: #6f788b;
      }
      .dark-mode .page-loading-inner > span {
        color: #fff;
        opacity: .6;
      }
      .page-spinner {
        display: inline-block;
        width: 2.75rem;
        height: 2.75rem;
        margin-bottom: .75rem;
        vertical-align: text-bottom;
        background-color: #d7dde2;
        border-radius: 50%;
        opacity: 0;
        -webkit-animation: spinner .75s linear infinite;
        animation: spinner .75s linear infinite;
      }
      .dark-mode .page-spinner {
        background-color: rgba(255,255,255,.25);
      }

      .toast-ss {
        position: absolute; 
        z-index:9999; 
        left:220px; 
        top:150px; 
        background:green;
      }
      @media (max-width: 400px) { /* or 301 if you want really the same as previously.  */
          .toast-ss {
            position: fixed; 
            z-index:9999; 
            left:10px;
            top:300px; 
            background:green;
          }
      }
      @-webkit-keyframes spinner {
        0% {
          -webkit-transform: scale(0);
          transform: scale(0);
        }
        50% {
          opacity: 1;
          -webkit-transform: none;
          transform: none;
        }
      }
      @keyframes spinner {
        0% {
          -webkit-transform: scale(0);
          transform: scale(0);
        }
        50% {
          opacity: 1;
          -webkit-transform: none;
          transform: none;
        }
      }

    </style>
    <!-- Page loading scripts-->
    <script>
      (function () {
        window.onload = function () {
          const preloader = document.querySelector('.page-loading');
          preloader.classList.remove('active');
          setTimeout(function () {
            preloader.remove();
          }, 1500);
        };
      })();

    </script>
    <!-- Import Google Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet" id="google-font">
    <!-- Vendor styles-->
    <link rel="stylesheet" media="screen" href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}"/>
    <link rel="stylesheet" media="screen" href="{{asset('assets/vendor/aos/dist/aos.css')}}"/>
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="{{asset('assets/css/theme.min.css')}}">
  </head>
  <!-- Body-->
  <body>

    <main class="page-wrapper">
        <div class="dark-mode">
        @include('layouts.main.header')
      </div>

    
        {{-- <div class="toast show fade mx-auto toast-ss" id="toasttt" role="alert" aria-live="assertive" aria-atomic="true" data-mdb-autohide="false">
        <div class="toast-header">
          <strong class="me-auto">Notice!!!</strong>
          <small>13 Mar, 2023</small>
           <button type="button" onclick="c_toss()" class="btn-close" data-mdb-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body"><a href="{{route('main_wwu')}}">Click here!</a> to see the available Tenders</div>
      </div> --}}
      <!-- Page content-->
      @yield('content')
    </main>
    <!-- Footer-->
    @include('layouts.main.footer')
    <!-- Back to top button--><a class="btn-scroll-top" href="#top" data-scroll>
      <svg viewBox="0 0 40 40" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <circle cx="20" cy="20" r="19" fill="none" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"></circle>
      </svg><i class="ai-arrow-up"></i></a>
    <!-- Vendor scripts: js libraries and plugins-->
    <script src="{{asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js')}}"></script>
    <script src="{{asset('assets/vendor/parallax-js/dist/parallax.min.js')}}"></script>
    <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/aos/dist/aos.js')}}"></script>
    <!-- Main theme script-->
    <script src="{{asset('assets/js/theme.min.js')}}"></script>

    <script>
      function c_toss() {
        document.getElementById("toasttt").style.display = "none";
      }
    </script>
  </body>
</html>
