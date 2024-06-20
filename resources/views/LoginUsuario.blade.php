<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
<body>

    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <label for="correo">Correo:</label><br>
        <input type="email" name="correo" required value="{{ old('correo') }}"><br>
        @error('correo')
        <small style="color:red">{{ $message }}</small>
        @enderror
        <br>
        <label for="contraseña">Contraseña:</label><br>
        <input type="password" name="contraseña" required value="{{ old('contraseña') }}"><br>
        @error('contraseña')
        <small style="color:red">{{ $message }}</small>
        @enderror
        <br>
        <button type="submit">Login</button>
    </form>

    
<p>Si no tienes cuenta, haz click <a href="registroPersona">aquí</a></p>

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
