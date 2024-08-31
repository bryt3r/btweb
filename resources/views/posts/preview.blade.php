@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')
<!-- all other page content  -->
     @section('page_content')

            <!-- ARTICLE AREA -->
            <div class="articles_area_wrapper flex_col">
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

                                <div class="article_image">
                                    @if (count($post->images) < 1)
                                           
                                        <img src="{{asset('uploads/post_images')}}/post.jpg">
                                       
                                    @else
                                        @foreach ($post->images as $image)
                                            @if ($image->is_main)
                                              <img src="{{asset('uploads/post_images')}}/{{$image->filename}}"> 
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="article_post">
                                    {!!$post->content!!}
                                </div>

                            </div>
                        </div>

                    </div>

                </div>


                <div class="flex_row centerAlign">

                    <a href="{{route('posts.manage')}}">
                        <button>
                            <i class="fa-solid fa-floppy-disk"></i> SAVE 
                        </button>
                    </a>
                    
                    <a href="{{route('post.edit', ['id' =>  $post->id])}}">
                        <button class="alt_btn">
                            <i class="fa-solid fa-pencil"></i> EDIT
                        </button>
                    </a>       
                    
                </div>
            </div>
     @endsection     
  
