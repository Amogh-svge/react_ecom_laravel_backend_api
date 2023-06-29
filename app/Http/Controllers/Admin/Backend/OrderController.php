<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Enum\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\CartOrder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    protected CartOrder $cartOrderModel;

    /**
     * @param CartOrder $cartOrderModel
     */
    public function __construct(CartOrder $cartOrderModel)
    {
        $this->cartOrderModel = $cartOrderModel;
    }

    public function pendingList(): View
    {
        $pending_orders =  $this->cartOrderModel->orderStatus(OrderStatusEnum::PENDING)->get();
        return view('admin.order.order_pending', compact('pending_orders'));
    }

    public function processingList(): View
    {
        $processing_orders =  $this->cartOrderModel->orderStatus(OrderStatusEnum::PROCESSING)->get();
        return view('admin.order.order_processing', compact('processing_orders'));
    }

    public function purchasedList(): View
    {
        $purchased_orders =  $this->cartOrderModel->orderStatus(OrderStatusEnum::PURCHASED)->get();
        return view('admin.order.order_purchase', compact('purchased_orders'));
    }

    //provides order details and status
    public function details(CartOrder $details): View
    {
        return view('admin.order.order_details', compact('details'));
    }

    //processes pending order
    public function processing(CartOrder $process): RedirectResponse
    {
        $processed = $process->update(['order_status' => OrderStatusEnum::PROCESSING]);

        $notification = [
            'alert' => $processed ? 'success' : 'failed',
            'message' => $processed ?  'Order Succesfully Processed' : 'Failed To Process Order',
        ];

        return  redirect(route("pending.list"))->with('notification', $notification);
    }

    //completes processing order
    public function purchasing(CartOrder $purchase): RedirectResponse
    {
        $purchased = $purchase->update(['order_status' => OrderStatusEnum::PURCHASED]);

        $notification = [
            'alert' => $purchased ? 'success' : 'failed',
            'message' => $purchased ?  'Order Succesfully Purchased' : 'Failed To Purchase Order',
        ];
        return  redirect(route("processing.list"))->with('notification', $notification);
    }

    //Deletes completed purchased order statements
    public function statementDelete(CartOrder $delete): RedirectResponse
    {
        $deleted = $delete->delete();
        $notification = [
            'alert' => $deleted ? 'success' : 'failed',
            'message' => $deleted ?  'Order Statement Succesfully Deleted' : 'Failed To Delete Order Statement',
        ];
        return  redirect(route("purchased.list"))->with('notification', $notification);
    }
}
