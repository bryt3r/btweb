@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')

@section('page_content')
   
            {{ ucfirst(Auth::user()->role)}} HOME
Lorem ipsum dolor sit, amet consectetur adipisicing elit.
 Error eveniet similique harum facere tempore adip
 isci commodi veniam. Porro, quaerat. Facer
 e expedita nostrum totam possimus maiores 
 consectetur eius aut ipsam, quibusdam animi. 
 Omnis delectus cupiditate ad fugiat nemo numqu
 am, officiis aperiam expedita unde mollitia n
 am quia. Expedita exercitationem asperiores maio
 res cum, sapiente labore rerum amet repudiandae quod 
 magni, eius unde, itaque animi doloremque? Est illo vo
 luptatem dignissimos, laboriosam dolor fugit praesenti
 um quia atque, dolorem asperiores nulla doloribus repe
 llat quae eum nihil sapiente quod a nobis. Nihil nisi 
 quibusdam alias voluptate mollitia dolor 
quisquam amet perferendis possimus minus, hic quos cumque ducimus!    
       
@endsection