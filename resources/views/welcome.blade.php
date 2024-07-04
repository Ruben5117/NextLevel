<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
@if (session('id'))
  @else
  <script>
    window.location.href="{{url('/')}}";
    </script>
@endif
    <h1>Hola</h1>
<form action="/logout" method="POST">
   @csrf
   <button type="submit">Logout</button><br>


</form>
</body>
</html>