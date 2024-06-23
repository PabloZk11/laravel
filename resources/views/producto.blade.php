<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Productos</h1>
    <table>
    <tr>
    <th scope="col">id</th>
        <th scope="col">nombre</th>
        <th scope="col">precio_unitario</th>
        <th scope="col">unidades_disponibles</th>
        <th scope="col">marca</th>
        <th scope="col">id proveedor</th>
        <th scope="col">categoria</th>
    </tr>
    @foreach($productos as $producto)

    <tr>
        <td>{{$producto->id_producto}}</td>
        <td>{{$producto->nom_producto}}</td>
        <td>{{$producto->precio_unitario}}</td>
        <td>{{$producto->unidades_disponibles}}</td>
        <td>{{$producto->marca}}</td>
        <td>{{$producto->proveedor_id_proveedor}}</td>
        <td>{{$producto->categoria_producto}}</td>
    </tr>

    @endforeach
    </table>
</body>
</html>