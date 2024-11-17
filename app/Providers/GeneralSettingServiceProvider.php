<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class GeneralSettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('settings')) {
            $settings = DB::table('settings')->first();

            // Site title, logo, favicon set
            if ($settings) {
                config(['app.name' => $settings->site_title ?? config('app.name')]);
                config(['app.logo' => $settings->logo ?? null]);
                config(['app.favicon' => $settings->fav_icon ?? null]);
                config(['app.email' => $settings->email ?? null]);
                config(['app.address' => $settings->address ?? null]);
                config(['app.state' => $settings->state ?? null]);
            }

            config(['app.error', 'tostar']);
        }
    }
}
