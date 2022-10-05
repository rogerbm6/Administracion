            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Descripciones</h3>
                        </div>
                    </div>
                </div>
                @if ($descripciones->count())

                <div class="table">
                    <!-- Projects table -->
                    <table class="table align-items-center" id="example">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Titulo</th>
                                <th scope="col">Descripción</th>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($descripciones as $descripcion)
                            <tr class="flex-wrap">
                                <td>
                                    {{$descripcion->titulo}}
                                </td>
                                <td>
                                    {{$descripcion->descripcion}}
                                </td>

                                <td>
                                    <button type="button" wire:click="edit({{$descripcion->id}})" class="btn btn-sm btn-primary">
                                        <i class="ni ni-ruler-pencil text-success mr-3"></i>Editar</button>
                                </td>
                                
                                <td>
                                    <button type="button" wire:click="destroy({{$descripcion->id}})" class="btn btn-sm btn-danger">
                                        <i class="ni ni-fat-delete text-success"></i>Eliminar</button>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$descripciones->links('livewire.partials.pagination-links')}}
                </div>
                @else 
                <div class="alert alert-secondary" role="alert">
                    <strong>Sin resultados,</strong> no se encuentra ningún registro
                </div>
                @endif

            </div>




