<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Nueva descripcion</h3>
            </div>
        </div>
    </div>

    @include('descripcions.form')

    <div class="card-footer py-4">
        <nav aria-label="...">
            <button wire:click="store" type="button" class="btn btn-success">
                <i class="ni ni-fat-add text-Secondary mr-3"></i>Guardar</button>
        </nav>
    </div>
</div>