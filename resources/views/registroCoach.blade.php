<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de coach</title>
</head>
<body>

    <form id="registrocoachForm" action="{{ route('coach.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
       
        <label for="fk_usuario">Usuario:</label>
        <select name="fk_usuario" id="fk_usuario" class="form-control" required>
        <option value="" disabled selected>Selecciona una opcion</option>
        @foreach($datoscoach as $usuario)
                <option value="{{ $usuario->pk_usuario }}">
                    {{ $usuario->nombre }} ({{ $usuario->correo }})
                   
                </option>
            @endforeach
        </select>

        <button type="submit">Guardar</button>
    </form>
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
