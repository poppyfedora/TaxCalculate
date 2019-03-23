<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateAPI
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
        $apiToken = $request->header('API_TOKEN');

        $key = env('API_TOKEN');
        $key = md5($key);
        if($apiToken !== $key){
            return [
                'error' => 'There is no token found',
                'data' => []
            ];
        }
        return $next($request);
    }
}
