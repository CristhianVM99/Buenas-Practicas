<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Entidad;
use Yajra\DataTables\Facades\DataTables;

class EntidadController extends Controller
{
    
    public function index()
    {
        return view('admin.entidades');
    }
    public function dataLista()
    {
        $model = Entidad::query();

        return DataTables::eloquent($model)
            ->editColumn('logo', fn($reg) => '<img class="object-contain" style="height:50px" src="'.$reg->logo.'" alt="No Imagen"></img>')
            ->addColumn(
                'actions', fn($reg) => 
                '<a href="'.route('entidad.edit', $reg->id).'" class=" fontsize_20" title="Editar">
                    <i class="fa fa-edit"></i>
                </a>'
                .'<a href="" class="eliminar fontsize_20" data-url='.route('entidad.delete').' data-id='.$reg->id.' " title="Remover">
                    <i class="fa fa-trash-o"></i>
                </a>' 
            )
            ->rawColumns(['actions', 'logo'])
            ->tojson();
    }
    public function create()
    {
        return view('admin.form_entidad');
    }
    public function edit(Entidad $entidad)
    {
        $datas = ['entidad' => $entidad];
        return view('admin.form_entidad', $datas);
    }
    public function store(Request $request)
    {
        $data['name']    = $request->name??'';
        $data['logo']    = $request->logo??'';
        $data['link']    = $request->link??'';
        $data['email']   = $request->email??'';
        $entidad = Entidad::create($data);
        return Redirect::route('entidad.list');
    }
    public function update(Request $request, Entidad $entidad)
    {
        $entidad->name   = $request->name??'';
        $entidad->logo   = $request->logo??'';
        $entidad->link   = $request->link??'';
        $entidad->email  = $request->email??'';
        $res = $entidad->save();
        return Redirect::route('entidad.list');
    }
    public function delete(Request $request)
    {
        $res = Entidad::find($request->id)->delete();
        if($res)
        {
            return response("La Entidad ha sido Eliminada", 200);
        }
        return response('La Entidad No pudo ser Eliminada', 404);
    }

}
