<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Vista rutinas</title>
</head>
@if (session('fk_tipo_usuario') == 2)
@else
<script>
    window.location.href = "{{ url('/') }}";
</script>
@endif
<body class="bk">
    <button class="button">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
        </svg>
        <a href="admin">
            <div class="text">Salir</div>
        </a>
    </button>

    <h1 style="text-align: center; color: white; font-weight: 900; font-size: 50px; font-family: Arial, Helvetica, sans-serif;">Nuestros desafios</h1>
    <h2 style="color: white; text-align: center; font-size: x-large;">Impulsa tu crecimiento al siguiente nivel</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="container">
        @foreach($rutinas as $rutina)
        <div class="card" style="margin-left: 30px;">
            <h3 class="rutina-nombre heading" style="cursor: pointer;">{{ $rutina->nombre }}</h3>
            <div class="rutina-detalles" style="display: none;">
            <div class="line-container">
            <div class="single-line"> <p>Descripción: {{ $rutina->descripción }}</p></div></div><br>
                <img src="{{ asset('storage/' . $rutina->foto) }}" width="100" height="100">
                <p>Nombre del Cliente: {{ $rutina->nombre_cliente }}</p>
                <p>Correo del Cliente: {{ $rutina->correo_cliente }}</p>
                <p>Nombre Coach: {{ $rutina->nombre_coach }}</p>
                <p>Correo Coach: {{ $rutina->correo_coach }}</p>
               <div class="botones">
                <a href="{{ route('rutinas.show', ['id' => $rutina->pk_rutina]) }}"><button id="alien"  class="bl">Detalles</button></a>
                <form action="{{ route('rutina.destroy', ['id' => $rutina->pk_rutina]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bl" id="alien" >Eliminar</button>
                </form>
                </div>
                </div>
         
        </div>
        @endforeach
    </div>

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
    </script>
</body>
</html>
<style>
 .botones {
    display: inline-flex;
    gap: 10px; /* Espacio entre botones */
}

#alien {
    display: inline-block;
    width: 90px;
    height: 40px;
    margin: 0;
    padding: 0;
}





</style>