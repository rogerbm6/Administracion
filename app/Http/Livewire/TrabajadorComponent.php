<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Trabajador;

class TrabajadorComponent extends Component
{

    use WithPagination;
    //page config
    public $view = 'create';

    public $search = '';

    public $nombre, $telefono, $trabajador_id;


    public function render()
    {
        $trabajadores = Trabajador::where('nombre', 'like', "%$this->search%")
                        ->orWhere('telefono', 'like', "%$this->search%")
                        ->orderBy('id', 'desc')->paginate(6);
        return view('livewire.trabajador-component', [
            'trabajadores'  => $trabajadores,
            'name_page'        => 'Empleados'
        ]);
    }

    public function store()
    {
        $this->validate([
            'nombre'    => 'required|max:47|min:2', 
            'telefono'  => 'required|max:12|min:2'
        ],[
            "required"  => "El campo :attribute es necesario",
            "max"       => "El campo :attribute tiene como máximo :max caracteres",
            "min"       => "El campo :attribute tiene como mínimo :min caracteres"
        ]);

        $trabajador = Trabajador::create([
            'nombre'     => $this->nombre,
            'telefono'   => $this->telefono
        ]);

        $this->edit($trabajador);

    }

    public function edit(Trabajador $trabajador)
    {
        $this->trabajador_id    = $trabajador->id;
        $this->nombre           = $trabajador->nombre;
        $this->telefono         = $trabajador->telefono;
        $this->view             = 'edit';
    }

    public function update()
    {
        $this->validate([
            'nombre'    => 'required|max:47|min:2', 
            'telefono'  => 'required|max:12|min:2'
        ],[
            "required"  => "El campo :attribute es necesario",
            "max"       => "El campo :attribute tiene como máximo :max caracteres",
            "min"       => "El campo :attribute tiene como mínimo :min caracteres"
        ]);

        $trabajador = Trabajador::find($this->trabajador_id);
        $trabajador->update([
            'nombre'     => $this->nombre,
            'telefono'   => $this->telefono
        ]);

        $this->default();
    }

    public function default()
    {
        $this->trabajador_id= '';
        $this->nombre       = '';
        $this->telefono     = '';
        $this->view         = 'create';
    }

    public function destroy(Trabajador $trabajador)
    {
        $trabajador->delete();
    }

}
