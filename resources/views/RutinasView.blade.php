<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista rutinas</title>
</head>
@if (session('fk_tipo_usuario')== 2)
@else
<script>
    window.location.href="{{url('/')}}";
</script>
@endif
<body>
    <a href="/admin"><button>Index</button></a>

        <h1 >Listado de Rutinas</h1>

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

        @foreach($rutinas as $rutina)
        <div>
            <h3 class="rutina-nombre" style="cursor: pointer;">{{ $rutina->nombre }}</h3>
            <div class="rutina-detalles" style="display: none;">
                <p>Descripción: {{ $rutina->descripción }}</p>
                <img src="{{ asset('storage/' . $rutina->foto) }}" width="100" height="100">
                <p>Nombre del Cliente: {{ $rutina->nombre_cliente }}</p>
                <p>Correo del Cliente: {{ $rutina->correo_cliente }}</p>
                <p>Nombre Coach: {{ $rutina->nombre_coach }}</p>
                <p>Correo Coach: {{ $rutina->correo_coach }}</p>
                <a href="{{ route('rutinas.show', ['id' => $rutina->pk_rutina]) }}"><button>Detalles</button></a>
               
                <form action="{{ route('rutina.destroy',['id' => $rutina->pk_rutina]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
        
     
            
        </div>
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
