@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')


<!-- all other page content  -->

@section('page_content')  

<div class="dash_back_icon" onclick="location.href='{{ route('page_visits') }}';"> 
    <h2><i class="fa-solid fa-arrow-left"></i> Visits </h2>
 </div>

       <p> <h2>Page Visits</h2> </p>  
       
       <div><h2>Log For: {{$identifier}}</h2></div>
    <div class="table_wrapper centerAlign flex_col">

            @if (count($visits) < 1)

            {!! '<div> No Statistics Available </div>' !!}    
            
            @else
            <table>
                <tr>
                  <th>No. </th>
                  <th>User</th>
                  <th>Device_Info</th>
                  <th>Url</th>
                  <th>State - Country</th>
                  <th>User Agent</th>
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
                         <p>{{$visit->username}}</p>
                         <p><small>{{$visit->browser}}</small></p>
                         <p>IP - {{$visit->user_ip}}</p>
                    </td>
                    <td>
                         {{$visit->device_info}}
                    </td>
                    <td>
                         <p>{{$visit->url}}</p>
                         <small> {{$visit->created_at}}</small>
                    </td>
                    <td>
                         <p>{{$visit->user_state}}</p>
                          {{$visit->user_country}}
                    </td>
                    <td>
                        {{$visit->user_agent}}
                    </td>
                </tr>
                   
                @endforeach

            </table>
                @endif

            {{ $visits->links() }}
        
         
    </div>

@endsection 