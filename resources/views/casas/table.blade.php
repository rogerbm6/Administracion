<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Casas</h3>
            </div>
        </div>
    </div>
    @if ($casas->count())

    <div class="table">
        <!-- Projects table -->
        <table class="table align-items-center" id="example">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Numero</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($casas as $casa)
                <tr class="flex-wrap">
                    <td>
                        {{$casa->nombre}}
                    </td>
                    <td>
                        {{$casa->direccion}}
                    </td>

                    <td>
                        {{$casa->numero}}
                    </td>

                    <td>
                        <button type="button" wire:click="edit({{$casa->id}})" class="btn btn-sm btn-primary">
                            <i class="ni ni-ruler-pencil text-success mr-3"></i>Editar</button>
                    </td>
                    
                    <td>
                        <button type="button" wire:click="destroy({{$casa->id}})" class="btn btn-sm btn-danger">
                            <i class="ni ni-fat-delete text-success"></i>Eliminar</button>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        {{$casas->links('livewire.partials.pagination-links')}}
    </div>
    @else 
    <div class="alert alert-secondary" role="alert">
        <strong>Sin resultados,</strong> no se encuentra ningún registro
    </div>
    @endif

</div>




