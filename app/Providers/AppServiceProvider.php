<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        // جلب التيننت من المسار الحالي وتثبيته
        $tenantId = request()->segment(1);
        
        if ($tenantId) {
            URL::defaults(['tenant' => $tenantId]);
        }
    }
}
