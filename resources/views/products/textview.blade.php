@extends('outlay.app')


<!-- all other page content  -->

@section('page_content')

            <div class="shop_header centerAlign" onclick="location.href='{{route('shop-home')}}';">
                Beta - SHOP <i class="fa-solid fa-cart-shopping "></i>
                </a>
            </div>
            <div class="dash_back_icon" onclick="location.href='{{ URL::previous() }}';"> <h2><i class="fa-solid fa-arrow-left"></i> Back </h2> </div>

            <div class="items_header flex_row">
                <div class="guard_line"></div>
                <p>{{$category??'Products'}}</p>
                <div class="guard_line"></div>
            </div>
           
            <!-- ITEMS  -->
            <div class="shop_items_wrapper flex_col">

                <div class="items_group centerAlign flex_col">

                    @if (count($products) < 1)

                    {!! '<div> No Products Available </div>' !!}    
                   
                    @else
                    <p>This List was auto-generated on {{$date}}.</p>
                    <br>
                    -----
                    <br>
                    <br>
                    @foreach ($products as $product)
                    
                    <div class="" >
                        <div class=" flex_col">
                            <p class="item_main_title"> {{ $product->title }}</p>
                            <p class="">{!!$product->description!!}</p>
                            <p class="item_price">NGN {{number_format($product->sellingprice, 2)}}</p>
                        </div>
                    </div>
                    -----
                    <br>
                    <br>
                    @endforeach
                    
                    @endif
                    
                    {{ $products->appends(Request::all())->links() }}
                </div>
                
            </div>

@endsection