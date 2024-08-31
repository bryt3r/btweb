@extends('outlay.app')


<!-- all other page content  -->
@section('page_content')

            <div class="hero_container centerAlign">
                <div class="hero_back flex_row">
                    <div class="left_hero_back"></div>
                    <img src="assets/images/contact_us.png" alt="">
                </div>
                <div class="services_hero_front centerAlign">
                    <p>Contact Us</p>
                    <p>For Your</p>
                    <p>Installations & Support</p>
                </div>
            </div>

            <div class="contacts_list_wrapper centerAlign flex_row">
                <div class="contacts_list flex_col">
                    <p><i class="fa-solid fa-phone "></i> : +{{config('website.phone_number')}}</p>
                    <p> <a href="https://wa.me/{{config('website.phone_number')}}?text=Hello,%20Beta"> <i class="fa-brands fa-whatsapp-square "></i> WhatsApp: +{{config('website.phone_number')}} </a> </p>
                    <p><i class="fa-solid fa-envelope "></i> : {{config('website.email')}}</p>
                    <a href="https://instagram.com/betatechnicians" target="_blank">
                        <p><i class="fa-brands fa-instagram-square "></i> : @betatechnicians</p>
                    </a>
                    <p><i class="fa-brands fa-twitter-square "></i> : @betatechnicians</p>
                    <p><i class="fa-brands fa-facebook-square "></i> : betatechnicians</p>
                </div>


                @php $section = "contact us page"; @endphp

                @include('inc.contact_form')

            </div>
            
         @endsection  


