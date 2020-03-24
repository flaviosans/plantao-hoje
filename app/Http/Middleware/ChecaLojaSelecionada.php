<?php

namespace App\Http\Middleware;

use Closure;
use App\Library\Message;

class ChecaLojaSelecionada
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->session()->has('loja')){
            Message::Warning("Nenhuma loja selecionada! ");  
        }  
        return $next($request);
    }
}
