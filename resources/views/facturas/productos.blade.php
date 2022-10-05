<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col-sm-1 d-none d-md-block d-lg-none">
                <h3 class="mb-4">Productos</h3>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" class="form-control" 
                    name="producto"
                    wire:model="searchProduct"
                    wire:click.prevent="buscandoProducto()"
                    placeholder="Producto">
                    @error('searchProduct')
                    <span class="badge badge-warning">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <input type="number" 
                    placeholder="Cantidad"
                    min="1"
                    wire:model="cantidadProduct"
                    class="form-control"/>
                </div>
                @error('cantidadProduct')
                <span class="badge badge-warning">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-3 mb-4">
                <textarea class="form-control" 
                wire:model="descripcionProduct"
                rows="1">
                </textarea>
                @error('descripcionProduct')
                <span class="badge badge-warning">{{$message}}</span>
                @enderror
            </div>


            <div class="col-2 text-right mb-4">
                <button href="#!" wire:click.prevent="addProduct" class="btn btn-sm btn-success">Agregar producto +</button>
            </div>
            <div class="col text-right">
                <button href="#!" class="btn btn-sm btn-default">{{$total}}€</button>
            </div>
        </div>

        <!-- Resultado de la busqueda, productos -->
        @if ($productos->count())
            @if ($buscandoProducto)
                @foreach ($productos as $producto)
                <button type="button" class="btn btn-sm btn-primary mt-1" wire:click="productoEncontrado({{$producto->id}})">
                    <span>{{"$producto->nombre -- $producto->precio"}}€</span>
                </button>
                @endforeach
            @endif
            
        @else
        <div class="alert alert-secondary" role="alert">
            <strong>No se encuentran resultados</strong>
        </div>
        @endif

    </div>
    <div class="card-body">
        @include('facturas.productos_factura')
    </div>
</div>

