<?php

namespace App\Http\Controllers;

use App\Models\Purchases;
use App\Models\Purchases_Details;
use App\Models\OrderStatus;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\VinylsController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function ShowOrderForm()
    {
        return view('order');
    }

    public function StoreOrder(Request $request)
    {
        $items = \Cart::getContent();
        if($items == null)
            return redirect()->route('home')->with('error', 'Koszyk jest pusty');

        if($request->user_id == null)
            return redirect()->route('home')->with('error', 'Musisz być zalogowany aby złożyć zamówienie');

        $rules = [
            'city' => 'required',
            'post_code' => 'required',
            'address' => 'required',
        ];

        
        $request->validate($rules);

        $purchase = new Purchases();
        $purchase->user_id = $request->user_id;
        $purchase->city = $request->city;
        $purchase->post_code = $request->post_code;
        $purchase->address = $request->address;
        $purchase->total_price = \Cart::getTotal();
        $purchase->save();

        $vinyls = new VinylsController();

        foreach ($items as $item) {
            $purchase_details = new Purchases_Details();
            $purchase_details->purchase_id = $purchase->id;
            $purchase_details->vinyl_id = $item['id'];
            $purchase_details->quantity = $item['quantity'];
            
            $purchase_details->save();
            $vinyls->UpdateQuantity($item['id'], $item['quantity']);
        }
        $order_status_controller = new OrderStatusController();
        $order_status_controller->CreateStatus($purchase->id, "1");
        \Cart::clear();

        return redirect()->route('home')->with('success', 'Zamówienie zostało złożone');
    }

    public function ShowOrders()
    {
        $orders = Purchases::all();
        return view('orders', ['orders' => $orders]);
    }

    public function GetOrdersOfUser($id)
    {
        $status_controller = new OrderStatusController();
        $vinyls_controller = new VinylsController();

        //take from table purchases all orders of user
        $orders = Purchases::where('user_id', $id)->get();

        foreach ($orders as $order) {
            //take status of order
            $order->status = $status_controller->GetStatus($order->id);

            //take details of order
            $order->details = Purchases_Details::where('purchase_id', $order->id)->get();

            //take vinyls of order
            foreach ($order->details as $detail) {
                $detail->vinyl = $vinyls_controller->GetVinyl($detail->vinyl_id);
            }
        }
        return view('my_account', ['orders' => $orders]);
    }

    public function GetAllOrders()
    {
        $status_controller = new OrderStatusController();
        $vinyls_controller = new VinylsController();

        //take from table purchases all orders of user
        $orders = Purchases::all();

        foreach ($orders as $order) {
            //take status of order
            $order->status = $status_controller->GetStatus($order->id);

            //take details of order
            $order->details = Purchases_Details::where('purchase_id', $order->id)->get();

            //take vinyls of order
            foreach ($order->details as $detail) {
                $detail->vinyl = $vinyls_controller->GetVinyl($detail->vinyl_id);
            }
        }
        return $orders;
    }

    public function UpdateQuantityAfterCancel($purchaseId)
    {
        $details = Purchases_Details::where('purchase_id', $purchaseId)->get();
        $vinyls_controller = new VinylsController();

        foreach ($details as $detail) {
            $vinyls_controller->UpdateQuantityAfterCancel($detail->vinyl_id, $detail->quantity);
        }
    }
}
