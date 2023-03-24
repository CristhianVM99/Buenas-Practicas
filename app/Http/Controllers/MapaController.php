<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\IdeaProyecto;


class MapaController extends Controller
{
    public function index()
    {            

        $Proyectos = IdeaProyecto::all()->where('aprobacion',1);
        $Ciudades = Ciudad::all();
        $listaProyectos = [];
        foreach($Proyectos as $proy){
            foreach($Ciudades as $ciudad){
                if($ciudad->id == $proy->ciudad)
                {
                    $objeto = ['proyecto'=>$proy,'lat'=>$ciudad->lat,'long'=>$ciudad->lng];
                    array_push($listaProyectos,$objeto);
                }
            }
        }
        $extras = [            
            'listaIdeasProyecto' => $listaProyectos,            
        ];        
        return view('maps.mapa', $extras);
    }
}
