<div class="row p-4">
    <div class="col-md-6">
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
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <input
            wire:model="nif"
            type="text"
            class="form-control"
            id="exampleFormControlInput1"
            pattern="([A-Za-z]{,1})([0-9]{})([A-Za-z]{,1})"
            placeholder="NIF">
                @error('nif')
            <span class="badge badge-warning">{{$message}}</span>
                @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <input
            wire:model="telefono"
            type="text"
            class="form-control"
            id="exampleFormControlInput1"
            pattern="(?=.*\d)([0-9]{9,11})"
            placeholder="Teléfono">
                @error('telefono')
            <span class="badge badge-warning">{{$message}}</span>
                @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <input
            wire:model="email"
            type="email"
            class="form-control"
            id="exampleFormControlInput1"
            placeholder="Email">
                @error('email')
            <span class="badge badge-warning">{{$message}}</span>
                @enderror
        </div>
    </div>

    <div class="col-md-12">
        
        <div class="form-group">
            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                </div>
                <input
                wire:model="searchDescripcion"
                wire:click="buscando"
                type="text"
                class="form-control"
                placeholder="Descripción">

            @error('descripcion')
            <span class="badge badge-warning">{{$message}}</span>
                @enderror
            </div>
        </div>
        
    </div>

    @if ($buscando)
    <div class="col-md-12">
        @include('clientes.descripciones')
    </div>
    @endif

    <div class="col-md-12">
        <textarea wire:model="direccion" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Escribe la dirección aquí"></textarea>
        @error('direccion')
            <span class="badge badge-warning">{{$message}}</span>
        @enderror
    </div>
</div>