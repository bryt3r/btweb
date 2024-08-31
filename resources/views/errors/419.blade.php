@extends('outlay.app')
<!-- all other page content  -->
@section('page_content')

<div class="error_content_wrapper centerAlign flex_col" >

    <div class="error_text">
        Expired Session, Please Log In.
     </div> 

     <div class="error_image">
        <img src="{{ asset('assets/images/errors/419.png') }}" alt="">
    </div>

     <div class="error_page_button flex_row">
        <button class="outline_link_button">
            <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-left"></i>  Back To Previous Page</a>
        </button>
       
        <button class="">
            <a href="{{ route('login') }}">Login</a>
        </button>
     </div>


</div>


@endsection