@extends('outlay.app')


<!-- all other page content  -->

@section('page_content')

            <div class="shop_header centerAlign" onclick="location.href='{{route('shop-home')}}';">
                Beta - SHOP <i class="fa-solid fa-cart-shopping "></i>
                </a>
            </div>
            <div class="search_form_wrapper articles_search centerAlign">
                <form class="" action="{{route('product.search')}}" method="GET">
                    <div class="search_wrapper flex_row centerAlign">
                        <input class="search_input" type="search" name="search" id="">
                        <button class="search_btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
            <div class="items_header flex_row">
                <div class="guard_line"></div>
                <p>{{$category??'Products'}}</p>
                <div class="guard_line"></div>
            </div>
            @php
                $brands = $brands??null;
            @endphp
            @if ($brands != null)
                @if ($category!='ALL')
                    <form class="" action="{{route('product.filter_brand')}}" method="GET">
                        <div class="filter_wrapper centerAlign flex_row">
                            <div>
                                <select class="filter_select" name="brand" id="brand" required>
                                        <option value="">Filter By Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{$brand->name}}" @selected( old('brand',$brand_filter??null) == $brand->name)>{{strtoupper($brand->name)}}</option>
                                        @endforeach
                                </select>
                                @error('category')
                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                @enderror
                                <input type="hidden" name="category" value="{{$category??null}}">
                            </div>
                            <button class="filter_btn"><i class="fa-solid fa-filter"></i></button>
                        </div>
                    </form> 
                @endif
             @endif
            <!-- ITEMS  -->
            <div class="shop_items_wrapper flex_col">

                <div class="items_group centerAlign flex_col">

                    @if (count($products) < 1)

                    {!! '<div> No Products Available </div>' !!}    
                   
                    @else
                    @foreach ($products as $product)
                    
                    <div class="item_box flex_row" onclick="location.href='{{route('product.show', ['slug' => $product->slug])}}';">
                        <div class="item_image">
                            <img src="{{asset('uploads/product_images')}}/@php echo $product->images[0]->filename??'product.jpg' @endphp " alt="">
                        </div>

                        <div class="item_details flex_col">
                            <p class="item_main_title"> {{ Str::limit( $product->title, '35' ) }}</p>
                            <p class="product_brand"> <small>{{strtoupper($product->brand) }} </small> </p>
                            <p class=" product_{{$product->condition}} "> <small> {{$product->condition == 'used' ? 'Pre-Owned' : 'New'}} </small> <sup class="{{$product->condition.'_badge'}}">*</sup></p>
                            
                            <ul class="product_price_group">
                            @if ($product->discounted)
                              <li><h3>NGN {{number_format($product->saleprice, 2)}}</h3></li>  
                              <li><small> <s> NGN {{number_format($product->sellingprice, 2)}} </s> </small></li>   
                              <li><small> <span class="error_text"> {{number_format(($product->discount * 100), 0)}}% off !!!</span> </small></li>   
                              @else
                              <li><h3><p class="item_price">NGN {{number_format($product->sellingprice, 2)}}</p></h3></li>
                            @endif
                            </ul>   
                            
                        </div>
                    </div>
                    
                    @endforeach
                    
                     @endif
                    
                     {{ $products->links() }}
                </div>
                
            </div>

@endsection