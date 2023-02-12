<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notificationDetail(Request $request)
    {

        $request->id == 0 ?
            $notification = Notification::all() :
            $notification = Notification::where('id', $request->id)->get();

        return $notification;
    }
}
