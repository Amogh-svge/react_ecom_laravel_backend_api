<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function userProfile()
    {
        $adminData = Auth::user();

        return view('admin.layout.admin_profile', compact('adminData'));
    }
}
