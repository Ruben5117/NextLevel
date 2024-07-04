<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>

@if (session('fk_tipo_usuario') != 1)
    <script>
        window.location.href = "{{ url('/') }}";
    </script>
@endif

<h1>CLIENTE</h1>
<form action="/logout" method="POST">
    @csrf
    <button type="submit">Logout</button><br>
</form>

<h1>Tus rutinas</h1>
@foreach($rutinasC as $rutina)
    <h3 class="rutina-nombre" style="cursor: pointer;">{{ $rutina->nombre }}</h3>
    <div class="rutina-detalles" style="display: none;">
        <p>Descripción: {{ $rutina->descripción }}</p>
        <img src="{{ asset('storage/' . $rutina->foto_rutina) }}" width="100" height="100">
        <p>Nombre del Cliente: {{ $rutina->nombre_cliente }}</p>
        <p>Correo del Cliente: {{ $rutina->correo_cliente }}</p>
        <p>Nombre Coach: {{ $rutina->nombre_coach }}</p>
        <p>Correo Coach: {{ $rutina->correo_coach }}</p>
       
        
    </div>
@endforeach

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
