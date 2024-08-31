@extends(Auth::user()->is_admin ? 'outlay.admin_dashboard' : 'outlay.user_dashboard')


<!-- all other page content  -->

@section('page_content')  





            <a href="{{route('brand.create')}}">
                <button class="add_new_btn">
                    <i class="fa-solid fa-plus"></i> New 
                </button>
            </a>

            <p> <h2>Brands</h2> </p>   

            <div class="table_wrapper centerAlign flex_col">
                @if (count($brands) < 1)

                {!! '<div> No Brands Available </div>' !!}    
                
                @else

                    <table>
                        <tr>
                        <th>No. </th>
                        <th>Brand Name </th>
                        <th>Category </th>
                        <th>Action</th>
                        </tr>

                        @php
                            $i = 1;
                        @endphp
                        
                        @foreach ($brands as $brand)
                        <tr>
                            <td> 
                                {{$i++}}
                            </td>
                            <td> 
                                {{$brand->name}}
                            </td>
                            <td> 
                                {{$brand->device_type}}
                            </td>
                            <td> 
                                <div class="flex_row">
                                    <a href="{{route('brand.edit', ['id' =>  $brand->id])}}">
                                        <button>
                                            <i class="fa-solid fa-pencil"></i> Edit
                                        </button>
                                    </a> 
    
                                    <form onsubmit = "return confirm('Do you want to delete?');" action="{{ route('brand.delete', ['id'=>$brand->id]) }}" method="post">
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
                    {{ $brands->links() }}
                @endif  

            </div>


          @endsection 