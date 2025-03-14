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

        if ($request->has('entry_maker')) {
            $session->put('filters.entry_maker', $request->get('entry_maker'));
        }else{
            $session->put('filters.entry_maker');  // NULL
        }

        if ($request->has('q')) {
            $session->put('filters.q', $request->get('q'));
        }else{
            $session->put('filters.q');  // NULL
        }

        if ($request->has('end_date')) {
            $session->put('filters.end_date', $this->makeDate($request->get('end_date')));
        }else{
            $session->put('filters.end_date', date('Y-m-d'));
        }

        if ($request->has('start_date')) {
            $session->put('filters.start_date', $this->makeDate($request->get('start_date')));
        }else{
            $endDate = Carbon::createFromFormat('Y-m-d', $session->get('filters.end_date'));
            $startDate = Carbon::create($endDate)->subtract('30 days');
            $session->put('filters.start_date', $startDate->format('Y-m-d'));
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
