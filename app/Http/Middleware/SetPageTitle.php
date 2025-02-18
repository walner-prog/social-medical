<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetPageTitle
{
    public function handle(Request $request, Closure $next)
    {
        // Define títulos basados en el nombre de la ruta
        $titles = [
            'dashboard' => 'Inicio | ' . config('app.name', 'Social Medical'),
        ];

        // Validar que la ruta no sea null
        $currentRoute = $request->route();
        $currentRouteName = $currentRoute ? $currentRoute->getName() : null;

        // Comparte el título con las vistas
        view()->share('title', $titles[$currentRouteName] ?? config('app.name', 'Social Medical'));

        return $next($request);
    }
}
