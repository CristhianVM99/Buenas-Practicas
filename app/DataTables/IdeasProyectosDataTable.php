<?php

namespace App\DataTables;

use App\Models\IdeaProyecto;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class IdeasProyectosDataTable
{
    
    public function dataTable( $user_create = null)
    {
        $model = is_null($user_create)?
            IdeaProyecto::query()
            : IdeaProyecto::where('created_by', $user_create);

        return DataTables::eloquent($model)
                ->editColumn('tipo', fn($reg) => $reg->tipo_de_proyecto())
                ->editColumn('aprobacion', fn($reg) => $reg->estado())
                ->editColumn('titulo', fn($reg) => Str::limit($reg->titulo, 120, '...' ))
                ->editColumn('descripcion', fn($reg) => Str::limit($reg->descripcion, 120, '...' ))
                ->addColumn('actions', fn($reg) => $reg->aprobacion == 0?
                    '<a href="'.route('registro.edit', $reg->id).'" class=" fontsize_20" title="Editar">
                        <i class="fa fa-edit"></i>
                    </a>'
                    // .'<a href="#" class="remove fontsize_20" title="Remover">
                    //     <i class="fa fa-trash-o"></i>
                    // </a>'
                    : ""
                )
                ->rawColumns(['actions'])
                ->toJson();
    }

}
