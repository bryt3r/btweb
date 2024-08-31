@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')
<!-- all other page content  -->
     @section('page_content')

     <div class="projects_page_wrapper flex_col centerAlign">

        <div class="dash_back_icon" onclick="location.href='{{ route('projects-home') }}';"> <h4><i class="fa-solid fa-arrow-left"></i> projects </h4> </div>

        
        <div><h1>{{$project->title}}</h1></div>

        {{-- <div class="image_section_wrapper"> --}}
            
                @if (count($project->images) < 1)
                    <div class="item_image_container">
                        <div class="imageSlide activeSlide">
                            <img src="{{asset('uploads/project_images')}}/project.jpg">
                        </div>
                    </div>  
                @else
                    <div class="item_image_container">
                        @foreach ($project->images as $image)
                            <div class="imageSlide @php echo $image->is_main || $project->images[0] == $image ? 'activeSlide' : ''  @endphp ">
                                <img src="{{asset('uploads/project_images')}}/{{$image->filename}}">
                            </div>  
                        @endforeach
                    
                    </div>
                    <div class="item_image_thumbnails flex_row">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($project->images as $image)
                            @php $i++ @endphp
                            <div onclick="showSlide({{$i}})" class="imageThumb  @php echo $image->is_main ? 'activeThumb' : ''  @endphp ">
                                <img src="{{asset('uploads/project_images')}}/{{$image->filename}}">
                            </div>
                        @endforeach
                    </div>
                @endif
        {{-- </div> --}}
        
        <div class="project_box_body flex_col">
            <div class="grey_color"><small> <i class="fa-solid fa-calendar-days"></i> {{date_format($project->date, "d M, Y")}}  </small></div>
            <div class="grey_color"><small> <i class="fa-solid fa-location-dot"></i> {{$project->location}} </small></div>
        </div>
            
        <h4>{{$project->title}}</h4>
        
        <div>
            {!!$project->details!!}
        </div>

    </div>


                <div class="flex_row centerAlign">

                    <a href="{{route('projects.manage')}}">
                        <button>
                            <i class="fa-solid fa-floppy-disk"></i> SAVE 
                        </button>
                    </a>
                    
                    <a href="{{route('project.edit', ['id' =>  $project->id])}}">
                        <button class="alt_btn">
                            <i class="fa-solid fa-pencil"></i> EDIT
                        </button>
                    </a>       
                    
                </div>
            
     @endsection     
  
