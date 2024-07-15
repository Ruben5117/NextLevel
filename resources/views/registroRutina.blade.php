<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Registro de rutina</title>
</head>

@if (session('fk_tipo_usuario')== 2)
  @else
  <script>
    window.location.href="{{url('/')}}";
    </script>
@endif
<body class="bk">
<button class="button">

  
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
</svg>

<a href="admin"> 
<div class="text">
 Salir
</div>
</a>

</button>


<img src="css/img/imgr.jpg" class="imgg"> 
    <div class="line"> </div>

   <form action="{{ route('rutina.store') }}" method="POST" enctype="multipart/form-data" class="form" style="margin-left: auto; margin-top: -40%; margin-right: 110px;">
    @csrf
    <p class="title">Registro </p>
    <p class="message">Registra la rutina </p>
    <label for="nombre"></label>
    <input class="input" type="text" name="nombre" placeholder="Nombre" required><br>
    <label for="descripción"></label>
    <textarea name="descripción" placeholder="Descripción" required class="input"></textarea><br>
    <input type="file" name="foto" accept="image/*" required class="input"><br>
    
    <select name="fk_cliente" required class="input">
        <option value="" disabled selected>Selecciona un cliente</option>
        @foreach ($clientesDA as $cliente)
            <option value="{{ $cliente->pk_cliente }}">{{ $cliente->correo }} - {{ $cliente->nombre }}</option>
        @endforeach
    </select>
    
    <select name="fk_coach" required class="input">
        <option value="" disabled selected>Selecciona un coach</option>
        @foreach ($coachs as $coach)
            <option value="{{ $coach->pk_coach }}">{{ $coach->correo }} - {{ $coach->nombre }}</option>
        @endforeach
    </select>
    
    <button type="submit" class="bl">Crear Rutina</button>
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

    <style>
        input{
            color: white;
            
        }
        label{
            color: white;
        }
        textarea{
            color: white;
        }
        select{
            color: white;
        }
    </style>
</body>
</html>
