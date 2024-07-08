<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Rutina Coach</title>
</head>

@if (session('fk_tipo_usuario') != 4)
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
        <p>Peso del cliente: {{ $rutina->peso_cliente }} Kg</p>
        <p>Estatura del cliente: {{ $rutina->estatura_cliente }} cm</p>
    </div>
    <a href="/coach"><button>Index</button></a><br>

    <form action="{{ route('comentarios.store', ['id' => $rutina->pk_rutina]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="comentario">Escribe tu comentario</label><br>
        <textarea type="text" name="comentario" placeholder="comentario" required></textarea><br>
        <button type="submit">Publicar</button>
    </form>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <h2>Comentarios</h2>
    <div id="detalleseleccion" name="detalleseleccion" class="este">
    @if ($comentarios->isEmpty())
        <p>No hay comentarios para esta rutina.</p>
    @else
        <ul>
            @php
                $sortedComentarios = $comentarios->sortByDesc('fecha');
            @endphp
            @foreach ($sortedComentarios as $comentario)
                <li>
                    <p>Por: {{ $comentario->usuario->persona->nombre }}</p>
                    <p>{{ $comentario->comentario }}</p>
                    <p>Fecha: {{ $comentario->fecha }}</p>
                    @if(auth()->id() == $comentario->fk_usuario)
                        <button class="rutina-nombre" data-comentario-id="{{ $comentario->pk_comentario }}" style="cursor: pointer;">Editar</button>
                        <div id="comentario-{{ $comentario->pk_comentario }}-form" class="rutina-detalles" style="display: none;">
                            <form action="{{ route('comentario.update', ['id' => $comentario->pk_comentario]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label for="comentario">Comentario:</label>
                                    <input type="text" id="comentario" name="comentario" value="{{ old('comentario', $comentario->comentario) }}">
                                    @error('comentario')
                                        <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit">Actualizar</button>
                            </form>
                        </div>
                        <form action="{{ route('comentario.destroy', ['id' => $comentario->pk_comentario]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Eliminar</button>
</form>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
    </div>
</body>
</html>
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
<style>
    .este {
        height: 20em;
        line-height: 1em;
        overflow-x: hidden;
        overflow-y: scroll;
        width: 100%;
        border: 1px solid;
        background-color: lightblue;
    }
</style>
