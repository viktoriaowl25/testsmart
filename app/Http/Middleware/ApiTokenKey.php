<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class ApiTokenKey
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
        $api_token = $request->input('api_token');
        
        if($api_token != '') {
            $user = User::where('api_token', $api_token)->first();
            if(!$user) {
                return response()->json(['message' => 'Error! Not access 403'], 403);
            }
        } else {
            return response()->json(['message' => 'Api key not found'],401);
        }

        Auth::login($user);
        return $next($request);
    }
}
