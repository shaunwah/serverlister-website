<?php

namespace App\Http\Middleware;

use Closure;

class Localise
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
        app()->setLocale($request->getPreferredLanguage(config('app.locales')));
        return $next($request);
    }
}
