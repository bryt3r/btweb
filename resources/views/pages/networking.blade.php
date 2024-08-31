@extends('outlay.app')

        @php
        $page_image = asset('assets/images/network').'/support_netwk.jpg';
        @endphp

<!-- all other page content  -->
@section('page_content')

            <div class="hero_container centerAlign">
                <div class="hero_back flex_row">
                    <div class="left_hero_back"></div>
                    <div class="hero_slides">
                        <div class="slide_container">
                            <img src="assets/images/network/netwk_pic1.jpg" alt="">
                        </div>
                        <div class="slide_container">
                            <img src="assets/images/network/netwk_pic2.jpg" alt="">
                        </div>
                        <div class="slide_container">
                            <img src="assets/images/network/netwk_pic3.jpg" alt="">
                        </div>
                        <div class="slide_container">
                            <img src="assets/images/network/netwk_pic4.jpg" alt="">
                        </div>
                        <div class="slide_container">
                            <img src="assets/images/network/netwk_pic5.jpg" alt="">
                        </div>
                        <div class="slide_container">
                            <img src="assets/images/network/netwk_pic6.jpg" alt="">
                        </div>
                        <div class="slide_container">
                            <img src="assets/images/network/netwk_pic7.jpg" alt="">
                        </div>
                    
                       
                    </div>

                </div>
                <div class="services_hero_front centerAlign">
                    <p>LAN NETWORKING</p>
                    <p>Installations & Support</p>
                    <button><a href="https://wa.me/{{config('website.phone_number')}}?text=Hi,%20I%20need%20a%20network%20quote">GET A QUOTE <i class="fa-brands fa-whatsapp"></i></a></button>

                </div>
            </div>

            <div class="intro_text centerAlign">
                We are ready to help you setup your Local Area Network Infrastructure, Computer Networking,
                 Printers and related peripherals
            </div>


            <div class="projects_wrapper centerAlign flex_row">
                <div class="project_box flex_col centerAlign" >
                    <div class="project_box_image">
                        <img src="assets/images/network/office_netwk.jpg" alt="">
                    </div>
                    <div class="project_box_body flex_col">
                        <h3>Offices & Computers</h3>
                        <div class="grey_color"><small> Connect your offices and computers together for file sharing and for Server - Client Setups. </small></div>
                    </div>
                </div> 
                <div class="project_box flex_col centerAlign" >
                    <div class="project_box_image">
                        <img src="assets/images/network/home_netwk.jpg" alt="">                    </div>
                    <div class="project_box_body flex_col">
                        <h3>Homes & Residentials</h3>
                        <div class="grey_color"><small> We can help you share your internet within your homes easily via WiFi or plug-ins.  </small></div>
                    </div>
                </div> 
                <div class="project_box flex_col centerAlign" >
                    <div class="project_box_image">
                        <img src="assets/images/network/camera_netwk.jpg" alt="">
                    </div>
                    <div class="project_box_body flex_col">
                         <h3>Network Cameras</h3>
                         <div class="grey_color"><small>We can deploy a LAN infrastructure to enable your Network/IP Cameras work effectively </small></div>
                    </div>
                </div> 
                <div class="project_box flex_col centerAlign" >
                    <div class="project_box_image">
                        <img src="assets/images/network/support_netwk.jpg" alt="">
                    </div>
                    <div class="project_box_body flex_col">
                         <h3>Maintenance</h3>
                         <div class="grey_color"><small> We are always available to help you keep your connections up and running </small></div>
                    </div>
                </div> 
            </div>
            
         @endsection  


