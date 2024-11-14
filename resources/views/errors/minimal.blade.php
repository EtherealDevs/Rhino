<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RINO Indumentaria</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            overflow: hidden;
            position: relative;
            height: 100vh;
        }

        .container {
            text-align: center;
            position: relative;
            z-index: 1;
            padding: 50px;
        }

        .logo {
            margin-top: 20px;
            width: 100px;
            height: auto;
        }

        h1 {
            font-size: 48px;
            font-weight: bold;
            color: #000000;
        }

        p {
            font-size: 18px;
            color: #333333;
            margin: 20px 0;
        }

        button {
            background-color: #005ac8;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px auto;
        }

        button svg {
            margin-right: 10px;
        }

        .background {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: radial-gradient(circle at center, #bb94b7, #004cff);
            opacity: 0.7;
            z-index: 0;
            filter: blur(100px);
        }
    </style>
</head>

<body>
    <div class="background"></div>
    <div class="container">
        <img src="public\img\rino-blue.png" alt="Logo Rino" class="logo">
        <div class="message">
            @yield('message')
        </div>
    </div>
</body>

</html>
