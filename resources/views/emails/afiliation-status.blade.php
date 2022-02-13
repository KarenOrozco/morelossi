<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    @switch($store->status)
        @case(1)
            @break
        @case(2)
            <p>Solicitud aprobada</p>
            @break
        @case(3)
            
            @break
        @case(4)
            
            @break
        @case(5)
            {!! $slot !!}
            @break
        @default
            
    @endswitch
    
    <p>MorelosSí</p>
</body>
</html>