<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Casa;

class CasaComponent extends Component
{

    public $view = 'create';

    public $search = '';

    public $casa_id, $nombre, $direccion, $numero;


    public function render()
    {

        $casas = Casa::where('nombre', 'like', "%$this->search%")
                    ->orWhere('direccion', 'like', "%$this->search%")
                    ->orWhere('numero', 'like', "%$this->search%")
                    ->orderBy('id', 'desc')->paginate(6);

        return view('livewire.casa-component', [
            'name_page'         => 'Casas',
            'casas'             => $casas,
        ]);
    }

    public function store()
    {
        $this->validate([
            'nombre'         => 'required|min:2|max:37', 
            'direccion'      => 'required|max:100|min:2',
            'numero'         => 'required|min:1|max:2'
        ],[
            "required"       => "El campo :attribute es necesario",
            "max"            => "El campo :attribute tiene como máximo :max caracteres",
            "min"            => "El campo :attribute tiene como mínimo :min caracteres"
        ]);

        $casa = Casa::create([
            'nombre'        => $this->nombre,
            'direccion'     => $this->direccion,
            'numero'        => $this->numero
        ]);

        $this->edit($casa);
    }

    public function edit(Casa $casa)
    {
        $this->casa_id      = $casa->id;
        $this->nombre       = $casa->nombre;
        $this->direccion    = $casa->direccion;
        $this->numero       = $casa->numero;
        $this->view             = 'edit';
    }


    public function update()
    {
        $this->validate([
            'nombre'         => 'required|min:2|max:37', 
            'direccion'      => 'required|max:100|min:2',
            'numero'         => 'required|min:1|max:7'
        ],[
            "required"       => "El campo :attribute es necesario",
            "max"            => "El campo :attribute tiene como máximo :max caracteres",
            "min"            => "El campo :attribute tiene como mínimo :min caracteres"
        ]);

        $casa = Casa::find($this->casa_id);
        $casa->update([
            'nombre'        => $this->nombre,
            'direccion'     => $this->direccion,
            'numero'        => $this->numero
        ]);

        $this->default();
    }

    public function default()
    {
        $this->nombre        = '';
        $this->numero        = '';
        $this->direccion     = '';
        $this->casa_id       = '';
        $this->view          = 'create';
    }

    public function destroy(Casa $casa)
    {
        $casa->delete();
    }

}
