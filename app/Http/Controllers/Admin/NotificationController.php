<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CartOrder;
use App\Models\Notification;

use App\Notifications\PendingOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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
        $order = CartOrder::where('email', 'jakeshrestha@yahoo.com')
            ->where('order_date', date("d-m-y"))
            ->where('order_status', 'Pending')->get();

        return $prepended = Arr::add($order[0], 'count_orders', 2);
    }

    public function markAsRead($id)
    {
        if ($id) Auth::user()->notifications->where('id', $id)->markAsRead();
        return back();
    }
}
