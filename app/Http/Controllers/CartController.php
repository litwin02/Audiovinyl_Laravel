<?php

namespace App\Http\Controllers;

use App\Http\Controllers\VinylsController;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        return view('cart', compact('cartItems'));
    }
    
    public function addToCart(Request $request)
    {
        // dd($request->all());
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->title,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'title' => $request->title,
                'description' => $request->description,
                'artist_id' => $request->artist_id,
                'genre_id' => $request->genre_id,             
                'image_paths' => $request->image_paths,
                'artist_name' => $request->artist_name,
                'genre_description' => $request->genre_description
            )
            )
        );
        session()->flash('success_msg', 'Dodano winyl do koszyka!');
        return redirect()->route('cart.list');
    }

    public function updateCart(Request $request)
    {
        $vinylsController = new VinylsController();
        $vinyl = $vinylsController->getVinyl($request->id);
        if($request->quantity == 0)
        {
            \Cart::remove($request->id);
            session()->flash('success', 'Usunięto winyl z koszyka!');
            return redirect()->route('cart.list');
        }
        if($request->quantity > 10)
        {
            session()->flash('error', 'Nie można dodać więcej niż 10 sztuk tego samego winyla!');
            return redirect()->route('cart.list');
        }
        if($request->quantity < 0)
        {
            session()->flash('error', 'Nie można dodać ujemnej liczby sztuk winyla!');
            return redirect()->route('cart.list');
        }
        if($request->quantity == null || $request->quantity == "")
        {
            session()->flash('error', 'Nie można dodać pustej liczby sztuk winyla!');
            return redirect()->route('cart.list');
        }
        if($vinyl->quantity < $request->quantity)
        {
            session()->flash('error', 'Nie można dodać więcej sztuk winyla niż jest dostępnych!');
            return redirect()->route('cart.list');
        }
        \Cart::update($request->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity
            ),
        ));
        session()->flash('success_msg', 'Zaktualizowano koszyk!');
        return redirect()->route('cart.list');
    }

    public function removeItem(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success_msg', 'Usunięto winyl z koszyka!');
        return redirect()->route('cart.list');
    }

    public function clearCart()
    {
        \Cart::clear();
        session()->flash('success_msg', 'Wyczyszczono koszyk!');
        return redirect()->route('cart.list');
    }
}
