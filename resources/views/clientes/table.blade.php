<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Clientes</h3>
            </div>
        </div>
    </div>
    @if ($clientes->count())

    <div class="table">
        <!-- Projects table -->
        <table class="table align-items-center" id="example">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Nif</th>
                    <th scope="col">Telefono</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                <tr class="flex-wrap">
                    <td>
                        {{$cliente->nombre}}
                    </td>
                    <td>
                        {{$cliente->nif}}
                    </td>

                    <td>
                        {{$cliente->telefono}}
                    </td>

                    <td class="text-white">
                        <button type="button" wire:click="edit({{$cliente->id}})" class="btn btn-sm btn-primary my-1">
                            <i class="ni ni-ruler-pencil text-success mr-3"></i>Editar</button>

                        <button type="button" wire:click="destroy({{$cliente->id}})" class="btn btn-sm btn-danger my-1">
                            <i class="ni ni-fat-delete text-success mr-3"></i>Eliminar</button>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        {{$clientes->links('livewire.partials.pagination-links')}}
    </div>
    @else 
    <div class="alert alert-secondary" role="alert">
        <strong>Sin resultados,</strong> no se encuentra ningún registro
    </div>
    @endif

</div>