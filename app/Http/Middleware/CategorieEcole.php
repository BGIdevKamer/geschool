<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Identify;
use Illuminate\Support\Facades\Auth;

class CategorieEcole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $categorie): Response
    {
        if (Identify::where('id', Auth::user()->identifie_id)->value('type') == $categorie) {
            return $next($request);
        }
        return redirect()->route('403');
    }
}
