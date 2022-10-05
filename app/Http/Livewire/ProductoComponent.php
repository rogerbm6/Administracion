<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;
use App\Models\Cliente;

class ProductoComponent extends Component
{

    use WithPagination;
    //page config
    public $view = 'create';

    public $search = '';
    //Variables para la busqueda de clientes 
    public $searchCliente, $cliente_id;
    public $buscando = true;

    //Producto config
    public $personalizado = false;
    public $nombre, $precio, $producto_id;

    
    public function render()
    {
        $productos  = Producto::where('nombre', 'like', "%$this->search%")
                        ->orWhere('precio', 'like', "%$this->search%")
                        ->orWhere('tipo', 'like', "%$this->search%")
                        ->orderBy('id', 'desc')->paginate(6);

        $clientes   = Cliente::where('nombre', 'like', "%$this->searchCliente%")
                        ->orWhere('nif', 'like', "%$this->searchCliente%")
                        ->orWhere('telefono', 'like', "%$this->searchCliente%")
                        ->orderBy('id', 'desc')->limit(3)->get();

        return view('livewire.producto-component', [
            'productos'  => $productos,
            'clientes'   => $clientes,
            'name_page'  => 'Productos'
        ]);
    }

    public function store()
    {
        //valida datos
        $this->validate([
            'nombre'         => 'required|max:47|min:2', 
            'precio'         => 'required|max:2000|min:2'
        ],[
            "required"       => "El campo :attribute es necesario",
            "max"            => "El campo :attribute tiene como máximo :max caracteres",
            "precio.max"     => "El campo :attribute tiene como máximo :max ",
            "precio.min"     => "El campo :attribute tiene como máximo :min ",
            "min"            => "El campo :attribute tiene como mínimo :min caracteres"
        ]);
        //crea producto
        $producto           = new Producto();
        $producto->nombre   =$this->nombre;
        $producto->precio   =$this->precio;
        //si el producto es común une producto y cliente
        $producto->tipo     ='comun';
        $producto->cliente()->associate(null);
        //si el producto es personalizado
        if ($this->personalizado && Cliente::find($this->cliente_id)) {
            $producto->tipo     ='personalizado';
            $producto->cliente()->associate(Cliente::find($this->cliente_id));
        }

        //guardar
        $producto->save();
        
        $this->edit($producto);
    }

    public function encontrado(Cliente $cliente)
    {
        $this->cliente_id           = $cliente->id;

        $this->searchCliente        = $cliente->nombre;

        $this->buscando             = false;
    }

    public function buscando()
    {
        $this->buscando             = true;
    }

    public function edit(Producto $producto)
    {
        $this->producto_id      =$producto->id;
        $this->nombre           =$producto->nombre;
        $this->precio           =$producto->precio;
        $this->personalizado    =true;
        //si el producto no tiene asignado un cliente
        $this->cliente_id       ="";
        $this->searchCliente    ="";
        $this->buscando         =true;
        //si el producto ya tiene asignado un cliente
        if ($producto->cliente) {
            $this->cliente_id       =$producto->cliente->id;
            $this->searchCliente    =$producto->cliente->nombre;
            $this->buscando         =false;
        }


        $this->view             = 'edit';

    }

    public function update()
    {
        //valida datos
        $this->validate([
            'nombre'         => 'required|max:47|min:2', 
            'precio'         => 'required|max:2000|min:2'
        ],[
            "required"       => "El campo :attribute es necesario",
            "max"            => "El campo :attribute tiene como máximo :max caracteres",
            "precio.max"     => "El campo :attribute tiene como máximo :max ",
            "precio.min"     => "El campo :attribute tiene como máximo :min ",
            "min"            => "El campo :attribute tiene como mínimo :min caracteres"
        ]);
        //encuentra cliente
        $producto = Producto::find($this->producto_id);
        //actualiza cliente
        $producto->nombre    =$this->nombre;
        $producto->precio    =$this->precio;
        //si el producto es común une producto y cliente
        $producto->tipo     ='comun';
        $producto->cliente()->associate(null);
        //si el producto es personalizado
        if ($this->personalizado && Cliente::find($this->cliente_id)) {
            $producto->tipo     ='personalizado';
            $producto->cliente()->associate(Cliente::find($this->cliente_id));
        }
        //guardar
        $producto->update();

        $this->default();
    }

    public function default()
    {
        //default page
        $this->view         ="create";
        $this->search       ="";
        $this->searchCliente="";
        //default producto
        $this->personalizado=false;
        $this->nombre       ="";
        $this->precio       ="";
        $this->producto_id  ="";
        //default busqueda cliente
        $this->cliente_id   ="";
        $this->buscando     =true;

    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
    }
}
