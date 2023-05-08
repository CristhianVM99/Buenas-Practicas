<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Categoria;
use App\Models\Pais;
use App\Models\Ciudad;
use App\Models\Sector;
use App\Models\IdeaProyecto;
use App\Models\Documento;
use App\Http\Requests\IdeaProyecto\StoreIdeaProyectoRequest;
use App\Notifications\ProyectoAprobado;
use App\DataTables\IdeasProyectosDataTable;

class IdeaProyectoController extends Controller
{
    public function index()
    {
        $extras = [
            'proyectos' => IdeaProyecto::all(),
        ];

        return view('registros.lista', $extras);
    }

    public function dataLista()
    {
        $user_id = auth()->user()->id;
        // return (new IdeasProyectosDataTable())->dataTable();
        return (new IdeasProyectosDataTable())->dataTable( $user_id);
    }

    public function new ()
    {
        $extras = [
            'categorias' => Categoria::all(),
            'paises'     => Pais::all(),
            'ciudades'   => Ciudad::all(),
            'sectores'   => Sector::all(),
        ];
        return view('registros.registro', $extras);
    }

    public function crear(StoreIdeaProyectoRequest $request)
    {
        $data               = $request->validated();
        $data['tipo']       = isset($data['tipo'])? true: false;
        $data['created_by'] = Auth::user()->id;
        $registro   	    = IdeaProyecto::create($data);
        return response()->json([
            'registro' => $registro, 
            'mensaje'  => 'Registro Creado!', 
            'datos'=> $data,
            'redirect' => route('profile.edit')
        ]);
    }

    public function edit (IdeaProyecto $registro)
    {
        $extras = [
            'categorias'    => Categoria::all(),
            'paises'        => Pais::all(),
            'ciudades'      => Ciudad::all(),
            'sectores'      => Sector::all(),
            'fotografias'   => Documento::where("proyecto_id", $registro->id)->where('tipo','imagenes')->get(),
            'archivos'      => Documento::where("proyecto_id", $registro->id)->where('tipo','documentos')->get(),
            'registro'      => $registro,
        ];
        return view('registros.registro', $extras);
    }

    public function update(StoreIdeaProyectoRequest $request, IdeaProyecto $registro)
    {
        $data               = $request->validated();
        $data['tipo']       = isset($data['tipo'])? true: false;
        $data['modified_by']= auth()->user()->id;
        $redirect           = route('profile.edit');

        if( isset($data['estado']) && auth()->user()->hasRole('admin') )
        {
            $data['aprobacion'] = $data['estado'];
            $redirect           = route('proyectos.list');
            unset($data['estado']);
        }
        $result = $registro->update($data);

        if( $result)
        {
            if( auth()->user()->hasRole('admin') && isset($data['aprobacion']))
            {
                $registro->creador->notify( new ProyectoAprobado([
                    'tipo'  => $registro->tipo_de_proyecto(),
                    'id'    => $registro->id,
                    'titulo'=> $registro->titulo,
                ]));
            }
            return response()->json([
                'registro' => $registro, 
                'mensaje'  => 'Registro Actualizado!', 
                'redirect' => $redirect,
            ]);
        }
        return response("Error, Registro No Actualizado", 500);
    }

    public function post( IdeaProyecto $proyecto)
    {
        $extras = [
            'proyecto'=> $proyecto,
            'archivos'=> $proyecto->archivos,
        ];
        return view('posts.post', $extras);
    }
    
}
