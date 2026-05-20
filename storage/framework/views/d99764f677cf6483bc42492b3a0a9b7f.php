<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام SaaS للمراسلات</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f3f4f6; margin: 0; padding: 0; text-align: center; }
        .hero { background-color: #ffffff; padding: 100px 20px; border-bottom: 1px solid #e5e7eb; }
        .hero h1 { color: #111827; font-size: 3rem; margin-bottom: 20px; }
        .hero p { color: #4b5563; font-size: 1.25rem; margin-bottom: 40px; }
        .btn { background-color: #2563eb; color: #ffffff; padding: 15px 30px; text-decoration: none; border-radius: 8px; font-size: 1.1rem; font-weight: bold; transition: 0.3s; }
        .btn:hover { background-color: #1d4ed8; }
    </style>
</head>
<body>

    <div class="hero">
        <h1>مرحباً بك في نظام إدارة المراسلات</h1>
        <p>النظام الأفضل لإدارة أعمالك والتواصل مع فريقك بكفاءة عالية وبمساحة عمل مستقلة تماماً.</p>
        
      <a href="/central/create-company" class="btn">.  ابدأ الآن وأنشئ شركتك.</a>
    </div>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

            <br>
            <a href="<?php echo e(session('tenant_url')); ?>" target="_blank">اضغط هنا للانتقال إلى لوحة تحكم شركتك</a>
        </div>
    <?php endif; ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\saas\my-saas-project\resources\views/welcome.blade.php ENDPATH**/ ?>