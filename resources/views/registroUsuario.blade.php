<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Registro de usuarios</title>
</head>
<body class="bk">

    <form id="registroForm" action="{{ route('usuario.store') }}" method="POST">
        @csrf
        <label for="correo">Correo</label>
        <input type="email" name="correo" placeholder="Correo electrónico" required>
        
        <label for="contraseña">Contraseña</label>
        <input type="password" name="contraseña" placeholder="Contraseña" required>
        
        <input type="hidden" name="fk_tipo_usuario" value="1">
        <input type="hidden" name="fk_persona" value="{{ $fk_persona }}">
        
        <button type="submit">Guardar Usuario</button>
    </form>

    @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert error">
            {{ session('error') }}
        </div>
    @endif

</body>
<style>
    body.bk {
  background-color: #050715;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
  font-family: Arial, sans-serif;
  color: #fff;
}

#registroForm {
  display: flex;
  flex-direction: column;
  gap: 15px;
  padding: 20px;
  border-radius: 10px;
  background-color: #1a1a1a;
  border: 1px solid #333;
  max-width: 350px;
  width: 100%;
}

#registroForm label {
  font-size: 14px;
  color: #A238FF;
}

#registroForm input[type="email"],
#registroForm input[type="password"] {
  padding: 10px;
  border: 1px solid #A238FF;
  border-radius: 5px;
  background-color: #333;
  color: #fff;
  outline: none;
}

#registroForm input[type="email"]::placeholder,
#registroForm input[type="password"]::placeholder {
  color: rgba(255, 255, 255, 0.5);
}

#registroForm button {
  padding: 10px;
  border: none;
  border-radius: 5px;
  background-color: #A238FF;
  color: #fff;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s;
}

#registroForm button:hover {
  background-color: #8831cc;
}

.alert {
  margin-top: 15px;
  padding: 10px;
  border-radius: 5px;
  text-align: center;
  max-width: 350px;
  width: 100%;
}

.alert.success {
  background-color: green;
}

.alert.error {
  background-color: red;
}

@media (max-width: 768px) {
  #registroForm {
    padding: 15px;
  }

  #registroForm button {
    font-size: 14px;
    padding: 8px;
  }

  .alert {
    font-size: 14px;
  }
}

@media (max-width: 480px) {
  #registroForm {
    padding: 10px;
  }

  #registroForm label {
    font-size: 12px;
  }

  #registroForm input[type="email"],
  #registroForm input[type="password"] {
    padding: 8px;
  }

  #registroForm button {
    font-size: 12px;
    padding: 6px;
  }

  .alert {
    font-size: 12px;
  }
}

</style>
</html>
