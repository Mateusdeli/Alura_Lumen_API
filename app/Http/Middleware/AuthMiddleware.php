<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Exception;
use Firebase\JWT\JWT;
use Throwable;

class AuthMiddleware
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
        try {
            if (!$request->hasHeader('Authorization')) {
                throw new Exception();
            }

            $token = str_replace('Bearer ', '', $request->header('Authorization'));
            $payload = JWT::decode($token, env('APP_TOKEN_KEY'), ['HS256']);
            $user = User::where('email', $payload->email)->first();

            if (is_null($user)) {
                throw new Exception();
            }

            return $next($request);
        }
        catch (Throwable $ex) {
            return response()->json('Não autorizado', 401);
        }
    }
}
