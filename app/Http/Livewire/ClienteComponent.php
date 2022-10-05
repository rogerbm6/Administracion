<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Descripcion;
use App\Models\Cliente;

class ClienteComponent extends Component
{

    use WithPagination;

    public $search = '';

    //Variables para la busqueda de descripciones 
    public $searchDescripcion = 'Cliente comun';
    public $buscando = false;
    public $descripcion_id;
    //Variables para la gestión de clientes
    public $nombre, $nif, $telefono, $email, $direccion, $cliente_id;

    public $view = 'create';



    public function render()
    {
        $clientes = Cliente::where('nombre', 'like', "%$this->search%")
                        ->orWhere('nif', 'like', "%$this->search%")
                        ->orWhere('telefono', 'like', "%$this->search%")
                        ->orWhere('email', 'like', "%$this->search%")
                        ->orderBy('id', 'desc')->paginate(6);
        
        $descripciones = Descripcion::where('titulo', 'like', "%$this->searchDescripcion%")
                        ->orWhere('descripcion', 'like', "%$this->searchDescripcion%")
                        ->orderBy('id', 'desc')->limit(3)->get();
                        
        return view('livewire.cliente-component', [
            'clientes'      => $clientes,
            'name_page'   => 'Clientes',
            'descripciones' => $descripciones
        ]);
    }

    public function buscando()
    {
        $this->buscando = true;
    }

    public function encontrado(Descripcion $des)
    {
        $this->buscando = false;

        $this->descripcion_id = $des->id;

        $this->searchDescripcion = $des->titulo;
    }

    public function store()
    {
        //valida datos
        $this->validate([
            'nombre'         => 'required|max:40|min:2', 
            'nif'            => 'required|max:10|min:2',
            'telefono'       => 'required|max:12|min:2',
            'email'          => 'required|max:47|min:2',
            'direccion'      => 'required|max:500|min:2',
            'descripcion_id' => 'required'
        ],[
            "required"       => "El campo :attribute es necesario",
            "max"            => "El campo :attribute tiene como máximo :max caracteres",
            "min"            => "El campo :attribute tiene como mínimo :min caracteres"
        ]);
        //crea cliente
        $cliente = new Cliente();
        $cliente->nombre    =$this->nombre;
        $cliente->nif       =$this->nif;
        $cliente->telefono  =$this->telefono;
        $cliente->email     =$this->email;
        $cliente->direccion =$this->direccion;

        //unir cliente y descripción
        $cliente->descripcion()->associate(Descripcion::find($this->descripcion_id));
        //guardar
        $cliente->save();
        //default all
        $this->edit($cliente);
    }


    public function edit(Cliente $cliente)
    {
        $this->cliente_id       =$cliente->id;
        $this->nombre           =$cliente->nombre;
        $this->nif              =$cliente->nif;
        $this->telefono         =$cliente->telefono;
        $this->email            =$cliente->email;
        $this->direccion        =$cliente->direccion;
        $this->descripcion_id   =$cliente->descripcion->id;
        $this->searchDescripcion=$cliente->descripcion->titulo;
        $this->view             = 'edit';

    }


    public function update()
    {
        //valida datos
        $this->validate([
            'nombre'         => 'required|max:40|min:2', 
            'nif'            => 'required|max:10|min:2',
            'telefono'       => 'required|max:12|min:2',
            'email'          => 'required|max:47|min:2',
            'direccion'      => 'required|max:500|min:2',
            'descripcion_id' => 'required'
        ],[
            "required"       => "El campo :attribute es necesario",
            "max"            => "El campo :attribute tiene como máximo :max caracteres",
            "email"          => "El campo :attribute debe ser un email valido",
            "min"            => "El campo :attribute tiene como mínimo :min caracteres"
        ]);
        //encuentra cliente
        $cliente = Cliente::find($this->cliente_id);
        //actualiza cliente
        $cliente->nombre    =$this->nombre;
        $cliente->nif       =$this->nif;
        $cliente->telefono  =$this->telefono;
        $cliente->email     =$this->email;
        $cliente->direccion =$this->direccion;

        //unir cliente y descripción
        $cliente->descripcion()->associate(Descripcion::find($this->descripcion_id));
        //guardar
        $cliente->update();

        $this->default();
    }


    public function default()
    {
        //default cliente
        $this->cliente_id       ="";
        $this->nombre           ="";
        $this->nif              ="";
        $this->telefono         ="";
        $this->email            ="";
        $this->direccion        ="";
        //default busqueda descripcion
        $this->descripcion_id   ="";
        $this->buscando         =false;
        $this->searchDescripcion= 'Cliente comun';
        //default page
        $this->view             = 'create';

    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
    }
}
