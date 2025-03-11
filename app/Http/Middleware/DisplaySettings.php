<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
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
        $session = $request->session();
        if ($request->has('grouping')) {
            $session->put('filters.grouping', $request->get('grouping'));
        }else{
            $session->put('filters.grouping', config('settings.display.grouping'));
        }

        if ($request->has('types')) {
            $session->put('filters.types', Arr::wrap($request->get('types')));
        }else{
            $session->put('filters.types', config('settings.display.types'));
        }

        if ($request->has('date')) {
            $session->put('filters.date', $this->makeDate($request->get('date')));
        }else{
            $session->put('filters.date', date('Y-m-d'));
        }

        return $next($request);
    }

    protected function makeDate($input) {
        if ($input != null) {
            try {
                $date = Carbon::createFromFormat('Y-m-d', $input);
                return $date->format('Y-m-d');
            }
            catch (\Exception $e) {
                Log::error($e);
            }
        }
        // If the input was empty or not parseable, we return default of current date
        return date('Y-m-d');
    }
}
