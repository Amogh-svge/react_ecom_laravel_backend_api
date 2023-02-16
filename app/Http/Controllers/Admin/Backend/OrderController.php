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

    public function details($id)
    {
        $details = CartOrder::find($id);
        return view('admin.order.order_details', compact('details'));
    }

    public function processing($id)
    {
        $details = CartOrder::find($id);
        $details->update([
            'order_status' => 'Processing'
        ]);
        return view('admin.order.order_details', compact('details'));
    }

    public function purchasing($id)
    {
        $details = CartOrder::find($id);
        $details->update([
            'order_status' => 'Processing'
        ]);
        return view('admin.order.order_details', compact('details'));
    }
}
