<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

// bootstrap/app.php

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php', // الروابط المركزية
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
        then: function () {
            // هنا يمكنك إضافة روابط إضافية إذا لزم الأمر
            // لارفيل سيقوم بتحميل TenancyServiceProvider تلقائياً
            // وسيقوم موديول Mwarda بتحميل روابطه أيضاً
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        // هذا الجزء يحدد أين يذهب المستخدم "المسجل" إذا حاول دخول صفحة ضيف
        $middleware->redirectUsersTo(function () {
            $tenantId = tenant('id') ?? request()->segment(1);
            
            // التأكد من أننا لا نوجه المستخدم لروابط بدون تيننت
            if ($tenantId && $tenantId !== 'profile' && $tenantId !== 'login') {
                return route('dashboard', ['tenant' => $tenantId]);
            }
            
            return '/'; // العودة للرئيسية إذا تاه النظام
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
    $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, $request) {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // جلب التيننت من المسار أو من أول جزء في الرابط
        $tenant = $request->route('tenant') ?? $request->segment(1);

        // إذا وجدنا تيننت، نوجهه لصفحة اللوجن الخاصة به
        if ($tenant) {
            return redirect()->route('login', ['tenant' => $tenant]);
        }

        // إذا لم يوجد تيننت (رابط مركزي)، وجهه للرئيسية
        return redirect()->to('/');
    });

})->create();