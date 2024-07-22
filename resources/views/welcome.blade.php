<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Welcome</title>
</head>
<body class="bk">

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
            <div class="navv">
            <div id="mainListDiv" class="main_list" >
                <ul class="navlinks">
                    <li><a href="#section1">Inicio</a></li>
                    <li><a href="#section2">Medidas</a></li> <br> 
                    <li><a href="#section3">Rutinas</a></li> <br>  <br>  <br> 
                    <li><a href="#section4">Sobre nosotros</a></li>
                    <li><a href="#sect5">Contactanos</a></li>

                    <form action="/logout" method="POST">
    @csrf
    <button type="submit" class="btnlo">Cerrar sesión</button><br>
</form>              
   </div>
</form>
                </ul>
            </div>
           
        </div>
    </nav>

    <main style="overflow: hidden; /* Oculta la barra de scroll */
    overflow-y: auto; /* Permite el desplazamiento vertical */
    -ms-overflow-style: none;  /* IE y Edge */
    scrollbar-width: none;  /* Firefox */"> 
 <section class="parallax bg" id="section1">
 
 <br><br>
    <h1 style="color:white; text-align:left; font-size: 60px; font-family:arial black; font-weight:30%"><span style="font-size: 15px;"> NextLevel Gym-Lleva tu entrenamiento al próximo nivel </span>
         Evoluciona tu <br> cuerpo, <br> eleva tu mente.</h1> <br>
         <button class="bbt"> Unete ahora
         </button>
 </section>
 <section class="no-parallax" id="section2"> 
    <div class="contenedorr" style="margin-left: 53%;"> 
@php
    $userId = session('id');
    $existingMedida = App\Models\Medida::where('fk_usuario', $userId)->first();
@endphp

