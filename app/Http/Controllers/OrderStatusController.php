<?php

namespace App\Http\Controllers;

use App\Http\Controllers\OrdersController;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    public function GetStatus($purchaseId)
    {
        $orderStatus = OrderStatus::where('purchase_id', $purchaseId)->get();
        return $orderStatus;
    }

    public function CreateStatus($id, $status)
    {
        $orderStatus = new OrderStatus();
        $orderStatus->purchase_id = $id;
        $orderStatus->status = $status;
        $orderStatus->save();
    }

    public function UpdateStatus($id, $status)
    {
        $orderStatus = OrderStatus::where('purchase_id', $id)->first();
        $orderStatus->status = $status;
        $orderStatus->save();
    }

    public function CancelOrder(Request $request)
    {
        $purchaseId = $request->order_id;
        $orderController = new OrdersController();
        $orderController->UpdateQuantityAfterCancel($purchaseId);
        
        $orderStatus = OrderStatus::where('purchase_id', $purchaseId)->first();
        $orderStatus->status = '0';
        $orderStatus->save();
        return redirect()->route('home')->with('success', 'Zamówienie zostało anulowane');
    }

    public function ConfirmOrder(Request $request)
    {
        $purchaseId = $request->order_id;
        $orderStatus = OrderStatus::where('purchase_id', $purchaseId)->first();
        $orderStatus->status = '2';
        $orderStatus->save();
        return redirect()->route('admin.orders')->with('success', 'Zamówienie zostało sfinalizowane');
    }

}
