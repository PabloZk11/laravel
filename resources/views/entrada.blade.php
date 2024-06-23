<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Entradas Mercancia</h1>
    <table>
    <tr>
    <th scope="col">id</th>
        <th scope="col">unidades</th>
        <th scope="col">id_producto</th>
        <th scope="col">id_pedido</th>
        <th scope="col">id_proveedor</th>
    </tr>
    @foreach($entradas as $entrada)

    <tr>
        <td>{{$entrada->id_entrada}}</td>
        <td>{{$entrada->cantidad_unidades}}</td>
        <td>{{$entrada->id_producto}}</td>
        <td>{{$entrada->id_pedido}}</td>
        <td>{{$entrada->id_proveedor}}</td>
    </tr>

    @endforeach
    </table>
</body>
</html>