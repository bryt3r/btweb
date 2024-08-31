@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')

         @php
           
            if ($product ?? null) {
                $action = route('product.update', ['id'=>$product->id]);
                $legend = 'Edit';
                $button = 'Update';
            }else {
                $action = route('product.store');
                $legend = 'New';
                $button = 'Add';
            }
        @endphp
       

            <!-- all other page content  -->
        @section('page_content')

        @if (Auth::user()->is_admin)
            <div class="dash_back_icon" onclick="location.href='{{ route('products.manage') }}';"> <h2><i class="fa-solid fa-arrow-left"></i> Products </h2> </div>
        @endif

            <div class="create_article_wrapper centerAlign">
                <div class="create_form flex_col centerAlign">
                    <div class="form_title centerAlign">

                    </div>
                    <form action="{{$action}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <legend class="form_item centerAlign"> {{$legend}} Product</legend>
                            <div class="form_item centerAlign">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" value="{{$product->title ?? old('title')}}" required >
                            @error('title')
                            <div class="error_text"> <small>{{ $message }}</small> </div>
                            @enderror
                            </div>
                            <div class="form_item centerAlign">
                                 <label for="category">Category</label>
                               
                                @if ($product->id ?? null)

                                <select class="filter_select" name="category" id="category" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)

                                    <option value="{{$category->name}}" @selected( old('category',$product->category??null) == $category->name)>{{strtoupper($category->name)}}</option>
  
                                    @endforeach
                                </select> 
                                @else
                                <input readonly type="text" name="category" id="" value="{{strtoupper($product->category??$category)}}" required>
                            
                                @endif
                                

                                @error('category')
                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                @enderror
                            </div>

                            <div class="form_item centerAlign">
                                <label for="brand">Brand</label>
                                <select name="brand" id="brand" required>
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)

                                    <option value="{{$brand->name}}" @selected( old('brand',$product->brand??null) == $brand->name)>{{strtoupper($brand->name)}}</option>
  
                                    @endforeach
                                </select>
                                @error('category')
                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                @enderror
                            </div>
                            
                            <div class="form_item centerAlign">
                                <label for="condition">Condition</label>
                                <select name="condition" id="condition" required>
                                    <option value="">Condition</option>
                                    <option value="new" @selected( old('condition',$product->condition??null) == 'new')>NEW</option>
                                    <option value="used" @selected( old('condition',$product->condition??null) == 'used')>USED</option>
                                </select>
                                @error('condition')
                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                @enderror
                            </div>
                            
                            <div class="form_item centerAlign">
                                <label for="description">Description</label>
                                <textarea name="description" id="wysiwyg_editor" cols="30" rows="10" >
                                    {{$product->description ?? old('description')}}
                                </textarea>
                                @error('description')
                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                @enderror
                            </div>

                            <div class="form_item centerAlign">
                                    <label for="cost_price">Cost Price</label>
                                    NGN <input type="number" step="0.01" name="cost_price" id="cost_price" value= {{$product->costprice ?? intval(old('cost_price')) }} required>
                                    @error('cost_price')
                                    <div class="error_text"> <small>{{ $message }}</small> </div>
                                @enderror
                            </div>
                        
                            @if (!isset($product->images[0]))

                            <div class="form_item centerAlign">
                                <label for="imageFile1">Select Main image:</label>
                                <input type="file" id="imageFile1" name="imageFile[]" >
                                @error('imageFile.0')
                                     <div class="error_text"> <small>{{ $message }}</small> </div>
                                 @enderror
                            </div>
                            @endif
                            
                            @if (!isset($product->images[1]))
                                
                                <div class="form_item centerAlign">
                                    <label for="imageFile2">image 2:</label>
                                    <input type="file" id="imageFile2" name="imageFile[]" >
                                    @error('imageFile.1')
                                        <div class="error_text"> <small>{{ $message }}</small> </div>
                                    @enderror
                                </div>
                            @endif

                            @if (!isset($product->images[2]))

                                <div class="form_item centerAlign">
                                    <label for="imageFile3">image 3:</label>
                                    <input type="file" id="imageFile3" name="imageFile[]" >
                                    @error('imageFile.3')
                                        <div class="error_text"> <small>{{ $message }}</small> </div>
                                    @enderror
                                </div>
                            @endif
                            
                            <div class="form_item centerAlign">
                                <button type="submit"><i class="fa-solid fa-floppy-disk"></i> {{$button}} Product</button>
                            </div>
                    </form>

                    <div class="flex_col">
                        @if (isset($product))

                        @foreach ($product->images as $image)
                        <div class="edit_page_image_wrapper flex_col centerAlign">
                            <div class="edit_page_image centerAlign">
                                <img src="{{asset('uploads/product_images')}}/{{$image->filename}}">
                            </div>
                            <div class="edit_page_image_panel flex_row centerAlign">
                                <form action="{{ route('image.product_main', ['id'=>$image->id])}}" method="post">
                                    @csrf
                                    <button class="div_button @php echo $image->is_main ? 'green_div_button' : '' @endphp ">
                                        <i class="fa-solid fa-star"></i> @php echo $image->is_main ? 'Main Image' : 'Mark As Main' @endphp 
                                    </button>
                                </form>

                                <form onsubmit = "return confirm('Do you want to delete?');" action="{{ route('image.product_delete', ['id'=>$image->id])}}" method="post">
                                    @csrf
                                    <button>
                                        <i class="fa-solid fa-trash-can"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>   

                        @endforeach
                            
                        @endif
                       
                    </div>

                </div>
            </div>
        @endsection
      

   @section('page_script')
   <script src="{{ secure_asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
   <script>
       ClassicEditor
           .create( document.querySelector( '#wysiwyg_editor' ) )
           .catch( error => {
               console.error( error );
           } );
   </script>   
   @endsection
   
