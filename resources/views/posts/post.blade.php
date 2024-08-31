@extends('outlay.app')


<!-- all other page content  -->
@section('page_content')

        
            
            <!-- ARTICLE AREA -->
            <div class="articles_area_wrapper flex_col">

                <div class="blog_header centerAlign" onclick="location.href='{{route('blog-home')}}';">
                    Beta Technicians - Blog 
                </div>

                <div class="search_form_wrapper articles_search centerAlign">
                    <form class="" action="#" method="GET">
                        <div class="search_wrapper flex_row centerAlign">
                            <input class="search_input" type="search" name="search" id="">
                            <button class="search_btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>

                <div class="articles_wrapper flex_row">
                    <div id="articles_main" class="articles_main_group centerAlign flex_col">
                        <div class="article_box centerAlign flex_col">
                            <div class="article_title">
                                <p><h1>{{$post->title}}</h1></p>
                            </div>
                            <div class="article_info">
                                <p> Written By: {{$post->author??''}} </p>
                                <p> <i class="fa-solid fa-puzzle-piece"></i> {{ucwords($post->category)}} </p> 
                                <p>  <i class="fa-solid fa-calendar-days"></i> {{date_format($post->created_at, "d M, Y")}} </p>
                            </div>

                            <div class="article_body flex_col">

                                
                                    @if (count($post->images) < 1)
                                    <div class="article_image">      
                                        <img src="{{asset('uploads/post_images')}}/post.jpg">
                                    </div> 
                                    @else
                                    <div class="article_image">
                                        @foreach ($post->images as $image)
                                            @if ($image->is_main)
                                              <img src="{{asset('uploads/post_images')}}/{{$image->filename}}"> 
                                            @endif
                                        @endforeach
                                    </div>
                                    @endif
                                
                                <div class="article_post">
                                    {!!$post->content!!}
                                </div>

                            </div>
                        </div>
                            @php $section = $post->title; @endphp

                            @include('inc.contact_form')

                    </div>

                    <div class="articles_sidebar centerAlign flex_col">
                        @if (count($sideposts) < 1)

                        {!! '<div> No Content Available </div>' !!}    
                            
                        @else
                            @foreach ($sideposts as $post)
                                <div class="sidebox flex_col" onclick="location.href='{{ route('post.show', ['slug'=>$post->slug]) }}'">
                                    <div class="sidebox_image ">
                                        <img src="{{asset('uploads/post_images')}}/@php echo $post->images[0]->filename??'post.jpg' @endphp " alt="">

                                    </div>
                                    <p class="sidebox_title"><h4>{{$post->title}}</h4></p>
                                </div>
                            @endforeach
                        @endif

                    </div>

                </div>
            </div>


            <div class="blog_footer">
                <div id="blog_footer_content">
                    <ul class="blog_footer_links flex_row">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#tech">TECH</a></li>
                        <li><a href="#power">POWER</a></li>
                        <li><a href="#">Uncategorized</a></li>
                    </ul>
                </div>
            </div>

@endsection