<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Logo;
use Illuminate\Support\ServiceProvider;

class LogoServiceProvider extends ServiceProvider
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
        $systemLogo = Logo::whereIs_active(true)->first();
        view()->share('systemLogo', $systemLogo->logo ?? "sadsad");

    }
}
