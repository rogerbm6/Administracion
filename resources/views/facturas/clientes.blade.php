    <div class="form-group">
        <div class="input-group mb-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
            </div>
            <input
            wire:model="searchCliente"
            wire:click="buscando"
            type="text"
            class="form-control"
            placeholder="Cliente">

        </div>
    </div>
    @if ($clientes->count())
        @if ($buscando)
            @foreach ($clientes as $cliente)
            
            <button type="button" class="btn btn-sm btn-primary mt-1" wire:click="encontrado({{$cliente->id}})">
                <span>{{$cliente->nombre}}</span>
            </button>
            
            @endforeach
        @endif
    @else 
    <div class="alert alert-secondary" role="alert">
        <strong>No se encuentran resultados</strong>
    </div>
    @endif

