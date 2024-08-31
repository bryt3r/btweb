@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')


<!-- all other page content  -->

@section('page_content')

            <div class="items_header flex_row">
                <div class="guard_line"></div>
                <p>{{$category??'Products'}}</p>
                <div class="guard_line"></div>
            </div>


            <div class="centerAlign">
                <form action="{{route('products.list') }}" method="POST" >
                    @csrf
                        <p class=" centerAlign"> Get List Of Products</p>
                        <div class="filter_wrapper flex_row centerAlign">
                            <div class="">

                                <select class="filter_select" name="category" id="category" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)

                                    <option value="{{$category->name}}" @selected( old('category',$product->category??null) == $category->name)>{{strtoupper($category->name)}}</option>
  
                                    @endforeach
                                </select>

                                @error('category')
                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                @enderror
                            </div>
                            <button class="" type="submit">Generate List</button>
                        </div>
                </form>
            </div>

            <!-- ITEMS  -->
            <div class="shop_items_wrapper flex_col">


                <div class="centerAlign">
                    <form action="{{route('product.new') }}" method="" >
                            <p class=" centerAlign"> Add New Product</p>
                            <div class="filter_wrapper flex_row centerAlign">
                                <div class="">

                                    <select class="filter_select" name="category" id="category" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
    
                                        <option value="{{$category->name}}" @selected( old('category',$product->category??null) == $category->name)>{{strtoupper($category->name)}}</option>
      
                                        @endforeach
                                    </select>

                                    @error('category')
                                    <div class="error_text"> <small>{{ $message }}</small> </div>
                                    @enderror
                                </div>
                                <button class="" type="submit">NEW</button>
                            </div>
                    </form>
                </div>

                <div class="items_group centerAlign flex_col">

                    @if (count($products) < 1)

                    {!! '<div> No Products Available </div>' !!}    
                   
                    @else

                    @foreach ($products as $product)

                            @php
                                $bag = 'form'.$product->id;
                            @endphp
                            <!-- SET PRICE MODAL -->
                            @can('set_price', $product)
                            <div id="modal" class="modal_wrapper @php echo count($errors->$bag) > 0   ? 'show_block' : ''; @endphp ">
                                <div class="modal_header">
                                
                                </div>
                                <div class="modal_content centerAlign">
                                    <span class="modal_close_btn">&times;</span>
                                    <p><h1>SET PRICE</h1></p> 
                                    <form action={{route('product.set_price', ['id'=>$product->id])}} class="flex upload_form" method="POST">
                                        
                                        @csrf
                                        
                                        <div class="form_item centerAlign">
                                            <label for="cost_price">Cost Price</label>
                                            NGN <input type="number" step="0.01" name="cost_price" id="cost_price" value= {{$product->costprice ?? intval(old('cost_price')) }} required>
                                            @error('cost_price', $bag)
                                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                            @enderror
                                        </div>
        
                                        <div class="form_item centerAlign">
                                            <label for="selling_price">Selling Price</label>
                                            NGN <input type="number" step="0.01" name="selling_price" id="selling_price" value= {{$product->sellingprice ?? intval(old('selling_price')) }} >
                                            @error('selling_price', $bag)
                                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                            @enderror
                                        </div>

                                        {{-- <div class="form_item centerAlign">
                                            <label for="selling_price">Selling Price</label>
                                            NGN <input type="text" name="selling_price" id="selling_price" value=" @php echo number_format($product->costprice, 2) ?? intval(old('selling_price')) @endphp ">
                                            @error('selling_price', $bag)
                                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                            @enderror
                                        </div> --}}

                                        <div class="form_item centerAlign">
                                            <label for="discount">Discount</label>
                                            <input disabled type="text" name="discount" id="discount" value=" @php echo $product->discount * 100 ?? intval(old('discount')) @endphp %">
                                            @error('discount', $bag)
                                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                            @enderror
                                        </div>

                                        <div class="form_item centerAlign">
                                            <label for="sale_price">Sale Price</label>
                                            NGN <input type="number" step="0.01" name="sale_price" id="sale_price" value= {{$product->saleprice ?? intval(old('sale_price')) }} >
                                            @error('sale_price', $bag)
                                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                            @enderror
                                        </div>

                                        <button class="expanded_btn centerAlign">SET PRICE</button>
                                    </form>
                                </div>
                            </div>
                            @endcan
                            <!-- SET PRICE MODAL ENDS -->


                            <div class="admin_item_box flex_col" >
                                <div class="admin_item flex_row">
                                    <div class="item_image">
                                        <img src="{{asset('uploads/product_images')}}/@php echo $product->images[0]->filename??'product.jpg' @endphp " alt="">
                                    </div>

                                    <div class="item_details flex_col">
                                        <a href="{{route('product.show', ['slug' => $product->slug])}}">
                                        <p class="item_main_title"> {{ Str::limit( $product->title, '35' ) }}</p>
                                        </a> 
                                        <p class=" product_{{$product->condition}} ">{{$product->condition == 'used' ? 'Pre-Owned' : 'New'}} <sup class="{{$product->condition.'_badge'}}">*</sup> <span class="page_views">{{$product->visits_count}} page views</span></p>
                            
                                        <ul class="product_price_group">
                                        @if ($product->discounted)
                                        <li><h3>NGN {{number_format($product->saleprice, 2)}}</h3></li>  
                                        <li><small> <s> NGN {{number_format($product->sellingprice, 2)}} </s> <span class="error_text"> {{number_format(($product->discount * 100), 0)}}% off !!!</span> </small></li>   
                                        @else
                                        <li><h3><p class="item_price">NGN {{number_format($product->sellingprice, 2)}}</p></h3></li>
                                        @endif
                                        </ul> 
                                        @can('set_price', $product)
                                            <p class=""><button id="modal_open_btn">Set Price</button></p>
                                        @endcan  
                                        
                                    </div>
                                </div>
                                <div class="product_admin_panel flex_row centerAlign">
                                    <div class="product_admin_panel_btn" onclick="location.href='{{route('product.edit', ['id' => $product->id])}}';">
                                         <i class="fa-solid fa-pencil"></i> Edit
                                    </div> 
                                    @can('list', $product)
                                  
                                        <form action="{{ route('product.mark_listed', ['id' => $product->id])}}" method="post">
                                            @csrf
                                            <button class="product_admin_panel_btn {{$product->is_listed ? 'product_admin_panel_active' : ''}}" >
                                                <i class="fa-solid fa-upload"></i>  {{$product->is_listed ? 'Listed' : 'Unlisted'}}
                                            </button>
                                        </form>
                                    @endcan

                                    @can('sold', $product)
                                        <form action="{{ route('product.mark_sold', ['id' => $product->id])}}" method="post">
                                            @csrf
                                            <button class="product_admin_panel_btn {{$product->is_sold ? 'product_admin_panel_active' : ''}}">
                                                <i class="fa-solid fa-sack-dollar"></i> {{$product->is_sold ? 'Sold' : 'UnSold'}}
                                            </button>
                                        </form>
                                    @endcan

                                    @can('delete', $product)
                                    <form onsubmit = "return confirm('Do you want to delete?');" action="{{ route('product.delete', ['id'=>$product->id])}}" method="post">
                                        @csrf
                                        <button class="error_text product_admin_panel_btn ">
                                            <i class="fa-solid fa-trash-can"></i> Delete
                                        </button>
                                    </form>  
                                    @endcan
                                
                                </div>
                            </div>

                    @endforeach
                    
                    @endif
                    
                    {{ $products->links() }}

                </div>
            </div>

@endsection