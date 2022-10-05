<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Descripcion;



class DescripcionComponent extends Component
{

    use WithPagination;


    public $view = 'create';

    public $search = '';

    public $descripcion_id, $titulo, $descripcion;

    public function render()
    {
        $descripciones = Descripcion::where('titulo', 'like', "%$this->search%")
                        ->orWhere('descripcion', 'like', "%$this->search%")
                        ->orderBy('id', 'desc')->paginate(6);
        return view('livewire.descripcion-component', [
            'descripciones' => $descripciones,
            'name_page'     => 'Descripciones'
        ]);
    }

    public function store()
    {
        $this->validate([
            'titulo' => 'required', 
            'descripcion' => 'required'
        ],[
            "titulo.required"       => "El título es necesario",
            "descripcion.required"  => "La descripción es necesaria"
        ]);

        $descripcion = Descripcion::create([
            'titulo'        =>  $this->titulo,
            'descripcion'   => $this->descripcion
        ]);

        $this->edit($descripcion);
    }

    public function edit(Descripcion $descripcion)
    {
        $this->descripcion_id   = $descripcion->id;
        $this->titulo           = $descripcion->titulo;
        $this->descripcion      = $descripcion->descripcion;
        $this->view             = 'edit';
    }

    public function update()
    {
        $this->validate([
            'titulo' => 'required', 
            'descripcion' => 'required'
        ],[
            "titulo.required"       => "El título es necesario",
            "descripcion.required"  => "La descripción es necesaria"
        ]);

        $descripcion = Descripcion::find($this->descripcion_id);
        $descripcion->update([
            'titulo'        => $this->titulo,
            'descripcion'   => $this->descripcion
        ]);

        $this->default();
    }


    public function default()
    {
        $this->titulo        = '';
        $this->descripcion   = '';
        $this->descripcion_id= '';
        $this->view          = 'create';
    }

    public function destroy(Descripcion $descripcion)
    {
        $descripcion->delete();
    }
}
