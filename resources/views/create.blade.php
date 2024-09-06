<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('users')}}" method="post" enctype="multipart/form-data">
        @csrf

        name<input type="text" name="name" id="">
        email<input type="email" name="email" id="">
        password<input type="password" name="password" id="">
        bio<input type="text" name="bio" id="">
        photo<input type="file" name="thumb" id="">
        Type<select name="type" id="">
            <option value="mentor">Mentor</option>
            <option value="mentee">Mentorando</option>
        </select>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
