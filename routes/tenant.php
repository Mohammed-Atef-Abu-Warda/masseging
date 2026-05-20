<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
// use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use \Stancl\Tenancy\Middleware\InitializeTenancyByPath;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\ProfileController;
use Chatify\Http\Controllers\MessagesController;

// 1. روابط الـ Broadcast تحتاج أن تكون داخل الميدل وير ولكن بدون تكرار الـ Prefix



// ملاحظة: لا تضع prefix هنا لأن الـ Provider يضعه تلقائياً

// روابط الـ Broadcast الخاصة بـ Chatify
// ستصبح تلقائياً: {tenant}/broadcasting/auth
Broadcast::routes(); 

// روابط الداشبورد والـ Auth
// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

// روابط Breeze
require base_path('routes/auth.php');

// Route::middleware([
//     'web',
//     'universal', // تأكد من إضافة هذا إذا كنت تستخدمه
//     InitializeTenancyByDomain::class, // أو InitializeTenancyBySubdomain
//     PreventAccessFromCentralDomains::class,
// ])->group(function () {
//     // هنا توضع مسارات تسجيل الدخول الخاصة بالشركات
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
//     Auth::routes(); 
// });

// Route::middleware([
//     'web',
//     InitializeTenancyByPath::class, 
//     PreventAccessFromCentralDomains::class,
// ])->group(function () {
    
//     // هذا السطر يستدعي كل مسارات Breeze (Login, Register, etc.) داخل نطاق الشركة
//     require __DIR__.'/auth.php'; 

//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->middleware(['auth', 'verified'])->name('dashboard');
// });

// Route::middleware([
//     'web',
//     \Stancl\Tenancy\Middleware\InitializeTenancyByPath::class, // تغيير هنا
// ])->group(function () {
    
//     Route::prefix('{tenant}')->group(function () { // إضافة البريفكس هنا
//         require __DIR__.'/auth.php';
        
//         Route::get('/dashboard', function () {
//             return "أهلاً بك في شركة: " . tenant('id');
//         })->middleware('auth')->name('dashboard');
//     });
// });

Route::middleware([
    'web',
    InitializeTenancyByPath::class, // هذا هو المسؤول عن التبديل في نظام الباث
])->group(function () {


// لا تضع Route::prefix('{tenant}') هنا مرة أخرى!
// ابدأ بكتابة المسارات مباشرة لأنها محملة مسبقاً بالبريفكس من الـ Provider
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// routes/tenant.php


Route::middleware([
    'web',
    \Stancl\Tenancy\Middleware\InitializeTenancyByPath::class,
    'auth',
])->group(function () {

    // لاحظ هنا: نضع prefix الـ {tenant} مرة واحدة للكل
    // Route::prefix('{tenant}')->group(function () {
        
        // مسار الشات الأساسي
        Route::get('/chat', [MessagesController::class, 'index'])->name('chatify');

        // مسارات الـ API الضرورية لعمل الشات (بدونها سيتعطل الإرسال والاستقبال)
        Route::prefix('chat/api')->group(function () {
            Route::get('/id', [MessagesController::class, 'id']);
            Route::post('/sendMessage', [MessagesController::class, 'send'])->name('send.message');
            Route::post('/fetchMessages', [MessagesController::class, 'fetch'])->name('fetch.messages');
            Route::post('/makeSeen', [MessagesController::class, 'makeSeen'])->name('messages.seen');
            Route::get('/getContacts', [MessagesController::class, 'getContacts'])->name('contacts.get');
            Route::post('/updateContactItem', [MessagesController::class, 'updateContactItem'])->name('contact.item.update');
            Route::post('/favorite', [MessagesController::class, 'favorite'])->name('make.favorite');
            Route::get('/getFavorites', [MessagesController::class, 'getFavorites'])->name('favorites.get');
            Route::post('/search', [MessagesController::class, 'search'])->name('search');
            Route::post('/sharedPhotos', [MessagesController::class, 'sharedPhotos'])->name('shared.photos');
            Route::post('/deleteConversation', [MessagesController::class, 'deleteConversation'])->name('conversation.delete');
            Route::post('/updateSettings', [MessagesController::class, 'updateSettings'])->name('avatar.update');
            Route::post('/setActiveStatus', [MessagesController::class, 'setActiveStatus'])->name('activeStatus.set');
        });
    // });
});
// روابط الـ Auth
require __DIR__.'/auth.php';
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/test-path/{tenant}', function ($tenant) {
    return "المسار مقروء، الشركة المطلوبة هي: " . $tenant;
});

