<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل شركة جديدة - SaaS</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; padding-top: 50px; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 400px; text-align: center; }
        input[type="text"] { width: 90%; padding: 10px; margin: 15px 0; border: 1px solid #ccc; border-radius: 4px; }
        button { background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #0056b3; }
        .success { color: green; margin-bottom: 15px; }
    </style>
</head>
<body>

    <div class="card">
        <h2>إضافة شركة جديدة للنظام</h2>
        <p>سيتم إنشاء مساحة عمل وقاعدة بيانات منفصلة للشركة.</p>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
            <a href="{{ session('tenant_url') }}" target="_blank">الدخول لنظام الشركة</a>
        @endif

        <form action="{{ route('company.store') }}" method="POST">
            @csrf
            <h3>بيانات الشركة</h3>
            <input type="text" name="company_id" placeholder="اسم الشركة (مثلاً: mwarda)" required>

            <hr>
            <h3>بيانات مدير النظام (Admin)</h3>
            <input type="text" name="name" placeholder="اسم المدير" required>
            <input type="email" name="email" placeholder="الإيميل الخاص بالمدير" required>
            <input type="password" name="password" placeholder="كلمة المرور" required>
            
            <button type="submit">إنشاء الشركة والمدير</button>
        </form>
    </div>
@if ($errors->any())
    <div style="background: #fee2e2; color: #dc2626; padding: 10px; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>