            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">{{$name_page}}</h3>
                        </div>
                        <div class="col text-right">
                            <button href="#!" wire:click.prevent="crear" class="btn btn-sm btn-success"><i class="ni ni-fat-add text-Secondary mr-3"></i>Crear nueva factura</button>
                        </div>
                    </div>
                </div>
                @if ($facturas->count())

                <div class="table">
                    <!-- Projects table -->
                    <table class="table align-items-center" id="example">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Número</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Total</th>
                                <th colspan="1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facturas as $factura)
                            <tr class="flex-wrap">
                                <td>
                                    {{$factura->numero}}
                                </td>
                                <td>
                                    {{$factura->fecha}}
                                </td>
                                <td>
                                    {{$factura->cliente->nombre}}
                                </td>

                                <td>
                                    {{$factura->total}}€
                                </td>
                                
                                <td>
                                    <button type="button" wire:click="destroy({{$factura->id}})" class="btn btn-sm btn-danger">
                                        <i class="ni ni-fat-delete text-success"></i>Eliminar</button>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$facturas->links('livewire.partials.pagination-links')}}
                </div>
                @else 
                <div class="alert alert-secondary" role="alert">
                    <strong>Sin resultados,</strong> no se encuentra ningún registro
                </div>
                @endif

            </div>




