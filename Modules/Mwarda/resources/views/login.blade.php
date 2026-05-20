<form action="{{ route('login') }}" method="POST">
    @csrf
    <h1>تسجيل دخول شركة: {{ tenant('id') }}</h1>
    <input type="email" name="email" placeholder="البريد الإلكتروني">
    <input type="password" name="password" placeholder="كلمة المرور">
    <button type="submit">دخول</button>
</form>