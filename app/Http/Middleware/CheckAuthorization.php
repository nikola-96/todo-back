<?php

namespace App\Http\Middleware;

use Closure;
use App\Todo;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;



class CheckAuthorization
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
        $user = JWTAuth::user();
        $todo = Todo::findOrFail($request->id);

        if( $todo->user_id !== $user->id ){
            return abort(403, 'Forbidden');
        }

            return $next($request);
    }
}
