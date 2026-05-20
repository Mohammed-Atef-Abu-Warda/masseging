<?php

use Illuminate\Support\Facades\Route;
// استدعاء الكنترولر الذي أنشأناه
use Modules\Mwarda\app\Http\Controllers\LoginController;

Route::middleware(['web'])->group(function () {
    
    // روابط تسجيل الدخول
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    // الرابط الرئيسي للشركة
    Route::get('/', function () {
        return 'لوحة تحكم الشركة: ' . tenant('id');
    });
});
