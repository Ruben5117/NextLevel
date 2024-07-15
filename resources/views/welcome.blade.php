<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
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


    <h1>Registrar medidas:</h1>
    <p>Es recomendable poner tus medidas y cambiarlas con<br> constancias para una rutina más personalizada</p>
    <form action="{{ route('welcome.store') }}" method="POST">
        @csrf
        <label for="peso">Ingresa tu peso (en Kg)</label><br>
        <input type="number" name="peso" id="peso" required><br>

        <label for="estatura">Ingresa tu estatura (en cm)</label><br>
        <input type="number" name="estatura" id="estatura" required><br>

        <button type="submit">Guardar medidas</button>
    </form>
   
@else
    <h1>Tus medidas actuales:</h1>
    <p>Peso: {{ $existingMedida->peso }} Kg</p>
    <p>Estatura: {{ $existingMedida->estatura }} cm</p>
    <p>Última actualización: {{ \Carbon\Carbon::parse($existingMedida->fecha)->format('d-m-Y') }}</p>

    <button id="toggleFormBtn">Actualizar medidas</button>

    <div id="updateForm" style="display: none;">
        <h2>Medidas:</h2>
        <form action="{{ route('welcome.update') }}" method="POST">
            @csrf
            @method('PUT')
            <label for="peso">Actualizar peso (en Kg)</label><br>
            <input type="number" name="peso" id="peso" value="{{ $existingMedida->peso }}" required><br>

            <label for="estatura">Actualizar estatura (en cm)</label><br>
            <input type="number" name="estatura" id="estatura" value="{{ $existingMedida->estatura }}" required><br>

            <button type="submit">Actualizar</button>
        </form>
    </div>
@endif


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
        <a href="{{ route('cliente.show', ['id' => $rutina->pk_rutina]) }}"><button>Detalles</button></a>
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

    document.getElementById('toggleFormBtn').addEventListener('click', function() {
        var updateForm = document.getElementById('updateForm');
        if (updateForm.style.display === 'none') {
            updateForm.style.display = 'block';
        } else {
            updateForm.style.display = 'none';
        }
    });

   
</script>

</body>
</html>
