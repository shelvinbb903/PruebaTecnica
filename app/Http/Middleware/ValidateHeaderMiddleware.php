<?php

namespace App\Http\Middleware;

use Closure;

class ValidateHeaderMiddleware
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
      // Validar si se envio como header en cada peticion el valor Content-Type
      if($request->header('Content-Type') == 'application/json'){
        return $next($request);
      }else{
        return response()->json(["error" => "Request should have 'Content-Type' header with value 'application/json'"], 403);
      }

    }
}
