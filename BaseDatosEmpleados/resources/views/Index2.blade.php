<!DOCTYPE html>
<html lang="es">
<head>
    <title>Burguer Joint | HOME</title>
    <meta charset="utf-8" />
    <meta name="description" content="Este es el Home de la pagina, esta trata sobre hamburgesas. 
    Contiene imagenes, una breve historia y los premios obtenios">
    <!-- Hoja de estilos css -->
    <link href="{{ url('assets/css/style.css') }}" rel="stylesheet">
    @yield('css')
    <!-- Icono de la pagina de navegación -->
    <link rel="shortcut icon" href="" />
  
</head>

<body>


    <div id="cajaHome">
        @section('header')
        <header>

            <nav>
                <ul id="main-nav">
                    <li class="linkHeader"><a href="{{ url('/') }}">INICIO</a></li>
                    <li class="linkHeader"><a href="{{ url('puesto') }}">PUESTOS</a> </li>
                    <li id="nombreHeader">BURGUER</br>JOINT</li>
                    <li class="linkHeader"><a href="{{ url('departamento') }}">DEPARTAMENTOS</a></li>
                    <li class="linkHeader"><a href="{{ url('trabajador') }}">TRABAJADORES</a></li>
                </ul>
            </nav>
    @show
        </header>
    </div>
    <div>
             @yield('content')
        </div>

<script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    @yield('js')
  </body>
</html>