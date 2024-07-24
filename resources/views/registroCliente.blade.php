<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Registro de cliente</title>

    
<button class="button">

  
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
</svg>

<a href="admin"> 
<div class="text">
 Salir
</div>
</a>

</button>

    <style>
        .container {
            display: flex;
            align-items: center;
        }
        .imgtu {
            margin-right: -20%;
        }
        .divr {
            display: inline-block;
            vertical-align: top;
            margin-left: -77%;
            margin-top: 70px;

        }

        a{
            text-decoration: none;
        }
        .container {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.imgtu {
    flex: 1 1 100%;
    margin: 0;
    padding: 10px;
    max-width: 100%;
    box-sizing: border-box;
}

.divr {
    flex: 1 1 100%;
    display: inline-block;
    vertical-align: top;
    margin: 190px auto 0 auto;
    box-sizing: border-box;
}

a {
    text-decoration: none;
}

@media (min-width: 768px) {
    .imgtu {
        flex: 1 1 50%;
        margin-right: 2%;
        display: block; /* Asegúrate de que la imagen sea visible en pantallas más anchas */
    }

    .divr {
        flex: 1 1 45%;
        margin-left: 0;
        margin-top: 0;
    }
}

@media (max-width: 767px) {
    .imgtu {
        display: none; /* Ocultar la imagen en pantallas pequeñas */
    }
}

    </style>
</head>
<body class="bk">
<div class="container"> 
    <img src="css/img/ft2.jpeg" class="imgtu"> 
    <form id="registrocliForm" action="{{ route('cliente.store') }}" method="POST" enctype="multipart/form-data" class="divr" >
        <label for="foto">Foto:</label>
        <input type="file" name="foto" required class="input"><br>
        <label for="fk_usuario">Usuario:</label>
        <select name="fk_usuario" id="fk_usuario" class="form-control" required>
            <option value="" disabled selected>Selecciona una opcion</option>
            @foreach ($datos as $dato)
                <option value="{{ $dato->pk_usuario }}">{{ $dato->correo }} - {{ $dato->nombre }}</option>
            @endforeach
        </select>
        <button type="submit" class="bl">Guardar</button>
    </form>
</div>
@if(session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
@endif
</body>
</html>
