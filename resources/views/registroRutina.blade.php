<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de cliente</title>
</head>

@if (session('fk_tipo_usuario') == 2)
  @else
  <script>
    window.location.href="{{url('/')}}";
    </script>
@endif
<body>

   <form action="{{ route('rutina.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" placeholder="Nombre" required><br>
    <label for="descripción">Descripción</label>
    <textarea name="descripción" placeholder="Descripción" required></textarea><br>
    <input type="file" name="foto" accept="image/*" required><br>
    
    <select name="fk_cliente" required>
        <option value="" disabled selected>Selecciona un cliente</option>
        @foreach ($clientesDA as $cliente)
            <option value="{{ $cliente->pk_cliente }}">{{ $cliente->correo }} - {{ $cliente->nombre }}</option>
        @endforeach
    </select><br>
    
    <select name="fk_coach" required>
        <option value="" disabled selected>Selecciona un coach</option>
        @foreach ($coachs as $coach)
            <option value="{{ $coach->pk_coach }}">{{ $coach->correo }} - {{ $coach->nombre }}</option>
        @endforeach
    </select>
    
    <button type="submit">Crear Rutina</button>
</form>
    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif
</body>
</html>
