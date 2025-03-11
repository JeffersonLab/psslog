<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class DisplaySettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('groupBy')) {
            Config::set('settings.display.group_by', $request->get('groupBy'));
        }

        if ($request->has('entryTypes')) {
            Config::set('settings.display.entry_types', Arr::wrap($request->get('entryTypes')));
        }

        return $next($request);
    }
}
