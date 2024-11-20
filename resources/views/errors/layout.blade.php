<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <style>
        /* Estilos base */
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.25);
            backdrop-blur: 2xl;
            position: relative;
            overflow: hidden;
        }

        /* Fondo con rombos */
        body::before,
        body::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            z-index: -1;
            opacity: 0.2;
        }

        /* Contenedor principal */
        .container {
            background-color: transparent;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 2rem;
            height: 100vh;
            width: 100vw;
            text-align: center;
            position: relative;
            z-index: 1;
            /* Asegúrate de que el contenedor principal esté por encima de los polígonos */
        }

        /* Texto */
        .code {
            font-size: 2rem;
            font-weight: bold;
            color: #4a5568;
            border-right: 2px solid #cbd5e0;
            padding-right: 1rem;
            margin-right: 1rem;
        }

        .message {
            font-size: 1.25rem;
            color: #4a5568;
            text-transform: uppercase;
        }

        /* Estilos para los polígonos */
        .polygon-container {
            position: absolute;
            inset-x: 0;
            top: 0;
            /* Ajusta esto si deseas que los polígonos estén más arriba o más abajo */
            z-index: -1;
            /* Asegúrate de que los polígonos estén detrás del contenedor principal */
            transform: translate3d(0, 0, 0);
            overflow: hidden;
            filter: blur(3xl);
            pointer-events: none;
            /* Asegúrate de que los polígonos no interfieran con los clics */
        }

        .polygon {
            position: absolute;
            aspect-ratio: 1155 / 678;
            width: 10rem;
            /* Ajusta el tamaño del polígono */
            height: auto;
            /* Mantén la relación de aspecto */
            background: linear-gradient(to top right, #0051ff, #bb94b7);
            opacity: 0.3;
            clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%);
        }

        /* Posiciones de los polígonos */
        .polygon1 {
            top: 10%;
            left: 10%;
            transform: rotate(20deg);
        }

        .polygon2 {
            top: 50%;
            left: 50%;
            transform: rotate(50deg) translateX(-50%);
        }

        .polygon3 {
            bottom: 10%;
            right: 10%;
            transform: rotate(-30deg);
        }
    </style>
</head>

<body class="antialiased">
    <div class="container">
        <div class="flex items-center justify-center">
            <div class="code">
                @yield('code')
            </div>
            <div class="message">
                @yield('message')
            </div>
        </div>
    </div>
</body>

</html>
