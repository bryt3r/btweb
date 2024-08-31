@extends('outlay.app')

            @php
                $page_image = asset('assets/images/solar').'/reliable.png';
            @endphp
<!-- all other page content  -->
@section('page_content')

            <div class="hero_container centerAlign">
                <div class="hero_back flex_row">
                    <div class="left_hero_back"></div>
                    <div class="hero_slides">
                        <div class="slide_container">
                            <img src="assets/images/solar/pic1.jpg" alt="">
                        </div>
                        <div class="slide_container">
                            <img src="assets/images/solar/pic2.jpg" alt="">
                        </div>
                        <div class="slide_container">
                            <img src="assets/images/solar/pic3.jpg" alt="">
                        </div>
                        <div class="slide_container">
                            <img src="assets/images/solar/pic4.jpg" alt="">
                        </div>
                        <div class="slide_container">
                            <img src="assets/images/solar/pic5.jpg" alt="">
                        </div>
                        <div class="slide_container">
                            <img src="assets/images/solar/pic7.jpg" alt="">
                        </div>
                        <div class="slide_container">
                            <img src="assets/images/solar/pic8.jpg" alt="">
                        </div>
                        <div class="slide_container">
                            <img src="assets/images/solar/pic9.jpg" alt="">
                        </div>
                        <div class="slide_container">
                            <img src="assets/images/solar/pic10.jpg" alt="">
                        </div>
                        <div class="slide_container">
                            <img src="assets/images/solar/pic11.jpg" alt="">
                        </div>
                

                    </div>

                </div>
                <div class="services_hero_front centerAlign">
                    <p>Solar - Inverter</p>
                    <p>Installations & Maintenance</p>
                    <button><a href="https://wa.me/{{config('website.phone_number')}}?text=Hi,%20I%20need%20a%20custom%20solar%20package">GET A CUSTOM QUOTE <i class="fa-brands fa-whatsapp"></i></a></button>

                </div>
            </div>

            <!-- PACKAGES -->
            <div class="solar_packages_wrapper flex_col">

                <div class="intro_text">
                    Solar Energy is a renewable source of energy which can be utilized to provide electrical energy to 
                    power your everyday appliances.
                    You can choose to have a solar-inverter installation to power your appliances,
                    or choose to have appliances that are directly powered by solar:
                   
                </div>
                    
                <p><i class="fa-solid fa-arrow-right"></i> Solar Powered Water Pumping Machine</p> 
                <p><i class="fa-solid fa-arrow-right"></i> Solar Powered Water Heater</p> 
                <p><i class="fa-solid fa-arrow-right"></i> Solar Powered Freezer</p> 
                <p><i class="fa-solid fa-arrow-right"></i> Solar Powered Surveillance Camera</p> 

                <br>
                
                <div class="flex_col centerAlign">
                    <div class="solar_pros centerAlign">
                        <img src="assets/images/solar/why_solar.png" alt="">
                    </div>
                    <div class="solar_pros_group flex_row centerAlign">
                        <div class="solar_pros centerAlign">
                            <img src="assets/images/solar/solar_savings.png" alt="">
                        </div>
                        <div class="solar_pros centerAlign">
                            <img src="assets/images/solar/reliable.png" alt="">
                        </div>
                        <div class="solar_pros centerAlign">
                            <img src="assets/images/solar/near_zero.png" alt="">
                        </div>
                    </div>
                    <br>
                    <div class="solar_pros centerAlign">
                        <button class="outline_link_button"><a href="/blog">Visit Our Blog To Learn More <i class="fa-solid fa-arrow-right"></i></a></button>
                    </div>
                    <br>
                    <div class="intro_text" >

                        <p> Feel free to <button class="outline_link_button"><a href="https://wa.me/{{config('website.phone_number')}}?text=Hi,%20I%20need%20a%20custom%20solar%20package">Contact Us <i class="fa-brands fa-whatsapp"></i></a></button>
                            for a solar installation setup that will cater for your energy needs or one fits your budget ! </p>
                        <p> You may also choose one of the common packages below </p>
                   
                    </div>
                    
                </div>
                   
                <div class="packages_header flex_row">
                    <div class="guard_line"></div>
                    <p>Common Inverter Packages</p>
                    <div class="guard_line"></div>
                </div>
                <div id="common_packages" class="solar_packages_group flex_row">

                    <div class="package_box flex_col">
                        <div class="package_card">
                            <div class="package_card_front flex_col">
                                <div class="package_header purple">
                                    REMOTE WORKER
                                </div>
                                <div class="package_image centerAlign">
                                    <img src="assets/images/solar/remote_worker.png" alt="">
                                </div>

                                <div class="package_body flex_col">
                                    <p class="package_main_title">Components</p>
                                    <ul class="fa-ul flex_col">
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>Solar Panels
                                        </li>
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>PWM Charge
                                            Controller
                                        </li>
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>Modified
                                            Sine-Wave Inverter</li>
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>Battery</li>
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>Installation
                                            Accessories
                                        </li>
                                    </ul>
                                </div>
                                <div class="flipcard_btn centerAlign purple_border">
                                    View More <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                </div>
                            </div>
                            <div class="package_card_back flex_col">
                                <div class="package_header purple">
                                    REMOTE WORKER
                                </div>

                                <div class="package_body flex_col">
                                    <p class="package_main_title">Load Capacity</p>
                                    <hr>
                                    <ul class="fa-ul flex_col">
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>2x
                                            Energy-Saving Bulbs</li>
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span> 1x
                                            Energy-Saving Fan </li>
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>1x Laptop</li>
                                    </ul>
                                </div>
                                <br>
                                <small>*the package can be tweaked to accomodate user's requirement</small>
                                <br>
                                <small>**intermittent usage and Energy-Saving appliances could allow for extended runtime</small>
                                
                                <div class="flipcard_btn centerAlign purple_border">
                                    <i class="fa-solid fa-arrow-left"></i> Go Back
                                </div>

                            </div>
                        </div>

                        <div class="package_button purple" onclick="location.href='https\:\/\/wa.me/{{config('website.phone_number')}}?text=Hi,%20I%20need%20the%20estimate%20for%20remote%20package';">

                            Get Estimate <i class="fa-brands fa-whatsapp"></i>

                        </div>
                    </div>
                    <div class="package_box flex_col">
                        <div class="package_card">
                            <div class="package_card_front flex_col">
                                <div class="package_header green">
                                    BASIC
                                </div>

                                <div class="package_image centerAlign">
                                    <img src="assets/images/solar/basic.png" alt="">
                                </div>

                                <div class="package_body flex_col">
                                    <p class="package_main_title">Components</p>
                                    <ul class="fa-ul flex_col">
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>Solar Panels
                                        </li>
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>PWM Charge
                                            Controller
                                        </li>
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>Modified
                                            Sine-Wave Inverter</li>
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>Battery</li>
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>Installation
                                            Accessories
                                        </li>
                                    </ul>
                                </div>
                                <div class="flipcard_btn centerAlign green_border">
                                    View More <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                </div>
                            </div>
                            <div class="package_card_back flex_col">
                                <div class="package_header green">
                                    BASIC
                                </div>

                                <div class="package_body flex_col">
                                    <p class="package_main_title">Load Capacity</p>
                                    <hr>
                                    <ul class="fa-ul flex_col">
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>4x
                                            Energy-Saving Bulbs</li>
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span> 2x
                                            Energy-Saving Fans </li>
                                            <li><span class="fa-li"><i class="fas fa-check-square"></i></span>Appliances(Fridge etc) within design capacity</li>
                                    </ul>
                                </div>
                                
                                <br>
                                <small>*the package can be tweaked to accomodate user's requirement</small>
                                <br>
                                <small>**other suitable appliances within load capacity can be used</small>
                                <br>
                                <small>***intermittent usage and Energy-Saving appliances could allow for extended runtime</small>
                                
                                <div class="flipcard_btn centerAlign green_border">
                                    <i class="fa-solid fa-arrow-left"></i> Go Back
                                </div>
                            </div>
                        </div>

                        <div class="package_button green" onclick="location.href='https\:\/\/wa.me/{{config('website.phone_number')}}?text=Hi,%20I%20need%20the%20estimate%20for%20basic%20package';">

                            Get Estimate <i class="fa-brands fa-whatsapp"></i>

                        </div>
                    </div>
                    <div class="package_box flex_col">
                        <div class="package_card">
                            <div class="package_card_front flex_col">
                                <div class="package_header blue">
                                    STANDARD
                                </div>
                                <div class="package_image centerAlign">
                                    <img src="assets/images/solar/standard.png" alt="">
                                </div>

                                <div class="package_body flex_col">
                                    <p class="package_main_title">Components</p>
                                    <ul class="fa-ul flex_col">
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>Solar Panels
                                        </li>
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>MPPT Charge
                                            Controller
                                        </li>
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>Pure Sine-Wave
                                            Inverter</li>
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>Batteries</li>
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>Installation
                                            Accessories
                                        </li>
                                    </ul>
                                </div>
                                <div class="flipcard_btn centerAlign blue_border">
                                    View More <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                </div>
                            </div>
                            <div class="package_card_back flex_col">
                                <div class="package_header blue">
                                    STANDARD
                                </div>

                                <div class="package_body flex_col">
                                    <p class="package_main_title">Load Capacity</p>
                                    <hr>
                                    <ul class="fa-ul flex_col">
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>10x
                                            Energy-Saving Bulbs</li>
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span> 3x
                                            Energy-Saving Fans </li>
                                        <li><span class="fa-li"><i class="fas fa-check-square"></i></span>Appliances(Freezer etc) within design capacity</li>
                                    </ul>
                                </div>
                                
                                <br>
                                <small>*the package can be tweaked to accomodate user's requirement</small>
                                <br>
                                <small>**other suitable appliances within load capacity can be used</small>
                                <br>
                                <small>***intermittent usage and Energy-Saving appliances could allow for extended runtime</small>
                                
                                <div class="flipcard_btn centerAlign blue_border">
                                    <i class="fa-solid fa-arrow-left"></i> Go Back
                                </div>
                            </div>
                        </div>

                        <div class="package_button blue" onclick="location.href='https\:\/\/wa.me/{{config('website.phone_number')}}?text=Hi,%20I%20need%20the%20estimate%20for%20standard%20package';">

                            Get Estimate <i class="fa-brands fa-whatsapp"></i>

                        </div>
                    </div>


                </div>

                <button><a href="https://wa.me/{{config('website.phone_number')}}?text=Hi,%20I%20need%20a%20custom%20solar%20package">GET A CUSTOM PACKAGE <i class="fa-brands fa-whatsapp"></i></a></button>
     @endsection