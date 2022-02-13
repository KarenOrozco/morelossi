<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Afiliación aprobada</title>
</head>
<body>
    
    <h1>¡Hola!</h1>
    <p>Hemos revisado su registro de afiliación a la página MorelosSí, enviado el {{ $store->createdAtFormat }}.</p>
    <p>Nos es grato informarle que su solicitud ha sido ACEPTADA. </p>

    <p>Estos son los datos registrados de su empresa:</p>
    <ul>
        <li>Nombre: {{ $store->name }}</li>
        <li>Descripción: {{ $store->description }}</li>
    </ul>

    <p>Recuerde que puede acceder a su cuenta para mantener actualizada su información, la cual será revisada por nuestro equipo antes de publicar dichos cambios en nuestra página.</p>
    <ul>
        <li>Enlace de acceso: </li>
        <li>Email: {{ $store->user->email }}</li>
    </ul>

    
    <p>MorelosSí</p>
</body>
</html>