<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Lista de Usuarios</title>
    <style>
    body{
        font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-size: large;
    }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            border: 3px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
            
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
        button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        button:hover {
            background-color: #ff1a1a;
        }
    </style>
</head>
<body class="bk">
<button class="button" style="margin-left: 1200px; margin-top: 10px;">

  
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
</svg>

<a href="admin"> 
<div class="text">
 Salir
</div>
</a>

</button>

    
    <h1 style="color: #ddd;">Lista de usuarios</h1>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody style="color: white;">
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->correo }}</td>
                    <td>
                        <form action="{{ route('usuario.destroy', ['id' => $usuario->pk_usuario]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
<style>
    @media (max-width: 767px){
    .button{
        margin-left: -200px;
    }
}
</style>
</html>
