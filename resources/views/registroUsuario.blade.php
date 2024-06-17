<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuarios</title>
</head>
<body>

    <form id="registroForm" action="{{ route('usuario.store') }}" method="POST">
        @csrf

        <input type="email" name="correo" placeholder="Correo electrónico">
        <input type="password" name="contraseña" placeholder="Contraseña">
        <input type="hidden" name="fk_tipo_usuario" value="1">
        <input type="hidden" name="fk_persona" value="{{ $fk_persona }}">
        <button type="submit">Guardar Usuario</button>
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
