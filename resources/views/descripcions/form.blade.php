<div class="row p-4">
    <div class="col-md-12">
        <div class="form-group">
            <input
                wire:model="titulo"
                type="text"
                class="form-control"
                id="exampleFormControlInput1"
                placeholder="Título">
            @error('titulo')
            <span class="badge badge-warning">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <textarea wire:model="descripcion" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Escribe la descripción aquí"></textarea>
        @error('descripcion')
            <span class="badge badge-warning">{{$message}}</span>
        @enderror
    </div>
</div>