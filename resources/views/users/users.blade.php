@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')


<!-- all other page content  -->

@section('page_content')  

       <p> <h2>Users List</h2> </p>   
    <div class="table_wrapper centerAlign flex_col">

            @if (count($users) < 1)

            {!! '<div> No Users </div>' !!}    
            
            @else
                <table>
                    <tr>
                    <th>No. </th>
                    <th>Username </th>
                    <th>Email</th>
                    <th>Role</th>
                    </tr>
                    @php
                    $i = 1;
                    @endphp
                    
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            {{$i++}}
                        </td>
                        <td> 
                            <a href="{{route('user.show', ['username' => $user->username])}}">
                            {{ $user->username}} 
                            </a>
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            {{$user->role}}
                        </td>
                    </tr>
                    
                    @endforeach

                </table>
            @endif

            {{ $users->links() }}
        
         
    </div>

@endsection 