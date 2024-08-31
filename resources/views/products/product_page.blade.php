@extends('outlay.app')


<!-- all other page content  -->

@section('page_content')

            <div class="shop_header centerAlign" onclick="location.href='{{route('shop-home')}}';">
                Beta - SHOP <i class="fa-solid fa-cart-shopping "></i>
                </a>
            </div>
            <!-- ITEM  -->
            <div class="search_form_wrapper articles_search centerAlign">
                <form class="" action="{{route('product.search')}}" method="GET">
                    <div class="search_wrapper flex_row centerAlign">
                        <input class="search_input" type="search" name="search" id="">
                        <button class="search_btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>

            <div class="dash_back_icon" onclick="location.href='{{ URL::previous() }}';"> <h2><i class="fa-solid fa-arrow-left"></i> Back </h2> </div>

            <div class="item_page_upper_wrapper centerAlign flex_col">
                <div class="item_page_image_wrapper centerAlign flex_col">
                    <div><h1>{{$product->title}}</h1></div>
                    
                        @if (count($product->images) < 1)
                            <div class="item_image_container">
                                <div class="imageSlide activeSlide">
                                    <img src="{{asset('uploads/product_images')}}/product.jpg">
                                </div>
                            </div>  
                        @else
                            <div class="item_image_container">
                            @foreach ($product->images as $image)
                            <div class="imageSlide {{ ($image->is_main || $product->images[0] == $image) ? 'activeSlide' : '' }} ">
                                <img src="{{asset('uploads/product_images')}}/{{$image->filename}}">
                            </div>  
                            @endforeach
                            </div>
                        @endif
                    
                    <div class="item_image_thumbnails flex_row">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($product->images as $image)
                             @php $i++ @endphp
                            <div onclick="showSlide({{$i}})" class="imageThumb  {{ $image->is_main ? 'activeThumb' : '' }} ">
                                <img src="{{asset('uploads/product_images')}}/{{$image->filename}}">
                            </div>
                        @endforeach

                    </div>
                </div>
                @php
                    $product_url = route('product.show_admin', ['identifier' => $product->identifier]);
                @endphp
                 <!-- <a href="https://wa.me/2348162596229">  -->
                {{-- <button class="item_page_mobile_order_button centerAlign" onclick="location.href='https:\/\/wa.me/2348162596229?text=Hi,%20I%20am%20interested%20in%20this%20item%20%20{{$product_url}}';">
                    Place Order <i class="fa-brands fa-whatsapp "></i>
                </button> --}}
                 <!-- </a> -->

                <div class="item_page_details_wrapper centerAlign flex_col">
                    <p>Description</p>
                    
                   
                    <p class="item_main_title">{!!$product->description!!}</p>
                    @if ($product->discounted)
                    <h3>NGN {{number_format($product->saleprice, 2)}}</h3>
                   <small> <s> NGN {{number_format($product->sellingprice, 2)}} </s> <span class="error_text"> {{number_format(($product->discount * 100), 0)}}% off !!!</span> </small> 
                        
                    @else
                        <h3><p class="item_price">NGN {{number_format($product->sellingprice, 2)}}</p></h3>
                    @endif
                         <p>
                            <button class="item_page_pc_order_button" onclick="location.href='https:\/\/wa.me/{{config('website.phone_number')}}?text=Hi,%20I%20am%20interested%20in%20this%20item%20%20{{$product_url}}';">
                                Place Order <i class="fa-brands fa-whatsapp "></i>
                            </button>
                        </p>
                </div>

            </div>
@endsection