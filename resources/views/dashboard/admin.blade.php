@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')

@section('page_content')
   
Admin HOME
          
@endsection