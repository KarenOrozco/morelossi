<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <h1>¡Hola!</h1>
    <p>Hemos recibido tu registro como {{$user->role}} a la página MorelosSí.</p>

    <p>Puedes acceder a tu cuenta para realizar los ajustes necesarios.</p>
    <ul>
        <li>Enlace de acceso: </li>
        <li>Email: {{ $user->email }}</li>
        <li>Password: {{ $key }}</li>
    </ul>

    
    <p>MorelosSí</p>
</body>
</html>