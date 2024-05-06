
@if ($errors->any())
<div >
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<form action="{{route('profile.update', 3)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
     <input type="number" name="user_id" id="user_id" placeholder="user_id"><br>
     <input type="text" name="phone" id="phone" placeholder="phone"><br>
     <input type="number" name="longitude" id="longitude" step=".0000000001" placeholder="longitude"><br>
     <input type="number" name="latitude" id="latitude" step=".0000000001" placeholder="latitude"><br>
     {{-- <input type="number" name="user_id" id="user_id" placeholder="user_id"><br>
     <input type="number" name="category_id" id="category_id" placeholder="category_id"><br> --}}
    <input type="file" name="image" > <br>

    <input type="submit" value="Upload">


  </form>
