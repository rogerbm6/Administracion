<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Entrada;
use App\Models\Casa;

//fechas
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class EntradaComponent extends Component
{

    public $view = 'create';

    public $search = '';

    public $entrada_id, $entrada, $salida, $personas;
    
    //manejo de fechas
    public $hoy;

    public function render()
    {
        $this->hoy      = Carbon::now()->format('Y-m-d');

        $ayer           = Carbon::now()->subDays(4)->format('Y-m-d');

        $un_mes         = Carbon::now()->addMonth()->format('Y-m-d');

        $all_days       = CarbonPeriod::create($ayer, $un_mes)->toArray();


        $entradas       = Entrada::whereBetween('entrada', [$ayer, $un_mes])->
        orWhere('salida', '>', $ayer)->get();

        //array días de entrada y salida en el calendario


        $casas= Casa::all();

        $calendario = [];
        
        foreach ($casas as $casa) {
            $calendario +=[$casa->nombre => array()];

            foreach ($all_days as $day) {

                $calendario[$casa->nombre][$day->format('Y-m-d')] = [
                    "ocupado"   => false,
                    "salida"    => false
                ];

                foreach ($entradas as $entrada) {
                    //guarda las entradas en el array

                    if ($entrada->entrada == $day->format('Y-m-d') && $entrada->casa->nombre == $casa->nombre) {

                        $calendario[$casa->nombre][$day->format('Y-m-d')] = [
                            "ocupado"   => true,
                            "entrada"   => $entrada,
                            "salida"    => false
                        ];
                    }
                    //guarda las salidas en el array
                    if ($entrada->salida == $day->format('Y-m-d') && $entrada->casa->nombre == $casa->nombre) {
                        $flag = false;
                        $calendario[$casa->nombre][$day->format('Y-m-d')] = [
                            "salida"    => true,
                            "ocupado"   => true,
                            "entrada"   => $entrada,
                        ];
                    }
                }
            }
        }        
        
        //actualiza a "ocupado" los días entre entrada y salida
        foreach ($calendario as $casa => $casita ) {
            $flag = false;
            foreach ($casita as $dia => $di ) {

                if (count($di)>2) {
                    if ($di["entrada"]) {
                        $flag = true;
                    }
                    if ($di["salida"]){
                        $flag = false;
                    }
                }

                if($flag == true){
                    $calendario[$casa][$dia]["ocupado"] = true;
                }
            }

            //actualiza a "ocupado" los días entre salida y entrada, empieza desde atras

            krsort($casita); //ordena el array de atras hacia adelante

            foreach ($casita as $dia => $di ) {

                if (count($di)>2) {
                    if ($di["entrada"]) {
                        $flag = false;
                    }
                    if ($di["salida"]){
                        $flag = true;
                    }
                }

                if($flag == true){
                    $calendario[$casa][$dia]["ocupado"] = true;
                }
            }

            ksort($casita); //ordena el array de manera descendente

        }

        //dd($calendario);

        return view('livewire.entrada-component', [
            'name_page'         => 'Entradas',
            'entradas'          => $entradas,
            'calendario'        => $calendario,
            'casas'             => $casas
        ]);
    }
}
