<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de cliente</title>
</head>
<body>

    <form id="registrocliForm" action="{{ route('cliente.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="foto">Foto:</label>
        <input type="file" name="foto" required><br>
        <label for="fk_usuario">Usuario:</label>
        <select name="fk_usuario" id="fk_usuario" class="form-control" required>
        <option value="" disabled selected>Selecciona una opcion</option>
        @foreach ($datos as $dato)
                <option value="{{ $dato->pk_usuario }}">{{ $dato->correo }} - {{ $dato->nombre }}</option>
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
