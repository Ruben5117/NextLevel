<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Index</title>
</head>
<body>

@if (session('fk_tipo_usuario') == 4)
@else
  <script>
    window.location.href="{{ url('/') }}";
  </script>
@endif

<h1>COACH</h1>
<form action="/logout" method="POST">
    @csrf
    <button type="submit">Logout</button><br>
</form>

<h1>Tus rutinas</h1>
@foreach($rutinas as $rutina)
    <h3 class="rutina-nombre" style="cursor: pointer;">{{ $rutina->nombre }}</h3>
    <div class="rutina-detalles" style="display: none;">
        <p>Descripción: {{ $rutina->descripción }}</p>
        <img src="{{ asset('storage/' . $rutina->foto) }}" width="100" height="100">
        <p>Nombre del Cliente: {{ $rutina->nombre_cliente }}</p>
        <p>Correo del Cliente: {{ $rutina->correo_cliente }}</p>
        <p>Nombre Coach: {{ $rutina->nombre_coach }}</p>
        <p>Correo Coach: {{ $rutina->correo_coach }}</p>
        <a href="{{ route('coach.show', ['id' => $rutina->pk_rutina]) }}"><button>Detalles</button></a>
        <a href="{{ route('rutinas.edit', ['id' => $rutina->pk_rutina]) }}">Editar</a>
        <form action="{{ route('rutina.destroy', ['id' => $rutina->pk_rutina]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar</button>
        </form>
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
