<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Localization
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
            if(Session::has('language')){
                $language = Language::find(Session::get('language'));
            }else{
                $language = Language::whereType('Website')->where('is_default',1)->first();
            }
            if(!$language){
                $language = Language::whereType('Website')->where('is_default',1)->first();
            }
            if ($language) {
                App::setlocale($language->name);
            }
        } catch (\Throwable $e) {}

        return $next($request);
    }
}
