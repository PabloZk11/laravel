<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Registro Salidas (Ventas)</h1>
    <table>
    <tr>
        <th scope="col">id</th>
        <th scope="col">unidades</th>
        <th scope="col">id factura</th>
        <th scope="col">id producto</th>
    </tr>
    @foreach($registro_salidas as $registro_salida)

    <tr>
        <td>{{$registro_salida->id_salida}}</td>
        <td>{{$registro_salida->unidades}}</td>
        <td>{{$registro_salida->id_factura_salida}}</td>
        <td>{{$registro_salida->id_producto}}</td>
    </tr>

    @endforeach
    </table>
</body>
</html>