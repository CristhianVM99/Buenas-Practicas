<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\IdeaProyecto;
use App\Models\Documento;
use App\Services\FileService;

class DocumentoController extends Controller
{
    //
    public function upload ( Request $request, IdeaProyecto $registro)
    {
        $name   = Str::uuid();
        $folder = isset($request->folder)? $request->folder: 'invalido';
        $url = FileService::storeFile($request->file, $folder, $name);
        if( $url )
        {
            $doc = [
                'name'          => $name.'.'.Str::afterLast($url, '.'),
                'name_original' => $request->file->getClientOriginalName(),
                'ruta'          => $url,
                'tipo'          => isset($request->galeria)? $request->galeria: $folder,
                'proyecto_id'   => $registro->id,
            ];
            $documento = Documento::create($doc);
            return response()->json($documento);
        }
        return response('Error al guardar el Archivo', 404);
    }

    public function getdocumento(Documento $documento)
    {
        $url = FileService::getUrl( $documento->ruta );
        return $url? response()->file( $url ): null;
    }    

    public function delete(Documento $documento)
    {
        $res = FileService::delete( $documento->ruta );
        if( !is_null($res) )
        {
            if( $res)
            {
                $data = [
                    'respuesta' => $res,
                    'mensaje' => "eliminado",
                    'id' => $documento->id,
                ];
                $documento->delete();
                return response()->json($data);
            }
            return response('Archivo No pudo ser Eliminado', 404);
        }
        return response('Archivo No encontrado', 402);
    }
}
