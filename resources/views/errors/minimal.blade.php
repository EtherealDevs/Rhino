<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RINO Indumentaria</title>
    <style>
        body {
            backdrop-filter: blur(10px);
            margin: 0;
            padding: 0;
            overflow: hidden;
            position: relative;
            height: 100vh;
        }

        .polygon-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .polygon {
            position: absolute;
            width: 200px;
            height: auto;
            background-color: linear-gradient(to top right, #0051ff, #bb94b7);
            opacity: 0.5;
            clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%);
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
    </style>
</head>

<body>
    <div class="container">
        <img src="public/img/rino-blue.png" alt="Logo Rino" class="logo">
        <div class="message">
            @yield('message')
        </div>
    </div>
    <div class="polygon-container">
        <div class="polygon polygon1"></div>
        <div class="polygon polygon2"></div>
        <div class="polygon polygon3"></div>
    </div>
</body>

</html>
