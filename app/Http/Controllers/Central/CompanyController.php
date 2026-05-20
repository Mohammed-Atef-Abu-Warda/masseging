<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Tenant; // هذا هو الموديل الصحيح الذي يحتوي على الدوال المطلوبة

class CompanyController extends Controller
{
    public function create()
    {
        return view('central.create-company');
    }

    // public function store(Request $request)
    // {
    //     // 1. التحقق من صحة البيانات (Validation)
    //     $request->validate([
    //         'company_name' => 'required|string|max:255|unique:tenants,id',
    //     ]);

    //     // 2. تحويل الاسم إلى "Slug" (لتجنب المسافات والمشاكل في الروابط)
    //     $tenantId = Str::slug($request->company_name);

    //     // 3. إنشاء المستأجر باستخدام البيانات القادمة من الـ Request
    //     $tenant = Tenant::create([
    //         'id'   => $tenantId,
    //         'plan' => 'premium', // يمكنك جعلها تأخذ من $request->plan أيضاً
    //     ]);

    //     // 4. إنشاء الدومين بناءً على اسم الشركة
    //     $tenant->domains()->create([
    //         'domain' => $tenantId . '.localhost', 
    //     ]);

    //     return "تم إنشاء شركة {$request->company_name} بنجاح! الرابط: http://localhost:8000/{$tenantId}";
    // }

    public function store(Request $request)
{
    // أضف هذا السطر مؤقتاً للفحص:
    // dd($request->all()); 

    $validated = $request->validate([
        'company_id' => 'required|alpha|unique:tenants,id',
        'name'       => 'required|string|max:255',
        'email'      => 'required|email|max:255',
        'password'   => 'required|string|min:8',
    ]);

    try {
    // 1. إنشاء الشركة
    $tenant = \App\Models\Tenant::create(['id' => $request->company_id]);
    
    // 2. إنشاء الدومين
// الكود الصحيح لإنشاء الدومين
    $tenant->domains()->create([
        'domain' => $request->company_id // تأكد أن المفتاح هو 'domain' فقط بدون إضافات
    ]);
    // 3. أجبر لارفيل على تشغيل الهجرة فوراً مع تحديد المسار يدوياً
    \Illuminate\Support\Facades\Artisan::call('tenants:migrate', [
        '--tenants' => [$tenant->id],
        '--path' => 'database/migrations/tenant' // نحدد المسار يدوياً هنا للتأكيد
    ]);

    // 4. تنفيذ إضافة المستخدم
    $tenant->run(function () use ($request) {
        \App\Models\User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);
    });
    $companyDomain = $request->company_id . '.localhost';
    $loginUrl = url('/' . $request->company_id . '/login');

    return view('central.company-created', [
        'loginUrl' => $loginUrl,
        'companyId' => $request->company_id
    ]);

} catch (\Exception $e) {
    // إذا فشل الـ Migrate، سيعطينا الكنترولر تفاصيل أكثر الآن
    return "خطأ في التخزين: " . $e->getMessage();
}
    }
}