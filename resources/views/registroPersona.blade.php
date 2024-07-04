<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Registro de personas</title>
</head>
<body class="bk">
    <img src="css/img/imgr.jpg" class="imgg"> 
    <div class="line"> </div>
<form class="form"   id="registroForm" action="{{ route('persona.store') }}" method="POST" class="formrp" style="margin-left: auto; margin-top: -40%; margin-right: 110px;">
    @csrf
    <p class="title">Registro </p>
    <p class="message">Registrate y se parte de nuestro equipo. </p>
        <div class="flex">
        <label for="nombre">
            <input class="input" type="text" name="nombre" required placeholder=""  style="width: 200px;" >
            <span>Nombre</span>
        </label>

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
