<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Models\CartOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function pendingList()
    {
        $pending_orders = CartOrder::where('order_status', 'pending')->get();
        return view('admin.order.order_pending', compact('pending_orders'));
    }

    public function processingList()
    {
        $processing_orders = CartOrder::where('order_status', 'processing')->get();
        return view('admin.order.order_processing', compact('processing_orders'));
    }

    public function purchasedList()
    {
        $purchased_orders = CartOrder::where('order_status', 'purchased')->get();
        return view('admin.order.order_purchase', compact('purchased_orders'));
    }

    //provides order details and status
    public function details(CartOrder $details)
    {
        return view('admin.order.order_details', compact('details'));
    }

    //processes pending order
    public function processing(CartOrder $process)
    {
        $processed = $process->update([
            'order_status' => 'Processing'
        ]);

        $notification = [
            'alert' => $processed ? 'success' : 'failed',
            'message' => $processed ?  'Order Succesfully Processed' : 'Failed To Process Order',
        ];

        return  redirect(route("pending.list"))->with('notification', $notification);
    }

    //completes processing order
    public function purchasing(CartOrder $purchase)
    {
        $purchased = $purchase->update([
            'order_status' => 'Purchased'
        ]);
        $notification = [
            'alert' => $purchased ? 'success' : 'failed',
            'message' => $purchased ?  'Order Succesfully Purchased' : 'Failed To Purchase Order',
        ];
        return  redirect(route("processing.list"))->with('notification', $notification);
    }

    //Deletes completed purchased order statements
    public function statementDelete(CartOrder $delete)
    {
        $deleted = $delete->delete();
        $notification = [
            'alert' => $deleted ? 'success' : 'failed',
            'message' => $deleted ?  'Order Statement Succesfully Deleted' : 'Failed To Delete Order Statement',
        ];
        return  redirect(route("purchased.list"))->with('notification', $notification);
    }
}
