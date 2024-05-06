<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     <style>
        .container{
            width: 500px;
            margin: auto;
        }
    </style>
</head> 
<body>
    <div class = "container">
    @if ($errors->any())
    <div >
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{route('pictures.store')}}" method="post" enctype="multipart/form-data">
        @csrf
         <input type="text" name="name" id="name" placeholder="name"><br>
         <input type="text" name="description" id="description" placeholder="description"><br>
         <input type="number" name="price" id="price" step=".01" placeholder="price"><br>
         <input type="number" name="state" id="state" placeholder="state"><br>
         <input type="number" name="user_id" id="user_id" placeholder="user_id"><br>
         <input type="number" name="category_id" id="category_id" placeholder="category_id"><br>
        <input type="file" name="images[]" multiple> <br>
        @if(Auth::user())
        <input type="submit" value="Upload">
        @endif
  
      </form>
    </div>
</body>
</html>