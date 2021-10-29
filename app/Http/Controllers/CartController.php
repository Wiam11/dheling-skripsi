<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use illuminate\support\Facades\Auth;

class CartController extends Controller
{
   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $carts = Cart::with(['product.galleries','user'])->where('users_id' , Auth::user()->id)->get();

        // dd($provinsi);

         $totalWeight = 0;
            foreach($carts as $cart){
            $weight = $cart->product->weight * $cart->qty;
            $totalWeight = $totalWeight + $weight;
        }


        return view('pages.cart' ,[
            'carts' => $carts,
            'totalWeight' => $totalWeight
        ]);


    }

   public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect()->route('cart');

    }

    public function success()
    {
        return view('pages.success');
    }
}
