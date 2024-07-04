<!-- resources/views/detallesRutina.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Rutina</title>
</head>

@if (session('fk_tipo_usuario')== 2)
  @else
  <script>
    window.location.href="{{url('/')}}";
    </script>
@endif
<body>
    <h1>Detalles de la Rutina: {{ $rutina->nombre }}</h1>
    <center>
    <div>
    <p>Foto rutina:</p><img src="{{ asset('storage/' . $rutina->foto_rutina) }}" width="200" height="200">
    <p>Descripción: {{ $rutina->descripción }}</p>
    </div>
    </center>
    <div>
    <p>Foto cliente:</p>
    <img src="{{ asset('storage/' . $rutina->foto) }}" width="100" height="100">
    <p>Nombre Cliente: {{ $rutina->nombre_cliente }}</p>
    <p>Correo Cliente: {{ $rutina->correo_cliente }}</p>
    <p>Codigo del Cliente: {{ $rutina->cod_cliente }}</p>
    </div>
    <div>
    <p>Nombre Coach: {{ $rutina->nombre_coach }}</p>
    <p>Correo Coach: {{ $rutina->correo_coach }}</p>
    <p>Codigo del Coach: {{ $rutina->cod_coach }}</p>
    </div>
</body>
</html>
