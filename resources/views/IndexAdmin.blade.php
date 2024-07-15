<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Admin Index</title>
</head>
@if (session('fk_tipo_usuario')== 2)
  @else
  <script>
    window.location.href="{{url('/')}}";
    </script>
@endif
  
 
<body class="bk">
<form action="/logout" method="POST">
   @csrf
 
   <nav class="nav">
        <div class="container">
            <div class="logo" style="margin-left: 20px; position:absolute; margin-top:70px;">
              
            <a class="aaa"  style="color: white;" >NEXTLEVEL</a>
            </div>
            <style>
                li{
                    margin-right:30px;
                    font-size: 10px;
                }
            </style>
            <div id="mainListDiv" class="main_list">
                <ul class="navlinks">
                    <li><a href="#">Inicio</a></li>
                    <li><a href="/registroPersona">Personas</a></li> <br> 
                    <li><a href="/cliente">Clientes</a></li> <br>  <br>  <br> 
                    <li><a href="/coachs">Coachs</a></li>
                    <li><a href="/rutina">Registrar rutina</a></li>
                    <li><a href="/tipo_usuario">Registrar tipo de usuario</a></li>
                    <li><a href="/usuariosAD">Usuarios</a></li>
                    <li><a href="/rutinas">Rutinas</a></li>
                    <button class="btnlo" type="submit">Logout</button>
</form>
                </ul>
            </div>
            <span class="navTrigger">
                <i></i>
                <i></i>
                <i></i>
            </span>
        </div>
    </nav>

    <div class="fondo">
    <img src="css/img/fondoindex.jpg" class="imgf"> 
        </div>
  
</body>
</html>