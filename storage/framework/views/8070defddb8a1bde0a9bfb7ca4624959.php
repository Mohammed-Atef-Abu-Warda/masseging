<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تم إنشاء الشركة</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md text-center max-w-md">
        <div class="text-green-500 text-6xl mb-4">✓</div>
        <h1 class="text-2xl font-bold mb-2">تم إنشاء الشركة بنجاح!</h1>
        <p class="text-gray-600 mb-6">تم إعداد قاعدة البيانات الخاصة بـ <strong><?php echo e($companyId); ?></strong> وإنشاء حساب المدير.</p>
        
        <a href="<?php echo e($loginUrl); ?>" 
           class="block w-full bg-blue-600 text-white font-bold py-3 px-4 rounded hover:bg-blue-700 transition duration-200">
            الذهاب لتسجيل الدخول في <?php echo e($companyId); ?>

        </a>
        
        <p class="mt-4 text-sm text-gray-400">الرابط: <?php echo e($loginUrl); ?></p>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\saas\my-saas-project\resources\views/central/company-created.blade.php ENDPATH**/ ?>