<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$user->fullName}}</title>
</head>
<body>
    <div>
        <h1>Hello {{$user->fullName}}</h1>
        <p>
            Please Make new password.
        </p>
    </div>
    <div>
        <form action="{{route('users.resetpassword', $user->id)}}" method="POST">
            @csrf
            <input type="email" name="email" id="email", value="{{$user->email}}"><br>
            <input type="password" name="password" id="password"><br>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>