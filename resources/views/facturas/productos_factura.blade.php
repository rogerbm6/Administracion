@if ($productsFactura)
<table class="table">
    <thead>
        <tr>
            <th>Productos</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Notas</th>
            <th colspan="1"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productsFactura as $productoFactura)
        <tr>
            <td scope="row">{{$productoFactura["producto"]["nombre"]}}</td>
            <td>{{$productoFactura["producto"]["precio"]}}€</td>
            <td>{{$productoFactura["cantidad"]}}</td>
            <td>{{$productoFactura["cantidad"] * $productoFactura["producto"]["precio"]}}€</td>
            <td>{{$productoFactura["notas"]}}</td>
            <td><div class="btn">ver</div></td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="alert alert-secondary" role="alert">
    <strong>Aun no se han agregado productos a la factura</strong>
</div>
@endif


