<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\IdeaProyecto;

class isPublishedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,  IdeaProyecto $post = null)
    {
        $post = $post?? $request->route('proyecto');
        if(is_null($post) && is_null($post->aprobacion))
        {
            abort(404, 'Pagina no Encontrada');
        }
        if( $post->aprobacion < 1 )
        {
            abort(404, 'Página No Esta Disponible Actualmente');
        }
        return $next($request);
    }
}
