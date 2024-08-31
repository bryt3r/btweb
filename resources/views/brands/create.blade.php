@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')


         @php
           
            if ($brand ?? null) {
                $action = route('brand.update', ['id'=>$brand->id]);
                $legend = 'Edit';
                $button = 'Update';
            }else {
                $action = route('brand.store');
                $legend = 'New';
                $button = 'Add';
            }
        @endphp
       

            <!-- all other page content  -->
        @section('page_content')

            <div class="create_article_wrapper centerAlign">

                <div class="dash_back_icon" onclick="location.href='{{ route('brands') }}';"> <h2><i class="fa-solid fa-arrow-left"></i> Brands </h2> </div>

                <div class="create_form flex_col centerAlign">
                    <div class="form_title centerAlign">

                    </div>
                    <form action="{{$action}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <legend class="form_item centerAlign"> {{$legend}} Brand</legend>
                            <div class="form_item centerAlign">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="{{$brand->name ?? old('name')}}" required >
                            @error('name')
                            <div class="error_text"> <small>{{ $message }}</small> </div>
                            @enderror
                            </div>
                           
                            <div class="form_item centerAlign">
                                <label for="device_type">Device Type</label>
                                <select name="device_type" id="device_type" required>
                                    <option value="">Select Device Type</option>
                                    <option value="phone" @selected( old('$brand->device_type',$brand->device_type??null) == 'phone')>PHONE</option>
                                    <option value="computer" @selected( old('$brand->device_type',$brand->device_type??null) == 'computer')>COMPUTER</option>
                                    <option value="accessory" @selected( old('$brand->device_type',$brand->device_type??null) == 'accessory')>ACCESSORY</option>
                                    <option value="others" @selected( old('$brand->device_type',$brand->device_type??null) == 'accessory')>OTHERS</option>
                                </select>
                                @error('device_type')
                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                @enderror
                            </div>
                            
                           
                            @if (isset($brand->image))

                                <div class="edit_page_image_wrapper flex_col centerAlign">
                                    <div class="edit_page_image centerAlign">
                                        <img src="{{asset('uploads/brand_images')}}/{{$brand->image}}">
                                    </div>
                                    <div class="edit_page_image_panel flex_row centerAlign">
                                         <div class="div_button red_div_button" onclick="location.href='{{ route('brand.image_delete', ['id'=>$brand->id]) }}';">
                                
                                                    <i class="fa-solid fa-trash-can"></i> Delete
                                        </div>
                                    </div>
                                </div>   

                            @else
                            <div class="form_item centerAlign">
                                <label for="imageFile1">Upload Brand image:</label>
                                <input type="file" id="imageFile1" name="imageFile[]" >
                                @error('imageFile.0')
                                     <div class="error_text"> <small>{{ $message }}</small> </div>
                                 @enderror
                            </div>
                            @endif
                            
                            @if (isset($brand->icon))
                                
                                <div class="edit_page_image_wrapper flex_col centerAlign">
                                    <div class="edit_page_image centerAlign">
                                        <img src="{{asset('uploads/product_images')}}/{{$brand->icon}}">
                                    </div>
                                    <div class="edit_page_image_panel flex_row centerAlign">
                                        
                                        <div class="div_button red_div_button" onclick="location.href='{{ route('delete.brand_icon', ['id'=>$brand->id]) }}';">
                                
                                                    <i class="fa-solid fa-trash-can"></i> Delete
                                        </div>
                                    </div>
                                </div>   

                             @else
                                <div class="form_item centerAlign">
                                    <label for="imageFile2">Brand Icon:</label>
                                    <input type="file" id="imageFile2" name="imageFile[]" >
                                    @error('imageFile.1')
                                        <div class="error_text"> <small>{{ $message }}</small> </div>
                                    @enderror
                                </div>
                            @endif

                            
                            <div class="form_item centerAlign">
                                <button type="submit"><i class="fa-solid fa-floppy-disk"></i>{{$button}} Brand</button>
                            </div>
                    </form>
                </div>
            </div>
        @endsection
      
   
