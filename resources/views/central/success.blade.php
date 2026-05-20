<x-app-layout>
    <div class="py-12">
        <div class="max-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <h2 class="text-2xl font-bold text-green-600 mb-4">🎉 تم إنشاء الشركة بنجاح!</h2>
                <p class="mb-6">يمكنك الآن التوجه إلى لوحة التحكم الخاصة بشركتك وتسجيل الدخول.</p>
                
                <a href="{{ $loginUrl }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    الذهاب لتسجيل دخول الشركة ({{ $tenant->id }})
                </a>
            </div>
        </div>
    </div>
</x-app-layout>