<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ciudad;

class CiudadController extends Controller
{
    //
    public function getCiudadesPorCodePais( $code = null )
    {
        if( isset($code) )
        {
            return Ciudad::where("country", $code)->orderBy('name', 'ASC')->get();
        }
        return [];
    }
}
