@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')


<!-- all other page content  -->

@section('page_content')  

    <div class="flex_row centerAlign">
        <p>Projects</p>
    </div>

    <a class="centerAlign" href="{{route('project.new')}}">
        <button class="add_new_btn">
            <i class="fa-solid fa-plus"></i> New 
        </button>
    </a>       
    <div class="table_wrapper centerAlign flex_col">

        @if (count($projects) < 1)

        {!! '<div> No projects  </div>' !!}    
        
        @else
            <table>
                <tr>
                {{-- <th>No. </th> --}}
                <th>Project Title </th>
                <th>Views</th>
                <th></th>
                </tr>
                {{-- @php
                $i = 1;
                @endphp --}}
                
                @foreach ($projects as $project)
                <tr>
                    {{-- <td>
                        {{$i++}}.
                    </td> --}}
                    <td> 
                        <a href="{{ route('project.show', ['slug'=>$project->slug]) }}">
                        <p>{{$project->title}}</p> 
                        </a>
                        <small>{{ucwords($project->category)}} - {{date_format($project->date, "d M, Y")}}</small>
                    </td>
                    <td>
                        {{$project->visits_count}}
                    </td>
                    <td>
                       <div class="article_btn_panel flex_row">
                            @if (!Auth::user()->is_admin)
                            
                                <button class="notification_{{$project->published ? 'success' : ''}}">
                                    <i class="fa-solid fa-upload"></i> 
                                </button>
                            
                            @endif
                    
                            <a href="{{route('project.edit', ['id' =>  $project->id])}}">
                                <button>
                                    <i class="fa-solid fa-pencil"></i> 
                                </button>
                            </a> 
                    @can('publish', $project)
                    
                            <form action="{{ route('project.publish', ['id'=>$project->id]) }}" method="post">
                                @csrf
                                 {{-- <input type="hidden" name="publish" value={{$project->published ? 'save' : 'publish'}}> --}}
                                <button class="notification_{{$project->published ? 'success' : ''}}">
                                    <i class="fa-solid fa-upload"></i> 
                                </button>
                            </form>
                        
                    @endcan
                        
                    @can('delete', $project)
                       
                                <form onsubmit = "return confirm('Do you want to delete?');" action="{{ route('project.delete', ['id'=>$project->id]) }}" method="post">
                                    @csrf
                                    <button class="notification_error">
                                        <i class="fa-solid fa-trash-can"></i> 
                                    </button>
                                </form>
                        
                    @endcan
                </div>
                    </td>
                </tr>
                
                @endforeach

            </table>
        @endif
    </div>
    {{ $projects->links() }}

    

@endsection 