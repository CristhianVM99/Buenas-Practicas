<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Pais;
use App\Models\Categoria;
use App\Models\Video;
use App\Models\Autor;
use App\Models\Sector;
use App\Models\Entidad;
use App\DataTables\VideosDataTable;
use App\Http\Requests\StoreVideoRequest;

class VideoController extends Controller
{
    const DIR_VIDEO = 'videos/imagenes';
    public function index(Request $request, Video $video)
    {
        // dd($video->toArray());
        $ods  = Categoria::all();
        return view('video.store', [
            'recomendaciones' => Video::orderByRaw("RAND()")->limit(6)->get(),
            'ods'  => $ods,
            'video' => $video,
        ]);
    }

    public function list()
    {
        return view('admin.videos');
    }
    public function dataLista()
    {
        return (new VideosDataTable())->dataTable();
    }

    public function create()
    {
        return view('admin.form_video', $this->getVariablesExtra());
    }
    public function edit(Video $video)
    {
        $datas = $this->getVariablesExtra();
        $datas['video'] = $video;
        return view('admin.form_video', $datas);
    }
    public function store(StoreVideoRequest $request)
    {
        $data = $request->validated();
        if(isset($data['ods']))
        {
            $data['ods'] = '['.implode(',',$data['ods']).']';
        }
        $video = Video::create($data);
        if(isset($data['foto']))
        {
            $url = $this->uploadImage($data['foto'], $video->id); 
            $video->update(['foto'=>$url]);
        }
        Session::flash('success','Registro de Video '.$video->titulo.' creado');
        return Redirect::route('video.list');
    }
    public function update(StoreVideoRequest $request, Video $video)
    {
        $data = $request->validated();
        if(!isset($data['ods'])){
            $data['ods'] = null;
        }
        if(isset($data['foto']))
        {
            $data['foto'] = $this->uploadImage($data['foto'], $video->id);
        }
        $res = $video->update($data);
        Session::flash('success','Registro de Video con ID:'.$video->id.' Actualizado!');
        return Redirect::route('video.list');
    }
    public function delete(Request $request)
    {
        $video    = Video::find($request->id);
        $mensajes = [ 'foto' => $this->deleteImage($video->foto)];
        if( $video->delete() )
        {
            $mensajes["registro"] = [
                'mensaje' => "El Registro de Video ha sido Eliminado",
                "class"   => "success"
            ];
            return response( $mensajes, 200);
        }
        $mensajes["registro"] = [
            'mensaje' => "El Registro de Video No pudo ser Eliminado",
            "class"   => "success"
        ];
        return response( $mensajes, 404);
    }

    private function uploadImage( $image, $id = null )
    {
        $fileName = is_null($id)? $image->getClientOriginalName(): $id.'.'.$image->extension();
        $url      = Storage::disk('public')->putFileAs(self::DIR_VIDEO, $image, $fileName);
        if(!$url)
        {
            Session::flash('error','Imagen:'.$fileName.' No se ha Guardado!');
        }
        return $url;
    }

    private function deleteImage( $url){
        if(is_null($url))
            return ['mensaje'=> "No tiene asignada ninguna imagen", "class" => "info"];
        if( !Storage::disk('public')->exists($url) )
            return ['mensaje'=> "la url ".$url." de la imagen no existe", "class" => "danger"];
        if( Storage::disk('public')->delete($url))
            return ['mensaje'=> $url." ha sido Eliminada", "class" => "success"];
        return ['mensaje'=> $url." no pudo ser eliminada", "class" => "error"];
    }

    private function getVariablesExtra(){
        return [
            "sectores"  => Sector::all(),
            "autores"   => Autor::all(),
            "paises"    => Pais::all(),
            "entidades" => Entidad::all(),
            "ods"       => Categoria::all(), 
        ];
    }
}
