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

<div class="container"> 
@foreach($rutinas as $rutina)
<div class="card" style="margin-left: 90px;">
      <h2  class="rutina-nombre heading" style="cursor: pointer; ">
      {{ $rutina->nombre }}
      </h2>
    <div class="rutina-detalles" style="display: none;">
      <div class="line-container"> 
      <div class="single-line">   Descripción: {{ $rutina->descripción }}</p>
         </div>
    </div>
    <div>
 <img src="{{ asset('storage/' . $rutina->foto) }}" width="100" height="100">
        <p>Nombre del Cliente: {{ $rutina->nombre_cliente }}</p>
        <p>Correo del Cliente: {{ $rutina->correo_cliente }}</p>
        <p>Nombre Coach: {{ $rutina->nombre_coach }}</p>
                <p>Correo Coach: {{ $rutina->correo_coach }}</p>      
 </div>
 <div class="botones">
    <a  href="{{ route('coach.show', ['id' => $rutina->pk_rutina]) }}"> <button id="alien" class="bl">Detalles </button>
    </a>
    <a href="{{ route('rutinas.edit', ['id' => $rutina->pk_rutina]) }}"><button id="alien" class="bl"> Editar </button>
    </a>
  </div>
  <form action="{{ route('rutina.destroy', ['id' => $rutina->pk_rutina]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bl" id="alien">Eliminar</button>
        </form>
</div>
    </div>
@endforeach
</div>
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

<style>
  
#alien {
    display: inline-block;
    width: 90px;
    height: 40px;
    margin: 0;
    padding: 0;
}
</style>

</html>
