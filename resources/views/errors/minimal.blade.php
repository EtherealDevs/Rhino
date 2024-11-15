<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RINO Indumentaria</title>
    <style>
        body {
            backdrop-filter: blur(5px);
            margin: 0;
            padding: 0;
            overflow: hidden;
            position: relative;
            height: 100vh;
        }

        .container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: 50;
            display: flex;
            justify-content: center;
            backdrop-filter: blur(20px);
            align-items: center;
            flex-direction: column;
        }

        .polygon-container {
            backdrop-filter: blur(20px);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: -1;
        }

        .polygon {
            position: absolute;
            width: 200px;
            height: 200px;
            background-color: rgba(0, 161, 211, 0.2);
            clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
        }

        .polygon1 {
            top: 10%;
            left: 10%;
            transform: rotate(20deg);
        }

        .polygon2 {
            top: 50%;
            left: 50%;
            transform: rotate(50deg) translate(-50%, -50%);
        }

        .polygon3 {
            bottom: 10%;
            right: 10%;
            transform: rotate(-30deg);
        }

        .absolute {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .button-scale {
            padding: 12px 24px;
            font-size: 16px;
            color: #fff;
            background-color: #1144aa;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .button-scale:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <div class="absolute"></div>
    <div class="container">
        <img src="{{ asset('img/rino-blue.png') }}" alt="Logo Rino">
        <div class="message">
            @yield('message')
        </div>
        <a href="{{ url('/') }}">
            <button class="button-scale" role="button">
                Volver al Inicio
            </button>
        </a>
    </div>
    {{-- <div class="polygon-container">
        <div class="polygon polygon1"></div>
        <div class="polygon polygon2"></div>
        <div class="polygon polygon3"></div>
    </div> --}}
</body>

</html>
