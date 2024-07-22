<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Coach Index</title>
</head>
<body  class="bk">

@if (session('fk_tipo_usuario') == 4)
@else
  <script>
    window.location.href="{{ url('/') }}";
  </script>
@endif

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
                    <li><a href="/rutina">Registrar rutina</a></li> <br> 
                    
                </ul>
            </div>
            <span class="navTrigger">
                <i></i>
                <i></i>
                <i></i>
            </span>
        </div>
    </nav>


<form action="/logout" method="POST">
    @csrf
    <button type="submit" class="btnlo" style="margin-left: 1200px;">Cerrar sesión</button><br>
</form>
<h1 style="text-align:center; color:white;">Tus rutinas</h1> 


@foreach($rutinas as $rutina)
<div class="card" style="margin-left: 90px;">
 <div class="image">
 <img src="{{ asset('storage/' . $rutina->foto) }}">
        <p>Nombre del Cliente: {{ $rutina->nombre_cliente }}</p>
        <p>Correo del Cliente: {{ $rutina->correo_cliente }}</p>
    
 </div>
  <div class="content">
    <a href="#">
      <span  class="rutina-nombre" style="cursor: pointer; ">
      {{ $rutina->nombre }}
      </span>
    </a>
    <br>

    <p class="desc" class="rutina-detalles">
    Descripción: {{ $rutina->descripción }}
    </p>

    <a class="action" href="{{ route('coach.show', ['id' => $rutina->pk_rutina]) }}">
      Detalles
      <span aria-hidden="true">
        →
      </span>
    </a>
    <a class="action" href="{{ route('rutinas.edit', ['id' => $rutina->pk_rutina]) }}">
      Editar
      <span aria-hidden="true">
        →
      </span>
    </a>
  </div>
  <form action="{{ route('rutina.destroy', ['id' => $rutina->pk_rutina]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bl">Eliminar</button>
        </form>
</div>
    </div>
@endforeach

<script>

    document.addEventListener('DOMContentLoaded', function () {
        const nombresRutina = document.querySelectorAll('.rutina-nombre');
        nombresRutina.forEach(nombre => {
            nombre.addEventListener('click', function () {
                const detalles = this.nextElementSibling;
                detalles.style.display = detalles.style.display === 'none' ? 'block' : 'none';
            });
        });
    });
</script>
</body>
</html>
