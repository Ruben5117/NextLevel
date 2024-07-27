<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Inicia sesion</title>
</head>  
<body class="bk">
        <div class="esp"> <h1 class="h1r"> INICIA SESIÓN</h1>
        <button class="btnr"> ¿No tienes una cuenta?, haz click  <a href="registroPersona">aquí</a> </button>
    </div> 

    <form  class="divr" action="{{ route('login.store') }}" method="POST" style="padding: 10px;">
        @csrf

        <div class="group">

  <input required value="{{ old('correo') }}" type="email" name="correo" placeholder="Correo" class="input">
  @error('correo')
        <small style="color:red">{{ $message }}</small>
        @enderror
        
        <br> <br>
        <label for="contraseña"></label><br>
        <input type="password" name="contraseña" required value="{{ old('contraseña') }}"  placeholder="Contraseña" class="input"><br>
        @error('contraseña')
        <small style="color:red">{{ $message }}</small>
        @enderror
        <br>

        <button type="submit" class="bl"> Inicia sesión
</button>
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
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<style>
     @media (max-width: 767px){
        .divr{
        margin-left: 25px;
    }
    .esp{
        margin-left: -70px;
    }
   
}

    
</style>

</body>
</html>
