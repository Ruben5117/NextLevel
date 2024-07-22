<!-- resources/views/detallesRutina.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Rutina</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #050715;
            color: #ffffff;
            font-family: 'Roboto', sans-serif;
        }
        h1, h2 {
            text-align: center;
            color: #A238FF;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #1c1c24;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section img {
            display: block;
            margin: 0 auto;
            border-radius: 8px;
        }
        .section p {
            text-align: center;
        }
    </style>
</head>

@if (session('fk_tipo_usuario') == 2)
@else
<script>
    window.location.href="{{ url('/') }}";
</script>
@endif

<body>
    <div class="container">
        <h1>Detalles de la Rutina: {{ $rutina->nombre }}</h1>
        
        <div class="section">
            <p>Foto rutina:</p>
            <img src="{{ asset('storage/' . $rutina->foto_rutina) }}" width="200" height="200">
            <p>Descripción: {{ $rutina->descripción }}</p>
        </div>
        
        <div class="section">
            <p>Foto cliente:</p>
            <img src="{{ asset('storage/' . $rutina->foto) }}" width="100" height="100">
            <p>Nombre Cliente: {{ $rutina->nombre_cliente }}</p>
            <p>Correo Cliente: {{ $rutina->correo_cliente }}</p>
            <p>Código del Cliente: {{ $rutina->cod_cliente }}</p>
        </div>
        
        <div class="section">
            <p>Nombre Coach: {{ $rutina->nombre_coach }}</p>
            <p>Correo Coach: {{ $rutina->correo_coach }}</p>
            <p>Código del Coach: {{ $rutina->cod_coach }}</p>
        </div>
    </div>
</body>
</html>
