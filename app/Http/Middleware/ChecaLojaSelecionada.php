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
            Message::Warning("Antes de prosseguir, cadastre uma loja  no seu perfil! ");
            return redirect()->route('lojas.index');
        }  
        return $next($request);
    }
}
