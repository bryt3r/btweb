@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')


<!-- all other page content  -->

@section('page_content') 

        @if (Auth::user()->is_admin)
        
        <div class="dash_back_icon" onclick="location.href='{{ route('admin.users') }}';"> <h2><i class="fa-solid fa-arrow-left"></i> Users </h2> </div>
 
        @endif

       <p> <h2>{{ strtoupper($user->last_name) }}, {{ucfirst($user->first_name)}} </h2> </p> 
       
       <div class=" flex_col user_card_wrapper blue_box_btn">
            <div class="user_card flex_col">
                <div class="upper_half_card flex_row">
                    <div class="card_avatar centerAlign">
                        <img src="/assets/images/circle_avatar.png" alt="">
                    </div>
                    <div class="user_details">
                            <p>Username: {{$user->username}}</p>
                            <p>Email: {{$user->email}}</p>
                            <p>Phone: {{$user->phone}}</p>
                            <p>Role: {{ucfirst($user->role)}}</p>
                            <p class=" notification_{{$user->is_banned ? 'error' : 'success'}} ">Access: {{$user->is_banned ? 'DENIED' : 'ALLOWED'}}</p>
                    </div>
                </div>
                <div class="lower_half_card"><p>Address: {{$user->address}}</p></div>
            </div>
           
            <button class="expanded_btn" id="modal_open_btn"><i class="fa-solid fa-pencil"></i> Edit</button>
            <br>
            @if (Auth::user()->is_admin)
             
            <form onsubmit = "return confirm('Do you want to delete?');" action="{{ route('admin.delete_user', ['id'=>$user->id]) }}" method="post">
                @csrf
                <button>
                    <i class="fa-solid fa-trash-can"></i> Delete
                </button>
            </form>
           <br>
           <hr>
           <div class=" flex_col blue_box_btn">
            <form action='{{route('admin.change_role', ['id' => $user->id])}}' class="create_form centerAlign" method="POST">
                @csrf
               <div class="flex_row">
                <div class="form_item centerAlign">
                    <label for="role">Role</label>
                    <select name="role" id="role" required>
                        <option value="">Role</option>
                        <option value="guest" @selected( old('role',$user->role??null) == 'guest')>Guest</option>
                        <option value="writer" @selected( old('role',$user->role??null) == 'writer')>Writer</option>
                        <option value="lister" @selected( old('role',$user->role??null) == 'lister')>Lister</option>
                    </select>
                    @error('role')
                    <div class="error_text"> <small>{{ $message }}</small> </div>
                    @enderror
                </div>
                <button class=" centerAlign">Change Role</button>
                </div> 
                
            </form>
           </div>
           <br>
           <br>
           <form action="{{ route('admin.ban_user', ['id' => $user->id])}}" method="post">
                @csrf
                <button class="expanded_btn notification_{{$user->is_banned ? 'success' : 'error'}} " >
                    {{$user->is_banned ? 'UNBAN' : 'BAN'}}
                </button>
            </form>

            @endif
           
        </div>
      

       <!-- User MODAL FORM  -->
       <div id="modal" class="modal_wrapper @php echo count($errors) > 0   ? 'show_block' : ''; @endphp ">
        <div class="modal_header">
        
        </div>
        <div class="modal_content centerAlign">
            <span class="modal_close_btn">&times;</span>
            <p><h2>EDIT USER</h2></p> 
            <form action='{{route('admin.update_user', ['id' => $user->id])}}' class="create_form centerAlign" method="POST">
                @csrf
                
                <div class="form_item centerAlign">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value=" @php echo $user->username ?? old('username') @endphp " required>
                    @error('username')
                        <div class="error_text"> <small>{{ $message }}</small> </div>
                    @enderror
                </div>
                <div class="form_item centerAlign">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" id="firstname" value=" @php echo $user->first_name ?? old('firstname') @endphp " required>
                    @error('firstname')
                        <div class="error_text"> <small>{{ $message }}</small> </div>
                    @enderror
                </div>
                <div class="form_item centerAlign">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" id="lastname" value=" @php echo $user->last_name ?? old('firstname') @endphp " required>
                    @error('lastname')
                        <div class="error_text"> <small>{{ $message }}</small> </div>
                    @enderror
                </div>
                <div class="form_item centerAlign">
                    <label for="email">Email</label>
                    <input readonly type="email" name="email" id="email" value=" @php echo $user->email ?? old('email') @endphp " required>
                    @error('email')
                        <div class="error_text"> <small>{{ $message }}</small> </div>
                    @enderror
                </div>
                <div class="form_item centerAlign">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value=" @php echo $user->phone ?? old('phone') @endphp " required>
                    @error('phone')
                        <div class="error_text"> <small>{{ $message }}</small> </div>
                    @enderror
                </div>
                <div class="form_item centerAlign">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" value=" @php echo $user->address ?? old('address') @endphp " required>
                    @error('address')
                        <div class="error_text"> <small>{{ $message }}</small> </div>
                    @enderror
                </div>

               
                <button class="expanded_btn centerAlign">UPDATE</button>
            </form>
        </div>
    </div>
    <!-- User MODAL FORM ENDS -->
   

@endsection 