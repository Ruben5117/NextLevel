<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Registro de coach</title>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .imgtu {
            flex: 1 1 auto;
            margin: 0;
            padding: 10px;
            max-width: 45%;
            box-sizing: border-box;
        }

        .divr {
            flex: 1 1 auto;
            display: inline-block;
            vertical-align: top;
            margin: 70px auto 0 auto;
            box-sizing: border-box;
            width: 90%;
            max-width: 400px;
        }

        a {
            text-decoration: none;
        }

        @media (max-width: 767px) {
            .imgtu {
                display: none; /* Ocultar la imagen en pantallas pequeñas */
            }

            .divr {
                margin-top: 200px;
                width: 100%;
            }
        }
    </style>
</head>
<body class="bk">
    <button class="button">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
        </svg>
        <a href="admin"> 
            <div class="text">Salir</div>
        </a>
    </button>

    <div class="container"> 
        <img src="css/img/ft2.jpeg" class="imgtu"> 
        <form id="registrocoachForm" action="{{ route('coach.store') }}" method="POST" enctype="multipart/form-data" class="divr" style="z-index: 9999; position: relative;">
            @csrf
            <label for="fk_usuario">Usuario:</label>
            <select name="fk_usuario" id="fk_usuario" class="form-control" required>
                <option value="" disabled selected>Selecciona una opción</option>
                @foreach($datoscoach as $usuario)
                    <option value="{{ $usuario->pk_usuario }}">
                        {{ $usuario->nombre }} ({{ $usuario->correo }})
                    </option>
                @endforeach
            </select>
            <br><br><br>
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
