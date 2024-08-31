@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')

<!-- all other page content  -->

@section('page_content')  

           

        <a href="{{route('category.create')}}">
            <button class="add_new_btn">
                <i class="fa-solid fa-plus"></i> New 
            </button>
        </a>

        <p> <h2>Categories</h2> </p>   

        <div class="table_wrapper centerAlign flex_col">
            @if (count($categories) < 1)

            {!! '<div> No Categories Available </div>' !!}    
            
            @else

                <table>
                    <tr>
                        <th>No. </th>
                        <th>Category Name </th>
                        <th>Category Section</th>
                        <th>Action</th>
                    </tr>
                    @php
                    $i = 1;
                     @endphp
                    @foreach ($categories as $category)
                    <tr>
                        <td> 
                            {{$i++}}
                        </td>
                        <td> 
                            {{$category->name}}
                        </td>
                        <td> 
                            {{$category->section}}
                        </td>
                        <td> 
                            <div class="flex_row">
                                <a href="{{route('category.edit', ['id' =>  $category->id])}}">
                                    <button>
                                        <i class="fa-solid fa-pencil"></i> Edit
                                    </button>
                                </a> 
    
                                <form onsubmit = "return confirm('Do you want to delete?');" action="{{ route('category.delete', ['id'=>$category->id]) }}" method="post">
                                    @csrf
                                    <button>
                                        <i class="fa-solid fa-trash-can"></i> Delete
                                    </button>
                                </form>

                            </div>
                            
                        </td>
                    </tr>
                        
                    @endforeach
    
                </table>
                {{ $categories->links() }}
                @endif  

        </div>


    @endsection 