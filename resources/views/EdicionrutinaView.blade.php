<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <title>Editar Rutina</title>
</head>
<body class="bk">
 <center> 
    <form class="form" action="{{ route('rutinas.update', ['id' => $rutina->pk_rutina]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <p class="title" style="color: white;">Editar Rutina</p>
        
        @if (session('success'))
            <div class="message">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="message">{{ session('error') }}</div>
        @endif

        <label for="nombre">
            <input class="input" type="text" id="nombre" name="nombre" value="{{ old('nombre', $rutina->nombre) }}" required>
            <span>Nombre</span>
        </label>
        @error('nombre')
            <div class="message">{{ $message }}</div>
        @enderror

        <label for="descripción">
            <textarea class="input" id="descripción" name="descripción" required>{{ old('descripción', $rutina->descripción) }}</textarea>
            <span>Descripción</span>
        </label>
        @error('descripción')
            <div class="message">{{ $message }}</div>
        @enderror

        <label for="foto">
            <input class="input" type="file" id="foto" name="foto" required>
            <span>Foto</span>
        </label>
        @error('foto')
            <div class="message">{{ $message }}</div>
        @enderror

        <button class="submit" type="submit">Actualizar</button>
    </form>
    </center>

    
    
<button class="button" style="margin-top: -300px;">
  
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
</svg>

<a href="/coach"> 
<div class="text">
 Salir
</div>
</a>

</button>
</body>
</html>
