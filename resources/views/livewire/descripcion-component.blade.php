<div>
    @include('livewire.partials.searchbar')
    <div class="container-fluid mt--9">
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                @include('descripcions.table')
            </div>
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                @include("descripcions.$view")
            </div>
        </div>
    </div>
</div>
