<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class AdminLocalization
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
            $language = Language::whereType('Dashboard')->where('is_default', 1)->first();
            if ($language) {
                App::setlocale($language->name);
            }
        } catch (\Throwable $e) {}

        return $next($request);
    }
}
