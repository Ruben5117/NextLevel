<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Registro de tipo de usuarios</title>
</head>
<body class="bk">
    
    <div class="container"> 
<img src="css/img/ft2.jpeg" class="imgtu"> 
</div>
    <div class="lines"> </div>
 
    <div class="container"> 

    <form action="{{ route('tipo_usuario.store') }}" method="POST" class="divr" style="margin-left: 40px; position:inline-block; margin: top 40px; height:200px">
        @csrf
        <center>

       
        <label for="nombre" placeholder="Nombre"></label>
        <input type="text" name="nombre" required class="input" placeholder="Nombre" > <br> <br> <br> <br> <br> <br> <br> <br> 


        <button type="submit" class="bl">Guardar</button>
        </center>
        
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

<style>
    .container{
        display: flex;
         }
</style>
</html>
