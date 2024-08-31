@extends('outlay.app')

        @php
        $page_image = asset('assets/images/surveillance').'/all_surv.jpg';
        @endphp

<!-- all other page content  -->
@section('page_content')
        <div class="hero_container centerAlign">
            <div class="hero_back flex_row">
                <div class="left_hero_back"></div>
                <div class="hero_slides">
                    <div class="slide_container">
                        <img src="assets/images/surveillance/surv_pic1.jpg" alt="">
                    </div>
                    <div class="slide_container">
                        <img src="assets/images/surveillance/surv_pic2.jpg" alt="">
                    </div>
                    <div class="slide_container">
                        <img src="assets/images/surveillance/surv_pic3.jpg" alt="">
                    </div>
                                        
                </div>

            </div>
            <div class="services_hero_front centerAlign">
                <p>CCTV surveillance</p>
                <p>Installations & Support</p>
                <button><a href="https://wa.me/{{config('website.phone_number')}}?text=Hi,%20I%20need%20a%20cctv%20quote">GET A QUOTE <i class="fa-brands fa-whatsapp"></i></a></button>

            </div>
        </div>

        <div class="intro_text">
            <h3>Contact us for your CCTV Installations :</h3>
        </div>

        <div class="projects_wrapper centerAlign flex_row">
            <div class="project_box flex_col centerAlign" >
                <div class="project_box_image">
                    <img src="assets/images/surveillance/shop_surv.jpg" alt="">
                </div>
                <div class="project_box_body flex_col">
                    <h3>Offices, Stores & Shops Surveillance</h3>
                    <div class="grey_color"><small> Keep an extra eye on your business and inventory even while you are away </small></div>
                </div>
            </div> 
            <div class="project_box flex_col centerAlign" >
                <div class="project_box_image">
                    <img src="assets/images/surveillance/home_surv.jpg" alt="">
                </div>
                <div class="project_box_body flex_col">
                    <h3>Residential Surveillance</h3>
                    <div class="grey_color"><small> Add a level of security to your home and environment with surveillance </small></div>
                </div>
            </div> 
            <div class="project_box flex_col centerAlign" >
                <div class="project_box_image">
                    <img src="assets/images/surveillance/farm_surv.jpg" alt="">
                </div>
                <div class="project_box_body flex_col">
                     <h3>Farm Monitoring</h3>
                     <div class="grey_color"><small> Monitor your farms, either crops or livestock </small></div>
                </div>
            </div> 
            <div class="project_box flex_col centerAlign" >
                <div class="project_box_image">
                    <img src="assets/images/surveillance/all_surv.jpg" alt="">
                </div>
                <div class="project_box_body flex_col">
                     <h3>General Surveillance</h3>
                     <div class="grey_color"><small> Wherever you require surveillance, we are ready to install... </small></div>
                </div>
            </div> 
        </div>

@endsection