<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
// dd([
//     'الشركة الحالية' => tenant('id'), 
//     'قاعدة البيانات' => DB::connection()->getDatabaseName(),
//     'هل الاتصال متبدل؟' => config('database.connections.tenant.database')
// ]);
        // 1. التحقق من البيانات (ستتم في قاعدة بيانات الشركة لأننا داخل الـ Middleware)
        $request->authenticate();

        // 2. إعادة إنشاء الجلسة
        $request->session()->regenerate();

        // 3. التوجيه إلى الداشبورد (استخدم route name لضمان بقائه في الدومين الفرعي)
    // التأكد من تمرير التيننت كباراميتر للمسار وليس كـ Query String
    return redirect()->route('dashboard', ['tenant' => tenant('id')]);    
    
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
