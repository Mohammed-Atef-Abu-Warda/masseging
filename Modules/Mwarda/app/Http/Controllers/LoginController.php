<?php

namespace Modules\Mwarda\app\Http\Controllers; // تأكد من وجود كلمة app هنا

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLoginForm()
    {
        return view('mwarda::login'); // سنقوم بإنشاء هذا الملف الآن
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mwarda::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('mwarda::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('mwarda::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
