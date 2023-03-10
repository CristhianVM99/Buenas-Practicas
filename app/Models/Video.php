<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'titulo',
        'descripcion',
        'entidad_id',
        'sector_id',
        'pais_id',
        'autor_id',
        'ods',
        'foto',
        'url',
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id', 'code');
    }
    public function autor()
    {
        return $this->belongsTo(Autor::class, 'autor_id');
    }
    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }
    public function entidad()
    {
        return $this->belongsTo(Entidad::class, 'entidad_id');
    }
    public function ODS()
    {
        $ods = json_decode($this->ods)??[];
        $list = [];
        foreach ($ods as $item) {
            array_push( $list, Categoria::find($item));
        }
        return $list;
    }

}
