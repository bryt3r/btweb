@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')


<!-- all other page content  -->

@section('page_content')  

       <p> <h2>Page Visits</h2> <button><a href="{{route('visits_all')}}">View All</a></button> </p>   
    <div class="table_wrapper centerAlign flex_col">

            @if (count($visits) < 1)

            {!! '<div> No Statistics Available </div>' !!}    
            
            @else
            <table>
                <tr>
                  <th>No. </th>
                  <th>Page </th>
                  <th>Number Of Views</th>
                </tr>
                @php
                $i = 1;
                 @endphp
                @foreach ($visits as $visit)
                <tr>
                    <td>
                        {{$i++}}
                    </td>
                    <td> 
                        <a href="{{ $visit->url}}">
                         {{ $titles[$visit->page_identifier]['title']?? $visit->page_identifier}} 
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('visits.list', ['identifier' => $visit->page_identifier])}}">
                            {{$visit->views_count}}
                        </a>
                    </td>
                </tr>
                {{-- <tr>
                    @if (isset($titles[$visit->page_identifier]['type']))
                    <td> <a href="{{ route($titles[$visit->page_identifier]['type'].'.show_admin', ['identifier' => $visit->page_identifier])}}"> {{ $titles[$visit->page_identifier]['title']?? $visit->page_identifier}} </a></td>
                    
                    @else
                    <td> <a href="{{ route($visit->page_identifier)}}"> {{ $titles[$visit->page_identifier]['title']?? $visit->page_identifier}} </a></td>
                    
                    @endif 
                    
                    <td>{{$visit->views_count}}</td>
                </tr> --}}
                   
                @endforeach

            </table>
                @endif

            {{ $visits->links() }}
        
         
    </div>

@endsection 