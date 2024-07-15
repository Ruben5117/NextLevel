<!DOCTYPE html>
<html>
<head>
    <title>Editar Rutina</title>
</head>
<body>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <form action="{{ route('rutinas.update', ['id' => $rutina->pk_rutina]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $rutina->nombre) }}" >
            @error('nombre')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="descripción">Descripción:</label>
            <textarea id="descripción" name="descripción" >{{ old('descripción', $rutina->descripción) }}</textarea>
            @error('descripción')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto">
            @error('foto')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Actualizar</button>
    </form>
    <a href="/coach"><button>Index</button></a><br>
</body>
</html>
