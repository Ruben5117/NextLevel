<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Registro de Usuario</h1>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <h2>Usuarios</h2>
    <ul>
        @foreach ($usuarios as $usuario)
            <li>
                {{ $usuario->nombre }} - {{ $usuario->correo }}
                <form action="{{ route('usuario.destroy',['id' => $usuario->pk_usuario]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>

</body>
</html>
