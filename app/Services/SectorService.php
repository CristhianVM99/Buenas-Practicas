<?php

namespace App\Services;

use App\Models\Sector;

class SectorService
{
    public static function getSectoresWithVideos()
    {
        return Sector::whereHas('video')
                ->with('video', function($query)
                {
                    $query->with('pais:code,flag_4x3')->orderByRaw("RAND()")->limit(6);
                })->get();
    }

}