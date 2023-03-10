<?php

namespace App\DataTables;

use App\Models\Video;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class VideosDataTable
{
    
    public function dataTable()
    {
        $model = Video::query()->orderBy('created_at','desc');

        return DataTables::eloquent($model)
            ->editColumn('foto', function($reg) {
                return view('sections.image',['url'=>url('storage/'.$reg->foto)]);
            })
            ->editColumn('descripcion', fn($reg) => Str::limit($reg->descripcion, 120, '...' ))
            ->editColumn('url', fn($reg) => Str::limit($reg->url, 15, '...' ))
            ->editColumn('pais_id', fn($reg) => $reg->pais->name??'')
            ->editColumn('entidad_id', fn($reg) => $reg->entidad->name??'')
            ->editColumn('sector_id', fn($reg) => $reg->sector->name??'')
            ->editColumn('autor_id', fn($reg) => $reg->autor->name??'')
            ->editColumn('ods', fn($reg) => array_map( fn($item)=>$item->name, $reg->ODS() ))
            ->addColumn('actions', function($reg) {
                $data = [
                    'id'     => $reg->id,
                    'editar' => route('video.edit', $reg->id),
                    'delete' => route('video.delete'),
                ];
                return view('sections.acciones',$data);
            })
            ->rawColumns(['actions', 'foto'])
            ->tojson();
    }

}
