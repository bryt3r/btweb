<div class="contact_form create_form">
    <form action="{{ route('contact.form')}}"  method="post" >
        @csrf
            <input type="hidden" name="section" value="{{$section}}" >

            <legend class="form_item centerAlign">Send Us A Message</legend>

            <div class="form_item centerAlign" style="display: none;">
                <label for="reply">Reply Email</label>
                <input placeholder="Reply Email" type="checkbox" name="reply" id="reply">
            </div>

            <div class="form_item centerAlign">
                <label for="name">Name</label>
                <input placeholder="Name" type="text" name="name" id="" value="{{old('name')}}" required >
            @error('name')
            <div class="error_text"> <small>{{ $message }}</small> </div>
            @enderror
            </div>

            <div class="form_item centerAlign">
                <label for="email">Email</label>
                <input placeholder="Email" type="email" name="email" id="" value="{{old('email')}}" required >
            @error('email')
            <div class="error_text"> <small>{{ $message }}</small> </div>
            @enderror
            </div>

            <div class="form_item centerAlign">
                <label for="phone">Phone</label>
                <input placeholder="Phone" type="number" name="phone" id="" value="{{old('phone')}}" required >
            @error('phone')
            <div class="error_text"> <small>{{ $message }}</small> </div>
            @enderror
            </div>
        
            <div class="form_item centerAlign">
                <label for="content">Message / Comment</label>
                <textarea name="content" id="" cols="30" rows="10" >{{old('content') }}</textarea>
                @error('content')
                <div class="error_text"> <small>{{ $message }}</small> </div>
                @enderror
            </div>
            
            <div class="form_item centerAlign">
                <button class="full_button" type="submit">SEND</button>
            </div>
    </form>
</div>