<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar Cliente</h3>
            </div>
        </div>
    </div>

    @include('clientes.form')

    <div class="card-footer py-4 align-items-center">
        <nav aria-label="...">
            <button wire:click="update" type="button" class="btn btn-success">
                <i class="ni ni-fat-add text-Secondary mr-3"></i>Actualizar</button>

            <button wire:click="default" type="button" class="btn btn-link">
                <i class="ni ni-fat-remove text-Secondary mr-3"></i>Cancelar</button>
        </nav>
    </div>
</div>