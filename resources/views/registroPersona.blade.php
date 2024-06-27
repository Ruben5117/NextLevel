<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de personas</title>
</head>
<body>

    <form  action="{{ route('persona.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="fnac">Fecha de Nacimiento:</label>
        <input type="date" name="fnac" required><br>

        <label for="apellidop">Apellido Paterno:</label>
        <input type="text" name="apellidop" required><br>

        <label for="apellidom">Apellido Materno:</label>
        <input type="text" name="apellidom" required><br>

        <button type="submit">Guardar</button>
    </form>

<p>Si ya tienes cuenta, haz click <a href="/">aquí</a></p>
</body>
</html>
