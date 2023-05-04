<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Ciudad;
use App\Models\Documento;
use App\Models\IdeaProyecto;
use App\Models\Pais;
use App\Models\Sector;
use Illuminate\Http\Request;

class MapaController extends Controller
{
    public function index()
    {            

        $Proyectos = IdeaProyecto::all()->where('aprobacion',1);
        $Ciudades = Ciudad::all();
        $Documentos = Documento::all();
        $listaProyectos = [];
        $Paises = Pais::all();
        $ods = Categoria::all();
        $sectores = Sector::all();

        foreach($Proyectos as $proy){
                foreach($Ciudades as $ciudad){
                    if($ciudad->id == $proy->ciudad)
                    {
                        if($proy->tipo == 1){
                            $objeto = ['proyecto'=>$proy,'ciudad'=>$ciudad->name,'lat'=>$ciudad->lat,'lng'=>$ciudad->lng,'type'=>'idea inovadora'];
                            array_push($listaProyectos,$objeto);
                        }else{
                            $objeto = ['proyecto'=>$proy,'ciudad'=>$ciudad->name,'lat'=>$ciudad->lat,'lng'=>$ciudad->lng,'type'=>'buena practica'];
                            array_push($listaProyectos,$objeto);
                        }
                    }
            }
        }
        $extras = [            
            'listaIdeasProyecto' => $listaProyectos,            
            'documentos' => $Documentos,
            'paises' => $Paises,
            'ods' => $ods,
            'sectores' => $sectores,
        ];        
        return view('maps.mapa', $extras);
    }

    public function like(Request $request)
    {
        $id = base64_decode($request->input('id'));        
        $Proyecto = IdeaProyecto::find($id);        
        $Proyecto->popularidad += 1;
        $Proyecto->save();
        if (!$Proyecto) {
            // Si no se encontró el registro, lanza una excepción o retorna un error
            throw new \InvalidArgumentException("El registro con ID $id no existe");
        }
        response()->json(['mensaje' => $id]);
    }
}
