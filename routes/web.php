<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Central\CompanyController; // تأكد من وجود هذا السطر في الأعلى
use App\Models\Tenant;

Route::get('/force-tenant/{id}', function ($id) {
    $tenant = Tenant::find($id);
    tenancy()->initialize($tenant);
    
    return [
        'current_tenant' => tenant('id'),
        'database' => DB::connection()->getDatabaseName(),
    ];
});

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/central/create-company', [CompanyController::class, 'create']);



// require __DIR__.'/auth.php';

// المسارات المركزية (Central)
Route::prefix('central')->group(function () {
    Route::post('/create-company', [App\Http\Controllers\Central\CompanyController::class, 'store'])->name('company.store');
    
    // راوت عرض صفحة النجاح (اختياري إذا كنت ستستخدم view مباشرة من الـ store)
    Route::get('/success', function() {
        return view('central.success');
    })->name('central.success');
});

Route::get('/company-created-success', function () {
    return view('central.company-created');
})->name('company.success');
