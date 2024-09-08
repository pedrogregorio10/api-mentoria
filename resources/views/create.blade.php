<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if ($errors->any()){
        @foreach ($errors as $error)
            {{ $erro }}
        @endforeach
    }

    @endif
    <form method="post" action="{{route('users.store')}}"  enctype="multipart/form-data">
        @csrf
        name<input type="text" name="name" id=""> <br>
        email<input type="email" name="email" id=""> <br>
        password <input type="password" name="password" id=""> <br>
        bio<input type="text" name="bio" id=""> <br> <br>
        photo<input type="file" name="thumb" id=""> <br>
        Type<select name="type" id=""> <br>
            <option value="mentor">Mentor</option>
            <option value="mentee">Mentorando</option>
        </select>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
