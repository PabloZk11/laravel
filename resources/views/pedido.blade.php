<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Informe Pedidos</h1>
    <table>
    <tr>
    <th scope="col">id</th>
        <th scope="col">unidades</th>
        <th scope="col">id_producto</th>
        <th scope="col">id_admin</th>
        <th scope="col">id_proveedor</th>
    </tr>
    @foreach($pedidos as $pedido)

    <tr>
        <td>{{$pedido->id_pedido}}</td>
        <td>{{$pedido->unidades}}</td>
        <td>{{$pedido->id_producto}}</td>
        <td>{{$pedido->id_admin}}</td>
        <td>{{$pedido->id_proveedor}}</td>
    </tr>

    @endforeach
    </table>
</body>
</html>