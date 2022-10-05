<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Entradas</h3>
            </div>
        </div>
    </div>
    @if (count($calendario))

    <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center" id="example">
            <thead class="thead-light">
                <tr>
                    <th scope="col">casas</th>
                    @foreach ($calendario[$casas[0]->nombre] as $fecha => $datos)
                        
                        <th scope="col" 
                        @if ($fecha==date("Y-m-d"))
                        style="background-color : #f8e5af;"
                        @endif
                        >{{substr($fecha, -2)}}</th>
                        
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($calendario as $casa => $dia)
                <tr>
                    <th scope="col" class="position-absolute">{{$casa}}</th>
                    @foreach ($dia as $diita => $entrada)
                        <td>
                            <div class="{{$entrada['ocupado'] ? 'table-danger' : 'table-success'}}
                            @if(count($entrada)>2)
                            p-3 m-0
                            @else
                            p-4 m-0
                            @endif
                            ">

                            @if ($entrada['salida'])
                                <svg width="20" height="10" viewBox="0 0 72 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 41L36 11L66 41" stroke="black" stroke-width="15"/>
                                </svg>
                                
                            @endif

                            @if (count($entrada)>2 && !$entrada['salida'])
                                <svg width="20" height="10" viewBox="0 0 72 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 6L36 36L66 6" stroke="black" stroke-width="15"/>
                                </svg>
                                
                                
                            @endif

                            </div>
                        </td>
                    @endforeach
                </tr>
                
                @endforeach

            </tbody>
        </table>
    </div>
    @else 
    <div class="alert alert-secondary" role="alert">
        <strong>Sin resultados,</strong> no se encuentra ningún registro
    </div>
    @endif

</div>