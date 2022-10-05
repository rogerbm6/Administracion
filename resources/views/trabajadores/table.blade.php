            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">{{$name_page}}</h3>
                        </div>
                    </div>
                </div>
                @if ($trabajadores->count())

                <div class="table">
                    <!-- Projects table -->
                    <table class="table align-items-center" id="example">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Telefono</th>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trabajadores as $trabajador)
                            <tr class="flex-wrap">
                                <td>
                                    {{$trabajador->nombre}}
                                </td>
                                <td>
                                    {{$trabajador->telefono}}
                                </td>

                                <td>
                                    <button type="button" wire:click="edit({{$trabajador->id}})" class="btn btn-sm btn-primary">
                                        <i class="ni ni-ruler-pencil text-success mr-3"></i>Editar</button>
                                </td>
                                
                                <td>
                                    <button type="button" wire:click="destroy({{$trabajador->id}})" class="btn btn-sm btn-danger">
                                        <i class="ni ni-fat-delete text-success mr-3"></i>Eliminar</button>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$trabajadores->links('livewire.partials.pagination-links')}}
                </div>
                @else 
                <div class="alert alert-secondary" role="alert">
                    <strong>Sin resultados,</strong> no se encuentra ningún registro
                </div>
                @endif

            </div>




