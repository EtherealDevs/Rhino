<!DOCTYPE html>
<html>

<head>
    <title>Nuevo Mensaje de Contacto</title>
</head>

<body>
    <h1>Detalles del Mensaje de Contacto</h1>
    <p><strong>Nombre:</strong> {{ $data['first_name'] }} {{ $data['last_name'] }}</p>
    <p><strong>Correo Electrónico:</strong> {{ $data['email'] }}</p>
    <p><strong>Mensaje:</strong> {{ $data['message'] }}</p>
</body>

</html>
