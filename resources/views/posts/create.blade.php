
@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')

         @php
           
            if ($post ?? null) {
                $action = route('post.update', ['id'=>$post->id]);
                $legend = 'EDIT';
            }else {
                $action = route('post.store_preview');
                $legend = 'NEW';
            }
        @endphp
       

            <!-- all other page content  -->
        @section('page_content')
        
        @if (Auth::user()->is_admin)
            <div class="dash_back_icon" onclick="location.href='{{ route('posts.manage') }}';"> <h2><i class="fa-solid fa-arrow-left"></i> Posts </h2> </div>
        @endif   

            <div class="create_article_wrapper centerAlign">
                <div class="create_form flex_col centerAlign">
                   
                    <form action="{{$action}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <legend class="form_item centerAlign"> {{$legend}} ARTICLE</legend>
                            <div class="form_item centerAlign">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" value="{{$post->title ?? old('title')}}" required >
                            @error('title')
                            <div class="error_text"> <small>{{ $message }}</small> </div>
                            @enderror
                            </div>
                           

                            <div class="form_item centerAlign">
                                <label for="content">Content</label>
                                <textarea name="content" id="wysiwyg_editor" cols="30" rows="10" >
                                    {{$post->content ?? old('content')}}
                                </textarea>
                                @error('content')
                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                @enderror
                            </div>

                            <div class="form_item centerAlign">
                                <label for="author">Author</label>
                                <input type="text" name="author" id="author" value="{{$post->author ?? old('author')}}" required >
                            @error('author')
                            <div class="error_text"> <small>{{ $message }}</small> </div>
                            @enderror
                            </div>

                            <div class="form_item centerAlign">
                                <label for="category">Category</label>

                                <select name="category" id="category" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)

                                    <option value="{{$category->name}}" @selected( old('category',$post->category??null) == $category->name)>{{strtoupper($category->name)}}</option>
  
                                    @endforeach
                                </select>
                                @error('category')
                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                @enderror
                            </div>

                            @if (!isset($post->images[0]))
                                <div class="form_item centerAlign">
                                    <label for="imageFile1">Upload Main image:</label>
                                    <input type="file" id="imageFile1" name="imageFile[]" >
                                    @error('imageFile.0')
                                        <div class="error_text"> <small>{{ $message }}</small> </div>
                                    @enderror
                                </div> 
                            @endif
                           

                            <div class="form_item centerAlign">
                                <button type="submit"><i class="fa-solid fa-floppy-disk"></i>SAVE & PREVIEW</button>
                            </div>
                    </form>

                    <div class="flex_col">

                        @if (($post->images??null) && isset($post->images))
                            @foreach ($post->images as $image)
                            <div class="edit_page_image_wrapper flex_col centerAlign">
                                <div class="edit_page_image centerAlign">
                                    <img src="{{asset('uploads/post_images')}}/{{$image->filename}}" id="image_{{$image->id}}">
                                    <input type="text" value="" id="text_{{$image->id}}">
                                    
                                </div>
                                <div class="edit_page_image_panel flex_row centerAlign">
                                    <form action="{{ route('image.post_main', ['id'=>$image->id])}}" method="post">
                                        @csrf
                                        <button class="div_button @php echo $image->is_main ? 'green_div_button' : '' @endphp " >
                                            <i class="fa-solid fa-star"></i> @php echo $image->is_main ? 'Main Image' : 'Mark As Main' @endphp 
                                        </button>
                                    </form>
                                    <div class="div_button 'green_div_button' : '' @endphp " onclick="copyImageHtml('image_{{$image->id}}', 'text_{{$image->id}}')">
                            
                                        <i class="fa-solid fa-copy"></i> Copy link
                                    </div>

                                    <form onsubmit = "return confirm('Do you want to delete?');" action="{{ route('image.post_delete', ['id'=>$image->id])}}" method="post">
                                        @csrf
                                        <button class="div_button red_div_button">
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
            .create( document.querySelector( '#wysiwyg_editor' ), {
                ckfinder: {
                    uploadUrl: '{{route('image.post_upload').'?_token='.csrf_token()}}'
                }
            },{
                alignment: {
                    options: [ 'right', 'right' ]
                }} )
            .then( editor => {
                console.log( editor );
            })
            .catch( error => {
                console.error( error );
            })
    </script>
   @endsection
   
