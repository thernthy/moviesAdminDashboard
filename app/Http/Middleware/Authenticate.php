<?php
namespace App\Http\Middleware;
use Closure;
use CRUDBooster;


class Authenticate
{
    public function handle($request, Closure $next)
    {
        if (CRUDBooster::myId()) {
            return $next($request);
        } else {
            return redirect()->route('error-page', ['message' => 'accessError']); 
        }
    }
}
