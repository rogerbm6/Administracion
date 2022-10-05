<div class="row">
    <div class="col-md-6">
        <div class="form-group">
                @include('facturas.clientes')
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <input type="date" value='{{$fecha}}' class="form-control"/>
        </div>
        @error('fecha')
            <span class="badge badge-warning">{{$message}}</span>
        @enderror
    </div>
</div>
@include('facturas.productos')
