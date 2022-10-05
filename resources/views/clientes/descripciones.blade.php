@if ($descripciones->count())
    @foreach ($descripciones as $descripcion)

        <button type="button" class="btn btn-sm btn-primary mt-1" wire:click="encontrado({{$descripcion->id}})">
            <span>{{$descripcion->titulo}}</span>
        </button>

    @endforeach
<hr>
@endif