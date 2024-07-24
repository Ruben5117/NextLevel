<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Admin Index</title>
</head>
@if (session('fk_tipo_usuario')== 2)
  @else
  <script>
    window.location.href="{{url('/')}}";
  </script>
@endif

<body class="bk">
<form action="/logout" method="POST">
   @csrf
</form>
<nav class="nav">
    <div class="container">
        <div class="logo" style="margin-left: 20px; position:absolute; margin-top:70px;">
            <a class="aaa" style="color: white;">NEXTLEVEL</a>
        </div>
        <style>
            li {
                margin-right: 30px;
                font-size: 10px;
            }
        </style>
        <div class="navv">
            <div id="mainListDiv" class="main_list">
                <ul class="navlinks">
                    <li><a href="#">Inicio</a></li>
                    <li><a href="/registroPersona">Personas</a></li>
                    <li><a href="/cliente">Clientes</a></li>
                    <li><a href="/coachs">Coachs</a></li>
                    <li><a href="/tipo_usuario">Registrar tipo de usuario</a></li>
                    <li><a href="/usuariosAD">Usuarios</a></li>
                    <li><a href="/rutinas">Rutinas</a></li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btnlo">Cerrar sesión</button>
                    </form>
                </ul>
            </div>
            <span class="navTrigger">
                <i></i>
                <i></i>
                <i></i>
            </span>
        </div>
    </div>
</nav>

<div class="fondo">
    <img src="css/img/fondoindex.jpg" class="imgf">
</div>

<script>
$(document).ready(function() {
    $('.navTrigger').click(function () {
        $(this).toggleClass('active');
        $("#mainListDiv").toggleClass("show_list");
        console.log("Clicked menu");
    });
});
</script>

<style>
@media screen and (max-width: 768px) {

    .imgf{
  width: 100%;
  height: 100vh;
  background-image: url("/./public/css/img/fondoindex2.jpg") !important;
  background-size: cover; /* Hace que la imagen cubra todo el contenedor */
  background-position: center; /* Centra la imagen */
  background-repeat: no-repeat; /* Evita que la imagen se repita */
}
    .navTrigger {
        display: block;
    }
    .nav div.logo {
        margin-left: 15px;
    }
    .nav div.main_list {
        width: 100%;
        height: 0;
        overflow: hidden;
    }
    .nav div.show_list {
        height: auto;
    }
    .nav div.main_list ul {
        flex-direction: column;
        width: 100%;
        height: 100vh;
        background-color: #5E3AD4;
        background-position: center top;
    }
    .nav div.main_list ul li {
        width: 100%;
        text-align: center;
    }
    .nav div.main_list ul li a {
        width: 100%;
        font-size: 2rem;
        padding: 10px;
    }
}



@-webkit-keyframes inM {
    50% {
        -webkit-transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(45deg);
    }
}

@keyframes inM {
    50% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(45deg);
    }
}

@-webkit-keyframes outM {
    50% {
        -webkit-transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(45deg);
    }
}

@keyframes outM {
    50% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(45deg);
    }
}

@-webkit-keyframes inT {
    0% {
        -webkit-transform: translateY(0px) rotate(0deg);
    }
    50% {
        -webkit-transform: translateY(9px) rotate(0deg);
    }
    100% {
        -webkit-transform: translateY(9px) rotate(135deg);
    }
}

@keyframes inT {
    0% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(9px) rotate(0deg);
    }
    100% {
        transform: translateY(9px) rotate(135deg);
    }
}

@-webkit-keyframes outT {
    0% {
        -webkit-transform: translateY(0px) rotate(0deg);
    }
    50% {
        -webkit-transform: translateY(9px) rotate(0deg);
    }
    100% {
        -webkit-transform: translateY(9px) rotate(135deg);
    }
}

@keyframes outT {
    0% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(9px) rotate(0deg);
    }
    100% {
        transform: translateY(9px) rotate(135deg);
    }
}

@-webkit-keyframes inBtm {
    0% {
        -webkit-transform: translateY(0px) rotate(0deg);
    }
    50% {
        -webkit-transform: translateY(-9px) rotate(0deg);
    }
    100% {
        -webkit-transform: translateY(-9px) rotate(135deg);
    }
}

@keyframes inBtm {
    0% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(-9px) rotate(0deg);
    }
    100% {
        transform: translateY(-9px) rotate(135deg);
    }
}

@-webkit-keyframes outBtm {
    0% {
        -webkit-transform: translateY(0px) rotate(0deg);
    }
    50% {
        -webkit-transform: translateY(-9px) rotate(0deg);
    }
    100% {
        -webkit-transform: translateY(-9px) rotate(135deg);
    }
}

@keyframes outBtm {
    0% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(-9px) rotate(0deg);
    }
    100% {
        transform: translateY(-9px) rotate(135deg);
    }
}


.navTrigger {
    cursor: pointer;
    width: 30px;
    height: 25px;
    margin: auto;
    position: absolute;
    right: 30px;
    top: 0;
    bottom: 0;
}

.navTrigger i {
    background-color: #fff;
    border-radius: 2px;
    content: '';
    display: block;
    width: 100%;
    height: 4px;
}

.navTrigger i:nth-child(2) {
    margin: 5px 0;
}

.navTrigger.active i:nth-child(1) {
    transform: translateY(9px) rotate(135deg);
}

.navTrigger.active i:nth-child(2) {
    opacity: 0;
}

.navTrigger.active i:nth-child(3) {
    transform: translateY(-9px) rotate(135deg);
}

.affix {
    padding: 0;
    margin: 0;
    background-color: blue;
}

.navv {
    background-color: #050715;
    padding: 30px;
    width: 100%;
}
</style>

</body>
</html>
