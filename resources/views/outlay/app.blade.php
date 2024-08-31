<!doctype html>
{{-- <html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/" lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- OG Meta --}}
    
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="Beta Technicians">
    <meta property="og:url" content="{{Request::url()}}">
    <meta property="og:title" content="{{$page_title ?? 'BETA'}}">
    <meta property="og:description" content="{{$page_description ?? $page_title ?? 'BETA'}}">
    <meta property="og:image" itemprop="image" content="{{$page_image ?? asset('assets/images/beta_dft.jpg') }}"/>
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image" itemprop="image" content="{{$page_image ?? asset('assets/images/beta_dft.jpg') }}"/>
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">

    {{-- favicon --}}
     <link rel="icon" type="image/x-icon" href="{{asset('assets/favicons/favicon.ico')}}">

     <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/favicons/apple-touch-icon.png')}}">
     <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/favicons/favicon-32x32.png')}}">
     <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/favicons/favicon-16x16.png')}}">
     <link rel="manifest" href="{{asset('assets/favicons/site.webmanifest')}}">

     <!-- Custom CSS -->
     {{-- <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}" > --}}
     <link rel="stylesheet" href="{{ asset('css/style.css') }}" >
     
     <!-- Font Awesome CSS -->
     {{-- <link rel="stylesheet" href="{{ secure_asset('font_awesome/css/all.min.css') }}" > --}}
     <link rel="stylesheet" href="{{ asset('font_awesome/css/all.min.css') }}" >
 
    <title> {{$page_title ?? 'BETA'}}</title>
</head>


<body>
    
    <div id="page_container">
        <div class="contactbar flex_row">
            <ul>
                <li>+{{config('website.phone_number')}}</li>
                |
                <li>{{config('website.email')}}</li>
            </ul>
            <ul>
                {{-- <li>Login</li> --}}
            </ul>
        </div>
        <nav id="navbar">
            <div id="nav_content" class="flex_row">
                <!-- <a href="./">Beta Technicians</a> -->
                <div id="brand_logo" class="brand_logo">
                    <a href="{{ route('beta-home') }}"><img src="{{ asset('assets/images/beta_logo_blue.svg') }}"
                            alt=""></a>
                </div>
                <div class="shop_link"><a href="{{ route('shop-home') }}">Shop</a></div>
                <ul id="nav_toggle" class="nav_links flex_row">
                    <li><a href="{{ route('beta-home') }}">Home</a></li>
                    <li><a href="{{ route('beta-home') }}/#services">Services</a></li>
                    <li><a href="{{ route('projects-home') }}">Projects</a></li>
                    <li><a href="{{ route('shop-home') }}">Shop</a></li>
                    <li><a href="{{ route('blog-home') }}">Blog</a></li>
                    <li><a href="{{ route('contact-us') }}">Contact</a></li>
                </ul>
                <div class="menu_icon" id="menu_icon">
                    <div class="bar_item"></div>
                    <div class="bar_item"></div>
                    <div class="bar_item"></div>
                </div>
            </div>
        </nav>
        <div class="floating_icon">
            <a href="https://wa.me/{{config('website.phone_number')}}"><i class="fa-brands fa-whatsapp fa-2x"></i></a>
        </div>
            <div id="main">
                <div class=""> @include('inc.messages') </div>
                    @yield('page_content')

            </div>
    
            <!-- FOOTER  -->
            <footer id="footer">
                    <div id="footer_content" class="flex_col">
                        <ul id="footer_links" class="flex_row">
                            <li><a href="{{ route('beta-home') }}">Home</a></li>
                            <li><a href="{{ route('beta-home') }}/#services">Services</a></li>
                            <li><a href="{{ route('projects-home') }}">Projects</a></li>
                            <li><a href="{{ route('shop-home') }}">Shop</a></li>
                            <li><a href="{{ route('blog-home') }}">Blog</a></li>
                            <li><a href="{{ route('contact-us') }}">Contact</a></li>
                        </ul>
                        <ul id="footer_sm_links" class="flex_row">
                            <li><a href="#whatsapp"><i class="fa-brands fa-whatsapp-square fa-2x"></i></a></li>
                            <li><a href="#twitter"><i class="fa-brands fa-twitter-square fa-2x"></i></a></li>
                            <li><a href="#instagram"><i class="fa-brands fa-instagram-square fa-2x"></i></a></li>
                            <li><a href="#facebook"><i class="fa-brands fa-facebook-square fa-2x"></i></a></li>
                        </ul>
                    </div>
            </footer>
    </div>

<script src="{{ secure_asset('js/script.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>

@yield('page_script')


</body>

</html>