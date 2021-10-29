<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id)
    {
        $product = Product::with(['galleries','user'])->where('slug', $id)->firstOrFail();
        $comment = Comment::where('products_id',$product->id)->with('user')->orderBy('created_at','desc')->paginate(3);

        return view('pages.detail', [
            'product' => $product,
            'comment' => $comment
        ]);
    }

    public function add(Request $request, $id)
    {

        $data = [
            'products_id' => $id,
            'qty' => $request->qty,
            'users_id'  => Auth::user()->id,
        ];

        Cart::create($data);

        return redirect()->route('cart');
    }


      public function comment(Request $request)
    {

        // dd($request->all());
        Comment::create([
            'users_id' => request()->users_id,
            'products_id' => request()->products_id,
            'konten' => request()->konten,
        ]);
        return redirect()->back()->with('success','Komentar Success !!');
    }
}
