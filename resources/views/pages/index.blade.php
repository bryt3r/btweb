
        @extends('outlay.app')
        <!-- all other page content  -->
        @section('page_content')
            <div class="hero_container centerAlign">
                <div class="hero_back flex_row">
                    <div class="left_hero_back"></div>
                    <img src="assets/images/tch.jpg" alt="">
                </div>
                <div class="hero_front">
                    <p>Welcome To Beta Technicians</p>
                    <p> <h4>IT & TECHNICAL SERVICES PROVIDER</h4></p>
                    <h5>IT - POWER - SURVEILLANCE </h5>
                    <button><a href="{{ route('contact-us') }}">CONTACT US</a></button>
                </div>
            </div>
            <!-- SERVICES  -->
            <div id="services" class="services_wrapper flex_col">
                <a href="" name="services"></a>
                <div class="services_header">
                    <div class="guard_line"></div>
                    <p>Our Services</p>
                    <div class="guard_line"></div>
                </div>
                <div class="services_group centerAlign flex_row">

                    <div onclick="location.href='./solar';" class="services_box blue_box_btn flex_col">
                        <div class="service_icon">
                            <i class="fa-solid fa-charging-station fa-2x"></i>
                        </div>
                        <p>INVERTER | SOLAR INSTALLATIONS</p>
                    </div>

                    <div onclick="location.href='./networking';" class="services_box blue_box_btn flex_col">
                        <div class="service_icon">
                            <i class="fa-solid fa-network-wired fa-2x"></i>
                        </div>
                        <p>LAN | COMPUTER NETWORKING</p>
                    </div>

                    <div onclick="location.href='./shop';" class="services_box blue_box_btn flex_col">
                        <div class="service_icon">
                            <i class="fa-solid fa-money-check-dollar fa-2x"></i>
                        </div>
                        <p>DEVICE SALES</p>
                        <p>& </p>
                        <p>PROCUREMENTS</p>
                    </div>


                    <div onclick="location.href='./surveillance';" class="services_box blue_box_btn flex_col">
                        <div class="service_icon">
                            <i class="fa-solid fa-video fa-2x"></i>
                        </div>
                        <p>CCTV SURVEILLANCE INSTALLATIONS</p>
                    </div>

                </div>
            </div>
            <!-- VALUES -->

            <div class="values_wrapper centerAlign flex_col">
                <div class="values_header flex_row">
                    <div class="guard_line"></div>
                    <p>Our Core Values</p>
                    <div class="guard_line"></div>
                </div>
                <div class="values_group flex_row ">
                    <div class="value_box flex_col centerAlign">
                        <i class="fa-solid fa-user-check fa-2x"></i>
                        <p>Customer-Focused</p>
                        <div class="value_text">
                            Our choices and decisions, from quotes to installation and maintenance,
                             are usually for the good of our customers.
                        </div>
                    </div>
                    <div class="value_box flex_col centerAlign">
                        <i class="fa-solid fa-hand-holding-dollar fa-2x"></i>
                        <p>Value For Money</p>
                        <div class="value_text">Either you are making a purchase or you employ any of our
                             services, we strive to give you value for every coin you spend.
                        </div>
                    </div>
                    <div class="value_box flex_col centerAlign">
                        <i class="fa-solid fa-screwdriver-wrench fa-2x"></i>
                        <p>Technical Expertise</p>
                        <div class="value_text">We are good at what we do. Nevertheless, we regularly upskill and update our expertise 
                            to keep up with innovations and industry standard.
                        </div>
                    </div>
                </div>
            </div>

            <!-- GALLERY  -->
            <a href="{{ route('projects-home') }}" >
              
                <div class="view_gallery_wrapper centerAlign">
                    <div class="view_gallery_image">
                        <img src="assets/images/gallery_grid.jpg" alt="">
                    </div>
    
                    <div class="view_gallery_overlay centerAlign flex_row">
                        <div class="guard_line"></div>
                        <p>View Our Gallery</p>
                        <div class="guard_line"></div>
                    </div>
    
                </div>
    

            </a>

           
            <!-- REVIEWS  -->
            <!-- <div class="reviews_wrapper centerAlign flex_col">
                <div class="reviews_header flex_row">
                    <div class="guard_line"></div>
                    <p>Feedback</p>
                    <div class="guard_line"></div>
                </div>
                <div class="reviews_group flex_row">
                    <div class="review_box">REVIEW</div>
                    <div class="review_box">REVIEW</div>
                    <div class="review_box">REVIEW</div>
                    <div class="more_reviews">View More ></div>
                </div>
            </div>  -->

    @endsection
       