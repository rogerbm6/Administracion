<div class="row p-4">
    <div class="col-md-12">
        <div class="form-group">
            <input
                wire:model="nombre"
                type="text"
                class="form-control"
                id="exampleFormControlInput1"
                placeholder="Nombre">
            @error('nombre')
            <span class="badge badge-warning">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <input
                wire:model="precio"
                type="number"
                class="form-control"
                id="exampleFormControlInput1"
                step="0.01"
                min=0
                placeholder="Precio">
            @error('precio')
            <span class="badge badge-warning">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    Personalizado:
                </div>
                <div class="col-md-8">
                    <label class="custom-toggle">
                        <input type="checkbox" wire:model="personalizado">
                        <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                </div>
            </div>
            @error('personalizado')
            <span class="badge badge-warning">{{$message}}</span>
            @enderror
        </div>

        @if ($personalizado)
            @include('productos.clientes')
        @endif
        

    </div>
</div>