<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Usuarios</h1>
    <table>
    <tr>
        <th scope="col">id</th>
        <th scope="col">nombre</th>
        <th scope="col">email</th>
        <th scope="col">usuario</th>
        <th scope="col">tdoc usuario</th>
    </tr>
    @foreach($usuarios as $usuario)

    <tr>
        <td>{{$usuario->id_usuario}}</td>
        <td>{{$usuario->nombre}}</td>
        <td>{{$usuario->email}}</td>
        <td>{{$usuario->contraseña}}</td>
        <td>{{$usuario->id_usuario}}</td>
        <td>{{$usuario->id_rol}}</td>
    </tr>

    @endforeach
    </table>
</body>
</html>