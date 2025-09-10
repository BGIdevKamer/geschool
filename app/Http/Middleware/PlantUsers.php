<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlantUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $plant): Response
    {
        if ($request->user()->plants()->last()->where('date_fin', '>', now())->where('libeller', '=', $plant)->exists()) return $next($request);

        abord(403);
    }
}
