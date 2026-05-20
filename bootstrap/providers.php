<?php

use App\Providers\AppServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    Nwidart\Modules\LaravelModulesServiceProvider::class, // أضف هذا السطر هنا
    App\Providers\TenancyServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
];
