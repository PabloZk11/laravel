<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Informe Devolucion</h1>
    <table>
    <tr>
    <th scope="col">id</th>
        <th scope="col">unidades</th>
        <th scope="col">id_producto</th>
        <th scope="col">id_pedido</th>
        <th scope="col">id_proveedor</th>
    </tr>
    @foreach($devoluciones as $devolucion)

    <tr>
        <td>{{$devolucion->id_devolucion}}</td>
        <td>{{$devolucion->unidades}}</td>
        <td>{{$devolucion->id_producto}}</td>
        <td>{{$devolucion->id_pedido}}</td>
        <td>{{$devolucion->id_proveedor}}</td>
    </tr>

    @endforeach
    </table>
</body>
</html>