@if (session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif

@if (!$existingMedida)


    <h1 style="font-family:avenir;">Registrar medidas:</h1>
    <p stye="font-family:avenir;">Es recomendable poner tus medidas y cambiarlas con<br> constancias para una rutina más personalizada</p>
    <form action="{{ route('welcome.store') }}" method="POST">
        @csrf
        <label for="peso">Ingresa tu peso (en Kg)</label><br>
        <input type="number" name="peso" id="peso" required><br>

        <label for="estatura">Ingresa tu estatura (en cm)</label><br>
        <input type="number" name="estatura" id="estatura" required><br>

        <button type="submit">Guardar medidas</button>
    </form>
   
@else
    <h1 style="text-align: center; font-family:arial black;">Tus medidas actuales:</h1> 
    <p style="margin-left: 10px; font-family:avenir;">Peso: {{ $existingMedida->peso }} Kg</p>
    <p style="margin-left: 10px; font-family:avenir;">Estatura: {{ $existingMedida->estatura }} cm</p>
    <p style="margin-left: 10px; font-family:avenir;">Última actualización: {{ \Carbon\Carbon::parse($existingMedida->fecha)->format('d-m-Y') }}</p>

    <button id="toggleFormBtn" style="margin-left: 10px;" class="small-button">Actualizar medidas</button>

    <div id="updateForm" style="display: none;">
        <h2 style="margin-left: 10px; margin-top:5px">Medidas:</h2>
        <form action="{{ route('welcome.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-control">
  <input class="input input-alt" placeholder="Type something intelligent" type="number" name="peso" id="peso" value="{{ $existingMedida->peso }}" required  style="margin-top:-20px;">
  <span class="input-border input-border-alt"></span>
  </div>
  <div class="form-control">
  <input class="input input-alt" placeholder="Type something intelligent" type="number" name="estatura" id="estatura" value="{{ $existingMedida->estatura }}" required style="margin-top:-20px;">
  <span class="input-border input-border-alt"></span>
  </div>
            <button type="submit" class="small-button" style="margin-left: 10px;">Actualizar</button>
        </form>
    </div>
@endif
</div>
<div>
    <img src="css/img/morrilla.webp" class="imgmed" style="margin-left: 20px;"> 
     </div>
 </section>
 <section class="no-parallax" id="section3"> 
    <div class="container"> 
 
    <h1 style="text-align: center; color:#050715; font-weight: 900; font-size: 50px; font-family:arial black; margin-top:-130px; margin-left:130px; position:absolute;">Tus rutinas</h1>
@foreach($rutinasC as $rutina)
<div class="card" style="margin-left: 30px;">
    <h3 class="rutina-nombre" style="cursor: pointer; color: white; font-family: avenir;">{{ $rutina->nombre }}</h3>
    <div class="rutina-detalles" style="display: none;">
        <p style="font-family: avenir;">Descripción: {{ $rutina->descripción }}</p>
        <img src="{{ asset('storage/' . $rutina->foto_rutina) }}" width="100" height="100">
        <p style="font-family: avenir;">Nombre del Cliente: {{ $rutina->nombre_cliente }}</p>
        <p style="font-family: avenir;">Correo del Cliente: {{ $rutina->correo_cliente }}</p>
        <p style="font-family: avenir;">Nombre Coach: {{ $rutina->nombre_coach }}</p>
        <p style="font-family: avenir;">Correo Coach: {{ $rutina->correo_coach }}</p>
        <a href="{{ route('cliente.show', ['id' => $rutina->pk_rutina]) }}"><button id="alien"  class="bl">Detalles</button></a>
    </div>
    </div>
@endforeach
</div>

 </section>


 <section  class="no-parallax" id="section4"> 
 <div>
    <img src="css/img/snn.webp" class="imgmed" style="height:600px; margin-left:20px;"> 
     </div>

     <div   class="contenedorrr" style="margin-left: 53%;"> 
    <h1 style="color: white;">Acerca de Nosotros</h1>
    <p style="margin-left: 30px; margin-right:30px; text-align:center; font-family:avenir;">NextLevel es un espacio dedicado a brindar un servicio de entrenamiento personalizado y semi-presencial. Nuestro equipo de entrenadores certificados está comprometido a ayudarte a alcanzar tus metas de forma segura y efectiva. Aquí podrás conocer más sobre nuestros servicios, nuestro equipo y lo que nos hace diferentes de nuestros competidores.
    Nuestra plataforma está diseñada para mantenerte motivado en cada paso del camino, guiándote hacia la consecución de tus aspiraciones para ser fitness. ¡Déjanos ayudarte a alcanzar tu mejor versión!
        
    </p>
    </div>
 </section>

 </main>
 <footer id="sect5"> 
<h1 style="color: white; margin-top:90px; text-align:center;">¡Siguenos en nuestras redes sociales!</h1>
<div class="horizontal-line">
    <img src="css/img/logotipo-de-instagram.png" style="z-index: 1; width:40px; height:40px; margin-left:450px; margin-top:10px;" > 
    <img src="css/img/facebook.png" style="z-index: 1; width:40px; height:40px; margin-left: 10%; margin-top:10px;" > 
    <img src="css/img/tik-tok.png" style="z-index: 1; width:40px; height:40px; margin-left: 10%; margin-top:10px;" > 
</div>
<h3 style="color: white; margin-left:1100px; margin-top:60px; font-family:avenir;"> CREADORES</h3>
<h4 style="color: white; margin-left:1000px; margin-top:60px; font-family:avenir;"> KARLA VANESSA RUBIO SEGURA </h4>
<h4 style="color: white; margin-left:1000px; margin-top:60px; font-family:avenir;"> RUBÉN EDUARDO PERAZA ESQUER</h4>
</footer>




@if (session('fk_tipo_usuario') != 1)
    <script>
        window.location.href = "{{ url('/') }}";
    </script>
@endif



@php
    $userId = session('id');
    $existingMedida = App\Models\Medida::where('fk_usuario', $userId)->first();
@endphp

@if (session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif




<script>
    // Script para mostrar/ocultar detalles al hacer clic en el nombre de la rutina
    document.addEventListener('DOMContentLoaded', function () {
        const nombresRutina = document.querySelectorAll('.rutina-nombre');
        nombresRutina.forEach(nombre => {
            nombre.addEventListener('click', function () {
                const detalles = this.nextElementSibling;
                detalles.style.display = detalles.style.display === 'none' ? 'block' : 'none';
            });
        });
    });

    document.getElementById('toggleFormBtn').addEventListener('click', function() {
        var updateForm = document.getElementById('updateForm');
        if (updateForm.style.display === 'none') {
            updateForm.style.display = 'block';
        } else {
            updateForm.style.display = 'none';
        }
    });

   
</script>



<style>

.horizontal-line {
            width: 100%;
            height: 60px;
            background-color:#5E3AD4; /* Puedes ajustar el color de la línea aquí */  }
    #alien {
    display: inline-block;
    width: 90px;
    height: 40px;
    margin: 0;
    padding: 0;
}

.input {
  color: #fff;
  font-size: 0.9rem;
  background-color: transparent;
  width: 100%;
  box-sizing: border-box;
  padding-inline: 0.5em;
  padding-block: 0.7em;
  border: none;
  border-bottom: var(--border-height) solid var(--border-before-color);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.input-border {
  position: absolute;
  background: var(--border-after-color);
  width: 0%;
  height: 2px;
  bottom: 0;
  left: 0;
  transition: width 0.3s cubic-bezier(0.6, -0.28, 0.735, 0.045);
}

.input:focus {
  outline: none;
}

.input:focus + .input-border {
  width: 100%;
}

.form-control {
  position: relative;
  --width-of-input: 300px;
}

.input-alt {
  font-size: 1.2rem;
  padding-inline: 1em;
  padding-block: 0.8em;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.input-border-alt {
  height: 3px;
  background: linear-gradient(90deg, #5E3AD4 0%, #1B065E 50%, #47C9FF 100%);
  transition: width 0.4s cubic-bezier(0.42, 0, 0.58, 1.00);
}

.input-alt:focus + .input-border-alt {
  width: 100%;
}


.small-button {
        padding: 5px 10px; /* Ajusta el relleno para hacer el botón pequeño */
        font-size: 12px; /* Tamaño de fuente pequeño */
        color: #FFFFFF; /* Color del texto */
        background-color: #A238FF; /* Color de fondo */
        border: none; /* Sin borde */
        border-radius: 1px; /* Bordes redondeados */
        cursor: pointer; /* Cambia el cursor al pasar sobre el botón */
        transition: background-color 0.3s ease; /* Transición suave para el cambio de color de fondo */
    }

    .small-button:hover {
        background-color: #8e30d6; /* Color de fondo al pasar el mouse */
    }

    .small-button:active {
        background-color: #7328b3; /* Color de fondo al hacer clic */
    }

    .small-button:focus {
        outline: none; /* Sin contorno */
        box-shadow: 0 0 0 2px rgba(162, 56, 255, 0.5); /* Sombra de enfoque */
    }



.navv{
    background-color: #050715;
    padding: 30px;
    width: 100%;
    margin: 10;
}

.contenedorr{
 width: 45%;
 height: 89%;
 background-color: #050715;
 margin-left: 650px;
 position: absolute;
 margin-top: -9px;


}
.contenedorrr{
 width: 45%;
 height: 93%;
 background-color: #050715;
 margin-left: 650px;
 position: absolute;
 margin-top: -15px;


}
.imgmed{
    width: 50%;
    height: 100%;
    margin-right: 650px;

}
    main{
        height: 100vh;
        overflow-x: hidden;
        overflow: auto;
        perspective: 2px;

    }
    section{
        transform-style: preserve-3d;
        position: relative;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }
    section h1{
        text-align: center;
        font-size: 4rem;
        font-family: sans-serif;

    }
    .no-parallax{
        background-color:  white ;
        z-index: 999;

    }
    .parallax h1{
        width: 60%;
        font-size: 2em;

    }
    .parallax::after{
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        transform: translateZ(-1px) scale(1.5);
        background-size: 100%;
        z-index: -1;
    }
    .bg::after{
        background: linear-gradient(rgba(0,0,0.5), rgba(0,0,0.5));
        background-size: cover;
        background-image:url("css/img/fondousu.png");
        background-position: center;
       
    }
   </style>
</body>
</html>
