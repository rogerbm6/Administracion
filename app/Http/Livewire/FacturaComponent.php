<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Factura;
use App\Models\Cliente;
use App\Models\Producto;


class FacturaComponent extends Component
{
    use WithPagination;

     //page config
    public $search = '';
    public $view = 'table';
    public $fecha; 


    //Variables para la busqueda de clientes 
    public $searchCliente, $cliente_id;
    public $buscando = true;

    //Factura config
    public $total, $factura_id;

    //productos config
    public $productsFactura = [];

    //busqueda de productos
    public $searchProduct, $producto_id;
    public $buscandoProducto    = true;
    public $cantidadProduct     = 1;
    public $descripcionProduct;


    public function render()
    {
        $this->fecha = date("Y-m-d");
        $cliente = Cliente::where('nombre', 'like', "%$this->search%")->first();

        //si no hay cliente encontrado
        $facturas  = Factura::where('numero', 'like', "%$this->search%")
        ->orWhere('fecha', 'like', "%$this->search%")
        ->orderBy('id', 'desc')->paginate(6);

        //si hay hay cliente encontrado
        if ($cliente) {

            $facturas  = Factura::where('numero', 'like', "%$this->search%")
            ->orWhere('fecha', 'like', "%$this->search%")
            ->orWhere('cliente_id', 'like', "%$cliente->id%")
            ->orderBy('id', 'desc')->paginate(6);
        }
        //busca el cliente de la factura
        $clientes   = Cliente::where('nombre', 'like', "%$this->searchCliente%")
                        ->orWhere('nif', 'like', "%$this->searchCliente%")
                        ->orWhere('telefono', 'like', "%$this->searchCliente%")
                        ->orderBy('id', 'desc')->limit(3)->get();


        $productos  = Producto::where('nombre', 'like', "%$this->searchProduct%")
                        ->orWhere('precio', 'like', "%$this->searchProduct%")
                        ->orWhere('tipo', 'like', "%$this->searchProduct%")
                        ->orderBy('id', 'desc')->limit(6)->get();


        return view('livewire.factura-component', [
            'facturas'  => $facturas,
            'productos' => $productos,
            'clientes'  => $clientes,
            'fecha'     => $this->fecha,
            'name_page' => 'Facturación'
        ]);
    }


    //guarda producto
    public function store()
    {
        //valida datos
        $this->validate([
            'fecha'             => 'required|date', 
            'searchCliente'     => 'required'
        ],[
            "required"       => "El campo :attribute es necesario",
        ]);

        //busca cliente
        $cliente           = Cliente::find($this->cliente_id);
        //busca producto
        $producto           = Producto::find($this->producto_id);

        //busca ulfima factura para aumentar el número
        $ultimaFactura      = Factura::orderBy('id', 'desc')->first();
        //asigna el nuevo numero
        $ultimoNumero       =   '0001';
        //si ya hay facturas creadas
        if ($ultimaFactura) {
            $ultimoNumero   = $ultimaFactura->numero;
            $ultimoNumero++;
        }

        $numeroFinal = str_pad($ultimoNumero, 4, '0', STR_PAD_LEFT);


        //crea factura
        $factura            = new Factura();
        $factura->fecha     = $this->fecha;
        $factura->numero    = $numeroFinal;
        $factura->total     = $this->cantidad * $producto->precio;
            //asocia con cliente
        $factura->cliente()->associate($cliente->id);
        $factura->save();


            //asocia la factura con el producto
        $factura->productos()->attach($producto, ['notas_privadas'=>$this->notas_privadas, 'cantidad'=>$this->cantidad]);
        $factura->update();




        //guardar
    }

    public function addProduct()
    {
        $this->validate([
            'searchProduct'       => 'required|max:40|min:2', 
            'cantidadProduct'     => 'required|max:50|min:1',
            'descripcionProduct'  => 'max:240',
        ],[
            "required"       => "El campo :attribute es necesario",
            "max"            => "El campo :attribute tiene como máximo :max caracteres",
            "min"            => "El campo :attribute tiene como mínimo :min caracteres"
        ]);

        $producto=Producto::find($this->producto_id);

        $this->productsFactura[]=[
            "producto"  => $producto,
            "cantidad"  => $this->cantidadProduct,
            "notas"     => $this->descripcionProduct
        ];
        
        $this->productos_default();
    }


    public function crear()
    {
        $this->view = 'create';
    }

    
    public function buscando()
    {
        $this->buscando = true;
    }

    public function buscandoProducto()
    {
        $this->buscandoProducto = true;
    }
    
    public function encontrado(Cliente $cliente)
    {
        $this->cliente_id           = $cliente->id;

        $this->searchCliente        = $cliente->nombre;

        $this->buscando             = false;
    }

    public function productoEncontrado(Producto $producto)
    {
        $this->producto_id          = $producto->id;

        $this->searchProduct        = $producto->nombre;

        $this->buscandoProducto     = false;
    }

    public function default()
    {
        $this->view = 'table';
    }

    public function productos_default()
    {
        $this->searchProduct       = "";
        $this->buscandoProducto    = false;
        $this->cantidadProduct     = 1;
        $this->descripcionProduct  ="";
    }
}
