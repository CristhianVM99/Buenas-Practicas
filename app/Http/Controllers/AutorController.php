<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;

class AutorController extends Controller
{
    public function team()
    {
        $data = [
            'autores' => Autor::all(),
        ];
        return view('team.equipo', $data);
    }

    public function getAutorCompleted(Autor $autor)
    {
        $data = [
            'autor' => $autor,
            'videos' => $autor->videos()->get(),
        ];
        // dd($autor->videos()->get());
        return view('team.autor', $data);
    }
}
