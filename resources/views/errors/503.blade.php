@extends('outlay.app')
<!-- all other page content  -->
@section('page_content')


<div class="error_content_wrapper centerAlign flex_col" >

    <div class="error_text">
        Server Busy, We are Temporarily Unavailable,
        Please Try Again In A While - 503
     </div> 

     <div class="error_image">
        <img src="{{ asset('assets/images/errors/500.png') }}" alt="">
     </div>

     <div class="error_page_button">
         <button class="outline_link_button">
            <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-left"></i>  Back To Previous Page</a>
         </button>
     </div>


</div>

@endsection