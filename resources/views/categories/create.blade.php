@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')


         @php
           
            if ($category ?? null) {
                $action = route('category.update', ['id' => $category->id]);
                $legend = 'Edit';
                $button = 'Update';
            }else {
                $action = route('category.store');
                $legend = 'New';
                $button = 'Add';
            }
        @endphp
       

            <!-- all other page content  -->
        @section('page_content')

            <div class="create_article_wrapper centerAlign">

                <div class="dash_back_icon" onclick="location.href='{{ route('categories') }}';"> <h2><i class="fa-solid fa-arrow-left"></i> Categories </h2> </div>

                <div class="create_form flex_col centerAlign">
                    <div class="form_title centerAlign">

                    </div>
                    <form action="{{$action}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <legend class="form_item centerAlign"> {{$legend}} Category</legend>
                            <div class="form_item centerAlign">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="{{$category->name ?? old('name')}}" required >
                            @error('name')
                            <div class="error_text"> <small>{{ $message }}</small> </div>
                            @enderror
                            </div>
                           
                            <div class="form_item centerAlign">
                                <label for="section">Section</label>
                                <select name="section" id="section" required>
                                    <option value="">Select Section</option>
                                    <option value="posts" @selected( old('$category->section',$category->section??null) == 'posts')>Posts</option>
                                    <option value="products" @selected( old('$category->section',$category->section??null) == 'products')>Products</option>
                                    <option value="projects" @selected( old('$category->section',$category->section??null) == 'projects')>Projects</option>
                                </select>
                                @error('section')
                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                @enderror
                            </div>
                            
                           
                            @if (isset($category->image))

                                <div class="edit_page_image_wrapper flex_col centerAlign">
                                    <div class="edit_page_image centerAlign">
                                        <img src="{{asset('uploads/category_images')}}/{{$category->image}}">
                                    </div>
                                    <div class="edit_page_image_panel flex_row centerAlign">
                                         <div class="div_button red_div_button" onclick="location.href='{{ route('category.image_delete', ['id'=>$category->id]) }}';">
                                
                                                    <i class="fa-solid fa-trash-can"></i> Delete
                                        </div>
                                    </div>
                                </div>   

                            @else
                            <div class="form_item centerAlign">
                                <label for="imageFile1">Upload Category image:</label>
                                <input type="file" id="imageFile1" name="imageFile[]" >
                                @error('imageFile.0')
                                     <div class="error_text"> <small>{{ $message }}</small> </div>
                                 @enderror
                            </div>
                            @endif
                            
                            @if (isset($category->icon))
                                
                                <div class="edit_page_image_wrapper flex_col centerAlign">
                                    <div class="edit_page_image centerAlign">
                                        <img src="{{asset('uploads/category_images')}}/{{$category->icon}}">
                                    </div>
                                    <div class="edit_page_image_panel flex_row centerAlign">
                                        
                                        <div class="div_button red_div_button" onclick="location.href='{{ route('delete.category_icon', ['id'=>$category->id]) }}';">
                                
                                                    <i class="fa-solid fa-trash-can"></i> Delete
                                        </div>
                                    </div>
                                </div>   

                             @else
                                <div class="form_item centerAlign">
                                    <label for="imageFile2">Category Icon:</label>
                                    <input type="file" id="imageFile2" name="imageFile[]" >
                                    @error('imageFile.1')
                                        <div class="error_text"> <small>{{ $message }}</small> </div>
                                    @enderror
                                </div>
                            @endif

                            
                            <div class="form_item centerAlign">
                                <button type="submit"><i class="fa-solid fa-floppy-disk"></i>{{$button}} Category</button>
                            </div>
                    </form>
                </div>
            </div>
        @endsection
      
   
