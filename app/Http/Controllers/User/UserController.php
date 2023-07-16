<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function user()
    {
        return Auth::user();
    }

    public function dashboard(): View
    {
        return view('admin.layout.index');
    }
}
