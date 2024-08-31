@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')


<!-- all other page content  -->

@section('page_content')  
    <div class="flex_row centerAlign">
        <p>Posts</p>
    </div>
       
    <a class="centerAlign" href="{{route('post.new')}}">
        <button class="add_new_btn">
            <i class="fa-solid fa-plus"></i> New 
        </button>
    </a>       
    <div class="table_wrapper centerAlign flex_col">

        @if (count($posts) < 1)

        {!! '<div> No Posts  </div>' !!}    
        
        @else
            <table>
                <tr>
                {{-- <th>No. </th> --}}
                <th>Post </th>
                <th>Views</th>
                <th></th>
                </tr>
                {{-- @php
                $i = 1;
                @endphp --}}
                
                @foreach ($posts as $post)
                <tr>
                    {{-- <td>
                        {{$i++}}.
                    </td> --}}
                    <td> 
                        <a href="{{ route('post.show', ['slug'=>$post->slug]) }}">
                        <p>{{$post->title}}</p> 
                        </a>
                       <p> <small>{{ucwords($post->category)}} - {{date_format($post->created_at, "d M, Y")}}</small> </p>
                        <p> <small>written by: {{$post->author??''}}</small> </p>
                    </td>
                    <td>
                        {{$post->visits_count}}
                    </td>
                    <td>
                       <div class="article_btn_panel flex_row">
                            @if (!Auth::user()->is_admin)
                            
                                <button class="notification_{{$post->published ? 'success' : ''}}">
                                    <i class="fa-solid fa-upload"></i> 
                                </button>
                            
                            @endif
                    
                            <a href="{{route('post.edit', ['id' =>  $post->id])}}">
                                <button>
                                    <i class="fa-solid fa-pencil"></i> 
                                </button>
                            </a> 
                    @can('publish', $post)
                    
                            <form action="{{ route('post.publish', ['id'=>$post->id]) }}" method="post">
                                @csrf
                                 {{-- <input type="hidden" name="publish" value={{$post->published ? 'save' : 'publish'}}> --}}
                                <button class="notification_{{$post->published ? 'success' : ''}}">
                                    <i class="fa-solid fa-upload"></i> 
                                </button>
                            </form>
                        
                    @endcan
                        
                    @can('delete', $post)
                       
                                <form onsubmit = "return confirm('Do you want to delete?');" action="{{ route('post.delete', ['id'=>$post->id]) }}" method="post">
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
    {{ $posts->links() }}

    

@endsection 