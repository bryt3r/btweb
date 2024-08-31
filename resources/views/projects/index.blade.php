@extends('outlay.app')

<!-- all other page content  -->

@section('page_content')

        {{-- @php
            $page_image = {{asset('uploads/project_images')}}.'/project.jpg';
        @endphp --}}

        <div class="projects_page_wrapper flex_col centerAlign">

            <div class="flex_row centerAlign">
                <div>~ ~ -</div>
                <p><i>Our Projects</i></p>
                <div>- ~ ~</div>
            </div>

            @if (count($projects) < 1)
                <h1> No Published Projects </h1>
            @else
                
            <div class="projects_wrapper centerAlign flex_row">

                @foreach ($projects as $project)
                   <div class="project_box flex_col centerAlign" onclick="location.href='{{route('project.show', ['slug' => $project->slug])}}';">
                        <div class="project_box_image">
                            <img src="{{asset('uploads/project_images')}}/@php echo $project->images[0]->filename??'project.jpg' @endphp " alt="">
                        </div>
                        <div class="project_box_body flex_col">
                            <div class="grey_color"><small> <i class="fa-solid fa-calendar-days"></i> {{date_format($project->date, "M, Y")}}  </small></div>
                            <div class="grey_color"><small> <i class="fa-solid fa-location-dot"></i> {{$project->location}} </small></div>
                            <h3>{{$project->title}}</h3>
                        </div>
                    </div> 
                @endforeach

            </div>

            @endif

            <div class="centerAlign"> {{ $projects->links() }} </div> 

        </div>
    @endsection