<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;
    
    protected $table = 'autores';

    protected $fillable = [
        'name',
        'tipo',
        'user_id',
        'perfil_html',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class,'autor_id');
    }

}
