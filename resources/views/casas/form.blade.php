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
            wire:model="numero"
            type="text"
            class="form-control"
            id="exampleFormControlInput1"
            placeholder="Número">

            @error('numero')
            <span class="badge badge-warning">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <textarea wire:model="direccion" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Escribe la direccion aquí"></textarea>
        @error('direccion')
            <span class="badge badge-warning">{{$message}}</span>
        @enderror
    </div>
</div>