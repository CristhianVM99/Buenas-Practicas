<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdeaProyecto extends Model
{
    use HasFactory;

    protected $table = 'ideas_proyectos';

    protected $fillable = [
        'tipo',
        'created_by',
        'modified_by',
        'sector',
        'pais',
        'ciudad',
        'titulo',
        'descripcion',
        'poblacion',
        'entidad',
        'presupuesto',
        'ods',
        'aprobacion',
        'popularidad',
    ];

    public function tipo_de_proyecto()
    {
        if($this->tipo == 1)
        {
            return "Idea Innovadora";
        }
        return "Buena Práctica";
    }

    public function estado()
    {
        if($this->aprobacion == 1)
        {
            return "Aprobado";
        }
        return "En Revisión";
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function Sector()
    {
        return $this->belongsTo(Sector::class, 'sector');
    }

    public function ODS()
    {
        $ods = json_decode($this->ods);
        $list = [];
        foreach ($ods as $item) {
            array_push( $list, Categoria::find($item));
        }
        return $list;
    }

    public function archivos()
    {
        return $this->hasMany(Documento::class,'proyecto_id');
    }
}
