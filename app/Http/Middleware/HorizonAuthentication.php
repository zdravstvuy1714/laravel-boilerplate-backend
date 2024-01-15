<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;

final class HorizonAuthentication
{
    /**
     * @throws BindingResolutionException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (app()->environment('local')) {
            return $next($request);
        }

        $authenticationHasPassed = false;

        if ($request->header('PHP_AUTH_USER', null) && $request->header('PHP_AUTH_PW', null)) {
            $username = $request->header('PHP_AUTH_USER');
            $password = $request->header('PHP_AUTH_PW');

            if ($username === config('horizon.authentication.username') && $password === config('horizon.authentication.password')) {
                $authenticationHasPassed = true;
            }
        }

        if (false === $authenticationHasPassed) {
            return response()->make('Invalid credentials.', 401, ['WWW-Authenticate' => 'Basic']);
        }

        return $next($request);
    }
}
