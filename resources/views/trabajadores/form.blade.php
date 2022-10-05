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
                wire:model="telefono"
                type="text"
                class="form-control"
                id="exampleFormControlInput1"
                placeholder="Telefono">
            @error('telefono')
            <span class="badge badge-warning">{{$message}}</span>
            @enderror
        </div>
    </div>

</div>