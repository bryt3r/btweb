@extends('outlay.app')
<!-- all other page content  -->
@section('page_content')

<div class="error_content_wrapper centerAlign flex_col" >
        <br>
       <div class="error_text">
            Sorry the request cannot be processed - Bad Request(405)
        </div> 
        <br>
        <div class="error_image">
            <img src="{{ asset('assets/images/errors/404.png') }}" alt="">
        </div>

        <div class="error_page_button">
            <button class="outline_link_button">
                <a href="{{ URL::previous() }}"><i class="fa-solid fa-arrow-left"></i>  Back To Previous Page</a>
            </button>
        </div>

</div>
@endsection