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
    <p>Hemos recibido tu registro de afiliación a la página MorelosSí, enviado a las {{ $store->created_at->format('h:i:s') }} horas.</p>
    <p>Estos son los datos registrados de su empresa:</p>
    <ul>
        <li>Nombre: {{ $store->name }}</li>
        <li>Descripción: {{ $store->description }}</li>
    </ul>

    <p>Puedes acceder a tu cuenta para realizar los ajustes necesarios, los cuales serán revisados por nuestro equipo.</p>
    <ul>
        <li>Enlace de acceso: </li>
        <li>Email: {{ $store->user->email }}</li>
        <li>Password: {{ $key }}</li>
    </ul>

    
    <p>MorelosSí</p>
    <ul>
        {{-- <li>Latitud: {{ $distressCall->lat }}</li>
        <li>Longitud: {{ $distressCall->lng }}</li>
        <li>
            <a href="https://www.google.com/maps/dir/{{ $distressCall->lat }},{{ $distressCall->lng }}">
                Ver en Google Maps
            </a>
        </li> --}}
    </ul>
</body>
</html>