@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')

         @php
           
            if ($project ?? null) {
                $action = route('project.update', ['id'=>$project->id]);
                $legend = 'EDIT';
            }else {
                $project = null;
                $action = route('project.store_preview');
                $legend = 'NEW';
            }
        @endphp
       

            <!-- all other page content  -->
        @section('page_content')
        
        @if (Auth::user()->is_admin)
            <div class="dash_back_icon" onclick="location.href='{{ route('projects.manage') }}';"> <h2><i class="fa-solid fa-arrow-left"></i> projects </h2> </div>
        @endif   

            <div class="create_article_wrapper centerAlign">
                <div class="create_form flex_col centerAlign">
                   
                    <form action="{{$action}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <legend class="form_item centerAlign"> {{$legend}} PROJECT</legend>
                            <div class="form_item centerAlign">
                                <label for="title">Project Title</label>
                                <input type="text" name="title" id="title" value="{{$project->title ?? old('title')}}" required >
                                @error('title')
                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                @enderror
                            </div>
                           

                            <div class="form_item centerAlign">
                                <label for="details">Project Details</label>
                                <textarea name="details" id="wysiwyg_editor" cols="30" rows="10" >
                                    {{$project->details ?? old('details')}}
                                </textarea>
                                @error('details')
                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                @enderror
                            </div>

                            <div class="form_item centerAlign">
                                <label for="location">Project Location</label>
                                <input type="text" name="location" id="location" value= "{{$project->location ?? old('location')}}" required >
                                @error('location')
                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                @enderror
                            </div>

    
                            <div class="form_item centerAlign">
                                <label for="date">Project Date</label>
                                <input type="date" name="date" id="date" value= {{ $project ? date_format($project->date, "Y-m-d"): '' }}   required >
                                @error('date')
                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                @enderror
                            </div>


                            <div class="form_item centerAlign">
                                <label for="category">Category</label>

                                <select name="category" id="category" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->name}}" @selected( old('category',$project->category??null) == $category->name)>{{strtoupper($category->name)}}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <div class="error_text"> <small>{{ $message }}</small> </div>
                                @enderror
                            </div>
                            @if (!isset($project->images[0]))
                                <div class="form_item centerAlign">
                                    <label for="imageFile1">Select Main image:</label>
                                    <input type="file" id="imageFile1" name="imageFile[]" >
                                    @error('imageFile.0')
                                        <div class="error_text"> <small>{{ $message }}</small> </div>
                                    @enderror
                                </div>
                            @endif
                        
                        @if (!isset($project->images[1]))
                            <div class="form_item centerAlign">
                                <label for="imageFile2">image 2:</label>
                                <input type="file" id="imageFile2" name="imageFile[]" >
                                @error('imageFile.1')
                                    <div class="error_text"> <small>{{ $message }}</small> </div>
                                @enderror
                            </div>
                        @endif

                        @if (!isset($project->images[2]))
                                <div class="form_item centerAlign">
                                    <label for="imageFile3">image 3:</label>
                                    <input type="file" id="imageFile3" name="imageFile[]" >
                                    @error('imageFile.3')
                                        <div class="error_text"> <small>{{ $message }}</small> </div>
                                    @enderror
                                </div>
                        @endif

                            <div class="form_item centerAlign">
                                <button type="submit"><i class="fa-solid fa-floppy-disk"></i>SAVE & PREVIEW</button>
                            </div>
                            
                    </form>



                    <div class="flex_col">
                    @if (isset($project))
                        @foreach ($project->images as $image)
                        
                        <div class="edit_page_image_wrapper flex_col centerAlign">
                            <div class="edit_page_image centerAlign">
                                <img src="{{asset('uploads/project_images')}}/{{$image->filename}}">
                            </div>
                            <div class="edit_page_image_panel flex_row centerAlign">
                                <form action="{{ route('image.project_main', ['id'=>$image->id])}}" method="post">
                                    @csrf
                                    <button class="div_button @php echo $image->is_main ? 'green_div_button' : '' @endphp ">
                                        <i class="fa-solid fa-star"></i> @php echo $image->is_main ? 'Main Image' : 'Mark As Main' @endphp 
                                    </button>
                                </form>

                                <form onsubmit = "return confirm('Do you want to delete?');" action="{{ route('image.project_delete', ['id'=>$image->id])}}" method="post">
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
   
