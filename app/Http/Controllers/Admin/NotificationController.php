<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CartOrder;
use App\Models\Notification;

use App\Notifications\PendingOrder;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // consists of all frontend and backend notification logic

    public function notificationDetail(Request $request)
    {

        $request->id == 0 ?
            $notification = Notification::all() :
            $notification = Notification::where('id', $request->id)->get();

        return $notification;
    }

    public function notifyAll()
    {
        // $order = CartOrder::where('email', auth()->user()->email)
        //     ->where('order_date', date("d-m-y"))
        //     ->where('order_status', 'Pending')->first();
        // return auth()->user()->notify(new PendingOrder($order));

        return Notification::all();
    }
}
