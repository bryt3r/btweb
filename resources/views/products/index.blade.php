@extends('outlay.app')


<!-- all other page content  -->

@section('page_content')

                <div class="shop_header centerAlign" onclick="location.href='{{route('shop-home')}}';">
                    Beta - SHOP <i class="fa-solid fa-cart-shopping "></i>
                </div>
                <div class="search_form_wrapper articles_search centerAlign">
                    <form class="" action="{{route('product.search')}}" method="GET">
                        <div class="search_wrapper flex_row centerAlign">
                            <input class="search_input" type="search" name="search" id="">
                            <button class="search_btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
            <!-- Categories  -->
            <div class="shop_categories_wrapper flex_row centerAlign">

                <div onclick="location.href='{{route('product.show_category', ['category' => 'all'])}}';" class="blue_box_btn shop_categories_box flex_col">
                    <div class="service_icon">
                        <i class="fa-solid fa-border-all fa-2x"></i>
                    </div>
                    <p>All Products</p>
                </div>
                <div onclick="location.href='{{route('product.show_category', ['category' => 'computer'])}}';" class="blue_box_btn shop_categories_box flex_col">
                    <div class="service_icon">
                        <i class="fa-solid fa-display fa-2x"></i>
                    </div>
                    <p>Laptops </p>
                    <p>&</p>
                    <p>Computers</p>
                </div>
                <div onclick="location.href='{{route('product.show_category', ['category' => 'phone'])}}';" class="blue_box_btn shop_categories_box flex_col">
                    <div class="service_icon">
                        <i class="fa-solid fa-mobile-screen-button fa-2x"></i>
                    </div>
                    <p>Phones</p>
                </div>
                <div onclick="location.href='{{route('product.show_category', ['category' => 'accessory'])}}';" class="blue_box_btn shop_categories_box flex_col">
                    <div class="service_icon">
                        <i class="fa-solid fa-headset fa-2x"></i></i>
                    </div>
                    <p>Accessories</p>
                </div>
                

                
            </div>

@endsection