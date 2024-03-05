<?php

namespace App\Http\Controllers;

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BasicController extends Controller
{
    public function returnAboutPage(){
        return view('about');
    }

    public function returnContactPage(){
        return view('contact');
    }

    public function zmienStanUwierzytelnienia(){
        if(auth()->check()){
            $user = auth()->user();
            Auth::logout();
            return view('logout');
        }
        else{
            return redirect('/login');
        }
    }
    public function returnRegisterPage(){
        return view('auth.register');
    }

    public function returnMyOrdersPage(){
        return view('myOrders');
    }

    public function returnMyAccountPage(){
        $orderController = new OrderController();
        $orders_of_user = $orderController->getOrdersOfUser(Auth::user()->id);
        return view('my_account', ['orders_of_user' => $orders_of_user]);
    }
}
