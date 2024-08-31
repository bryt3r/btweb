@extends('outlay.app')
<!-- all other page content  -->
@section('page_content')


<div class="error_content_wrapper centerAlign flex_col" >

     <div class="error_text">
        Work In Progress, We are having some difficulty getting you the page,
        Please Bear With Us - 500
     </div> 

     <div class="error_image centerAlign">
        <img src="{{ asset('assets/images/errors/500.png') }}" alt="">
     </div>

     <div class="error_page_button">
         <button class="outline_link_button">
            <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-left"></i>  Back To Previous Page</a>
         </button>
     </div>


</div>

@endsection