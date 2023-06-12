<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SectorService;
use App\Models\Pais;
use App\Models\Video;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        $extras = [
            'sectores' => SectorService::getSectoresWithVideos(),
            'listVideos' => Video::with('pais:code,flag_4x3')->orderByRaw("RAND()")->limit(6)->get(),
            'paises' => Pais::all(),
        ];
        if (Auth::check() && !Auth::user()->hasVerifiedEmail()) {
            Auth::logout();
        }
        return view('home', $extras);
    }

    public function likeVideo(Request $request)
    {
        $videoId = $request->input('videoId');

        $video = Video::find($videoId);
        if ($video) {
            $video->popularidad += 1;
            $video->save();
        }        
    }
}
