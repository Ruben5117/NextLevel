<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Detalles de la Rutina Coach</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #050715;
            color: #ffffff;
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
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button-container button {
            padding: 10px 20px;
            background-color: #A238FF;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button-container button:hover {
            background-color: #861ccd;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        form label, form textarea, form input, form button {
            width: 100%;
            max-width: 500px;
            margin-bottom: 10px;
        }
        form textarea {
            height: 100px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        form button {
            width: auto;
            background-color: #A238FF;
            color: #ffffff;
        }
        form button:hover {
            background-color: #861ccd;
        }
        .success-message {
            color: green;
            text-align: center;
        }
        .comments {
            background-color: #2a2a3a;
            padding: 10px;
            border-radius: 5px;
        }
        .comments ul {
            list-style-type: none;
            padding: 0;
        }
        .comments li {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #1c1c24;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }
        .comments p {
            margin: 5px 0;
        }
        .comment-actions {
            display: flex;
            align-items: center;
        }
        .comment-actions form, .comment-actions button {
            margin: 0;
        }
        .edit-comment, .delete-comment {
            padding: 5px 10px;
            background-color: #A238FF;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .edit-comment:hover, .delete-comment:hover {
            background-color: #861ccd;
        }
        .edit-form {
            display: none;
            margin-top: 10px;
        }
        .scrollable {
            height: 20em;
            line-height: 1em;
            overflow-x: hidden;
            overflow-y: scroll;
            width: 100%;
            border: 1px solid #ccc;
            background-color: #2a2a3a;
            border-radius: 8px;
            padding: 10px;
        }
    </style>
</head>
<body>
    @if (session('fk_tipo_usuario') != 4)
    <script>
        window.location.href="{{url('/')}}";
    </script>
    @endif

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
            <p>Peso del cliente: {{ $rutina->peso_cliente }} Kg</p>
            <p>Estatura del cliente: {{ $rutina->estatura_cliente }} cm</p>
        </div>

        <div class="button-container">
            <a href="/coach"><button class="button">Regresar</button></a>
        </div>
        
        <form action="{{ route('comentarios.store', ['id' => $rutina->pk_rutina]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="comentario">Escribe tu comentario</label><br>
            <textarea name="comentario" placeholder="comentario" required></textarea><br>
            <button type="submit">Publicar</button>
        </form>

        @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
        @endif

        <h2>Comentarios</h2>
        <div id="detalleseleccion" name="detalleseleccion" class="scrollable">
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
                    <div class="comment-actions">
                        <button class="edit-comment" data-comentario-id="{{ $comentario->pk_comentario }}">Editar</button>
                        <form action="{{ route('comentario.destroy', ['id' => $comentario->pk_comentario]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-comment">Eliminar</button>
                        </form>
                    </div>
                    <div id="comentario-{{ $comentario->pk_comentario }}-form" class="edit-form">
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
                    @endif
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('.edit-comment');
            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const form = document.getElementById(`comentario-${this.dataset.comentarioId}-form`);
                    form.style.display = form.style.display === 'none' ? 'block' : 'none';
                });
            });
        });
    </script>
</body>
</html>
