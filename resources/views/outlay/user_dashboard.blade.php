<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

     <!-- Custom CSS -->
     <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}" >
     <link rel="stylesheet" href="{{ asset('css/style.css') }}" >
     
     <!-- Font Awesome CSS -->
     <link rel="stylesheet" href="{{ secure_asset('font_awesome/css/all.min.css') }}" >
     <link rel="stylesheet" href="{{ asset('font_awesome/css/all.min.css') }}" >
 
    <title> Admin - {{Auth::user()->role}}</title>
</head>


<body>
    
    <div id="page_container">
       
        <div id="main">

            <div class="dashboard_header centerAlign flex_row">
                <div id="dash_menu_icon" class=""> 
                    <i class="dash_menu_icon fa-solid fa-bars "></i>
                </div>
                <div id="brand_logo" class="brand_logo">
                    <a href="{{ route('beta-home') }}">
                        <img src="{{ asset('assets/images/beta_logo_white.svg') }}" alt="">
                    </a>
                </div>
                
                <div class="dash_header_label centerAlign flex_row">
                    {{-- <div> <small> {{$page_title??'HOME'}} </small></div> --}}
                    <div>{{Auth::user()->username}}</div>
                </div>
            </div>

            <div class="dash_page_wrapper flex_row">
                <div id="dash_nav_toggle" class="dash_side_nav">
                    <ul class="dash_side_ul flex_col">
                        <li class="dash_side_title"> MENU</li>
                        <li class="dash_side_link"><a href="{{route('posts.manage')}}"><i class="fa-solid fa-newspaper "></i> Posts</a></li>
                        <li class="dash_side_link"><a href="{{route('products.manage')}}"><i class="fa-solid fa-basket-shopping "></i> Products</a></li>
                        <br>
                        <br>
                        <li class="dash_side_link"><a href="{{route('user.profile', ['username' => Auth::user()->username])}}"><i class="fa-solid fa-user-gear"></i> Profile</a></li>
                        <br>
                        <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
    
                            <button href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                        </button>
                        </form>
                        </li>
                    </ul>
                    
                    
                </div>
                <div class="dash_main centerAlign">
                    <div class=""> @include('inc.messages') </div>

                        @yield('page_content')
                        
                </div>
            </div>
        </div>
    
            <!-- FOOTER  -->
            <footer id="footer">
                    <div id="footer_content" class="flex_col">
                        <ul id="footer_links" class="flex_row">
                            <li><a href="{{ route('beta-home') }}">Home</a></li>
                            <li><a href="./{{ route('beta-home') }}/#services">Services</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li><a href="#about">About</a></li>
                        </ul>
                    </div>
            </footer>
    </div>

<script src="{{ secure_asset('js/script.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>

@yield('page_script')


</body>

</html>