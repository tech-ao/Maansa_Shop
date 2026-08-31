<?php

namespace App\Providers;

use Illuminate\{
    Support\ServiceProvider,
    Support\Facades\DB
};
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Paginator::useBootstrap();
        view()->composer('*', function ($settings) {
            try {
                $setting = DB::table('settings')->find(1);
                $extra_settings = DB::table('extra_settings')->find(1);
                $menus = DB::table('menus')->find(1);
            } catch (\Throwable $e) {
                $setting = (object)[
                    'cookie_text' => '',
                    'title' => 'Maansa',
                    'meta_description' => 'Maansa eCommerce Store',
                    'meta_keywords' => 'ecommerce, store, shopping',
                    'meta_image' => '',
                    'favicon' => '',
                    'logo' => '',
                    'footer_logo' => '',
                    'is_announcement' => 0,
                    'announcement_delay' => 0,
                    'overlay' => 0,
                    'is_loader' => 0,
                    'loader' => '',
                    'theme' => 'theme1',
                    'is_cooki_alert' => 0,
                    'is_privacy_trms' => 0,
                ];
                $extra_settings = (object)[];
                $menus = (object)[];
            }

            $settings->with('setting', $setting ?? (object)['cookie_text' => '', 'title' => 'Maansa']);
            $settings->with('extra_settings', $extra_settings ?? (object)[]);
            $settings->with('menus', $menus ?? (object)[]);

            if (!session()->has('popup')) {
                view()->share('visit', 1);
            }
            session()->put('popup', 1);
        });
    }

    public function register()
    {
    }
}
