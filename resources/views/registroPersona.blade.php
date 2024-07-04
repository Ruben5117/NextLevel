<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Registro de personas</title>
</head>
<body>

    <form id="registroForm" action="{{ route('persona.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="fnac">
            <input class="input" type="date" name="fnac" placeholder="" required="">
            <span>Fecha de nacimiento</span>
        </label>
    </div>  
            
    <label for="apellidop">
        <input class="input" type="text" placeholder="" name="apellidop" required="">
        <span>Apellido paterno</span>
    </label> 
        
    <label for="apellidom">
        <input class="input" type="text" placeholder="" required="" name="apellidom">
        <span>Apellido materno</span>
    </label>
    <button class="submit" type="submit">Guardar</button>
    <p class="signin">Si ya tienes una cuenta, haz click <a href="/">aquí</a> </p>
</form>



</body>
</html>
