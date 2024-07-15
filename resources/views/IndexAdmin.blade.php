<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Index</title>
</head>
@if (session('fk_tipo_usuario')== 2)
  @else
  <script>
    window.location.href="{{url('/')}}";
    </script>
@endif
  
 
<body>
<h1>Administrador</h1>
<form action="/logout" method="POST">
   @csrf
   <button class="salir" type="submit">Logout</button><br>
   </form>
 <button> <a href="/registroPersona">Registrar Personas y usuario</a></button> <br>
 <button>  <a href="/cliente">Registrar clientes</a></button><br>
  <button> <a href="/coachs">Registrar coachs</a></button><br>
  <button> <a href="/tipo_usuario"">Registrar tipo de usuario</a></button>
  <p>Vista Usuario</p>
  <button> <a href="/usuariosAD">Usuarios</a></button>
  <p>Vista rutinas</p>
  <button> <a href="/rutinas">Rutinas</a></button>
</body>
</html>