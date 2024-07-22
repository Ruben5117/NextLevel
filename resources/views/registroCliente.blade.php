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
