<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PreventBackHistory
{
    /**
     * Manipula a requisição e adiciona cabeçalhos para impedir cache.
     * Evita erro em downloads (BinaryFileResponse não tem ->header()).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Só adiciona headers no-cache se NÃO for download de arquivo (BinaryFileResponse)
        if (!$response instanceof BinaryFileResponse) {
            $response->headers->set('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', 'Sun, 01 Jan 1990 00:00:00 GMT');
        }

        return $response;
    }
}